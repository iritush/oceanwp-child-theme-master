<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );
	// Load the stylesheet
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	
}
add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

/***
 * rcp: Add intro before registration form
 */
function resigtration_form_intro() {
	echo 'Please enter the address where you would like to recieve your welcome package:';
}

/**
 * rcp:Adds  custom fields to the registration form and profile editor
 *
 */
function pw_rcp_add_user_fields() {
	
	$street_line_1 = get_user_meta( get_current_user_id(), 'rcp_street_line_1', true );
	$street_line_2 = get_user_meta( get_current_user_id(), 'rcp_street_line_2', true );
	$city = get_user_meta( get_current_user_id(), 'rcp_city', true );
	$state = get_user_meta( get_current_user_id(), 'rcp_state', true );
	$zipcode = get_user_meta( get_current_user_id(), 'rcp_zipcode', true );
	$country = get_user_meta( get_current_user_id(), 'rcp_country', true );
	$phone_number = get_user_meta( get_current_user_id(), 'rcp_phone_number', true );

	?>
	<p>
		<label for="rcp_street_line_1"><?php _e( 'Street Line 1', 'rcp' ); ?></label>
		<input name="rcp_street_line_1" id="rcp_street_line_1" type="text" value="<?php echo esc_attr( $street_line_1 ); ?>"/>
	</p>
	<p>
		<label for="rcp_street_line_2"><?php _e( 'Street Line 2', 'rcp' ); ?></label>
		<input name="rcp_street_line_2" id="rcp_street_line_2" type="text" value="<?php echo esc_attr( $street_line_2 ); ?>"/>
	</p>	
	<p>
		<label for="rcp_city"><?php _e( 'Your City', 'rcp' ); ?></label>
		<input name="rcp_city" id="rcp_city" type="text" value="<?php echo esc_attr( $city ); ?>"/>
	</p>
	<p>
		<label for="rcp_state"><?php _e( 'Your State', 'rcp' ); ?></label>
		<input name="rcp_state" id="rcp_state" type="text" value="<?php echo esc_attr( $state ); ?>"/>
	</p>
	<p>
		<label for="rcp_zipcode"><?php _e( 'Your zipcode', 'rcp' ); ?></label>
		<input name="rcp_zipcode" id="rcp_zipcode" type="number" value="<?php echo esc_attr( $zipcode ); ?>"/> 
	</p>
		<p>
		<label for="rcp_country"><?php _e( 'Your Country', 'rcp' ); ?></label>
		<input name="rcp_country" id="rcp_country" type="text" value="<?php echo esc_attr( $country ); ?>"/> 
	</p>
	</p>
		<p>
		<label for="rcp_phone_number"><?php _e( 'Your Phone Number', 'rcp' ); ?></label>
		<input name="rcp_phone_number" id="rcp_phone_number" type="number" value="<?php echo esc_attr( $phone_number ); ?>"/> 
	</p>	
	<?php
}
add_action( 'rcp_before_register_form_fields', 'resigtration_form_intro' );
add_action( 'rcp_before_register_form_fields', 'pw_rcp_add_user_fields' );
add_action( 'rcp_profile_editor_after', 'pw_rcp_add_user_fields' );
// add_action( 'rcp_before_register_form', 'resigtration_form_intro');

/**
 * Adds the custom fields to the member edit screen
 *
 */
