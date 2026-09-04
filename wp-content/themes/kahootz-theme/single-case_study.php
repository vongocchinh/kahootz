<?php
/**
 * Single Template for Case Studies — Premium Editorial Design
 */
get_header();

// Fetch custom fields from PA (Piklist) meta boxes
$service_type  = get_post_meta( get_the_ID(), 'service_provided', true );
$result_metric = get_post_meta( get_the_ID(), 'result_metric', true );
$challenge     = get_post_meta( get_the_ID(), 'challenge', true );
$what_we_did   = get_post_meta( get_the_ID(), 'what_we_did', true );
$results_text  = get_post_meta( get_the_ID(), 'results_detail', true );
$client_quote  = get_post_meta( get_the_ID(), 'client_quote', true );
$client_name   = get_post_meta( get_the_ID(), 'client_name', true );

// Split result_metric → big number + label e.g. "+240% Organic Traffic"
$stat_value = '';
$stat_label = '';
if ( ! empty( $result_metric ) ) {
    $parts      = explode( ' ', trim( $result_metric ), 2 );
    $stat_value = $parts[0];
    $stat_label = isset( $parts[1] ) ? $parts[1] : '';
}

// Split client_name → "Jason Loftus, Sunseeker Asia"
$client_display = '';
$client_company = '';
if ( ! empty( $client_name ) ) {
    $parts          = explode( ',', $client_name, 2 );
    $client_display = trim( $parts[0] );
    $client_company = isset( $parts[1] ) ? trim( $parts[1] ) : '';
}
?>

