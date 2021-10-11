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
	$secondary_member = get_user_meta( get_current_user_id(), 'rcp_secondary_member', true );
	$secondary_email = get_user_meta( get_current_user_id(), 'rcp_secondary_email', true );

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
	<p>
		<label for="rcp_secondary_member"><?php _e( 'Secondary Member Name', 'rcp' ); ?></label>
		<input name="rcp_secondary_member" id="rcp_secondary_member" type="text" value="<?php echo esc_attr( $secondary_member ); ?>"/> 
	</p>
	<p>
        <label for="rcp_secondary_email"><?php _e( 'Secondary Member Email', 'rcp' ); ?></label>
        <input type="email" id="rcp_secondary_email" name="rcp_secondary_email" value="<?php echo esc_attr( $secondary_email ); ?>"/>
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
	$secondary_member = get_user_meta( $user_id, 'rcp_secondary_member', true );
	$secondary_email = get_user_meta( $user_id, 'rcp_secondary_email', true );

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
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_secondary_member"><?php _e( 'Secondary Member', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_secondary_member" id="rcp_secondary_member" type="text" value="<?php echo esc_attr( $secondary_member ); ?>"/>
			<p class="description"><?php _e( 'The member\'s secondary member', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
        <th scope="row" valign="top">
            <label for="rcp_secondary_email"><?php _e( 'Secondary Email', 'rcp' ); ?></label>
        </th>
        <td>
            <input type="email" id="rcp_secondary_email" name="rcp_secondary_email" value="<?php echo esc_attr( $secondary_email ); ?>"/>
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
	if ( ! empty( $posted['rcp_secondary_email'] ) && ! is_email( $posted['rcp_secondary_email'] ) ) {
        rcp_errors()->add( 'invalid_email_address', __( 'Please enter a valid  email address', 'rcp' ), 'register' );
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
		update_user_meta( $user_id, 'rcp_state', sanitize_text_field( $posted['rcp_state'] ) );
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
	if( ! empty( $posted['rcp_secondary_member'] ) ) {
		update_user_meta( $user_id, 'rcp_secondary_member', sanitize_text_field( $posted['rcp_secondary_member'] ) );
	}
	if ( ! empty( $posted['rcp_secondary_email'] ) ) {
        update_user_meta( $user_id, 'rcp_secondary_email', sanitize_email( $posted['rcp_secondary_email'] ) );
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
	// field is not required so empty field is OK
		update_user_meta( $user_id, 'rcp_street_line_2', sanitize_text_field( $_POST['rcp_street_line_2'] ) );
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
		update_user_meta( $user_id, 'rcp_phone_number', absint( $_POST['rcp_phone_number'] ) );
	}
	// field is not required so empty field is OK
	update_user_meta( $user_id, 'rcp_secondary_member', sanitize_text_field( $_POST['rcp_secondary_member'] ) );
	if ( ! empty( $_POST['rcp_secondary_email'] ) && is_email( $_POST['rcp_secondary_email'] ) ) {
        update_user_meta( $user_id, 'rcp_secondary_email', sanitize_email( $_POST['rcp_secondary_email'] ) );
    }
	// field is not required so empty field is OK
	else {
		update_user_meta( $user_id, 'rcp_secondary_email', sanitize_text_field( $_POST['rcp_secondary_email'] ) );
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
	$columns[ 'secondary_member' ] = 'Secondary Member';
	$columns[ 'secondary_email' ] = 'Secondary Email';
	$columns[ 'join_date' ] = 'Join Date';
	$columns[ 'legacy_member_id' ] = 'Legacy Member ID';
	$columns[ 'rcp_251_legacy_user_id' ] = 'Legacy User ID';

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
	$data[ 'secondary_member' ] = get_user_meta( $user_id, 'rcp_secondary_member', true );	
	$data[ 'secondary_email' ] = get_user_meta( $user_id, 'rcp_secondary_email', true );
	$data[ 'join_date' ] = get_user_meta( $user_id, 'rcp_join_date', true );
	$data[ 'legacy_member_id' ] = get_user_meta( $user_id, 'rcp_legacy_member_id', true );
	$data[ 'rcp_251_legacy_user_id' ] = get_user_meta( $user_id, 'rcp_251_legacy_user_id', true );

	/*
	 * This example is for including membership meta data.
	 */
	// $data[ 'my_third_custom_column' ] = rcp_get_membership_meta( $membership->get_id(), 'my_third_meta_key', true );

	return $data;

}
add_filter( 'rcp_export_memberships_get_data_row', 'pw_rcp_add_fields_to_export', 10, 2 );

/**
 * Import custom user fields.
 *
 * @param RCP_Membership $membership Newly created/updated membership object.
 * @param WP_User        $user       User associated with the membership.
 * @param array          $row        Array of data in the current CSV row.
 */
function ag_rcp_import_custom_fields( $membership, $user, $row ) {

	$street_line_1 = $row['rcp_street_line_1'];

	if ( ! empty( $street_line_1 ) ) {
		update_user_meta( $user->ID, 'rcp_street_line_1', sanitize_text_field( $street_line_1 ) );
		rcp_update_membership_meta( $membership->get_id(), 'rcp_street_line_1', sanitize_text_field( $street_line_1 ) );
	}

	$street_line_2 = $row['rcp_street_line_2']; 

	if ( ! empty( $street_line_2 ) ) {
		update_user_meta( $user->ID, 'rcp_street_line_2', sanitize_text_field( $street_line_2 ) );
		rcp_update_membership_meta( $membership->get_id(), 'rcp_street_line_2', sanitize_text_field( $street_line_2 ) );
	}

	$city = $row['rcp_city']; 

	if ( ! empty( $city ) ) {
		update_user_meta( $user->ID, 'rcp_city', sanitize_text_field( $city ) );
		rcp_update_membership_meta( $membership->get_id(), 'rcp_city', sanitize_text_field( $city ) );
	}

	$state = $row['rcp_state']; 

	if ( ! empty( $state ) ) {
		update_user_meta( $user->ID, 'rcp_state', sanitize_text_field( $state ) );
		rcp_update_membership_meta( $membership->get_id(), 'rcp_state', sanitize_text_field( $state ) );
	}

	$zipcode = $row['rcp_zipcode']; 

	if ( ! empty( $zipcode ) ) {
		update_user_meta( $user->ID, 'rcp_zipcode', sanitize_text_field( $zipcode ) );
		rcp_update_membership_meta( $membership->get_id(), 'rcp_zipcode', sanitize_text_field( $zipcode ) );
	}
	
	$country = $row['rcp_country']; 

	if ( ! empty( $country ) ) {
		update_user_meta( $user->ID, 'rcp_country', sanitize_text_field( $country ) );
		rcp_update_membership_meta( $membership->get_id(), 'rcp_country', sanitize_text_field( $country ) );
	}

	$phone_number = $row['rcp_phone_number']; 

	if ( ! empty( $phone_number ) ) {
		update_user_meta( $user->ID, 'rcp_phone_number', sanitize_text_field( $phone_number ) );
		rcp_update_membership_meta( $membership->get_id(), 'rcp_phone_number', sanitize_text_field( $phone_number ) );
	}

	$secondary_member = $row['rcp_secondary_member']; 

	if ( ! empty( $secondary_member ) ) {
		update_user_meta( $user->ID, 'rcp_secondary_member', sanitize_text_field( $secondary_member ) );
		rcp_update_membership_meta( $membership->get_id(), 'rcp_secondary_member', sanitize_text_field( $secondary_member ) );
	}

	$secondary_email = $row['rcp_secondary_email']; 

	if ( ! empty( $secondary_email ) ) {
		update_user_meta( $user->ID, 'rcp_secondary_email', sanitize_text_field( $secondary_email ) );
		rcp_update_membership_meta( $membership->get_id(), 'rcp_secondary_email', sanitize_text_field( $secondary_email ) );
	}

	$legacy_member_id = $row['rcp_legacy_member_id']; 

	if ( ! empty( $legacy_member_id ) ) {
		update_user_meta( $user->ID, 'rcp_legacy_member_id', sanitize_text_field( $legacy_member_id ) );
		rcp_update_membership_meta( $membership->get_id(), 'rcp_legacy_member_id', sanitize_text_field( $legacy_member_id ) );
	}

	$join_date = $row['rcp_join_date'];

	if ( ! empty( $join_date ) ) {
		update_user_meta( $user->ID, 'rcp_join_date', sanitize_text_field( $join_date ) );
		rcp_update_membership_meta( $membership->get_id(), 'rcp_join_date', sanitize_text_field( $join_date ) );
	}
	$legacy_user_id = $row['rcp_251_legacy_user_id'];

	if ( ! empty( $legacy_user_id ) ) {
		update_user_meta( $user->ID, 'rcp_251_legacy_user_id', sanitize_text_field( $legacy_user_id ) );
		rcp_update_membership_meta( $membership->get_id(), 'rcp_251_legacy_user_id', sanitize_text_field( $legacy_user_id ) );
	}
}
add_action( 'rcp_csv_import_membership_processed', 'ag_rcp_import_custom_fields', 10, 3 );

// /**
//  * Credit signup fee on membership upgrade
//  *
//  * @param RCP_Registration $registration
//  *
//  * @return void
//  */
// function rcp_credit_signup_fee_on_upgrade( $registration ) {
	
// 	if ( ! in_array( $registration->get_registration_type(), array( 'upgrade', 'downgrade' ) ) ) {
// 			return;
// 	}

// 	// $signup_fee = 0;
// 	// return $signup_fee;
// 	add_filter( 'rcp_apply_signup_fee_to_registration', false, 10 );
// }

// add_action( 'rcp_registration_init', 'rcp_credit_signup_fee_on_upgrade');

/**
 * Add prorate credit to member registration
 *
 * @param RCP_Registration $registration
 *
 * @since 2.5
 * @return void
 */
function rcp_add_prorate_signup_fee( $registration ) {
	
	if ( ! in_array( $registration->get_registration_type(), array( 'upgrade', 'downgrade' ) ) ) {
		return;
	}

	$signup_fee = $registration->get_signup_fees();

	$registration->add_fee( -1 * $signup_fee, __( 'Returning Member Discount', 'rcp' ), false, true );

	rcp_log( sprintf( 'Adding %.2f proration credits to registration for user #%d.', $signup_fee, get_current_user_id() ) );
}

add_action( 'rcp_registration_init', 'rcp_add_prorate_signup_fee' );
// add_filter( 'rcp_apply_signup_fee_to_registration', 'rcp_credit_signup_fee_on_upgrade' );
/**
 * Plugin Name: Restrict Content Pro - End-of-Month Expiration Dates
 * Description: Forces expiration dates to always be set to the end of the month.
 * Version: 1.0
 * Author: Sandhills Development, LLC
 * Author URI: https://sandhillsdev.com
 * License: GPL2
 */

/**
 * Forces expiration dates to always be set to the end of the month.
 *
 * NOTE: Changing the calculated expiration date does not change the renewal date
 * with the gateway, so using this alongside automatic renewals is not recommended.
 *
 * @param string     $expiration Calculated expiration date in MySQL format or 'none'.
 * @param int        $user_id    ID of the user the expiration date is being calculated for.
 * @param RCP_Member $member     Member object.
 *
 * @return string Modified expiration date.
 */
function ag_rcp_end_of_month_expiration( $expiration, $user_id, $member ) {
	// Don't make any changes if the expiration date is 'none'.
	if ( 'none' == $expiration ) {
		return $expiration;
		
	}
	/**
	 * Example #1: End of month based on already calculated expiration
	 *
	 * This example forces the expiration date to use the end of *calculated* month.
	 * So if a user signs up for a one-month subscription on July 15th 2017, the regular
	 * expiration date would be August 15th 2017, and this snippet would change that to
	 * August 31st 2017.
	 */
	$new_expiration_date = date( 'Y-m-t 23:59:59', strtotime( $expiration ) );
	return $new_expiration_date;

}
// for renewals
add_filter( 'rcp_membership_calculated_expiration_date', 'ag_rcp_end_of_month_expiration', 10, 3 );
// for signups and upgrades
add_filter( 'rcp_calculate_membership_level_expiration', 'ag_rcp_end_of_month_expiration', 10, 3 );

/***
 * redirect to home page after logout
 */

add_action('wp_logout','ps_redirect_after_logout');
function ps_redirect_after_logout(){
	$site_url = get_site_url();
	wp_redirect( $site_url );
	exit();
}
function fs_leaflet_loaded() {
	$towns_visited_array = [];
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
			$towns_visited_array[$i]['lat']= $lat;
			$towns_visited_array[$i]['lon']= $lon;
		}
		$i++;
	} 
	wp_enqueue_script('full_screen_leaflet', 'https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js', Array('wp_leaflet_map'), '1.0', true);
  	wp_enqueue_style('full_screen_leaflet_styles', 'https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css');

	wp_enqueue_script('member_map_js', get_theme_file_uri( '/js/member-map.js', Array('wp_leaflet_map'), '1.0', true ));

	$data_to_send = array(
	'towns_visited_array' => $towns_visited_array,
	);
	wp_add_inline_script( 'member_map_js', 'var data_to_send = ' . wp_json_encode( $data_to_send ), 'before' );
}
add_action('leaflet_map_loaded', 'fs_leaflet_loaded');