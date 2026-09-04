<?php
/**
 * Register Custom Taxonomies for Kahootz Theme
 */

function kahootz_register_custom_taxonomies() {
	// Add new taxonomy for Insights, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Insight Categories', 'taxonomy general name', 'kahootz' ),
		'singular_name'     => _x( 'Insight Category', 'taxonomy singular name', 'kahootz' ),
		'search_items'      => __( 'Search Insight Categories', 'kahootz' ),
		'all_items'         => __( 'All Insight Categories', 'kahootz' ),
		'parent_item'       => __( 'Parent Insight Category', 'kahootz' ),
		'parent_item_colon' => __( 'Parent Insight Category:', 'kahootz' ),
		'edit_item'         => __( 'Edit Insight Category', 'kahootz' ),
		'update_item'       => __( 'Update Insight Category', 'kahootz' ),
		'add_new_item'      => __( 'Add New Insight Category', 'kahootz' ),
		'new_item_name'     => __( 'New Insight Category Name', 'kahootz' ),
		'menu_name'         => __( 'Categories', 'kahootz' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'insights' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'insight_category', array( 'insight' ), $args );
}
add_action( 'init', 'kahootz_register_custom_taxonomies', 0 );
