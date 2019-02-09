<div class="wrap">
	<div class="kento-pvc-by-viewed">
		<h3>Top Viewed</h3>

		<?php
		global $wpdb;
		$table = $wpdb->prefix . "kento_pvc";

		$result = $wpdb->get_results("SELECT * FROM $table ORDER BY count DESC LIMIT 12", ARRAY_A);
		$total_rows = $wpdb->num_rows;
		?>
		<table class='kento-pvc-top-post widefat'>
			<thead>
				<tr>
					<th scope="col" class="manage-column column-name" style=""><strong>View
							Count</strong>
					</th>
					<th scope="col" class="manage-column column-name" style=""><strong>Post
							Title</strong>
					</th>
				</tr>
			</thead>


			<?php


			for($i=0;$i<$total_rows;$i++)
			{
				echo "<tr><td>";
				echo $view_count = $result[$i]['count']."<br />";
				echo "</td>";
				echo "<td class='post-title'>";
				$postid= $result[$i]['postid']."<br />";

				echo "<a href=".get_permalink( $postid ).">";
				echo get_the_title($postid);
				echo "</a>";
				echo "</td>";
				echo "</tr>";

			}
			echo "</table>";

			?>
			</div>
			<div class="kento-pvc-by-date">
				<h3>Top Viewed By Date</h3>
				Select Date <input type="text" id="kento-pvc-date"
					name="kento_pvc_date" value="<?php echo date("Y-m-d");?>" /><br />
				<div class="kento-pvc-by-date-submit">Submit</div>
				<script>
    jQuery(document).ready(function() {
        jQuery('#kento-pvc-date, #kpvc-date-referer').datepicker({
            dateFormat : 'yy-mm-dd'
        });
    });
    </script>

				<div id="kento-pvc-by-date-result">
					<br />
					<?php
					global $wpdb;
					$table = $wpdb->prefix . "kento_pvc_info";
					$today = date("Y-m-d");
					$result = $wpdb->get_results("SELECT * FROM $table WHERE date = CURDATE() ORDER BY count DESC LIMIT 12", ARRAY_A);
					$total_rows = $wpdb->num_rows;
					?>

					<table class='kento-pvc-top-post widefat'>
						<thead>
							<tr>
								<th scope="col" class="manage-column column-name" style=""><strong>View
										Count</strong>
								</th>
								<th scope="col" class="manage-column column-name" style=""><strong>Post
										Title</strong>
								</th>
							</tr>
						</thead>




						<?php

						$i=0;
						while($total_rows>$i)
						{
							echo "<tr><td>";
							echo $view_count = $result[$i]['count']."<br />";
							echo "</td>";
							echo "<td class='post-title'>";
							$postid= $result[$i]['postid']."<br />";

							echo "<a href=".get_permalink( $postid ).">";
							echo get_the_title($postid);
							echo "</a>";
							echo "</td>";
							echo "</tr>";



							$i++;
						}
						echo "</table>";

						?>
						</div>
						<!--kento-pvc-by-date-result -->


						</div>
						<!--kento-pvc-by-date -->


						<div class="kento-pvc-by-city" id="kpvc-recent-items"
							style="width: 95%;">
							<h3>Recent Visits</h3>

							<select style="margin-bottom: 10px;" name="kpvc_recent_items"
								class="kpvc-recent-items"
								onchange="location = this.options[this.selectedIndex].value;">
								<option
								<?php if($_GET['kpvc_recent_items']=="10") echo "selected='selected'" ?>
									value="<?php echo get_admin_url(); ?>admin.php?page=kento_pvc_settings_stats&kpvc_recent_items=10#kpvc-recent-items">10
									Items</option>
								<option
								<?php if($_GET['kpvc_recent_items']=="20") echo "selected='selected'" ?>
									value="<?php echo get_admin_url(); ?>admin.php?page=kento_pvc_settings_stats&kpvc_recent_items=20#kpvc-recent-items">20
									Items</option>
								<option
								<?php if($_GET['kpvc_recent_items']=="50") echo "selected='selected'" ?>
									value="<?php echo get_admin_url(); ?>admin.php?page=kento_pvc_settings_stats&kpvc_recent_items=50#kpvc-recent-items">50
									Items</option>

								<option
								<?php if($_GET['kpvc_recent_items']=="100") echo "selected='selected'" ?>
									value="<?php echo get_admin_url(); ?>admin.php?page=kento_pvc_settings_stats&kpvc_recent_items=100#kpvc-recent-items">100
									Items</option>
								<option
								<?php if($_GET['kpvc_recent_items']=="500") echo "selected='selected'" ?>
									value="<?php echo get_admin_url(); ?>admin.php?page=kento_pvc_settings_stats&kpvc_recent_items=500">500
									Items</option>
							</select>
							<?php
							global $wpdb;

							$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
							$limit = isset( $_GET['kpvc_recent_items'] ) ? absint( $_GET['kpvc_recent_items'] ) : 10;





							$offset = ( $pagenum - 1 ) * $limit;
							$entries = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}kento_pvc_city ORDER BY datetime DESC LIMIT $offset, $limit" );



							?>

							<table class="widefat">
								<thead>
									<tr>
										<th scope="col" class="manage-column column-name" style=""><strong>Post
												Title</strong>
										</th>
										<th scope="col" class="manage-column column-name" style=""><strong>Country</strong>
										</th>
										<th scope="col" class="manage-column column-name" style=""><strong>City</strong>
										</th>
										<th scope="col" class="manage-column column-name" style=""><strong>Date
												& Time</strong>
										</th>
										<th scope="col" class="manage-column column-name" style=""><strong>Referrer</strong>
										</th>

									</tr>
								</thead>

								<tfoot>
									<tr>
										<th scope="col" class="manage-column column-name" style=""><strong>Post
												Title</strong>
										</th>
										<th scope="col" class="manage-column column-name" style=""><strong>Country</strong>
										</th>
										<th scope="col" class="manage-column column-name" style=""><strong>City</strong>
										</th>
										<th scope="col" class="manage-column column-name" style=""><strong>Date
												& Time</strong>
										</th>
										<th scope="col" class="manage-column column-name" style=""><strong>Referrer</strong>
										</th>


									</tr>
								</tfoot>

								<tbody>
								<?php if( $entries ) { ?>

								<?php
								$count = 1;
								$class = '';
								foreach( $entries as $entry ) {
									$class = ( $count % 2 == 0 ) ? ' class="alternate"' : '';
									?>

									<tr <?php echo $class; ?>>
										<td><?php	$postid = $entry->postid; 
										echo "<a href=".get_permalink( $postid ).">";
										echo get_the_title($postid);
										echo "</a>";
										?></td>

										<td><?php echo $entry->country; ?>
										</td>
										<td><?php echo $entry->city; ?>
										</td>
										<td><?php $datetime = $entry->datetime; ?> <span
											title="IP: <?php echo $entry->ip; ?>"><?php echo $datetime; ?>
										</span>
										</td>
										<td><span title="Post View Referrer"><?php echo $entry->referer; ?>
										</span>
										</td>


									</tr>

									<?php
									$count++;
								}
								?>

								<?php } else { ?>
									<tr>
										<td colspan="2">No posts yet</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>

							<?php

							$total = $wpdb->get_var( "SELECT COUNT(`id`) FROM {$wpdb->prefix}kento_pvc_city" );
							$num_of_pages = ceil( $total / $limit );
							$page_links = paginate_links( array(
    'base' => add_query_arg( 'pagenum', '%#%#kpvc-recent-items' ),
    'format' => '',
    'prev_text' => __( '&laquo;', 'aag' ),
    'next_text' => __( '&raquo;', 'aag' ),
    'total' => $num_of_pages,
    'current' => $pagenum
							) );

							if ( $page_links ) {
								echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
							}


							?>


						</div>
						<!--kento-pvc-by-city-post -->









						<!-- /////////////////////////////////////////////////////////////////////// -->


						<div class="kento-pvc-feedbck">
							<h3>Please send us feedback</h3>
							<div id="kento-pvc-feedbck-box">
								We are continuously update this plugin to get more feature, We
								are waiting to see your reviews and feedback at wordpress.org <a
									href="http://wordpress.org/plugins/kento-post-view-counter/">Kento
									Post View Counter</a><br />
								<br /> if you need more help please feel free to join our forum
								and ask any question<br /> <a
									href="http://kentothemes.com/questions-answers/">KentoThemes.com
									Questions & Answers</a><br />
								<br /> <strong>Please Share With your Friends</strong><br />
								<br />
								<table>
									<tr>
										<td width="100px">
											<!-- Place this tag in your head or just before your close body tag. -->
											<script type="text/javascript"
												src="https://apis.google.com/js/platform.js"></script> <!-- Place this tag where you want the +1 button to render. -->
											<div class="g-plusone" data-size="medium"
												data-href="http://kentothemes.com/items/plugins/kento-post-view-counter/"></div>

										</td>
										<td width="100px"><iframe
												src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fkentothemes.com%2Fitems%2Fplugins%2Fkento-post-view-counter%2F&amp;width=100&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=743541755673761"
												scrolling="no" frameborder="0"
												style="border: none; overflow: hidden; width: 100px; height: 21px;"
												allowTransparency="true"></iframe></td>
										<td width="100px"><a href="https://twitter.com/share"
											class="twitter-share-button"
											data-url="http://kentothemes.com/items/plugins/kento-post-view-counter/"
											data-text="Kento Post View Counter">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
										</td>

									</tr>

								</table>






								<br /> <br />




							</div>
							<!--kento-pvc-feedbck-box -->

							<div class="kento-pvc-promotion">
								<h3>Get Timeline plugin for your website</h3>
								<a
									href="http://kentothemes.com/items/social/timeline-pro-responsive-timeline-for-wordpress/"><img
									width="100%"
									src="<?php echo KENTO_PVC_PLUGIN_PATH."css/timelin.png"; ?>" />
								</a>


							</div>

						</div>
						<!--kento-pvc-feedbck -->
						<!-- /////////////////////////////////////////////////////////////////////// -->









						<div class="kento-pvc-feedbck">
							<h3>Top 10 Referer - Total Or By Date</h3>
							<div id="kento-pvc-top-referer">

								<input type="text" id="kpvc-date-referer"
									name="kpvc_date_referer" value="" placeholder="Select date" /><br />
								<div class="kpvc-date-referer-submit">Submit</div>
								<br />

								<div class="kento-pvc-top-referer-display">
									<?php kento_pvc_top_referer(); ?>
								</div>
							</div>
							<!--kento-pvc-feedbck-box -->



						</div>
						<!--kento-pvc-feedbck -->

















						</div>
						<!--wrap -->