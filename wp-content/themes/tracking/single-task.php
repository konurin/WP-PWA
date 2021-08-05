<?php
get_header();
global $post;
$mode = ( isset( $_GET['mode'] ) && ! empty( $_GET['mode'] ) ) ? $_GET['mode'] : 'view';
?>

    <div class="container">
		<?php
		if ( 'edit' === $mode ) {
			get_template_part( 'template-parts/task/mode/edit' );
		} else if ( 'view' === $mode ) {
			get_template_part( 'template-parts/task/mode/view' );
		}
		?>
    </div>

<?php
get_footer();
