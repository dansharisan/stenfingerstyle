<?php
/*
 Plugin Name: Kento Post View Counter
 Plugin URI: http://kentothemes.com
 Description: Post or page view counter By City or Country or Date
 Version: 2.7
 Author: KentoThemes
 Author URI: http://kentothemes.com
 License: GPLv2 or later
 License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


require_once( plugin_dir_path( __FILE__ ) . 'includes/geoplugin.class.php');

define('KENTO_PVC_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
function kento_pvc_latest_jquery() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('kento_pvc_js', plugins_url( '/js/kento-pvc.js' , __FILE__ ) , array( 'jquery' ));
	wp_localize_script( 'kento_pvc_js', 'kento_pvc_ajax', array( 'kento_pvc_ajaxurl' => admin_url( 'admin-ajax.php')));
	wp_enqueue_style('kento-like-post-style', KENTO_PVC_PLUGIN_PATH.'css/style.css');
	wp_enqueue_style('kento-like-post-date-style', KENTO_PVC_PLUGIN_PATH.'css/jquery-ui.css');
	wp_enqueue_script('google-chart-jsapi', plugins_url( '/js/google-chart-jsapi.js' , __FILE__ ) , array( 'jquery' ));



}
add_action('init', 'kento_pvc_latest_jquery');




register_activation_hook(__FILE__, 'kento_pvc_install');
register_uninstall_hook(__FILE__, 'kento_pvc_drop');


function kento_pvc_install()
{
	global $wpdb;
	$sql = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "kento_pvc"
	."( UNIQUE KEY id (id),
					id int(100) NOT NULL AUTO_INCREMENT,
					postid  int(10) NOT NULL,
					count  int(10) NOT NULL)";
	$wpdb->query($sql);

	$sql2 = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "kento_pvc_info"
	."( UNIQUE KEY id (id),
					id int(100) NOT NULL AUTO_INCREMENT,
					postid  int(10) NOT NULL,
					count  int(10) NOT NULL,
					date DATE NOT NULL)";
	$wpdb->query($sql2);

	$sql3 = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "kento_pvc_city"
	."( UNIQUE KEY id (id),
					id int(100) NOT NULL AUTO_INCREMENT,
					postid  int(10) NOT NULL,
					ip  int(10) NOT NULL,
					city varchar(100) NOT NULL,
					country varchar(100) NOT NULL,
					datetime datetime NOT NULL,
					referer VARCHAR( 100 ) NOT NULL)";
	$wpdb->query($sql3);

}




function kento_pvc_drop() {
	if ( get_option('kento_pvc_deletion') == 1 ) {

		global $wpdb;
		$table = $wpdb->prefix . "kento_pvc";
		$wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'kento_pvc');
	}
}




function kento_pvc_by_date()
{
	$date = $_POST['date'];

	// if date is not valid form submission then query with current date(date('Y-m-d'))
	if (strtotime($date) !== false)
	{
		$date=$date;
	}
	else
	{
		$date = date('Y-m-d');
	}





	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc_info";
	$result = $wpdb->get_results("SELECT * FROM $table WHERE date = '$date' ORDER BY count DESC LIMIT 12", ARRAY_A);
	$total_rows = $wpdb->num_rows;
	if($total_rows>0)
	{


		?>

<br />
<table class='kento-pvc-top-post widefat'>
	<thead>
		<tr>
			<th scope="col" class="manage-column column-name" style=""><strong>View
					Count</strong></th>
			<th scope="col" class="manage-column column-name" style=""><strong>Post
					Title</strong></th>
		</tr>
	</thead>


	<?php

	$i=0;
	while($total_rows>$i)
	{
		echo "<tr><td>";
		echo $result[$i]['count'];
		echo "</td>";
		echo "<td class='post-title'>";
		$postid= $result[$i]['postid'];
			
		echo '<a href="'.get_permalink( $postid ).'" >'.get_the_title( $postid ).'</a>';

		echo "</td>";
		echo "</tr>";
		$i++;
	}
	echo "</table>";
	}
	else
	{
		echo "<br /><span class='no-result'>Result Not Found in This Date</span>";
	}


	die();
	return true;

}



add_action('wp_ajax_kento_pvc_by_date', 'kento_pvc_by_date');
add_action('wp_ajax_nopriv_kento_pvc_by_date', 'kento_pvc_by_date');


function kento_pvc_by_city()
{
	$postid = (int)$_POST['postid'];
	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc_city";
	$result = $wpdb->get_results("SELECT * FROM $table WHERE postid=$postid ORDER BY datetime DESC LIMIT 12", ARRAY_A);
	$total_rows = $wpdb->num_rows;
	echo "Title: <strong>".get_the_title($postid)."</strong>";
	?>
	<br />
	<br />
	<table class='pvc-top-post widefat'>
		<thead>
			<tr>
				<th scope="col" class="manage-column column-name" style=""><strong>City</strong>
				</th>
				<th scope="col" class="manage-column column-name" style=""><strong>Country</strong>
				</th>
				<th scope="col" class="manage-column column-name" style=""><strong>Date
						& Time</strong></th>
				<th scope="col" class="manage-column column-name" style=""><strong>Referer</strong>
				</th>
			</tr>
		</thead>
		<?php

		$i=0;
		while($total_rows>$i)
		{
			echo "<tr><td>";
			echo $result[$i]['city'];
			echo "</td>";
			echo "<td>";
			echo $result[$i]['country'];
			echo "</td>";
			echo "<td>";
			echo $result[$i]['datetime'];
			echo "</td>";
			echo "<td>";
			echo $result[$i]['referer'];
			echo "</td>";
			echo "</tr>";

			$i++;
		}
		echo "</table>";



		die();
		return true;


}
add_action('wp_ajax_kento_pvc_by_city', 'kento_pvc_by_city');
add_action('wp_ajax_nopriv_kento_pvc_by_city', 'kento_pvc_by_city');







function kento_pvc_top_geo()
{

	if(isset($_POST['kento_pvc_geo']))
	{
		$geo = $_POST['kento_pvc_geo'];
	}
	if(empty($geo))
	{
		$geo ="country";
	}
	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc_city";
	$result = $wpdb->get_results("SELECT $geo FROM $table GROUP BY $geo ORDER BY COUNT($geo) DESC LIMIT 10", ARRAY_A);
	$total_rows = $wpdb->num_rows;

	$count_country = $wpdb->get_results("SELECT country, COUNT(*) AS country FROM $table GROUP BY country ORDER BY COUNT(country) DESC LIMIT 10", ARRAY_A);

	$count_city = $wpdb->get_results("SELECT city, COUNT(*) AS city FROM $table GROUP BY city ORDER BY COUNT(city) DESC LIMIT 10", ARRAY_A);

	$top_geo ="";
	$top_geo.= "<table class='pvc-top-referer widefat'>";
	$top_geo.= "<thead><tr>";
	$top_geo.= "<th scope='col' class='manage-column column-name' ><strong>Rank</strong></th>";
	$top_geo.= "<th scope='col' class='manage-column column-name' ><strong>".ucfirst($geo)."</strong></th>";
	$top_geo.= "<th scope='col' class='manage-column column-name' ><strong>Count</strong></th>";
	$top_geo.= "</tr></thead>";
	$top_geo.= "<tfoot><tr>";
	$top_geo.= "<th scope='col' class='manage-column column-name' ><strong>Rank</strong></th>";
	$top_geo.= "<th scope='col' class='manage-column column-name' ><strong>".ucfirst($geo)."</strong></th>";
	$top_geo.= "<th scope='col' class='manage-column column-name' ><strong>Count</strong></th>";
	$top_geo.= "</tr></tfoot>";


	$i=0;
	$j=1;
	while($total_rows>$i)
	{
		if($result[$i][$geo]=="none" || $result[$i][$geo]==NULL || $result[$i][$geo]==""  )
		{

		}
		else
		{

			$top_geo.= "<tr><td>".$j."</td><td>";
			$top_geo.= $result[$i][$geo];
			$top_geo.= "</td><td>";
			if($geo=="country")
			{
				$top_geo.= 	$count_country[$i]['country'];
			}
			elseif($geo=="city")
			{
				$top_geo.= 	$count_city[$i]['city'];
			}

			$top_geo.= "</td></tr>";
			$j++;
		}

		$i++;
	}

	$top_geo.= "</table>";


	echo $top_geo;

	if(isset($_POST['kento_pvc_geo']))
	{
			
		die();
	}





}

add_action('wp_ajax_kento_pvc_top_geo', 'kento_pvc_top_geo');
add_action('wp_ajax_nopriv_kento_pvc_top_geo', 'kento_pvc_top_geo');





////////////////////////////
function kento_pvc_top_geo_map($geo)
{




	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc_city";
	$result = $wpdb->get_results("SELECT $geo FROM $table GROUP BY $geo ORDER BY COUNT($geo) DESC LIMIT 20", ARRAY_A);
	$total_rows = $wpdb->num_rows;




	if($geo=="country")
	{
		$count_country = $wpdb->get_results("SELECT country, COUNT(*) AS country FROM $table GROUP BY country ORDER BY COUNT(country) DESC LIMIT 20", ARRAY_A);
	}
	elseif($geo=="city")
	{
		$count_city = $wpdb->get_results("SELECT city, COUNT(*) AS city FROM $table GROUP BY city ORDER BY COUNT(city) DESC LIMIT 20", ARRAY_A);
	}



	$top_geo ="";



	$i=0;

	while($total_rows>$i)
	{
		if($result[$i][$geo]=="none" || $result[$i][$geo]==NULL || $result[$i][$geo]==""  )
		{

		}
		else
		{

			$top_geo.= "['".$result[$i][$geo]."',";


			if($geo=="country")
			{
				$top_geo.= 	$count_country[$i]['country'];
			}
			elseif($geo=="city")
			{
				$top_geo.= 	$count_city[$i]['city'];
			}
			$top_geo.= "],";

		}

		$i++;
	}



	return $top_geo;


}











































function kento_pvc_display($cont){




	$kento_pvc_posttype = get_option( 'kento_pvc_posttype' );


	if($kento_pvc_posttype==NULL)
	{
		$type ="none";
	}
	else
	{
		$type = "";
		foreach ( $kento_pvc_posttype as  $post_type => $post_type_value )
		{

			$type .= $post_type.",";
		}
	}


	if(is_singular(explode(',',$type))){

		$post_id = get_the_id();




		$cookie_nam = "kentopvc_".$post_id;

		if (isset($_COOKIE[$cookie_nam]))
		{

			$visited = "yes";
			$kento_pvc_uniq = get_option( 'kento_pvc_uniq' );

			if (empty($kento_pvc_uniq))
			{
				$visited = "no";
			}


		}
		else
		{

			?>
		<script>
			document.cookie="<?php echo $cookie_nam ?>=yes";
			</script>

			<?php

			$visited = "no";
		}



		if($visited=="yes")
		{

		}
		elseif($visited=="no")
		{



			global $wpdb;
			$table = $wpdb->prefix . "kento_pvc";

			$result = $wpdb->get_results("SELECT count FROM $table WHERE postid = $post_id", ARRAY_A);
			if(empty($result[0]['count']))
			{
				$view_count = 0;
			}
			else
			{
				$view_count = $result[0]['count'];
			}


			$already_insert = $wpdb->num_rows;





			if($already_insert > 0 )
			{
				$wpdb->query("UPDATE $table SET count = count+1 WHERE postid = '$post_id'");
			}
			else
			{
				$wpdb->query( $wpdb->prepare("INSERT INTO $table
										( id, postid, count )
								VALUES	( %d, %d, %d )",
				array	( '', $post_id,1)
				));
			}


			$date = date('Y-m-d', strtotime('+'.get_option('gmt_offset').' hour'));

			global $wpdb;
			$table = $wpdb->prefix . "kento_pvc_info";

			$result = $wpdb->get_results("SELECT * FROM $table WHERE date = '$date' AND postid = $post_id", ARRAY_A);
			$already_insert = $wpdb->num_rows;

			if($already_insert > 0 )
			{
				global $wpdb;
				$table = $wpdb->prefix . "kento_pvc_info";
				$wpdb->query("UPDATE $table SET count = count+1 WHERE (date = '$date') AND (postid = $post_id)");
					

			}
			else
			{
					
					
					
				global $wpdb;
				$table = $wpdb->prefix."kento_pvc_info";
				$wpdb->query( $wpdb->prepare("INSERT INTO $table
										( id, postid, count, date )
								VALUES	( %d, %d, %d, %s)",
				array	( '', $post_id, 1, $date)
				));
					
					

			}

			$ip = $_SERVER['REMOTE_ADDR'];


			/*


			$content = file_get_contents("http://www.geoplugin.net/xml.gp?ip=".$ip);
			preg_match('/<geoplugin_city>(.*)/i', $content, $matches);
			$city = !empty($matches[1]) ? $matches[1] : 0;
			$city = substr($city,0,-17);

			if($city == "")
			{
			$city = "none";
			}
			else
			{
			$city = $city;
			}



			preg_match('/<geoplugin_countryName>(.*)/i', $content, $matches);
			$country= !empty($matches[1]) ? $matches[1] : 0;
			$country = substr($country,0,-24);

			if($country == ""){
			$country = "none";}
			else {
			$country = $country;
			}




			*/



			$geoplugin = new geoPlugin();
			$geoplugin->locate();
			$city = $geoplugin->city;
			$country = $geoplugin->countryName;



			if($country == ""){
				$country = "none";}
				else {
					$country = $country;
				}


				if($city == "")
				{
					$city = "none";
				}
				else
				{
					$city = $city;
				}





				global $wpdb;
				$table = $wpdb->prefix."kento_pvc_city";
				$post_id = get_the_id();

				$datetime = date('Y-m-d H:i:s', strtotime('+'.get_option('gmt_offset').' hour'));

				$referer = get_referer($_SERVER["HTTP_REFERER"]);
				$wpdb->query( $wpdb->prepare("INSERT INTO $table
								( id, postid, ip, city, country, datetime, referer )
						VALUES	( %d, %d, %s, %s, %s, %s, %s)",
				array	( '', $post_id, $ip, $city, $country, $datetime, $referer)
				));


		} // end of $visited if


		global $wpdb;
		$table = $wpdb->prefix . "kento_pvc";
		$result = $wpdb->get_results("SELECT count FROM $table WHERE postid = $post_id", ARRAY_A);

		if(empty($result[0]['count']))
		{
			$view_count=0;
		}
		else
		{
			$view_count = $result[0]['count'];

		}



		$kento_pvc_today_text = get_option( 'kento_pvc_today_text' );
		$kento_pvc_total_text = get_option( 'kento_pvc_total_text' );


		if(!empty($kento_pvc_today_text))
		{
			$kento_pvc_today_text = $kento_pvc_today_text;
		}
		else
		{
			$kento_pvc_today_text = "Views Today ";
		}

		if(!empty($kento_pvc_total_text))
		{
			$kento_pvc_total_text = $kento_pvc_total_text;
		}
		else
		{
			$kento_pvc_total_text = "Total Views ";
		}


		$cont.= "<div id='kento-pvc'><span class='kento-pvc-total'> ".kento_pvc_convert_lang($view_count)." ".$kento_pvc_total_text."</span> <span class='kento-pvc-today'>".kento_pvc_convert_lang(kento_pvc_today_total())." ".$kento_pvc_today_text."</span>";
		$cont.=  "</div>";



		return $cont;


	}
	else
	{
		return $cont;
	}

}

