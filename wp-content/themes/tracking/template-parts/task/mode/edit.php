<?php
global $post;

$task_title   = get_the_title( $post );
$post_content = $post->post_content;
?>
    <div class="view__actions">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
           class="btn"><?php esc_html_e( 'To main screen', 'tracking' ); ?></a>
        <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="btn"><?php esc_html_e('View', 'tracking'); ?></a>
    </div>
<?php
acf_form( array(
	'post_title'   => true,
	'post_content' => true,
	'post_id'      => $post->ID,
	'field_groups' => array( 9 ),
	'return'       => get_permalink( $post->ID ) . '?mode=edit',
	'submit_value' => 'Update',
) );