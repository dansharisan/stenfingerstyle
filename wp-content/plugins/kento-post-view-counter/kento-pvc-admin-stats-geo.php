<div class="wrap">




	<div class="kento-pvc-feedbck">
		<h3>Please send us feedback</h3>
		<div id="kento-pvc-feedbck-box">
			We are continuously update this plugin to get more feature, We are
			waiting to see your reviews and feedback at wordpress.org <a
				href="http://wordpress.org/plugins/kento-post-view-counter/">Kento
				Post View Counter</a><br />
			<br /> if you need more help please feel free to join our forum and
			ask any question<br /> <a
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



	</div>
	<!--kento-pvc-feedbck -->
	<!-- /////////////////////////////////////////////////////////////////////// -->






	<div class="kento-pvc-geo">
		<h3>Top 20 City And Country</h3>

		<div id="kento-pvc-top-geo">

			<select id="kento-pvc-geo" name="kento_pvc_geo">
				<option value="country">Country</option>
				<option value="city">City</option>
			</select><br />
			<br />
		</div>
		<div class="kento-pvc-top-geo-display">
		<?php  kento_pvc_top_geo(); ?>

		</div>
		<!--kento-pvc-top-geo -->



	</div>
	<!--kento-pvc-geo -->




	<div class="kento-pvc-geo kento-pvc-geo-map">
		<h3>Top 20 Country by Map</h3>


		<div class="kento-pvc-top-geo-map-display">

			<script type='text/javascript'>
     google.load('visualization', '1', {'packages': ['geochart']});
     google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Visitors Count'],
<?php echo kento_pvc_top_geo_map("country"); ?>
        ]);

        var options = {
			
			colorAxis: {colors: ['#ffdb84', '#2bea89']}
			};

        var chart = new google.visualization.GeoChart(document.getElementById('chart_country'));
        chart.draw(data, options);
    };
    </script>
			<div id="chart_country" style="width: 100%; height: 300px;"></div>
		</div>
		<!--kento-pvc-top-geo -->



	</div>
	<!--kento-pvc-geo map -->









	<div class="kento-pvc-geo kento-pvc-geo-map">
		<h3>Top 10 City by Map</h3>


		<div class="kento-pvc-top-geo-map-display">

			<script type='text/javascript'>
     google.load('visualization', '1', {'packages': ['geochart']});
     google.setOnLoadCallback(drawMarkersMap);

      function drawMarkersMap() {
      var data = google.visualization.arrayToDataTable([
        ['City', 'Count'],
<?php echo kento_pvc_top_geo_map("city"); ?>
      ]);

      var options = {
        displayMode: 'markers',
        colorAxis: {colors: ['green', 'blue']}
      };

      var chart = new google.visualization.GeoChart(document.getElementById('chart_city'));
      chart.draw(data, options);
    };
    </script>
			<div id="chart_city" style="width: 100%; height: 300px;"></div>


		</div>
		<!--kento-pvc-top-geo -->



	</div>
	<!--kento-pvc-geo -->











</div>
<!--wrap -->
