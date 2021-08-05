<?php
global $tasks, $post;
$fields       = get_field_objects();
$task_title   = get_the_title( $post );
$post_content = $post->post_content;

if ( ! empty( $fields ) ):?>
    <div class="view__actions">
        <a href="<?php echo esc_url( home_url('/') ); ?>" class="btn"><?php esc_html_e('To main screen', 'tracking'); ?></a>
        <a href="<?php echo esc_url(get_permalink($post->ID) . '?mode=edit'); ?>" class="btn">Edit</a>
    </div>
    <div class="fields">
		<?php if ( ! empty( $task_title ) ): ?>
            <div class="field__group">
                <h4 class="value"><?php esc_html_e( $task_title ); ?></h4>
            </div>
		<?php endif; ?>

		<?php if ( ! empty( $post_content ) ): ?>
            <div class="field__group">
                <div class="label"><?php esc_html_e( 'Description', 'tracking' ); ?></div>
                <div class="value"><?php echo apply_filters( 'the_content', $post_content ); ?></div>
            </div>
		<?php endif; ?>

		<?php foreach ( $fields as $field ):
            $field_name = $field['name'];
		    $field_label = $field['label'];
			?>
            <div class="field__group">
                <div class="label"><?php esc_html_e( $field['label'] ); ?></div>
                <div class="value  <?php echo 'status' === $field['name'] ? 'status__label ' . esc_attr( $field['value']['value'] ) : ''; ?>">
					<?php $tasks->view_task_field_value( $field ); ?>
                </div>
            </div>
		<?php endforeach; ?>
    </div>
<?php endif; ?>