<form action="" method="post">
    <div class="fields">
        <div class="field__group">
            <label for="registration_first_name"><?php esc_html_e( 'First Name', 'tracking' ); ?></label>
            <input id="registration_first_name" type="text" name="registration_first_name" required="required"
                   value="<?php echo tracking_field_is_empty_post( 'registration_first_name' ); ?>">
			<?php tracking_field_errors( 'registration_first_name' ); ?>
        </div>
        <div class="field__group">
            <label for="registration_last_name"><?php esc_html_e( 'Last Name', 'tracking' ); ?></label>
            <input id="registration_last_name" type="text" name="registration_last_name" required="required"
                   value="<?php echo tracking_field_is_empty_post( 'registration_last_name' ); ?>">
			<?php tracking_field_errors( 'registration_last_name' ); ?>
        </div>
        <div class="field__group">
            <label for="registration_email"><?php esc_html_e( 'Email', 'tracking' ); ?></label>
            <input id="registration_email" type="email" name="registration_email" required="required"
                   value="<?php echo tracking_field_is_empty_post( 'registration_email' ); ?>">
			<?php tracking_field_errors( 'registration_email' ); ?>
        </div>
        <div class="field__group">
            <label for="registration_password"><?php esc_html_e( 'Password', 'tracking' ); ?></label>
            <input id="registration_password" type="password" name="registration_password" minlength="6"
                   required="required"
                   value="<?php echo tracking_field_is_empty_post( 'registration_password' ); ?>">
			<?php tracking_field_errors( 'registration_password' ); ?>
        </div>
        <div class="field__group">
            <input type="submit" value="<?php esc_html_e( 'Submit', 'tracking' ); ?>">
        </div>
    </div>
	<?php wp_nonce_field( 'registration', 'tracking_action' ); ?>
    <input type="hidden" name="tracking_action_hidden" value="registration">
</form>