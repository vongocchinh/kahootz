<?php
/**
 * Template Name: Work Page
 */
get_header();

// Fetch Case Studies & Testimonials
$case_studies_query = kahootz_get_case_studies();
$testimonials_query = kahootz_get_testimonials();
?>

<main class="bg-[#040814] min-h-screen">

    <!-- HERO -->
    <section class="relative pt-36 pb-20  max-md:pt-16 max-md:pb-10overflow-hidden border-b border-white/5">
        <div class="hidden top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#FF6A00]/50 to-transparent"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 max-md:hidden  w-[900px] h-[500px] bg-[#FF6A00]/5 rounded-full blur-[160px] pointer-events-none"></div>

        <div class="container-layout px-4 sm:px-6 lg:px-8 relative z-10 text-center max-w-4xl mx-auto">
            <h1 class="font-display font-black text-[48px] lg:text-[64px] leading-none mb-6 tracking-tight uppercase text-white">
                Real work.<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6A00] to-[#FF8C00]">Real results.</span>
            </h1>
            <p class="text-slate-300 font-body text-lg lg:text-xl font-medium tracking-wide max-w-2xl mx-auto">
                No vague promises — here's what we've actually delivered.
            </p>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="container-layout px-4 sm:px-6 lg:px-8 py-24">

        <!-- Case Studies Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-24 max-w-7xl mx-auto">
            <?php if ( $case_studies_query->have_posts() ) : ?>
                <?php while ( $case_studies_query->have_posts() ) : $case_studies_query->the_post();
                    $service_type  = get_post_meta( get_the_ID(), 'service_provided', true );
                    $result_metric = get_post_meta( get_the_ID(), 'result_metric', true );
                    $stat_value = '';
                    $stat_label = '';
                    if ( ! empty( $result_metric ) ) {
                        $parts      = explode( ' ', trim( $result_metric ), 2 );
                        $stat_value = $parts[0];
                        $stat_label = isset( $parts[1] ) ? $parts[1] : '';
                    }
                ?>
                    <article class="group relative bg-[#0A101F] border border-white/5 rounded-2xl overflow-hidden hover:border-[#FF6A00]/40 transition-all duration-500 flex flex-col">

                        <!-- Image -->
                        <div class="relative aspect-[4/3] overflow-hidden bg-[#040814]">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'large', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-700'] ); ?>
                            <?php else : ?>
                                <div class="w-full h-full bg-gradient-to-br from-[#0A101F] to-[#040814] flex items-center justify-center">
                                    <i class="ph-bold ph-image text-5xl text-white/10"></i>
                                </div>
                            <?php endif; ?>
                            <!-- gradient overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0A101F] via-[#0A101F]/40 to-transparent"></div>
                            <!-- service badge inside image -->
                            <?php if ( ! empty( $service_type ) ) : ?>
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center gap-1.5 bg-black/60 backdrop-blur border border-white/10 text-white font-body text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-full">
                                    <?php echo esc_html( $service_type ); ?>
                                </span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Card body -->
                        <div class="p-7 flex flex-col flex-grow">
                            <h2 class="font-display font-bold text-xl text-white mb-5 leading-tight group-hover:text-[#FF6A00] transition-colors duration-300">
                                <?php the_title(); ?>
                            </h2>

                            <?php if ( ! empty( $stat_value ) ) : ?>
                            <div class="flex items-baseline gap-3 mb-6">
                                <span class="font-display font-black text-4xl text-[#FF6A00] tracking-tight leading-none"><?php echo esc_html( $stat_value ); ?></span>
                                <span class="font-body text-xs font-bold uppercase tracking-widest text-white/40"><?php echo esc_html( $stat_label ); ?></span>
                            </div>
                            <?php endif; ?>

                            <div class="mt-auto pt-5 border-t border-white/5">
                                <a href="<?php echo esc_url( get_permalink() ); ?>" class="inline-flex items-center gap-2 text-[#FF6A00] font-body font-bold text-[11px] uppercase tracking-widest hover:gap-4 transition-all duration-300">
                                    View Case Study <i class="ph-bold ph-arrow-right text-sm"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="col-span-full text-center py-24 bg-[#0A101F] border border-white/5 rounded-2xl">
                    <p class="text-white/30 font-body text-base">Case studies coming soon.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Testimonials Section -->
        <?php if ( $testimonials_query->have_posts() ) : ?>
            <div class="max-w-7xl mx-auto mb-24">
                <div class="text-center mb-12">
                    <h2 class="font-display font-bold text-3xl text-white mb-4">What Our Clients Say</h2>
                    <div class="w-16 h-1 bg-[#FF6A00] mx-auto rounded-full"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); 
                        $client_name = get_post_meta( get_the_ID(), 'kahootz_client_name', true );
                        $client_company = get_post_meta( get_the_ID(), 'kahootz_client_company', true );
                        $rating = get_post_meta( get_the_ID(), 'kahootz_rating', true );
                        $rating = !empty($rating) ? intval($rating) : 5;
                        
                        if ( empty( $client_name ) ) $client_name = get_the_title();
                    ?>
                        <div class="bg-[#0A101F] border border-slate-800/80 rounded-2xl p-8 lg:p-10 relative">
                            <i class="ph-fill ph-quotes text-[#FF6A00]/20 text-6xl absolute top-6 right-8 pointer-events-none"></i>
                            
                            <div class="flex items-center gap-1 text-[#FF6A00] mb-6">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?php if ($i <= $rating): ?>
                                        <i class="ph-fill ph-star"></i>
                                    <?php else: ?>
                                        <i class="ph ph-star"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                            
                            <div class="text-slate-300 font-body text-base lg:text-lg italic leading-relaxed mb-8">
                                "<?php echo wp_strip_all_tags( get_the_content() ); ?>"
                            </div>
                            
                            <div class="flex items-center gap-4 mt-auto">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-slate-700">
                                        <?php the_post_thumbnail('thumbnail', ['class' => 'w-full h-full object-cover']); ?>
                                    </div>
                                <?php else : ?>
                                    <div class="w-12 h-12 rounded-full bg-slate-800 border-2 border-slate-700 flex items-center justify-center text-[#FF6A00] font-display font-bold">
                                        <?php echo substr( $client_name, 0, 1 ); ?>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <div class="font-body font-bold text-white text-sm"><?php echo esc_html( $client_name ); ?></div>
                                    <?php if ( ! empty( $client_company ) ) : ?>
                                        <div class="font-body text-xs text-slate-400 mt-0.5 uppercase tracking-wider"><?php echo esc_html( $client_company ); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        <?php endif; ?>

    </section>

    <!-- CTA Section -->
    <?php get_template_part('components/closing-cta', null, ['title' => 'Want results like these?']); ?>
</main>

<?php get_footer(); ?>
