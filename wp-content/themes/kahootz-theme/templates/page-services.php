<?php
/**
 * Template Name: Services Overview
 */
get_header();

$services_query = kahootz_get_services();

// Icon map per service title keyword
$service_icons = [
    'social' => 'ph-chart-line-up',
    'seo' => 'ph-magnifying-glass',
    'search' => 'ph-magnifying-glass',
    'paid' => 'ph-currency-circle-dollar',
    'advertising' => 'ph-currency-circle-dollar',
    'website' => 'ph-browser',
    'design' => 'ph-browser',
    'growth' => 'ph-rocket-launch',
    'partner' => 'ph-rocket-launch',
];

function kahootz_service_icon($title, $map)
{
    $title_lower = strtolower($title);
    foreach ($map as $keyword => $icon) {
        if (strpos($title_lower, $keyword) !== false) {
            return $icon;
        }
    }
    return 'ph-star';
}
?>

<main class="bg-[#040814] min-h-screen relative">

    <!-- ════════════════════════════════
         HERO
    ═══════════════════════════════════ -->
    <section class="relative pt-16 pb-24 overflow-hidden border-b border-white/5">
        <!-- top accent line -->
        <div class="hidden top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#FF6A00]/50 to-transparent">
        </div>
        <!-- glow -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 max-md:hidden  w-[800px] h-[500px] bg-[#FF6A00]/5 rounded-full blur-[140px] pointer-events-none">
        </div>

        <div class="container-layout max-w-5xl  relative z-10 text-center">
            <div
                class="inline-flex items-center gap-2 bg-[#FF6A00]/10 border border-[#FF6A00]/20 text-[#FF6A00] font-body text-[10px] font-bold uppercase tracking-[0.25em] px-5 py-2.5 rounded-full mb-10">
                <span class="w-1.5 h-1.5 rounded-full bg-[#FF6A00] animate-pulse"></span>
                What We Do
            </div>

            <h1
                class="font-display font-black text-5xl md:text-6xl lg:text-7xl text-white leading-[0.9] tracking-tight mb-8">
                Everything your business<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6A00] to-[#FF8C00]">needs to grow
                    online.</span>
            </h1>

            <p class="font-body text-lg md:text-xl text-slate-400 leading-relaxed max-w-3xl mx-auto mb-4">
                One team. Every channel. No guesswork.
            </p>
            <p class="font-body text-base md:text-lg text-slate-500 leading-relaxed max-w-3xl mx-auto mb-12">
                We combine UK &amp; European strategists, a skilled Thailand-based delivery team, and AI built into
                every process — so your marketing actually moves as fast as your business needs it to.
            </p>

            <a href="<?php echo esc_url(home_url('/contact')); ?>"
                class="inline-flex items-center gap-3 bg-[#FF6A00] hover:bg-[#FF5500] text-white font-body font-bold text-[12px] uppercase tracking-[0.2em] px-8 py-4 rounded-full transition-all duration-300 hover:shadow-[0_0_30px_rgba(255,106,0,0.35)] hover:-translate-y-0.5">
                <i class="ph-fill ph-chat-circle text-lg"></i> MESSAGE US NOW
            </a>
        </div>
    </section>


    <!-- ════════════════════════════════
         SERVICES GRID
    ═══════════════════════════════════ -->
    <section class="container-layout py-16 relative z-20">

        <?php if ($services_query->have_posts()): ?>
            <div class="swiper page-services-swiper relative z-20">
                <div class="swiper-wrapper">
                    <?php while ($services_query->have_posts()):
                        $services_query->the_post();
                        $subtitle = get_post_meta(get_the_ID(), 'hero_subtitle', true);
                        $starting_price = get_post_meta(get_the_ID(), 'starting_price', true);
                        $service_icon = get_post_meta(get_the_ID(), 'service_icon', true);
                        $icon_class = kahootz_service_icon(get_the_title(), $service_icons);
                        ?>
                        <div class="swiper-slide h-auto">
                            <article
                                class="group bg-[#0A101F] border border-white/8 rounded-2xl p-6 flex flex-col hover:border-[#FF6A00]/40 transition-all duration-300 h-full relative z-20">

                                <!-- Icon -->
                                <div class="w-12 h-12 flex items-center justify-center mb-6 transition-colors duration-300">
                                    <?php if (!empty($service_icon)): ?>
                                        <img src="<?php echo esc_url($service_icon); ?>" alt="<?php the_title(); ?>"
                                            class="w-12 h-12 object-contain">
                                    <?php else: ?>
                                        <i class="ph-bold <?php echo esc_attr($icon_class); ?> text-[#FF6A00] text-xl"></i>
                                    <?php endif; ?>
                                </div>

                                <!-- Title -->
                                <h2
                                    class="font-body font-bold text-base uppercase tracking-[0.18em] text-white mb-3 line-clamp-1">
                                    <?php the_title(); ?>
                                </h2>

                                <!-- Description -->
                                <?php if (!empty($subtitle)): ?>
                                    <p class="font-body text-[13px] text-slate-400 leading-relaxed mb-5 flex-grow line-clamp-2">
                                        <?php echo esc_html($subtitle); ?>
                                    </p>
                                <?php else: ?>
                                    <div class="flex-grow"></div>
                                <?php endif; ?>

                                <!-- Price -->
                                <?php if (!empty($starting_price)): ?>
                                    <p class="font-body text-sm font-bold text-white mb-4"><?php echo esc_html($starting_price); ?>
                                    </p>
                                <?php endif; ?>

                                <!-- Learn More -->
                                <a href="<?php echo esc_url(get_permalink()); ?>"
                                    class="inline-flex items-center gap-1.5 text-[#FF6A00] font-body font-bold text-[11px] uppercase tracking-widest hover:gap-3 transition-all duration-200">
                                    Learn More <i class="ph-bold ph-arrow-right text-xs"></i>
                                </a>
                            </article>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
                <div class="swiper-pagination mt-8 !relative"></div>
            </div>

        <?php else: ?>
            <!-- Fallback static cards -->
            <div class="swiper page-services-swiper relative z-20">
                <div class="swiper-wrapper">
                    <?php
                    $static_services = [
                        ['icon' => 'ph-chart-line-up', 'title' => 'Social Media', 'slug' => 'social-media', 'desc' => 'Content and strategy that actually builds a brand, not just posts.', 'price' => 'From $450 / ฿15,000/mo'],
                        ['icon' => 'ph-magnifying-glass', 'title' => 'SEO + AI Search', 'slug' => 'seo-ai-search', 'desc' => 'Get found on Google. Get found by AI. Most agencies still only do one.', 'price' => 'From $600 / ฿20,000/mo'],
                        ['icon' => 'ph-currency-circle-dollar', 'title' => 'Paid Advertising', 'slug' => 'paid-advertising', 'desc' => 'Every baht tracked. Every click accountable. No wasted spend.', 'price' => 'From $450 / ฿15,000/mo'],
                        ['icon' => 'ph-browser', 'title' => 'Website Design', 'slug' => 'website-design', 'desc' => 'Modern websites built to convert visitors into customers, not just look nice.', 'price' => 'From $1,350 / ฿45,000'],
                        ['icon' => 'ph-rocket-launch', 'title' => 'Growth Partner', 'slug' => 'growth-partner', 'desc' => 'A full marketing team, built around your business, without the overhead.', 'price' => 'From $1,550 / ฿50,000/mo'],
                    ];
                    foreach ($static_services as $svc): ?>
                        <div class="swiper-slide h-auto">
                            <article
                                class="group bg-[#0A101F] border border-white/8 rounded-2xl p-6 flex flex-col hover:border-[#FF6A00]/40 transition-all duration-300 h-full">
                                <div
                                    class="w-12 h-12 rounded-xl bg-[#FF6A00]/10 flex items-center justify-center mb-6 group-hover:bg-[#FF6A00]/20 transition-colors duration-300">
                                    <i class="ph-bold <?php echo esc_attr($svc['icon']); ?> text-[#FF6A00] text-xl"></i>
                                </div>
                                <h2 class="font-body font-bold text-[11px] uppercase tracking-[0.18em] text-white mb-3">
                                    <?php echo esc_html($svc['title']); ?>
                                </h2>
                                <p class="font-body text-[13px] text-slate-400 leading-relaxed mb-5 flex-grow">
                                    <?php echo esc_html($svc['desc']); ?>
                                </p>
                                <p class="font-body text-sm font-bold text-white mb-4"><?php echo esc_html($svc['price']); ?>
                                </p>
                                <a href="<?php echo esc_url(home_url('/' . $svc['slug'])); ?>"
                                    class="inline-flex items-center gap-1.5 text-[#FF6A00] font-body font-bold text-[11px] uppercase tracking-widest hover:gap-3 transition-all duration-200">
                                    Learn More <i class="ph-bold ph-arrow-right text-xs"></i>
                                </a>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination mt-8 !relative"></div>
            </div>
        <?php endif; ?>

        <style>
            .page-services-swiper .swiper-pagination-bullet {
                background-color: #334155;
                /* Slate 700 */
                opacity: 1;
                width: 8px;
                height: 8px;
                margin: 0 6px !important;
                transition: all 0.3s ease;
            }

            .page-services-swiper .swiper-pagination-bullet-active {
                background-color: #FF6A00;
                /* Màu cam chủ đạo */
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                new Swiper('.page-services-swiper', {
                    slidesPerView: 1.2,
                    spaceBetween: 16,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        640: { slidesPerView: 2.2 },
                        1024: { slidesPerView: 3.2 },
                        1280: { slidesPerView: 4, spaceBetween: 16 }
                    }
                });
            });
        </script>

    </section>

    <div class="hidden xl:block xl:col-span-3 rounded-2xl overflow-hidden group absolute bottom-[350px] right-0 z-[1]">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/how-it-works-wolf.png"
            alt="Kahootz Media Wolf" class="w-[500px] h-[500px] object-cover">
    </div>
    <!-- ════════════════════════════════
         CLOSING CTA STRIP
    ═══════════════════════════════════ -->
    <section class="border-t border-white/5 bg-[#0A101F] relative z-20">
        <div class="container-layout  py-20">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-10">
                <div class="text-center lg:text-left">
                    <h2 class="font-display font-bold text-3xl md:text-4xl text-white tracking-tight mb-4">Not sure what
                        you need?</h2>
                    <p class="font-body text-slate-400 text-lg max-w-xl">Tell us where your business is stuck — we'll
                        tell you exactly what will move the needle.</p>
                </div>
                <div class="flex flex-wrap items-center gap-4 flex-shrink-0">
                    <a href="<?php echo esc_url(home_url('/contact')); ?>"
                        class="inline-flex items-center gap-3 bg-[#FF6A00] hover:bg-[#FF5500] text-white font-body font-bold text-[12px] uppercase tracking-[0.2em] px-8 py-4 rounded-full transition-all duration-300 hover:shadow-[0_0_30px_rgba(255,106,0,0.35)]">
                        <i class="ph-fill ph-chat-circle text-lg"></i> MESSAGE US NOW
                    </a>
                    <a href="<?php echo esc_url(home_url('/packages')); ?>"
                        class="inline-flex items-center gap-2 border border-white/10 hover:border-[#FF6A00]/40 text-white/60 hover:text-[#FF6A00] font-body font-bold text-[12px] uppercase tracking-[0.2em] px-8 py-4 rounded-full transition-all duration-300">
                        View Packages <i class="ph-bold ph-arrow-right text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Trust bar -->
            <div
                class="mt-12 pt-10 border-t border-white/5 flex flex-wrap items-center justify-center lg:justify-start gap-8 text-white/30 font-body text-sm">
                <span class="flex items-center gap-2"><i class="ph-bold ph-lightning text-[#FF6A00]"></i> Fast
                    response</span>
                <span class="flex items-center gap-2"><i class="ph-bold ph-check-circle text-[#FF6A00]"></i> No lock-in
                    contracts</span>
                <span class="flex items-center gap-2"><i class="ph-bold ph-currency-dollar text-[#FF6A00]"></i>
                    Transparent pricing</span>
                <span class="flex items-center gap-2"><i class="ph-bold ph-target text-[#FF6A00]"></i> Results
                    focused</span>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>