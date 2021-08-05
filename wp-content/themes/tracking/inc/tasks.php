<?php

global $tasks;

class Tasks {
	public function all() {
		$args = array(
			'post_type' => 'task',
			'posts_per_page' => 10
		);

		return new WP_Query($args);
	}

	public function my() {

		$user_id = get_current_user_id();

		$args = array(
			'post_type' => 'task',
			'posts_per_page' => 10,
			'author__in' => array( $user_id )
		);

		return new WP_Query($args);
	}

	public function my_by_status($status = '') {
		$user_id = get_current_user_id();

		$args = array(
			'post_type' => 'task',
			'posts_per_page' => 10,
			'author__in' => array( $user_id ),
			'meta_key' => 'status',
			'meta_value' => $status
		);

		return new WP_Query($args);
	}

	public function view_task_field_value($field) {
		$value = $field['value'];
		$type = $field['type'];

		if ('default' === $type) {
			echo $value;
		} elseif ('select' === $type) {
			echo is_array($value) ? $value['label'] : $value;
		}
	}
}

$tasks = new Tasks();