<?php
/**
 * Single Template for Services — Premium Editorial
 */
get_header();

// Fetch all meta fields
$subtitle       = get_post_meta( get_the_ID(), 'hero_subtitle', true );
$service_icon   = get_post_meta( get_the_ID(), 'service_icon', true );
$included_raw   = get_post_meta( get_the_ID(), 'whats_included', true );
$why_it_matters = get_post_meta( get_the_ID(), 'why_it_matters', true );
$pricing_raw    = get_post_meta( get_the_ID(), 'pricing_tiers', true );
$starting_price = get_post_meta( get_the_ID(), 'starting_price', true );

// Parse What's Included
$included_items = [];
if ( ! empty( $included_raw ) && is_array( $included_raw ) ) {
    foreach ( $included_raw as $row ) {
        if ( ! empty( $row['item'] ) ) $included_items[] = $row['item'];
    }
}

// Parse Pricing tiers
$pricing_tiers = [];
if ( ! empty( $pricing_raw ) && is_array( $pricing_raw ) ) {
    foreach ( $pricing_raw as $row ) {
        if ( ! empty( $row['tier_name'] ) ) $pricing_tiers[] = $row;
    }
}

// Icon fallback map
$icon_map = [
    'social'      => 'ph-chart-line-up',
    'seo'         => 'ph-magnifying-glass',
    'search'      => 'ph-magnifying-glass',
    'paid'        => 'ph-currency-circle-dollar',
    'advertising' => 'ph-currency-circle-dollar',
    'website'     => 'ph-browser',
    'design'      => 'ph-browser',
    'growth'      => 'ph-rocket-launch',
    'partner'     => 'ph-rocket-launch',
];
$icon_class = 'ph-star';
$title_lower = strtolower( get_the_title() );
foreach ( $icon_map as $kw => $ic ) {
    if ( strpos( $title_lower, $kw ) !== false ) { $icon_class = $ic; break; }
}
?>