add_filter('the_content', 'kento_pvc_display');




function get_referer($url)
{
	$pieces = parse_url($url);
	$domain = isset($pieces['host']) ? $pieces['host'] : '';
	if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
		return $regs['domain'];
	}
	return "None";
}









function kento_pvc_today_total()
{

	$date = date('Y-m-d', strtotime('+'.get_option('gmt_offset').' hour'));

	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc_info";
	$post_id = get_the_id();
	$result = $wpdb->get_results("SELECT * FROM $table WHERE postid = '$post_id' AND date='$date'", ARRAY_A);

	if(empty($result[0]['count']))
	{
		$view_count = 0;
	}
	else
	{
		$view_count = $result[0]['count'];
	}

	return $view_count;

}





function kento_pvc_style()
{
	$kento_pvc_hide = get_option( 'kento_pvc_hide' );
	if($kento_pvc_hide==1)
	{
		echo "<style type='text/css'>";

		echo "#kento-pvc{
			display:none;
			
			}";

		echo "</style>";
	}
}

add_filter('wp_head', 'kento_pvc_style');


function kpvc_display_single($atts,  $content = null ) {
	$atts = shortcode_atts(
	array(
				'today' => "yes",				
				'total' => "yes",
	), $atts);


	$post_id = get_the_ID();
	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc";
	$result = $wpdb->get_results("SELECT count FROM $table WHERE postid = $post_id", ARRAY_A);


	if(empty($result[0]['count']))
	{
		$view_count=0;
	}
	else
	{
		$view_count = $result[0]['count'];
	}




	$kento_pvc_today_text = get_option( 'kento_pvc_today_text' );
	$kento_pvc_total_text = get_option( 'kento_pvc_total_text' );


	if(!empty($kento_pvc_today_text))
	{
		$kento_pvc_today_text = $kento_pvc_today_text;
	}
	else
	{
		$kento_pvc_today_text = "Views Today ";
	}

	if(!empty($kento_pvc_total_text))
	{
		$kento_pvc_total_text = $kento_pvc_total_text;
	}
	else
	{
		$kento_pvc_total_text = "Total Views ";
	}

	$kpvc = "";
	$kpvc.= "<div id='kento-pvc-single'>";

	if($atts['total']=="yes")
	{
		$kpvc.= "<span class='kento-pvc-total'> ".kento_pvc_convert_lang($view_count)." ".$kento_pvc_total_text." </span>";
	}

	if($atts['today']=="yes")
	{
		$kpvc.= "<span class='kento-pvc-today'>".kento_pvc_convert_lang(kento_pvc_today_total())." ".$kento_pvc_today_text."</span>";

	}

	$kpvc.=  "</div>";



	return $kpvc;


}

