<form action="" method="post">
    <div class="fields">
        <div class="field__group">
            <label for="login_email"><?php esc_html_e( 'Email', 'tracking' ); ?></label>
            <input id="login_email" type="email" name="login_email" required="required"
                   value="<?php echo tracking_field_is_empty_post( 'login_email' ); ?>">
	        <?php tracking_field_errors( 'login_email' ); ?>
        </div>
        <div class="field__group">
            <label for="login_password"><?php esc_html_e( 'Password', 'tracking' ); ?></label>
            <input id="login_password" type="password" name="login_password" required="required" minlength="6"
                   value="<?php echo tracking_field_is_empty_post( 'login_password' ); ?>">
	        <?php tracking_field_errors( 'login_password' ); ?>
        </div>
        <div class="field__group">
            <input type="submit" value="<?php esc_html_e( 'Submit', 'tracking' ); ?>">
        </div>
    </div>
	<?php wp_nonce_field( 'login', 'tracking_action' ); ?>
    <input type="hidden" name="tracking_action_hidden" value="login">
</form>