<main class="bg-[#040814] pb-8">
<?php while ( have_posts() ) : the_post(); ?>

    <!-- ═══════════════════════════════
         HERO
    ════════════════════════════════ -->
    <section class="relative pt-16 pb-8 overflow-hidden border-b border-white/5">
        <div class="hidden top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#FF6A00]/50 to-transparent"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 max-md:hidden  w-[900px] h-[500px] bg-[#FF6A00]/5 rounded-full blur-[160px] pointer-events-none"></div>

        <div class="container-layout px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-4xl">

                <!-- Breadcrumb -->
                <nav class="flex items-center gap-2 font-body text-[11px] uppercase tracking-widest text-white/30 mb-10">
                    <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-[#FF6A00] transition-colors">Home</a>
                    <i class="ph-bold ph-caret-right text-[9px]"></i>
                    <a href="<?php echo esc_url( home_url('/services') ); ?>" class="hover:text-[#FF6A00] transition-colors">Services</a>
                    <i class="ph-bold ph-caret-right text-[9px]"></i>
                    <span class="text-white/50"><?php the_title(); ?></span>
                </nav>

                <!-- Icon + label row -->
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-14 h-14 rounded-2xl bg-[#FF6A00]/10 border border-[#FF6A00]/20 flex items-center justify-center flex-shrink-0">
                        <?php if ( ! empty( $service_icon ) ) : ?>
                            <img src="<?php echo esc_url( $service_icon ); ?>" alt="<?php the_title(); ?>" class="w-8 h-8 object-contain">
                        <?php else : ?>
                            <i class="ph-bold <?php echo esc_attr( $icon_class ); ?> text-[#FF6A00] text-2xl"></i>
                        <?php endif; ?>
                    </div>
                    <span class="font-body text-[11px] font-bold uppercase tracking-[0.25em] text-[#FF6A00]">Service</span>
                </div>

                <!-- Title -->
                <h1 class="font-display font-black text-5xl md:text-6xl lg:text-7xl text-white leading-[0.9] tracking-tight mb-6">
                    <?php the_title(); ?>
                </h1>

                <!-- Subtitle -->
                <?php if ( ! empty( $subtitle ) ) : ?>
                <p class="font-body text-xl md:text-2xl text-slate-400 leading-relaxed max-w-3xl mb-10">
                    <?php echo esc_html( $subtitle ); ?>
                </p>
                <?php endif; ?>

                <!-- CTAs -->
                <div class="flex flex-wrap items-center gap-4">
                    <a href="<?php echo esc_url( home_url('/contact') ); ?>"
                       class="inline-flex items-center gap-3 bg-[#FF6A00] hover:bg-[#FF5500] text-white font-body font-bold text-[12px] uppercase tracking-[0.2em] px-8 py-4 rounded-full transition-all duration-300 hover:shadow-[0_0_30px_rgba(255,106,0,0.35)] hover:-translate-y-0.5">
                        <i class="ph-fill ph-chat-circle text-lg"></i> MESSAGE US NOW
                    </a>
                    <a href="<?php echo esc_url( home_url('/packages') ); ?>"
                       class="inline-flex items-center gap-3 border border-white/15 hover:border-[#FF6A00]/40 text-white/70 hover:text-[#FF6A00] font-body font-bold text-[12px] uppercase tracking-[0.2em] px-8 py-4 rounded-full transition-all duration-300">
                        View Packages <i class="ph-bold ph-arrow-right text-sm"></i>
                    </a>
                </div>

            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════
         WHAT'S INCLUDED + WHY IT MATTERS
    ════════════════════════════════ -->
    <section class="container-layout px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 xl:gap-20">

            <!-- What's Included -->
            <?php if ( ! empty( $included_items ) ) : ?>
            <div>
                <div class="flex items-center gap-4 mb-10">
                    <span class="h-px w-10 bg-[#FF6A00]"></span>
                    <span class="font-body text-[11px] font-bold uppercase tracking-[0.25em] text-[#FF6A00]">What's Included</span>
                </div>
                <ul class="space-y-5">
                    <?php foreach ( $included_items as $item ) : ?>
                    <li class="flex items-start gap-5">
                        <div class="w-6 h-6 rounded-full bg-[#FF6A00]/10 border border-[#FF6A00]/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="ph-bold ph-check text-[#FF6A00] text-xs"></i>
                        </div>
                        <span class="font-body text-[16px] text-slate-300 leading-relaxed"><?php echo esc_html( $item ); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Why It Matters -->
            <?php if ( ! empty( $why_it_matters ) ) : ?>
            <div>
                <div class="flex items-center gap-4 mb-10">
                    <span class="h-px w-10 bg-[#FF6A00]"></span>
                    <span class="font-body text-[11px] font-bold uppercase tracking-[0.25em] text-[#FF6A00]">Why It Matters</span>
                </div>
                <div class="font-body text-[16px] text-slate-300 leading-[1.9]
                    [&_p]:mb-5 [&_strong]:text-white [&_strong]:font-semibold
                    [&_ul]:space-y-3 [&_ul]:my-6 [&_ul_li]:pl-5 [&_ul_li]:relative
                    [&_ul_li]:before:absolute [&_ul_li]:before:left-0 [&_ul_li]:before:top-[0.6em] [&_ul_li]:before:w-1.5 [&_ul_li]:before:h-1.5 [&_ul_li]:before:rounded-full [&_ul_li]:before:bg-[#FF6A00]">
                    <?php echo wpautop( wp_kses_post( $why_it_matters ) ); ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </section>


    <!-- ═══════════════════════════════
         PRICING TABLE
    ════════════════════════════════ -->
    <?php if ( ! empty( $pricing_tiers ) ) : ?>
    <section class="border-t border-white/5 bg-[#0A101F]">
        <div class="container-layout px-4 sm:px-6 lg:px-8 py-8">

            <div class="flex items-center gap-4 mb-14">
                <span class="h-px w-10 bg-[#FF6A00]"></span>
                <span class="font-body text-[11px] font-bold uppercase tracking-[0.25em] text-[#FF6A00]">Pricing</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-<?php echo min( count( $pricing_tiers ), 3 ); ?> gap-6">
                <?php foreach ( $pricing_tiers as $i => $tier ) :
                    $is_middle = ( count( $pricing_tiers ) === 3 && $i === 1 );
                ?>
                <div class="relative rounded-2xl border <?php echo $is_middle ? 'border-[#FF6A00]/50 bg-gradient-to-b from-[#FF6A00]/8 to-[#0A101F]' : 'border-white/8 bg-[#040814]'; ?> p-8 flex flex-col">

                    <?php if ( $is_middle ) : ?>
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-[#FF6A00] text-white font-body font-bold text-[10px] uppercase tracking-widest px-4 py-1.5 rounded-full">
                        Most Popular
                    </div>
                    <?php endif; ?>

                    <!-- Tier name -->
                    <p class="font-body text-[11px] font-bold uppercase tracking-[0.2em] text-white/40 mb-4">
                        <?php echo esc_html( $tier['tier_name'] ); ?>
                    </p>

                    <!-- Prices -->
                    <div class="mb-6 pb-6 border-b border-white/8">
                        <?php if ( ! empty( $tier['tier_price_thb'] ) ) : ?>
                        <div class="font-display font-black text-3xl text-white tracking-tight leading-none mb-2">
                            <?php echo esc_html( $tier['tier_price_thb'] ); ?>
                        </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $tier['tier_price_usd'] ) ) : ?>
                        <div class="font-body text-sm text-white/40">
                            <?php echo esc_html( $tier['tier_price_usd'] ); ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Best For -->
                    <?php if ( ! empty( $tier['tier_best_for'] ) ) : ?>
                    <p class="font-body text-sm text-slate-400 leading-relaxed flex-grow">
                        <span class="text-white/30 text-[10px] uppercase tracking-widest block mb-2">Best for</span>
                        <?php echo esc_html( $tier['tier_best_for'] ); ?>
                    </p>
                    <?php endif; ?>

                    <!-- CTA -->
                    <a href="<?php echo esc_url( home_url('/contact') ); ?>"
                       class="mt-8 inline-flex items-center justify-center gap-2 <?php echo $is_middle ? 'bg-[#FF6A00] hover:bg-[#FF5500] text-white' : 'border border-white/10 hover:border-[#FF6A00]/40 text-white/60 hover:text-white'; ?> font-body font-bold text-[11px] uppercase tracking-widest px-6 py-3.5 rounded-full transition-all duration-300">
                        Get Started <i class="ph-bold ph-arrow-right text-xs"></i>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Packages link -->
            <div class="mt-12 text-center">
                <a href="<?php echo esc_url( home_url('/packages') ); ?>"
                   class="inline-flex items-center gap-2 text-white/30 hover:text-[#FF6A00] font-body text-[11px] uppercase tracking-widest transition-colors duration-200">
                    View Full Package Details <i class="ph-bold ph-arrow-right text-xs"></i>
                </a>
            </div>

        </div>
    </section>
    <?php endif; ?>


    <!-- ═══════════════════════════════
         BOTTOM CTA
    ════════════════════════════════ -->
    <section class="border-t border-white/5 py-8 md:py-10 relative overflow-hidden">
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[700px] h-[300px] bg-[#FF6A00]/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="container-layout px-4 sm:px-6 lg:px-8 relative text-center">
            <p class="font-body text-[11px] font-bold uppercase tracking-[0.25em] text-[#FF6A00] mb-6">Ready?</p>
            <h2 class="font-display font-black text-4xl md:text-6xl text-white tracking-tight leading-[0.9] mb-10">
                Let's talk about<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6A00] to-[#FF8C00]">your business.</span>
            </h2>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="<?php echo esc_url( home_url('/contact') ); ?>"
                   class="inline-flex items-center gap-3 bg-[#FF6A00] hover:bg-[#FF5500] text-white font-body font-bold text-[12px] uppercase tracking-[0.2em] px-10 py-5 rounded-full transition-all duration-300 hover:shadow-[0_0_40px_rgba(255,106,0,0.35)] hover:-translate-y-0.5">
                    <i class="ph-fill ph-chat-circle text-lg"></i> MESSAGE US NOW
                </a>
                <a href="<?php echo esc_url( home_url('/services') ); ?>"
                   class="inline-flex items-center gap-3 border border-white/10 hover:border-white/25 text-white/50 hover:text-white font-body font-bold text-[12px] uppercase tracking-[0.2em] px-10 py-5 rounded-full transition-all duration-300">
                    <i class="ph-bold ph-arrow-left text-sm"></i> All Services
                </a>
            </div>
        </div>
    </section>

<?php endwhile; ?>
</main>

<?php get_footer(); ?>