add_shortcode('kpvc_single', 'kpvc_display_single');







function kento_pvc_top_referer()
{

	global $wpdb;
	$table = $wpdb->prefix."kento_pvc_city";

	if(isset($_POST['kpvc_date_referer']))
	{
		$date = $_POST['kpvc_date_referer'];
	}

	if(isset($date))
	{
		$result = $wpdb->get_results("SELECT referer FROM $table WHERE datetime LIKE '$date%' GROUP BY referer ORDER BY COUNT(referer) DESC LIMIT 10", ARRAY_A);
		$total_rows = $wpdb->num_rows;

		$count = $wpdb->get_results("SELECT referer, COUNT(*) AS referer FROM $table WHERE datetime LIKE '$date%' GROUP BY referer ORDER BY COUNT(referer) DESC LIMIT 10", ARRAY_A);

	}
	else
	{
		$result = $wpdb->get_results("SELECT referer FROM $table GROUP BY referer ORDER BY COUNT(referer) DESC LIMIT 10", ARRAY_A);
		$total_rows = $wpdb->num_rows;

		$count = $wpdb->get_results("SELECT referer, COUNT(*) AS referer FROM $table GROUP BY referer ORDER BY COUNT(referer) DESC LIMIT 10", ARRAY_A);
	}



	$referer = "";
	if(isset($date))
	{
		$referer.= "Top Referer in Date: ".$date."<br /><br />";
	}
	else
	{
		$referer.= "Top Referer from Start Date:<br /><br />";





	}



	$referer.= "<table class='pvc-top-referer widefat'>";
	$referer.= "<thead><tr>";
	$referer.= "<th scope='col' class='manage-column column-name' ><strong>Rank</strong></th>";
	$referer.= "<th scope='col' class='manage-column column-name' ><strong>Domain Name</strong></th>";
	$referer.= "<th scope='col' class='manage-column column-name' ><strong>Count</strong></th>";
	$referer.= "</tr></thead>";

	$referer.= "<tfoot><tr>";
	$referer.= "<th scope='col' class='manage-column column-name' ><strong>Rank</strong></th>";
	$referer.= "<th scope='col' class='manage-column column-name' ><strong>Domain Name</strong></th>";
	$referer.= "<th scope='col' class='manage-column column-name' ><strong>Count</strong></th>";
	$referer.= "</tr></tfoot>";

	if(empty($total_rows))
	{
		$referer.= "<tr><td colspan='2'>";
		$referer.= "<span class='no-result'>No Result Found.</span>";
		$referer.= "</td></tr>";
	}
	$i=0;
	$j=1;
	while($total_rows>$i)
	{
			
		$domain = get_option('siteurl'); //or home
		$domain = str_replace('http://', '', $domain);
		$domain = str_replace('www', '', $domain); //add the . after the www if you don't want it


			
			
			
		if($result[$i]['referer']=="None" || $result[$i]['referer']==NULL || $result[$i]['referer']==$domain )
		{

		}
		else
		{

			$referer.= "<tr><td>".$j."</td><td>";


			$referer.= "<a href='http://".$result[$i]['referer']."' >";
			$referer.= $result[$i]['referer'];
			$referer.= "</a>";
			$referer.= "</td>";
			$referer.= "<td>";
			$referer.= 	$count[$i]['referer'];
			$referer.= "</td></tr>";
			$j++;
		}

		$i++;
	}

	$referer.= "</table>";


	echo $referer;

	if(isset($date))
	{
			
		die();
	}


}

