<?php
/**
 * The main template file
 *
 */

get_header();
?>

    <div class="container">
		<?php if ( is_user_logged_in() ): ?>
			<?php get_template_part( 'template-parts/tasks/open' ); ?>
			<?php get_template_part( 'template-parts/tasks/in-progress' ); ?>
			<?php get_template_part( 'template-parts/tasks/done' ); ?>
	    <?php else: ?>
            <?php get_template_part( 'template-parts/auth' ); ?>
		<?php endif; ?>
    </div>

<?php
get_footer();
