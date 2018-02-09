<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin_toolbar_misc.php';

$args = array( 'post_type' => 'wa_pns' );
$post_ids = get_posts(array(
		$args, //Your arguments
		'post_type'        => 'wa_pns',
		'posts_per_page'=> -1,
		'fields'        => 'ids,post_date',
		'meta_query' => array(
			array(
				'key' => '_wapn',
				'value' => 'iOS',
				'compare' => 'LIKE'
			)
		) // Only get post IDs
	));


$totalInstalls = count($post_ids);

$args = array( 'post_type' => 'wa_pns' );
$post_ids = get_posts(array(
		$args, //Your arguments
		'post_type'        => 'wa_pns',
		'posts_per_page'=> -1,
		'fields'        => 'ids,post_date',
		'meta_query' => array(
			array(
				'key' => '_wapn',
				'value' => 'android',
				'compare' => 'LIKE'
			)
		) // Only get post IDs
	));

$totalInstallsAndroid = count($post_ids);


$i = 1;
//Past 30 days
$dates = array();
for($i = 0; $i < 30; $i++) {
	$dates[] = array('day'=> date("d", strtotime('-'. $i .' days')), 'month'=>date("m", strtotime('-'. $i .' days')), 'year'=>date("Y", strtotime('-'. $i .' days')));
}
$table = array();
$table['cols'] = array(

	array('label' => 'Day', 'type' => 'number'),
	array('label' => 'Posts', 'type' => 'number')
);
$rows = array();
foreach($dates as $date){
	$temp = array();

	$args = array(
		'post_type' => 'wa_pns',
		'post_status' => 'publish',
		'orderby' => 'date',
		'order' => 'ASC',
		'nopaging' => true,
		'meta_query' => array(
			array(
				'key' => '_wapn',
				'value' => 'iOS',
				'compare' => 'LIKE'
			)
		),
		// Using the date_query to filter posts from everyday
		'date_query' => array(
			array(
				'year'  => $date['year'],
				'month' => $date['month'],
				'day'   => $date['day'],
			),
		)
	);
	$fulldate = $date['year'].$date['month'].$date['day'];
	$perdayposts = new WP_Query($args);
	//$each_day_count[$i] = $perdayposts->found_posts; //count without pagination
	//$temp[] = array('v' => $i);
	$temp[] = array('ios' => (int) $perdayposts->found_posts);
	//$temp[] = array('date' => $date['day'].$date['month']);
	$temp[] = array('date' => $date['month'].'/'.$date['day']);
	$rows[$fulldate] = array('c' => $temp);
	$i += 1;
}


foreach($dates as $date){
	$temp = array();

	$args = array(
		'post_type' => 'wa_pns',
		'post_status' => 'publish',
		'orderby' => 'date',
		'order' => 'ASC',
		'nopaging' => true,
		'meta_query' => array(
			array(
				'key' => '_wapn',
				'value' => 'android',
				'compare' => 'LIKE'
			)
		),
		// Using the date_query to filter posts from everyday
		'date_query' => array(
			array(
				'year'  => $date['year'],
				'month' => $date['month'],
				'day'   => $date['day'],
			),
		)
	);
	$fulldate = $date['year'].$date['month'].$date['day'];
	$perdayposts = new WP_Query($args);
	$rows[$fulldate]['c']['0']['android'] = $perdayposts->found_posts; //count without pagination

	$i += 1;
}

// populate the table with rows of data
$table['rows'] = $rows;

$table['rows'] = array_reverse($table['rows']);


?>




	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<h3><span><?php echo __( 'App Stats','wordapp-mobile-app'); ?></span></h3>



						<div class="inside">
  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Android', 'iOS']
		  <?php
foreach($table['rows'] as &$val){
	echo ",['".$val['c']['1']['date']."', ".$val['c']['0']['android'].", ".$val['c']['0']['ios']."]";
	//echo $val[c]['0']['android'];
}

?>
        ]);

        var options = {
          title: 'App Downloads in the last 30 days',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

							 <div id="curve_chart" style="width: 100%; height: 500px"></div>

<small>	* We are improving these stats. More to come in 2017 :)</small>

						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<div class="postbox">


						<div class="inside">
							<p><h3><?php _e('Download share','wordapp-mobile-app');?> </h3>

							 <div id="piechart" style="width: 100%; height: 300px;"></div>

							 <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Platform', 'Total Downloads'],
          ['Android',     <?php echo $totalInstallsAndroid; ?>],
          ['iOS',      <?php echo $totalInstalls; ?>],
          ['Windows',  0]
        ]);

        var options = {
          title: 'Download split'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>



    <h4><?php _e('Total Downloads: ','wordapp-mobile-app'); ?></h4>
							<hr>
							<h5><?php _e('Android: ','wordapp-mobile-app'); echo $totalInstallsAndroid; ?> </h5>
							<h5><?php _e('iOS: ','wordapp-mobile-app'); echo $totalInstalls; ?> </h5>
<hr>
<p><h3><?php _e('Need more downloads subscribe to our channel.','wordapp-mobile-app');?> </h3>
<script src="https://apis.google.com/js/platform.js"></script>

<script>
  function onYtEvent(payload) {
    if (payload.eventType == 'subscribe') {
      // Add code to handle subscribe event.
    } else if (payload.eventType == 'unsubscribe') {
      // Add code to handle unsubscribe event.
    }
    if (window.console) { // for debugging only
      window.console.log('YT event: ', payload);
    }
  }
</script>

<div class="g-ytsubscribe" data-channelid="UC7NJLsf6IonOy8QI8gt5BeA" data-layout="default" data-count="default" data-onytevent="onYtEvent"></div>
</p>

						</div>

						<!-- .inside -->

					</div>
					<!-- .postbox -->


				</div>
				<!-- .meta-box-sortables -->

			</div>
			<!-- #postbox-container-1 .postbox-container -->

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div> <!-- .wrap -->
<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'footer.php';
?>

<style>
	.message_invite{
		font-family: "Open Sans","lucida grande","Segoe UI",arial,verdana,"lucida sans unicode",tahoma,sans-serif;
  		font-size: 13px;
  		color: #3d464d;
  		font-weight: normal;
		text-align: center;
	}

	</style>