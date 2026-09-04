<?php
/**
 * Handle Contact Form Submission
 */
function kahootz_handle_contact_form() {
	if ( ! isset( $_POST['contact_nonce'] ) || ! wp_verify_nonce( $_POST['contact_nonce'], 'contact_form_nonce' ) ) {
		wp_die( 'Security check failed.' );
	}

	$name        = sanitize_text_field( $_POST['c_name'] ?? '' );
	$email       = sanitize_email( $_POST['c_email'] ?? '' );
	$phone       = sanitize_text_field( $_POST['c_phone'] ?? '' );
	$business    = sanitize_text_field( $_POST['c_business'] ?? '' );
	$looking_for = sanitize_text_field( $_POST['c_looking_for'] ?? '' );
	$message     = sanitize_textarea_field( $_POST['c_message'] ?? '' );

	$post_title = $name . ' - ' . $business;

	// Save to 'contact' CPT as private
	$post_id = wp_insert_post( array(
		'post_title'   => $post_title,
		'post_type'    => 'contact',
		'post_status'  => 'private',
	) );

	if ( ! is_wp_error( $post_id ) ) {
		// Update meta fields to match the Piklist/Pa meta box
		update_post_meta( $post_id, 'contact_email', $email );
		update_post_meta( $post_id, 'contact_phone', $phone );
		update_post_meta( $post_id, 'contact_business', $business );
		update_post_meta( $post_id, 'contact_looking_for', $looking_for );
		update_post_meta( $post_id, 'contact_message', $message );
	}

	$redirect_url = wp_get_referer();
	$redirect_url = add_query_arg( 'status', 'success', $redirect_url );
	wp_redirect( $redirect_url );
	exit;
}
add_action( 'admin_post_nopriv_submit_contact_form', 'kahootz_handle_contact_form' );
add_action( 'admin_post_submit_contact_form', 'kahootz_handle_contact_form' );


