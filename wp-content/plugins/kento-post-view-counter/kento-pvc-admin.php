<?php

if(empty($_POST['kentopvc_hidden']))
{
	$kento_pvc_hide = get_option( 'kento_pvc_hide' );
	$kento_pvc_posttype = get_option( 'kento_pvc_posttype' );
	$kento_pvc_numbers_lang = get_option( 'kento_pvc_numbers_lang' );
	$kento_pvc_today_text = get_option( 'kento_pvc_today_text' );
	$kento_pvc_total_text = get_option( 'kento_pvc_total_text' );
	$kento_pvc_uniq = get_option( 'kento_pvc_uniq' );
}
else
{
		

	if($_POST['kentopvc_hidden'] == 'Y') {
		//Form data sent
		if(empty($_POST['kento_pvc_hide']))
		{
			$kento_pvc_hide ="";
		}
		else
		{
			$kento_pvc_hide = $_POST['kento_pvc_hide'];
		}
		update_option('kento_pvc_hide', $kento_pvc_hide);



		if(empty($_POST['kento_pvc_posttype']))
		{
			$kento_pvc_posttype ="";
		}
		else
		{
			$kento_pvc_posttype = $_POST['kento_pvc_posttype'];
		}
		update_option('kento_pvc_posttype', $kento_pvc_posttype);
			
			
			
		if(empty($_POST['kento_pvc_uniq']))
		{
			$kento_pvc_uniq ="";
		}
		else
		{
			$kento_pvc_uniq = $_POST['kento_pvc_uniq'];
		}
		update_option('kento_pvc_uniq', $kento_pvc_uniq);
			


		$kento_pvc_numbers_lang = $_POST['kento_pvc_numbers_lang'];
		update_option('kento_pvc_numbers_lang', $kento_pvc_numbers_lang);

		$kento_pvc_today_text = $_POST['kento_pvc_today_text'];
		update_option('kento_pvc_today_text', $kento_pvc_today_text);

		$kento_pvc_total_text = $_POST['kento_pvc_total_text'];
		update_option('kento_pvc_total_text', $kento_pvc_total_text);

		?>
<div class="updated">
	<p>
		<strong><?php _e('Changes Saved.' ); ?> </strong>
	</p>
</div>

		<?php
	}
}
?>


<div class="wrap">
	<div id="icon-tools" class="icon32">
		<br>
	</div>
	<?php echo "<h2>".__('Kento Post View Counter Settings')."</h2>";?>
	<form method="post"
		action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="kentopvc_hidden" value="Y">
		<?php settings_fields( 'kento_pvc_plugin_options' );
		do_settings_sections( 'kento_pvc_plugin_options' );
			
		?>

		<table class="form-table">

			<tr valign="top">
				<th scope="row">Hide Count on Post</th>
				<td style="vertical-align: middle;"><input type="checkbox"
					name="kento_pvc_hide" id="kento-pvc-hide" value="1"
					<?php if (  $kento_pvc_hide==1 ) echo "checked"; ?>> ** this will
					hide post count on single content but still can record data.</td>
			</tr>

			<tr valign="top">
				<th scope="row">Unique Count</th>
				<td style="vertical-align: middle;"><input type="checkbox"
					name="kento_pvc_uniq" id="kento-pvc-uniq" value="1"
					<?php if (  $kento_pvc_uniq==1 ) echo "checked"; ?>> ** Check for
					only trace unique post view counter.</td>
			</tr>


			<tr valign="top">
				<th scope="row">Trace These Post Type Only</th>
				<td style="vertical-align: middle;"><?php

				$post_types = get_post_types( '', 'names' );

				foreach ( $post_types as $post_type ) {

					echo '<label for="kento-pvc-posttype['.$post_type.']"><input type="checkbox" name="kento_pvc_posttype['.$post_type.']" id="kento-pvc-posttype['.$post_type.']"  value ="1" ' ?>
					<?php if ( isset( $kento_pvc_posttype[$post_type] ) ) echo "checked"; ?>
					<?php echo' >'. $post_type.'</label><br />' ;
				}
				?>
				</td>
			</tr>





			<tr valign="top">
				<th scope="row">Numbers Language</th>
				<td style="vertical-align: middle;"><input type="text" size="20"
					name="kento_pvc_numbers_lang" id="kento-pvc-numbers-lang"
					value="<?php if (isset($kento_pvc_numbers_lang)) echo $kento_pvc_numbers_lang; ?>"
					placeholder="0,1,2,3,4,5,6,7,8,9" /><br />**Write numbers in your
					language as following 0,1,2,3,4,5,6,7,8,9<br /> Left blank if you
					are in English.</td>
			</tr>

			<tr valign="top">
				<th scope="row">Text For Today View</th>
				<td style="vertical-align: middle;"><input type="text" size="20"
					name="kento_pvc_today_text" id="kento-pvc-today-text"
					value="<?php if (isset($kento_pvc_today_text)) echo $kento_pvc_today_text; ?>"
					placeholder="Views Today " />
				</td>
			</tr>


			<tr valign="top">
				<th scope="row">Text For Total View</th>
				<td style="vertical-align: middle;"><input type="text" size="20"
					name="kento_pvc_total_text" id="kento-pvc-total-text"
					value="<?php if (isset($kento_pvc_total_text)) echo $kento_pvc_total_text; ?>"
					placeholder="Total Views " />
				</td>
			</tr>


			<tr valign="top">
				<th scope="row">Need Help ?</th>
				<td style="vertical-align: middle;">If you need any help please feel
					free to ask <a
					href="http://wordpress.org/support/plugin/kento-post-view-counter">WordPress.org</a>
					support forum and join our Official forum <a
					href="http://kentothemes.com/questions-answers/">
						http://kentothemes.com/questions-answers/</a>
				</td>
			</tr>





		</table>
		<p class="submit">
			<input class="button button-primary" type="submit" name="Submit"
				value="<?php _e('Save Changes' ) ?>" />
		</p>
	</form>


</div>
