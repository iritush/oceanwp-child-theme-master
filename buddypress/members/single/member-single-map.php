<?php

/**
 * Show a map with all the towns that the member marked as visited
 */

?>

<?php

$settings_single = get_site_option( 'bp-member-map-single-settings' );
extract($settings_single);
$key = 'geocode_' . $map_location_field;

$vermont_center_latlng = '44.000000,  -72.699997';
$center = $vermont_center_latlng;

if ( ! empty( $center ) ) {

	if ( wp_script_is( 'google-places-api', 'registered' ) ) {

		wp_enqueue_script( 'google-places-api' );
		wp_print_scripts( 'google-places-api' );

	}	
}

$locations_array = [];
$i = 0;
$towns_visited = xprofile_get_field_data('Towns Visited'); 
foreach($towns_visited as $town){
	$towns_info = get_posts(array(
		'numberposts'	=> 1,
		'post_type'		=> 'town',
		'fields' => 'ids',
		'meta_key'		=> 'town_name',
		'meta_value'	=> $town
	));
	foreach ($towns_info as $town_info) {
		$lat = get_field('latitude', $town_info );
		$lon = get_field('longitude', $town_info );
		$locations_array[$i]= "$lat, $lon";
	}
	$i++;
} 

?>

<div class="member-map-profile">

	<?php
	if ( ! empty( $address ) ) {
		echo stripslashes( $address ) . '<br>';
	}
	?>

	<?php if ( ! empty( $center ) ) : ?>

		<?php $map_id = uniqid( 'pp_member_map_' ); ?>


		<div id="<?php echo esc_attr( $map_id ); ?>" style="height: <?php echo $map_height; ?>px; width: 100%;"></div>

	    <script type="text/javascript">
			var map_<?php echo $map_id; ?>;
			function pp_run_map_<?php echo $map_id ; ?>(){
				var icon = "<?php echo pp_mm_load_dot(); ?>";
				var center = new google.maps.LatLng(<?php echo $center; ?>);
				var map_options = {
					zoom: <?php echo $map_zoom_level; ?>,
					center: center,
					mapTypeId: google.maps.MapTypeId.<?php echo strtoupper( $map_type ); ?>
				}
				map_<?php echo $map_id ; ?> = new google.maps.Map(document.getElementById("<?php echo $map_id; ?>"), map_options);
				 var marker;
				<?php foreach($locations_array as $location){ ?>
					marker = new google.maps.Marker({
					position: new google.maps.LatLng(<?php echo $location; ?>),
					map: map_<?php echo $map_id ; ?>,
					icon:  new google.maps.MarkerImage(icon)
					});
				<?php } ?>

			google.maps.event.addDomListener(window, "resize", function() {
				var map = map_<?php echo $map_id; ?>;
				var center = map.getCenter();
				google.maps.event.trigger(map, "resize");
				map.setCenter(center);
			});
			}

			pp_run_map_<?php echo $map_id ; ?>();
		</script>

	<?php else : ?>

		<?php _e( 'Soemthing went wrong We were not able to load the map', 'bp-member-maps' ); ?>

	<?php endif; ?>

</div>
