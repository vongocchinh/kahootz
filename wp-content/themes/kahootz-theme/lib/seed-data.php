<?php
/**
 * Seed data for Case Studies and Testimonials
 */

function kahootz_seed_case_studies() {
    if ( get_option( 'kahootz_case_studies_seeded' ) ) {
        return;
    }

    $case_studies = [
      [
        'title' => 'Pullman Hotels & Resorts',
        'service' => 'SEO & Content Strategy',
        'stat' => '+240%',
        'label' => 'Organic Traffic'
      ],
      [
        'title' => 'Luxury Kitchens',
        'service' => 'Social Media Management',
        'stat' => '+300%',
        'label' => 'Engagement Growth'
      ],
      [
        'title' => 'RE/MAX Thailand',
        'service' => 'Lead Generation',
        'stat' => '+65%',
        'label' => 'Qualified Leads'
      ],
      [
        'title' => 'The Coffee Club',
        'service' => 'Digital PR & Outreach',
        'stat' => '+55%',
        'label' => 'Conversions'
      ]
    ];

    foreach ( $case_studies as $index => $c ) {
        $post_id = wp_insert_post( [
            'post_title'   => $c['title'],
            'post_type'    => 'case_study',
            'post_status'  => 'publish',
            'menu_order'   => $index,
        ] );

        if ( ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, 'service_provided', $c['service'] );
            update_post_meta( $post_id, 'result_metric', $c['stat'] . ' ' . $c['label'] );
        }
    }

    update_option( 'kahootz_case_studies_seeded', true );
}
add_action( 'after_switch_theme', 'kahootz_seed_case_studies' );
if ( isset( $_GET['seed_data'] ) && is_admin() ) {
    add_action( 'admin_init', 'kahootz_seed_case_studies' );
}

function kahootz_seed_testimonials() {
    if ( get_option( 'kahootz_testimonials_seeded' ) ) {
        return;
    }

    $testimonials = [
      [
        'text' => 'Kahootz Media completely redesigned our website and our enquiries have increased significantly. Professional, responsive and easy to work with.',
        'name' => 'Jason Loftus',
        'company' => 'Sunseeker Asia'
      ],
      [
        'text' => 'Their SEO and content strategy has made a huge difference to our organic traffic and bookings. Highly recommend the team.',
        'name' => 'Tom Eames',
        'company' => 'Ocean Marina Yacht Club'
      ],
      [
        'text' => 'Excellent social media management and creative content. They understand our brand and get results month after month.',
        'name' => 'David Cummins',
        'company' => 'The Coffee Club'
      ],
      [
        'text' => 'Great team, great communication and measurable results. Kahootz feels like part of our business.',
        'name' => 'Tay O\'Ran',
        'company' => 'RE/MAX Thailand'
      ]
    ];

    foreach ( $testimonials as $index => $t ) {
        $post_id = wp_insert_post( [
            'post_title'   => $t['name'] . ' - ' . $t['company'],
            'post_content' => $t['text'],
            'post_type'    => 'testimonial',
            'post_status'  => 'publish',
            'menu_order'   => $index,
        ] );

        if ( ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, 'kahootz_client_name', $t['name'] );
            update_post_meta( $post_id, 'kahootz_client_company', $t['company'] );
        }
    }

    update_option( 'kahootz_testimonials_seeded', true );
}
add_action( 'after_switch_theme', 'kahootz_seed_testimonials' );
if ( isset( $_GET['seed_data'] ) && is_admin() ) {
    add_action( 'admin_init', 'kahootz_seed_testimonials' );
}
