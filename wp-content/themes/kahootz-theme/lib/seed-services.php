<?php
/**
 * Seed data for Services
 */

function kahootz_seed_services() {
    // Check if already seeded to prevent duplicates
    if ( get_option( 'kahootz_services_seeded' ) ) {
        return;
    }

    $services = [
        [
            'title' => 'Social Media',
            'subtitle' => 'Content and strategy that actually builds a brand — not just posts for the sake of posting.',
            'starting_price' => 'From $450 / ฿15,000/mo',
            'why_it_matters' => '<p>Most brands post because they feel like they have to. We post because it moves people closer to buying. Every piece of content has a job to do — build trust, start a conversation, or drive a sale.</p>',
            'whats_included' => [
                ['item' => 'Strategy built around your actual audience, not templates'],
                ['item' => 'Content creation & design — photo, video, and graphics'],
                ['item' => 'Scheduling & publishing across all major platforms'],
                ['item' => 'Monthly performance reporting'],
                ['item' => 'Ongoing optimisation based on what\'s actually working'],
            ],
            'pricing_tiers' => [
                ['tier_name' => 'Starter', 'tier_price_thb' => '฿15,000', 'tier_price_usd' => '$450/mo', 'tier_best_for' => 'Businesses building their presence from scratch'],
                ['tier_name' => 'Growth', 'tier_price_thb' => '฿25,000', 'tier_price_usd' => '$750/mo', 'tier_best_for' => 'Businesses ready to post more often and grow faster'],
                ['tier_name' => 'Pro', 'tier_price_thb' => '฿40,000', 'tier_price_usd' => '$1,200/mo', 'tier_best_for' => 'Businesses that want full content production + paid boosting'],
            ]
        ],
        [
            'title' => 'SEO + AI Search',
            'subtitle' => 'Get found on Google. Get found by AI. Most agencies still only do one.',
            'starting_price' => 'From $600 / ฿20,000/mo',
            'why_it_matters' => '<p>Search is changing. People aren\'t just Googling anymore — they\'re asking AI. If your business isn\'t optimised for both, you\'re invisible to a growing chunk of your market. We make sure you show up in both places.</p>',
            'whats_included' => [
                ['item' => 'Technical SEO audits & fixes'],
                ['item' => 'Keyword strategy built around real buyer intent'],
                ['item' => 'On-page content optimisation'],
                ['item' => 'AI search optimisation (so your business shows up in AI-generated answers, not just search results)'],
                ['item' => 'Monthly reporting & tracking'],
            ],
            'pricing_tiers' => [
                ['tier_name' => 'Starter', 'tier_price_thb' => '฿20,000', 'tier_price_usd' => '$600/mo', 'tier_best_for' => 'Getting your technical foundations right and ranking locally'],
                ['tier_name' => 'Growth', 'tier_price_thb' => '฿35,000', 'tier_price_usd' => '$1,050/mo', 'tier_best_for' => 'Competing seriously for key search terms'],
                ['tier_name' => 'Pro', 'tier_price_thb' => '฿55,000', 'tier_price_usd' => '$1,650/mo', 'tier_best_for' => 'Multi-location or highly competitive industries'],
            ]
        ],
        [
            'title' => 'Paid Advertising',
            'subtitle' => 'Every baht tracked. Every click accountable. No wasted spend.',
            'starting_price' => 'From $450 / ฿15,000/mo',
            'why_it_matters' => '<p>Paid ads without proper management is just an expensive way to find out what doesn\'t work. We manage every campaign like it\'s our own budget — cutting what fails fast, and doubling down on what performs.</p><p><em>(Management fee — ad spend is separate and paid directly to Google/Meta)</em></p>',
            'whats_included' => [
                ['item' => 'Google Ads & Meta Ads management'],
                ['item' => 'Campaign strategy & audience targeting'],
                ['item' => 'Ongoing optimisation — we don\'t "set and forget"'],
                ['item' => 'Full tracking & transparent reporting'],
                ['item' => 'Landing page recommendations to improve conversion'],
            ],
            'pricing_tiers' => [
                ['tier_name' => 'Starter', 'tier_price_thb' => '฿15,000', 'tier_price_usd' => '$450/mo', 'tier_best_for' => 'Ad budgets up to ฿50,000/mo'],
                ['tier_name' => 'Growth', 'tier_price_thb' => '฿25,000', 'tier_price_usd' => '$750/mo', 'tier_best_for' => 'Ad budgets ฿50,000–150,000/mo'],
                ['tier_name' => 'Pro', 'tier_price_thb' => '฿40,000', 'tier_price_usd' => '$1,200/mo', 'tier_best_for' => 'Ad budgets ฿150,000+/mo, multi-platform campaigns'],
            ]
        ],
        [
            'title' => 'Website Design',
            'subtitle' => 'Modern websites built to convert visitors into customers — not just look nice.',
            'starting_price' => 'From $1,350 / ฿45,000',
            'why_it_matters' => '<p>Your website is often the first real impression a customer has of your business. If it\'s slow, outdated, or confusing, you\'re losing customers before you even get the chance to make your case.</p><p><em>All website projects are scoped and quoted individually — the above are starting points.</em></p>',
            'whats_included' => [
                ['item' => 'Custom design — no generic templates'],
                ['item' => 'Mobile-first, fast-loading builds'],
                ['item' => 'Built with SEO & conversion in mind from day one'],
                ['item' => 'Easy content management so you\'re never stuck waiting on a developer'],
                ['item' => 'Ongoing support available'],
            ],
            'pricing_tiers' => [
                ['tier_name' => 'Essential Site', 'tier_price_thb' => '฿45,000', 'tier_price_usd' => '$1,350', 'tier_best_for' => 'Small business, up to 5 pages'],
                ['tier_name' => 'Business Site', 'tier_price_thb' => '฿85,000', 'tier_price_usd' => '$2,550', 'tier_best_for' => 'Growing business, up to 10 pages, blog/insights section'],
                ['tier_name' => 'Custom / E-commerce', 'tier_price_thb' => '฿150,000', 'tier_price_usd' => '$4,500', 'tier_best_for' => 'Larger sites, online stores, custom functionality'],
            ]
        ],
        [
            'title' => 'Growth Partner',
            'subtitle' => 'A complete marketing team, built around your business — without the overhead of hiring one.',
            'starting_price' => 'From $1,550 / ฿50,000/mo',
            'why_it_matters' => '<p>Businesses that are serious about growth and want one accountable team running everything — instead of piecing together freelancers, in-house hires, and disconnected agencies.</p><p><em>Ad spend and any paid media budgets are separate from the management fee.</em></p>',
            'whats_included' => [
                ['item' => 'Social media, SEO, paid advertising & content — all under one roof'],
                ['item' => 'AI-powered strategy, research & automation'],
                ['item' => 'A dedicated senior marketing lead overseeing your account'],
                ['item' => 'Monthly strategy calls & full transparent reporting'],
                ['item' => 'Priority response & support'],
            ],
            'pricing_tiers' => [
                ['tier_name' => 'Growth Partner', 'tier_price_thb' => '฿50,000', 'tier_price_usd' => '$1,550/mo', 'tier_best_for' => 'Businesses ready to hand off marketing entirely'],
                ['tier_name' => 'Growth Partner Plus', 'tier_price_thb' => '฿85,000', 'tier_price_usd' => '$2,550/mo', 'tier_best_for' => 'Larger businesses needing higher output & multi-market reach'],
            ]
        ]
    ];

    foreach ( $services as $index => $s ) {
        $post_id = wp_insert_post( [
            'post_title'   => $s['title'],
            'post_type'    => 'service',
            'post_status'  => 'publish',
            'menu_order'   => $index,
        ] );

        if ( ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, 'hero_subtitle', $s['subtitle'] );
            update_post_meta( $post_id, 'starting_price', $s['starting_price'] );
            update_post_meta( $post_id, 'why_it_matters', $s['why_it_matters'] );
            update_post_meta( $post_id, 'whats_included', $s['whats_included'] );
            update_post_meta( $post_id, 'pricing_tiers', $s['pricing_tiers'] );
        }
    }

    update_option( 'kahootz_services_seeded', true );
}
add_action( 'after_switch_theme', 'kahootz_seed_services' );

// Fallback: Run manually if accessed via ?seed_services=1 in WP Admin
if ( isset( $_GET['seed_services'] ) && is_admin() ) {
    add_action( 'admin_init', 'kahootz_seed_services' );
}
