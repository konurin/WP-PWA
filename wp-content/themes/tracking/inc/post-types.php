<?php

function imp_register_post_types() {

	// register tasks post type.
	register_post_type(
		'task',
		array(
			'label'               => 'Tasks',
			'labels'              => array(
				'name'          => 'Tasks',
				'singular_name' => 'Task',
				'menu_name'     => 'Tasks',
				'all_items'     => 'All tasks',
				'add_new'       => 'Add task',
				'add_new_item'  => 'Add new task',
				'edit'          => 'Edit',
				'edit_item'     => 'Edit task',
				'new_item'      => 'New task',
			),
			'description'         => '',
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_rest'        => false,
			'rest_base'           => '',
			'show_in_menu'        => true,
			'exclude_from_search' => false,
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'hierarchical'        => false,
			'has_archive'         => true,
			'query_var'           => true,
			'supports'            => array( 'title', 'editor', 'author' ),
		)
	);
}

add_action( 'init', 'imp_register_post_types' );

add_action( 'init', 'tracking_form_head' );
function tracking_form_head() {
	if ( ! is_admin() ) {
		acf_form_head();
	}
}