add_action('wp_ajax_kento_pvc_top_referer', 'kento_pvc_top_referer');
add_action('wp_ajax_nopriv_kento_pvc_top_referer', 'kento_pvc_top_referer');













function kpvc_display_loop($atts) {
	$atts = shortcode_atts(
	array(
				'today' => "yes",
				'total' => "yes",
				'post_id' => "",


	), $atts);

	$kento_pvc_today_text = get_option( 'kento_pvc_today_text' );
	$kento_pvc_total_text = get_option( 'kento_pvc_total_text' );


	if(!empty($kento_pvc_today_text))
	{
		$kento_pvc_today_text = $kento_pvc_today_text;
	}
	else
	{
		$kento_pvc_today_text = "Views Today ";
	}

	if(!empty($kento_pvc_total_text))
	{
		$kento_pvc_total_text = $kento_pvc_total_text;
	}
	else
	{
		$kento_pvc_total_text = "Total Views ";
	}



	$post_id = $atts['post_id'];
	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc";
	$result = $wpdb->get_results("SELECT count FROM $table WHERE postid = $post_id", ARRAY_A);

	if(empty($result[0]['count']))
	{
		$view_count = 0;
	}
	else
	{
		$view_count = $result[0]['count'];
	}

	$kpvc = "";
	$kpvc.= "<div id='kento-pvc-loop'>";
	if($atts['total']=="yes")
	{
		//Original
		//$kpvc.= "<span class='kento-pvc-total'>".($view_count)." ".$kento_pvc_total_text." </span>";
		//Modded by Sten Le
		$kpvc.= "<span>".($view_count)."</span>";
			
	}
	if($atts['today']=="yes")
	{

		$kpvc.= "<span class='kento-pvc-today'>".kento_pvc_today_total()." ".$kento_pvc_today_text." </span>";
	}
	$kpvc.=  "</div>";




	echo $kpvc;


}


