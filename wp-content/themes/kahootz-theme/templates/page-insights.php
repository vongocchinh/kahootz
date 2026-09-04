<?php
/**
 * Template Name: Insights Page
 */
get_header();

// Determine if we are on a taxonomy archive and get the current term slug
$current_term_slug = '';
if ( is_tax( 'insight_category' ) ) {
    $current_term = get_queried_object();
    $current_term_slug = $current_term->slug;
}

// Fetch insights using our query handler
$insights_query = kahootz_get_insights( 9, $current_term_slug );
?>

<main class="bg-[#040814] min-h-screen">

    <!-- HERO -->
    <section class="relative pt-36 pb-20  max-md:pt-16 max-md:pb-10overflow-hidden border-b border-white/5">
        <div class="hidden top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#FF6A00]/50 to-transparent"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 max-md:hidden  w-[900px] h-[500px] bg-[#FF6A00]/5 rounded-full blur-[160px] pointer-events-none"></div>

        <div class="container-layout px-4 sm:px-6 lg:px-8 relative z-10 text-center max-w-4xl mx-auto">
            <h1 class="font-display font-black text-[48px] lg:text-[64px] leading-none mb-6 tracking-tight uppercase text-white">
                Insights
            </h1>
            <p class="text-slate-300 font-body text-lg lg:text-xl font-medium tracking-wide max-w-2xl mx-auto">
                Straight-talking marketing advice — no fluff, no jargon.
            </p>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="container-layout px-4 sm:px-6 lg:px-8 py-24">

        <!-- Categories / Filters -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-16">
            <a href="<?php echo esc_url( home_url('/insights/') ); ?>" class="px-5 py-2.5 rounded-full <?php echo empty( $current_term_slug ) ? 'bg-[#FF6A00] text-white' : 'bg-[#0A101F] border border-slate-800 text-slate-300 hover:border-[#FF6A00] hover:text-[#FF6A00]'; ?> font-body text-[13px] font-bold tracking-widest uppercase transition-all">All</a>
            <?php
            $insight_categories = kahootz_get_insight_categories(false);
            
            if ( ! empty( $insight_categories ) && ! is_wp_error( $insight_categories ) ) :
                foreach ( $insight_categories as $category ) :
                    $is_active = ( $current_term_slug === $category->slug );
                    $btn_class = $is_active 
                        ? 'bg-[#FF6A00] text-white' 
                        : 'bg-[#0A101F] border border-slate-800 text-slate-300 hover:border-[#FF6A00] hover:text-[#FF6A00]';
            ?>
                    <a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="px-5 py-2.5 rounded-full <?php echo $btn_class; ?> font-body text-[13px] font-bold tracking-widest uppercase transition-all">
                        <?php echo esc_html( $category->name ); ?>
                    </a>
            <?php
                endforeach;
            endif;
            ?>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20 max-w-7xl mx-auto">
            <?php if ( $insights_query->have_posts() ) : ?>
                <?php while ( $insights_query->have_posts() ) : $insights_query->the_post(); ?>
                    <article class="bg-[#0A101F] border border-slate-800/80 rounded-2xl overflow-hidden flex flex-col hover:border-[#FF6A00]/50 transition-colors duration-300 group shadow-lg">
                        
                        <!-- Thumbnail -->
                        <div class="aspect-[16/9] w-full overflow-hidden bg-[#040814] relative">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500']); ?>
                            <?php else : ?>
                                <!-- Fallback image placeholder -->
                                <div class="w-full h-full flex items-center justify-center text-slate-800">
                                    <i class="ph-bold ph-image text-4xl"></i>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Category Badge -->
                            <?php
                            $categories = kahootz_get_post_insight_categories( get_the_ID() );
                            if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                                echo '<span class="absolute top-4 left-4 bg-[#FF6A00] text-white font-body text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded">' . esc_html( $categories[0]->name ) . '</span>';
                            }
                            ?>
                        </div>

                        <!-- Content -->
                        <div class="p-8 flex flex-col flex-grow">
                            <h2 class="font-display font-bold text-2xl text-white mb-4 line-clamp-2 group-hover:text-[#FF6A00] transition-colors">
                                <a href="<?php echo esc_url( get_permalink() ); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <div class="text-slate-400 font-body text-[15px] leading-relaxed mb-8 line-clamp-3">
                                <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                            </div>
                            
                            <div class="mt-auto">
                                <a href="<?php echo esc_url( get_permalink() ); ?>" class="inline-flex items-center gap-2 text-[#FF6A00] font-body font-bold text-[13px] tracking-widest uppercase hover:text-white transition-colors">
                                    READ MORE <i class="ph-bold ph-arrow-right text-[16px]"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <!-- Empty State -->
                <div class="col-span-full text-center py-20 bg-[#0A101F] border border-slate-800/80 rounded-2xl">
                    <i class="ph-bold ph-newspaper text-6xl text-slate-700 mb-4 block"></i>
                    <p class="text-slate-400 font-body text-lg">No insights published yet. Check back soon.</p>
                </div>
            <?php endif; ?>
        </div>

    </section>

    <!-- CTA Section -->
    <?php get_template_part('components/closing-cta', null, ['title' => 'Want advice specific to your business?']); ?>
</main>

<?php get_footer(); ?>
