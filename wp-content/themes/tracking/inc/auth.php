<?php

add_action( 'init', 'tracking_registration_form' );
function tracking_registration_form() {
	if ( isset( $_POST['tracking_action_hidden'] ) && ! empty( $_POST['tracking_action_hidden'] ) && $_POST['tracking_action_hidden'] === 'registration' ) {
		if ( ! empty( $_POST ) && wp_verify_nonce( $_POST['tracking_action'], 'registration' ) ) {
			global $errors;
			$errors   = array();
			$userdata = array(
				'user_pass'  => $_POST['registration_password'],
				'first-name' => esc_attr( $_POST['registration_first_name'] ),
				'surname'    => esc_attr( $_POST['registration_last_name'] ),
				'email'      => esc_attr( $_POST['registration_email'] ),
				'user_login' => esc_attr( $_POST['registration_first_name'] . $_POST['registration_last_name'] . rand( 1000, 9999 ) ),
				'role'       => 'author',
			);

			if ( ! $userdata['first-name'] ) {
				$errors['registration_first_name'] = __( 'First Name incorrect', 'tracking' );
			}

			if ( ! $userdata['surname'] ) {
				$errors['registration_last_name'] = __( 'Last Name incorrect', 'tracking' );
			}

			if ( ! is_email( $userdata['email'] ) ) {
				$errors['registration_email'] = __( 'Email incorrect', 'tracking' );
			} elseif ( email_exists( $userdata['email'] ) ) {
				$errors['registration_email'] = __( 'Sorry, that email address is already in use', 'tracking' );
			}

			if ( empty( $errors ) ) {
				$new_user_id = wp_insert_user( $userdata );
				wp_set_current_user( $new_user_id );
				wp_set_auth_cookie( $new_user_id );
				wp_redirect( home_url() );
				exit;
			}
		}
	}
}

add_action( 'init', 'tracking_login_form' );
function tracking_login_form() {
	if ( isset( $_POST['tracking_action_hidden'] ) && ! empty( $_POST['tracking_action_hidden'] ) && $_POST['tracking_action_hidden'] === 'login' ) {
		if ( ! empty( $_POST ) && wp_verify_nonce( $_POST['tracking_action'], 'login' ) ) {
			global $errors;
			$errors = array();

			$login_email    = $_POST['login_email'];
			$login_password = $_POST['login_password'];

			$credentials = array(
				'user_login'    => $_POST['login_email'],
				'user_password' => esc_attr( $_POST['login_password'] ),
				'remember'      => true
			);

			if ( ! is_email( $login_email ) ) {
				$errors['registration_email'] = __( 'Email incorrect', 'tracking' );
			}

			if ( empty( $errors ) ) {
				$user = wp_signon( $credentials, false );

				if ( is_wp_error( $user ) ) {
					if ( isset( $user->errors['invalid_email'] ) ) {
						$errors['login_email'] = __( 'Email not registered', 'tracking' );
					}

					if ( isset( $user->errors['incorrect_password'] ) ) {
						$errors['login_password'] = __( 'Password incorrect', 'tracking' );
					}
				} else {
					wp_redirect( home_url() );
					exit;
				}


			}
		}
	}
}

function tracking_field_errors( $name ) {
	global $errors;
	if ( isset( $errors[ $name ] ) && ! empty( $errors[ $name ] ) ) {
		echo '<span class="error">' . $errors[ $name ] . '</span>';
	}
}

function tracking_field_is_empty_post( $val ) {
	return ( isset( $_POST[ $val ] ) && ! empty( $_POST[ $val ] ) ) ? $_POST[ $val ] : '';
}