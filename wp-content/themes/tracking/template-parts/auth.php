<?php
$mode = ( isset( $_GET['registration'] ) && ! empty( $_GET['registration'] ) && true === (bool) $_GET['registration'] ) ? 'registration' : 'login';
?>
    <div class="auth-form">
		<?php
		if ( 'registration' === $mode ) {
			get_template_part( 'template-parts/auth/registration' );
		} else {
			get_template_part( 'template-parts/auth/login' );
		}
		?>
    </div>
<?php