function pw_rcp_add_member_edit_fields( $user_id = 0 ) {
	
	$street_line_1 = get_user_meta( $user_id, 'rcp_street_line_1', true );
	$street_line_2 = get_user_meta( $user_id, 'rcp_street_line_2', true );
	$city = get_user_meta( $user_id, 'rcp_city', true );
	$state = get_user_meta( $user_id, 'rcp_state', true );
	$zipcode = get_user_meta( $user_id, 'rcp_zipcode', true );
	$country = get_user_meta( $user_id, 'rcp_country', true );
	$phone_number = get_user_meta( $user_id, 'rcp_phone_number', true );

	?>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_street_line_1"><?php _e( 'Street Line 1', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_street_line_1" id="rcp_street_line_1" type="text" value="<?php echo esc_attr( $street_line_1 ); ?>"/>
			<p class="description"><?php _e( 'The member\'s street line 1', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_street_line_2"><?php _e( 'Street Line 2', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_street_line_2" id="rcp_street_line_2" type="text" value="<?php echo esc_attr( $street_line_2 ); ?>"/>
			<p class="description"><?php _e( 'The member\'s street line 2', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_city"><?php _e( 'City', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_city" id="rcp_city" type="text" value="<?php echo esc_attr( $city ); ?>"/>
			<p class="description"><?php _e( 'The member\'s city', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_state"><?php _e( 'State', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_state" id="rcp_state" type="text" value="<?php echo esc_attr( $state ); ?>"/>
			<p class="description"><?php _e( 'The member\'s state', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_zipcode"><?php _e( 'zipcode', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_zipcode" id="rcp_zipcode" type="number" value="<?php echo esc_attr( $zipcode ); ?>"/>
			<p class="description"><?php _e( 'The member\'s zipcode', 'rcp' ); ?></p>
		</td>
	</tr>			
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_country"><?php _e( 'Country', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_country" id="rcp_country" type="text" value="<?php echo esc_attr( $country ); ?>"/>
			<p class="description"><?php _e( 'The member\'s country', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_phone_number"><?php _e( 'Phone Number', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_phone_number" id="rcp_phone_number" type="number" value="<?php echo esc_attr( $phone_number ); ?>"/>
			<p class="description"><?php _e( 'The member\'s phone number', 'rcp' ); ?></p>
		</td>
	</tr>			
<?php	
}
add_action( 'rcp_edit_member_after', 'pw_rcp_add_member_edit_fields' );

/**
 * Determines if there are problems with the registration data submitted
 *
 */
function pw_rcp_validate_user_fields_on_register( $posted ) {

	if ( is_user_logged_in() ) {
	   return;
    	}

	if( empty( $posted['rcp_street_line_1'] ) ) {
		rcp_errors()->add( 'invalid_street_line_1', __( 'Please enter street', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_city'] ) ) {
		rcp_errors()->add( 'invalid_city', __( 'Please enter your city', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_state'] ) ) {
		rcp_errors()->add( 'invalid_state', __( 'Please enter your state', 'rcp' ), 'register' );
	}	
	if( empty( $posted['rcp_zipcode'] ) ) {
		rcp_errors()->add( 'invalid_zipcode', __( 'Please enter your zipcode', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_country'] ) ) {
		rcp_errors()->add( 'invalid_country', __( 'Please enter your country', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_phone_number'] ) ) {
		rcp_errors()->add( 'invalid_phone_number', __( 'Please enter your phone number', 'rcp' ), 'register' );
	}	
}
add_action( 'rcp_form_errors', 'pw_rcp_validate_user_fields_on_register', 10 );

/**
 * Stores the information submitted during registration
 *
 */
function pw_rcp_save_user_fields_on_register( $posted, $user_id ) {

	if( ! empty( $posted['rcp_street_line_1'] ) ) {
		update_user_meta( $user_id, 'rcp_street_line_1', sanitize_text_field( $posted['rcp_street_line_1'] ) );
	}
	if( ! empty( $posted['rcp_street_line_2'] ) ) {
		update_user_meta( $user_id, 'rcp_street_line_2', sanitize_text_field( $posted['rcp_street_line_2'] ) );
	}
	if( ! empty( $posted['rcp_city'] ) ) {
		update_user_meta( $user_id, 'rcp_city', sanitize_text_field( $posted['rcp_city'] ) );
	}
	if( ! empty( $posted['rcp_state'] ) ) {
		update_user_meta( $user_id, 'rcp_state', sanitize_text_field( $posted['rcp_strercp_stateet_line_2'] ) );
	}
	if( ! empty( $posted['rcp_zipcode'] ) ) {
		update_user_meta( $user_id, 'rcp_zipcode', absint( $posted['rcp_zipcode'] ) );
	}
	if( ! empty( $posted['rcp_country'] ) ) {
		update_user_meta( $user_id, 'rcp_country', sanitize_text_field( $posted['rcp_country'] ) );
	}
	if( ! empty( $posted['rcp_phone_number'] ) ) {
		update_user_meta( $user_id, 'rcp_phone_number', absint( $posted['rcp_phone_number'] ) );
	}		
}
add_action( 'rcp_form_processing', 'pw_rcp_save_user_fields_on_register', 10, 2 );

/**
 * Stores the information submitted profile update
 *
 */
function pw_rcp_save_user_fields_on_profile_save( $user_id ) {

	if( ! empty( $_POST['rcp_street_line_1'] ) ) {
		update_user_meta( $user_id, 'rcp_street_line_1', sanitize_text_field( $_POST['rcp_street_line_1'] ) );
	}
	if( ! empty( $_POST['rcp_street_line_2'] ) ) {
		update_user_meta( $user_id, 'rcp_street_line_2', sanitize_text_field( $_POST['rcp_street_line_2'] ) );
	}
	if( ! empty( $_POST['rcp_city'] ) ) {
		update_user_meta( $user_id, 'rcp_city', sanitize_text_field( $_POST['rcp_city'] ) );
	}
	if( ! empty( $_POST['rcp_state'] ) ) {
		update_user_meta( $user_id, 'rcp_state', sanitize_text_field( $_POST['rcp_state'] ) );
	}
	if( ! empty( $_POST['rcp_zipcode'] ) ) {
		update_user_meta( $user_id, 'rcp_zipcode', absint( $_POST['rcp_zipcode'] ) );
	}
	if( ! empty( $_POST['rcp_country'] ) ) {
		update_user_meta( $user_id, 'rcp_country', sanitize_text_field( $_POST['rcp_country'] ) );
	}
	if( ! empty( $_POST['rcp_phone_number'] ) ) {
		update_user_meta( $user_id, 'rcp_phone_number', sanitize_text_field( $_POST['rcp_phone_number'] ) );
	}	
}
add_action( 'rcp_user_profile_updated', 'pw_rcp_save_user_fields_on_profile_save', 10 );
add_action( 'rcp_edit_member', 'pw_rcp_save_user_fields_on_profile_save', 10 );

/**
 * Plugin Name: Restrict Content Pro - Custom Membership Export Columns
 * Description: Adds custom user meta or membership meta data to each membership export row.
 * Version: 1.0
 * Author: Sandhills Development, LLC
 * Author URI: https://sandhillsdev.com
 * License: GPL2
 */

/**
 * Adds custom user meta data to each member's export row.
 *
 * 1. Add your column IDs / Names
 * 2. Fill the column values from get_user_meta() using your unique meta keys
 */

/**
 * Add additional columns
 *
 * @param array $columns Array of columns.
 *
 * @return array
 */
function pw_rcp_register_export_columns( $columns ) {
	
	$columns[ 'street_line_1' ] = 'Street Line 1';
	$columns[ 'street_line_2' ] = 'Street Line 2';
	$columns[ 'city' ] = 'City';
	$columns[ 'state' ] = 'State';
	$columns[ 'zipcode' ] = 'zipcode';
	$columns[ 'country' ] = 'Country';
	$columns[ 'phone_number' ] = 'Phone Number';

	return $columns; 
}
add_filter( 'rcp_export_csv_cols_members', 'pw_rcp_register_export_columns' );

/**
 * Add values to each membership row
 *
 * @param array          $data       Array of member data to be included in the CSV export.
 * @param RCP_Membership $membership Membership object.
 *
 * @return array Array with new data added.
 */
function pw_rcp_add_fields_to_export( $data, $membership ) {

	/*
	 * This example is for including user meta data.
	 */
	$user_id = $membership->get_customer()->get_user_id();

	$data[ 'street_line_1' ] = get_user_meta( $user_id, 'rcp_street_line_1', true );
	$data[ 'street_line_2' ] = get_user_meta( $user_id, 'rcp_street_line_2', true );
	$data[ 'city' ] = get_user_meta( $user_id, 'rcp_city', true );
	$data[ 'state' ] = get_user_meta( $user_id, 'rcp_state', true );
	$data[ 'zipcode' ] = get_user_meta( $user_id, 'rcp_zipcode', true );
	$data[ 'country' ] = get_user_meta( $user_id, 'rcp_country', true );
	$data[ 'phone_number' ] = get_user_meta( $user_id, 'rcp_phone_number', true );	

	/*
	 * This example is for including membership meta data.
	 */
	// $data[ 'my_third_custom_column' ] = rcp_get_membership_meta( $membership->get_id(), 'my_third_meta_key', true );

	return $data;

}
add_filter( 'rcp_export_memberships_get_data_row', 'pw_rcp_add_fields_to_export', 10, 2 );