add_shortcode('kpvc_loop', 'kpvc_display_loop');







function kento_pvc_convert_lang($input) {


	$kento_pvc_numbers_lang = get_option( 'kento_pvc_numbers_lang' );
	if(empty($kento_pvc_numbers_lang))
	{
		$kento_pvc_numbers_lang = '0,1,2,3,4,5,6,7,8,9';
	}

	$bn_digits=explode(",",$kento_pvc_numbers_lang);
	return $output = str_replace(range(0, 9),$bn_digits, $input);
}











function kpvc_widget_geo($atts)
{

	$atts = shortcode_atts(
	array(
				'geo' => "",
				'width' => "300px",				
				'height' => "150px",					


	), $atts);



	if($atts['geo']=="country")
	{

		$widget_geo.= "";
		$widget_geo.= '<div class="kpvc-widget-geo">';

		$widget_geo.=  "<script type='text/javascript'>
				 google.load('visualization', '1', {'packages': ['geochart']});
				 google.setOnLoadCallback(drawRegionsMap);
				  function drawRegionsMap() {
					var data = google.visualization.arrayToDataTable([
					  ['Country', 'Visitors Count'],";
		$widget_geo.= kento_pvc_top_geo_map("country");
		$widget_geo.=  "]);
			
					var options = {
						colorAxis: {colors: ['#ffdb84', '#2bea89']}
						};
			
					var chart = new google.visualization.GeoChart(document.getElementById('kpvc-widget-country'));
					chart.draw(data, options);
				};
				</script>";
		$widget_geo.=  '<div id="kpvc-widget-country" style="width: '.$atts['width'].'; height: '.$atts['height'].';"></div>';

		$widget_geo.=  '</div>';

	}


	elseif($atts['geo']=="city")
	{

		$widget_geo.= "";
		$widget_geo.= '<div class="kpvc-widget-geo">';
		$widget_geo.=  "<script type='text/javascript'>
					 google.load('visualization', '1', {'packages': ['geochart']});
					 google.setOnLoadCallback(drawMarkersMap);
				
					  function drawMarkersMap() {
					  var data = google.visualization.arrayToDataTable([
						['City', 'Count'],";

		$widget_geo.= kento_pvc_top_geo_map("city");

		$widget_geo.=  "]);
				
					  var options = {
						displayMode: 'markers',
						colorAxis: {colors: ['green', 'blue']}
					  };
				
					  var chart = new google.visualization.GeoChart(document.getElementById('kpvc-widget-city'));
					  chart.draw(data, options);
					};
					</script>";
			
		$widget_geo.=  '<div id="kpvc-widget-city" style="width: '.$atts['width'].'; height: '.$atts['height'].';"></div>';

	}
	return $widget_geo;


}

add_shortcode('kpvc_widget_geo', 'kpvc_widget_geo');













///////////////////////////////////////

////////////////////////////////////////////////////////////

add_action('admin_init', 'kento_pvc_init' );
add_action('admin_menu', 'kento_pvc_menu');

function kento_pvc_init(){
	register_setting( 'kento_pvc_plugin_options', 'kento_pvc_hide');
	register_setting( 'kento_pvc_plugin_options', 'kento_pvc_posttype');
	register_setting( 'kento_pvc_plugin_options', 'kento_pvc_numbers_lang');
	register_setting( 'kento_pvc_plugin_options', 'kento_pvc_today_text');
	register_setting( 'kento_pvc_plugin_options', 'kento_pvc_total_text');
	register_setting( 'kento_pvc_plugin_options', 'kento_pvc_uniq');
}


function kento_pvc_menu() {
	add_menu_page(__('Kento Post View Counter Settings','kentopvc'), __('Kento PVC','kentopvc'), 'manage_options', 'kentopvc_settings', 'kento_pvc_settings');

	add_submenu_page('kentopvc_settings', __('Kento PVC Stats','kentopvc'), __('Stats','kentopvc'), 'manage_options', 'kento_pvc_settings_stats', 'kento_pvc_settings_stats');

	add_submenu_page('kentopvc_settings', __('Kento PVC Stats Geo','kentopvc'), __('Stats Geo','kentopvc'), 'manage_options', 'kento_pvc_settings_stats_geo', 'kento_pvc_settings_stats_geo');

}


function kento_pvc_settings(){
	include('kento-pvc-admin.php');
}

function kento_pvc_settings_stats(){
	include('kento-pvc-admin-stats.php');
}

function kento_pvc_settings_stats_geo(){
	include('kento-pvc-admin-stats-geo.php');
}










?>