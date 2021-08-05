<?php
/**
 * Template name: Add New Task
 *
 */

get_header();
?>

    <div class="container">
		<?php if ( is_user_logged_in() ): ?>
            <div class="view__actions">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                   class="btn"><?php esc_html_e( 'To main screen', 'tracking' ); ?></a>
            </div>
			<?php acf_form( array(
				'post_title'   => true,
				'post_content' => true,
				'post_id'      => 'new_post',
				'new_post'     => array(
					'post_type'   => 'task',
					'post_status' => 'publish'
				),
				'field_groups' => array( 9 ),
				'return' => home_url('/'),
				'submit_value' => 'Add',
			) ); ?>
		<?php else: ?>
			<?php esc_html_e( 'You are not able to view this page.', 'tracking' ); ?>
		<?php endif; ?>
    </div>

<?php
get_footer();