<style>
/* Gradient text utility */
.text-grad { background: linear-gradient(135deg, #fff 0%, #FF6A00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
/* Scrollbar hide for horizontal scroll */
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
/* Section divider pulse */
@keyframes hline { 0%,100%{opacity:.3} 50%{opacity:1} }
.divider-pulse { animation: hline 3s ease-in-out infinite; }
</style>

<?php while ( have_posts() ) : the_post(); ?>
<main class="bg-[#040814] overflow-x-hidden">

    <!-- ═══════════════════════════════════════════════
         SECTION 1 · CINEMATIC HERO
    ════════════════════════════════════════════════ -->
    <section class="relative w-full min-h-[100svh] flex flex-col justify-end overflow-hidden">

        <!-- Full-bleed background image -->
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="absolute inset-0 z-0">
                <?php the_post_thumbnail( 'full', [ 'class' => 'w-full h-full object-cover' ] ); ?>
                <!-- Layered dark overlays -->
                <div class="absolute inset-0 bg-gradient-to-t from-[#040814] via-[#040814]/60 to-[#040814]/20"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#040814] via-transparent to-transparent"></div>
            </div>
        <?php else : ?>
            <!-- Fallback abstract hero -->
            <div class="absolute inset-0 z-0 bg-[#0A101F]">
                <div class="absolute top-1/4 left-1/4 w-[700px] h-[700px] bg-[#FF6A00]/8 rounded-full blur-[160px]"></div>
                <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-blue-900/20 rounded-full blur-[140px]"></div>
            </div>
        <?php endif; ?>

        <!-- Content anchored to bottom-left -->
        <div class="relative z-10 container mx-auto max-w-7xl px-6 md:px-12 pb-20 md:pb-28 pt-44">

            <?php if ( ! empty( $service_type ) ) : ?>
            <div class="inline-flex items-center gap-2.5 mb-8 border border-[#FF6A00]/40 bg-[#FF6A00]/10 backdrop-blur-md px-5 py-2 rounded-full">
                <span class="w-1.5 h-1.5 rounded-full bg-[#FF6A00] animate-pulse"></span>
                <span class="font-body text-[11px] font-bold uppercase tracking-[0.22em] text-[#FF6A00]">
                    <?php echo esc_html( $service_type ); ?>
                </span>
            </div>
            <?php endif; ?>

            <h1 class="font-display font-black text-[13vw] md:text-[9vw] lg:text-[7.5vw] leading-[0.87] tracking-[-0.03em] text-white mb-10 max-w-4xl">
                <?php the_title(); ?>
            </h1>

            <!-- Stat pill -->
            <?php if ( ! empty( $stat_value ) ) : ?>
            <div class="flex items-end gap-4 flex-wrap">
                <div class="flex flex-col">
                    <span class="font-display font-black text-[60px] md:text-[80px] leading-none text-grad tracking-[-0.03em]">
                        <?php echo esc_html( $stat_value ); ?>
                    </span>
                    <span class="font-body text-sm font-bold uppercase tracking-[0.22em] text-white/60 mt-1">
                        <?php echo esc_html( $stat_label ); ?>
                    </span>
                </div>
                <?php if ( ! empty( $client_company ) ) : ?>
                <div class="mb-3 pl-8 border-l border-white/15">
                    <p class="font-body text-xs text-white/40 uppercase tracking-widest mb-1">Client</p>
                    <p class="font-body text-white text-base font-semibold"><?php echo esc_html( $client_company ); ?></p>
                </div>
                <?php endif; ?>
            </div>
            <?php elseif ( ! empty( $client_company ) ) : ?>
            <div class="pl-6 border-l-2 border-[#FF6A00]">
                <p class="font-body text-xs text-white/40 uppercase tracking-widest mb-1">Client</p>
                <p class="font-body text-white text-xl font-semibold"><?php echo esc_html( $client_company ); ?></p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Bottom fade -->
        <div class="absolute bottom-0 left-0 right-0 h-40 bg-gradient-to-t from-[#040814] to-transparent z-10"></div>
    </section>


    <!-- ═══════════════════════════════════════════════
         SECTION 2 · THE STORY  (editorial 3-up)
    ════════════════════════════════════════════════ -->
    <?php if ( ! empty( $challenge ) || ! empty( $what_we_did ) || ! empty( $results_text ) ) : ?>
    <section class="container mx-auto max-w-7xl px-6 md:px-12 py-28 md:py-36">

        <!-- Intro label -->
        <div class="flex items-center gap-4 mb-20">
            <span class="h-px flex-1 max-w-[60px] bg-[#FF6A00] divider-pulse"></span>
            <span class="font-body text-[11px] font-bold uppercase tracking-[0.25em] text-[#FF6A00]">The Full Story</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-0 lg:divide-x lg:divide-white/5">

            <?php
            $sections = [
                [ 'num' => '01', 'title' => 'The Challenge', 'content' => $challenge ],
                [ 'num' => '02', 'title' => 'What We Did',   'content' => $what_we_did ],
                [ 'num' => '03', 'title' => 'The Results',   'content' => $results_text ],
            ];
            foreach ( $sections as $sec ) :
                if ( empty( $sec['content'] ) ) continue;
            ?>
            <div class="lg:px-10 first:pl-0 last:pr-0 py-10 lg:py-0 border-b border-white/5 lg:border-b-0">
                <div class="font-display font-black text-[80px] leading-none text-white/5 -mb-4 select-none">
                    <?php echo esc_html( $sec['num'] ); ?>
                </div>
                <h2 class="font-display font-bold text-2xl text-white mb-6 relative z-10">
                    <?php echo esc_html( $sec['title'] ); ?>
                </h2>
                <div class="font-body text-[15px] text-slate-400 leading-[1.85] relative z-10">
                    <?php echo wpautop( wp_kses_post( $sec['content'] ) ); ?>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </section>
    <?php endif; ?>


    <!-- ═══════════════════════════════════════════════
         SECTION 3 · RESULTS SPOTLIGHT  (only if stat)
    ════════════════════════════════════════════════ -->
    <?php if ( ! empty( $stat_value ) ) : ?>
    <section class="relative overflow-hidden bg-[#0A101F] border-y border-white/5 py-28 md:py-40">
        <!-- Ambient glow -->
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
            <div class="w-[800px] h-[800px] bg-[#FF6A00]/8 rounded-full blur-[180px]"></div>
        </div>

        <div class="relative container mx-auto max-w-7xl px-6 md:px-12 flex flex-col lg:flex-row items-center gap-16 lg:gap-0 justify-between">

            <div class="text-center lg:text-left">
                <p class="font-body text-xs font-bold uppercase tracking-[0.25em] text-white/40 mb-4">Headline Result</p>
                <div class="font-display font-black text-[120px] md:text-[180px] lg:text-[220px] leading-[0.8] tracking-[-0.05em] text-grad">
                    <?php echo esc_html( $stat_value ); ?>
                </div>
                <p class="font-body font-bold uppercase tracking-[0.3em] text-[#FF6A00] text-base md:text-xl mt-6">
                    <?php echo esc_html( $stat_label ); ?>
                </p>
            </div>

            <div class="w-full max-w-xs lg:max-w-sm bg-white/3 border border-white/8 rounded-2xl p-8 backdrop-blur-md">
                <p class="font-body text-xs font-bold uppercase tracking-widest text-white/40 mb-3">Project Summary</p>
                <ul class="space-y-4">
                    <?php if ( ! empty( $service_type ) ) : ?>
                    <li class="flex flex-col gap-0.5 pb-4 border-b border-white/8">
                        <span class="font-body text-[10px] uppercase tracking-widest text-white/30">Service</span>
                        <span class="font-body text-white font-medium text-sm"><?php echo esc_html( $service_type ); ?></span>
                    </li>
                    <?php endif; ?>
                    <?php if ( ! empty( $client_display ) ) : ?>
                    <li class="flex flex-col gap-0.5 pb-4 border-b border-white/8">
                        <span class="font-body text-[10px] uppercase tracking-widest text-white/30">Client</span>
                        <span class="font-body text-white font-medium text-sm"><?php echo esc_html( $client_display ); ?></span>
                    </li>
                    <?php endif; ?>
                    <?php if ( ! empty( $client_company ) ) : ?>
                    <li class="flex flex-col gap-0.5">
                        <span class="font-body text-[10px] uppercase tracking-widest text-white/30">Company</span>
                        <span class="font-body text-white font-medium text-sm"><?php echo esc_html( $client_company ); ?></span>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>
    </section>
    <?php endif; ?>


    <!-- ═══════════════════════════════════════════════
         SECTION 4 · CLIENT QUOTE
    ════════════════════════════════════════════════ -->
    <?php if ( ! empty( $client_quote ) ) : ?>
    <section class="relative py-28 md:py-40 overflow-hidden">
        <div class="absolute -right-40 top-1/2 -translate-y-1/2 font-display font-black text-[30vw] text-white/[0.018] leading-none select-none pointer-events-none uppercase tracking-[-0.06em]">
            RESULT
        </div>

        <div class="relative container mx-auto max-w-5xl px-6 md:px-12">

            <!-- Giant open-quote mark -->
            <div class="font-display font-black text-[120px] leading-none text-[#FF6A00] opacity-30 mb-0 -mb-8 select-none">"</div>

            <blockquote class="font-display font-medium text-3xl md:text-4xl lg:text-5xl text-white leading-[1.25] tracking-tight mb-14">
                <?php echo esc_html( $client_quote ); ?>
            </blockquote>

            <?php if ( ! empty( $client_display ) ) : ?>
            <div class="flex items-center gap-5">
                <!-- Avatar initials circle -->
                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-[#FF6A00] to-[#FF4500] flex items-center justify-center text-white font-display font-black text-2xl flex-shrink-0">
                    <?php echo esc_html( strtoupper( substr( $client_display, 0, 1 ) ) ); ?>
                </div>
                <div>
                    <p class="font-body font-bold text-white text-base"><?php echo esc_html( $client_display ); ?></p>
                    <?php if ( ! empty( $client_company ) ) : ?>
                    <p class="font-body text-sm text-[#FF6A00] uppercase tracking-widest mt-0.5"><?php echo esc_html( $client_company ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </section>
    <?php endif; ?>


    <!-- ═══════════════════════════════════════════════
         SECTION 5 · CTA FOOTER
    ════════════════════════════════════════════════ -->
    <section class="border-t border-white/5 py-28 md:py-36 relative overflow-hidden">
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-[#FF6A00]/5 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="relative container mx-auto max-w-4xl px-6 md:px-12 text-center">
            <p class="font-body text-xs font-bold uppercase tracking-[0.25em] text-[#FF6A00] mb-6">Ready?</p>
            <h2 class="font-display font-black text-5xl md:text-7xl text-white tracking-tight leading-[0.9] mb-16">
                Be our next<br><span class="text-grad">success story.</span>
            </h2>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-[#FF6A00] hover:bg-[#FF5500] text-white font-body font-bold text-[12px] uppercase tracking-[0.2em] px-10 py-5 rounded-full transition-all duration-300 hover:shadow-[0_0_40px_rgba(255,106,0,0.35)] hover:-translate-y-0.5">
                    <i class="ph-fill ph-chat-circle text-lg"></i> MESSAGE US NOW
                </a>
                <a href="<?php echo esc_url( home_url( '/case-study' ) ); ?>"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-transparent border border-white/15 hover:border-white/30 text-white font-body font-bold text-[12px] uppercase tracking-[0.2em] px-10 py-5 rounded-full transition-all duration-300">
                    <i class="ph-bold ph-arrow-left text-base"></i> View All Work
                </a>
            </div>
        </div>
    </section>

</main>
<?php endwhile; ?>

<?php get_footer(); ?>
