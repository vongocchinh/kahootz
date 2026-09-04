<?php
/**
 * Register Custom Post Types for Kahootz Theme
 */

function kahootz_register_custom_post_types() {

	// 1. SERVICES POST TYPE
	// Used for: Social Media, SEO + AI Search, Paid Advertising, Website Design, Growth Partner
	$service_labels = array(
		'name'                  => _x( 'Services', 'Post Type General Name', 'kahootz' ),
		'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'kahootz' ),
		'menu_name'             => __( 'Services', 'kahootz' ),
		'name_admin_bar'        => __( 'Service', 'kahootz' ),
		'archives'              => __( 'Service Archives', 'kahootz' ),
		'attributes'            => __( 'Service Attributes', 'kahootz' ),
		'parent_item_colon'     => __( 'Parent Service:', 'kahootz' ),
		'all_items'             => __( 'All Services', 'kahootz' ),
		'add_new_item'          => __( 'Add New Service', 'kahootz' ),
		'add_new'               => __( 'Add New', 'kahootz' ),
		'new_item'              => __( 'New Service', 'kahootz' ),
		'edit_item'             => __( 'Edit Service', 'kahootz' ),
		'update_item'           => __( 'Update Service', 'kahootz' ),
		'view_item'             => __( 'View Service', 'kahootz' ),
		'view_items'            => __( 'View Services', 'kahootz' ),
		'search_items'          => __( 'Search Service', 'kahootz' ),
		'not_found'             => __( 'Not found', 'kahootz' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'kahootz' ),
	);
	$service_args = array(
		'label'                 => __( 'Service', 'kahootz' ),
		'description'           => __( 'Kahootz Services', 'kahootz' ),
		'labels'                => $service_labels,
		'supports'              => array( 'title', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => true, // Allows parent/child relationship if needed
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-admin-tools',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false, // Services usually have a custom page instead of an archive
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true, // Enable Gutenberg editor
	);
	register_post_type( 'service', $service_args );

	// 2. PACKAGES / PRICING POST TYPE
	// Used for the pricing tiers shown on the Packages page
	$package_labels = array(
		'name'                  => _x( 'Packages', 'Post Type General Name', 'kahootz' ),
		'singular_name'         => _x( 'Package', 'Post Type Singular Name', 'kahootz' ),
		'menu_name'             => __( 'Packages', 'kahootz' ),
		'all_items'             => __( 'All Packages', 'kahootz' ),
		'add_new_item'          => __( 'Add New Package', 'kahootz' ),
		'add_new'               => __( 'Add New', 'kahootz' ),
		'edit_item'             => __( 'Edit Package', 'kahootz' ),
		'update_item'           => __( 'Update Package', 'kahootz' ),
		'view_item'             => __( 'View Package', 'kahootz' ),
		'search_items'          => __( 'Search Package', 'kahootz' ),
	);
	$package_args = array(
		'label'                 => __( 'Package', 'kahootz' ),
		'labels'                => $package_labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 21,
		'menu_icon'             => 'dashicons-cart',
		'has_archive'           => false, // Packages are usually displayed via shortcode/block on the Pricing page
		'show_in_rest'          => true,
	);
	// register_post_type( 'package', $package_args );

	// 3. CASE STUDIES / WORK POST TYPE
	// Used for: Pullman, Hafele, RE/MAX, The Coffee Club, etc.
	$case_study_labels = array(
		'name'                  => _x( 'Case Studies', 'Post Type General Name', 'kahootz' ),
		'singular_name'         => _x( 'Case Study', 'Post Type Singular Name', 'kahootz' ),
		'menu_name'             => __( 'Case Studies', 'kahootz' ),
		'all_items'             => __( 'All Case Studies', 'kahootz' ),
		'add_new_item'          => __( 'Add New Case Study', 'kahootz' ),
		'add_new'               => __( 'Add New', 'kahootz' ),
		'edit_item'             => __( 'Edit Case Study', 'kahootz' ),
		'update_item'           => __( 'Update Case Study', 'kahootz' ),
		'view_item'             => __( 'View Case Study', 'kahootz' ),
		'search_items'          => __( 'Search Case Study', 'kahootz' ),
	);
	$case_study_args = array(
		'label'                 => __( 'Case Study', 'kahootz' ),
		'labels'                => $case_study_labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'taxonomies'            => array( 'category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 22,
		'menu_icon'             => 'dashicons-portfolio',
		'has_archive'           => true,
		'show_in_rest'          => true,
	);
	register_post_type( 'case_study', $case_study_args );

	// 4. INSIGHTS POST TYPE
	// (You could use the default 'post', but registering a separate one for 'Insights' allows for better organization)
	$insight_labels = array(
		'name'                  => _x( 'Insights', 'Post Type General Name', 'kahootz' ),
		'singular_name'         => _x( 'Insight', 'Post Type Singular Name', 'kahootz' ),
		'menu_name'             => __( 'Insights', 'kahootz' ),
		'all_items'             => __( 'All Insights', 'kahootz' ),
		'add_new_item'          => __( 'Add New Insight', 'kahootz' ),
		'add_new'               => __( 'Add New', 'kahootz' ),
		'edit_item'             => __( 'Edit Insight', 'kahootz' ),
		'update_item'           => __( 'Update Insight', 'kahootz' ),
		'view_item'             => __( 'View Insight', 'kahootz' ),
		'search_items'          => __( 'Search Insight', 'kahootz' ),
	);
	$insight_args = array(
		'label'                 => __( 'Insight', 'kahootz' ),
		'labels'                => $insight_labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 23,
		'menu_icon'             => 'dashicons-lightbulb',
		'has_archive'           => true,
		'show_in_rest'          => true,
	);
	register_post_type( 'insight', $insight_args );
	// 5. CONTACTS POST TYPE (For lead generation / form submissions)
	$contact_labels = array(
		'name'                  => _x( 'Contacts / Leads', 'Post Type General Name', 'kahootz' ),
		'singular_name'         => _x( 'Contact', 'Post Type Singular Name', 'kahootz' ),
		'menu_name'             => __( 'Contacts', 'kahootz' ),
		'all_items'             => __( 'All Contacts', 'kahootz' ),
		'add_new_item'          => __( 'Add New Contact', 'kahootz' ),
		'add_new'               => __( 'Add New', 'kahootz' ),
		'edit_item'             => __( 'Edit Contact', 'kahootz' ),
		'update_item'           => __( 'Update Contact', 'kahootz' ),
		'view_item'             => __( 'View Contact', 'kahootz' ),
		'search_items'          => __( 'Search Contact', 'kahootz' ),
	);
	$contact_args = array(
		'label'                 => __( 'Contact', 'kahootz' ),
		'labels'                => $contact_labels,
		'supports'              => array( 'title', 'editor', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => false,  // Not visible on frontend
		'show_ui'               => true,   // Visible in admin
		'show_in_menu'          => true,
		'menu_position'         => 24,
		'menu_icon'             => 'dashicons-email-alt',
		'has_archive'           => false,
		'show_in_rest'          => false,  // Disable Gutenberg for contacts since it's just data
	);
	register_post_type( 'contact', $contact_args );

	// 6. TESTIMONIALS POST TYPE
	$testimonial_labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'kahootz' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'kahootz' ),
		'menu_name'             => __( 'Testimonials', 'kahootz' ),
		'all_items'             => __( 'All Testimonials', 'kahootz' ),
		'add_new_item'          => __( 'Add New Testimonial', 'kahootz' ),
		'add_new'               => __( 'Add New', 'kahootz' ),
		'edit_item'             => __( 'Edit Testimonial', 'kahootz' ),
		'update_item'           => __( 'Update Testimonial', 'kahootz' ),
		'view_item'             => __( 'View Testimonial', 'kahootz' ),
		'search_items'          => __( 'Search Testimonial', 'kahootz' ),
	);
	$testimonial_args = array(
		'label'                 => __( 'Testimonial', 'kahootz' ),
		'labels'                => $testimonial_labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'menu_icon'             => 'dashicons-format-quote',
		'has_archive'           => false,
		'show_in_rest'          => true,
	);
	register_post_type( 'testimonial', $testimonial_args );

}
add_action( 'init', 'kahootz_register_custom_post_types', 0 );
