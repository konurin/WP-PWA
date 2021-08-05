<?php
global $tasks;

$my_tasks_query = $tasks->my_by_status( 'in_progress' );
?>
<div class="tasks">
    <div class="tasks__heading">
        <div class="status__label in_progress">
			<?php esc_html_e( 'In progress', 'tracking' ); ?>
        </div>
    </div>
    <div class="tasks__inner">
		<?php if ( ! empty( $my_tasks_query->posts ) ) : ?>
			<?php foreach ( $my_tasks_query->posts as $key => $task ):
				$task_title = $task->post_title;
				$task_status = get_field( 'status', $task->ID );
				$task_status_val = $task_status['value'];
				$task_status_label = $task_status['label'];
				?>
                <div class="tasks__task <?php echo $task_status_val; ?>">
                    <div class="tasks__task__heading">
                        <div class="tasks__task__title">
							<?php echo esc_html( $task->post_title ); ?>
                        </div>
                        <div class="tasks__task__actions">
                            <a href="<?php echo esc_url( get_permalink( $task->ID ) ); ?>"
                               class="tasks__task__action view"><?php esc_html_e( 'View', 'tracking' ); ?></a>
                            <a href="<?php echo esc_url( get_permalink( $task->ID ) . '?mode=edit' ); ?>"
                               class="tasks__task__action edit">Edit</a>
                            <a href="#" class="tasks__task__action delete">Delete</a>
                        </div>
                    </div>
                </div>
			<?php endforeach; ?>
		<?php else: ?>
            <div class="message">
                <div class="message__inner">
					<?php esc_html_e( 'There are no tasks here.', 'tracking' ); ?>
                </div>
            </div>
		<?php endif; ?>
    </div>
</div>



