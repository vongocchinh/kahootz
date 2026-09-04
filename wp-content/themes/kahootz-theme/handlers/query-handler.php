<?php
/**
 * Common Query Functions for Kahootz Theme
 * Useful for reusing WP_Query calls across multiple templates.
 */

/**
 * Get all services
 * 
 * @return WP_Query
 */
function kahootz_get_services($posts_per_page = -1) {
	return new WP_Query(array(
		'post_type'      => 'service',
		'posts_per_page' => $posts_per_page,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'title'      => 'ASC'
		)
	));
}

/**
 * Get insights (blog posts)
 * 
 * @param int $posts_per_page
 * @param string $category_slug
 * @return WP_Query
 */
function kahootz_get_insights($posts_per_page = 9, $category_slug = '') {
	$args = array(
		'post_type'      => 'insight',
		'posts_per_page' => $posts_per_page,
		'post_status'    => 'publish',
		'orderby'        => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC'
		)
	);
	
	if ( ! empty( $category_slug ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'insight_category',
				'field'    => 'slug',
				'terms'    => $category_slug,
			),
		);
	}
	
	return new WP_Query($args);
}

/**
 * Get case studies (work)
 * 
 * @param int $posts_per_page
 * @return WP_Query
 */
function kahootz_get_case_studies($posts_per_page = -1) {
	return new WP_Query(array(
		'post_type'      => 'case_study',
		'posts_per_page' => $posts_per_page,
		'post_status'    => 'publish',
		'orderby'        => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC'
		)
	));
}

/**
 * Get testimonials
 * 
 * @param int $posts_per_page
 * @return WP_Query
 */
function kahootz_get_testimonials($posts_per_page = -1) {
	return new WP_Query(array(
		'post_type'      => 'testimonial',
		'posts_per_page' => $posts_per_page,
		'post_status'    => 'publish',
		'orderby'        => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC'
		)
	));
}

/**
 * Get insight categories
 * 
 * @param bool $hide_empty
 * @return array|int|WP_Error
 */
function kahootz_get_insight_categories( $hide_empty = true ) {
	return get_terms( array(
		'taxonomy'   => 'insight_category',
		'hide_empty' => $hide_empty,
	) );
}

/**
 * Get insight categories for a specific post
 * 
 * @param int $post_id
 * @return array|WP_Error|false
 */
function kahootz_get_post_insight_categories( $post_id ) {
	return get_the_terms( $post_id, 'insight_category' );
}
