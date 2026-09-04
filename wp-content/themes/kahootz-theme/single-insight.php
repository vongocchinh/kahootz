<?php
/**
 * Single Template for Insights — Premium Editorial
 */
get_header();

$categories = get_the_terms( get_the_ID(), 'insight_category' );
$primary_cat = ( ! empty( $categories ) && ! is_wp_error( $categories ) ) ? $categories[0] : null;

$word_count = str_word_count( wp_strip_all_tags( get_the_content() ) );
$read_time  = max( 1, (int) ceil( $word_count / 200 ) );

$related_args = [
    'post_type'      => 'insight',
    'posts_per_page' => 3,
    'post__not_in'   => [ get_the_ID() ],
    'orderby'        => 'rand',
];
if ( $primary_cat ) {
    $related_args['tax_query'] = [[
        'taxonomy' => 'insight_category',
        'field'    => 'term_id',
        'terms'    => $primary_cat->term_id,
    ]];
}
$related = new WP_Query( $related_args );
?>

<main class="bg-[#040814] pb-28">
<?php while ( have_posts() ) : the_post(); ?>

    <!-- ══════════════════════════
         CINEMATIC HERO — full bleed image bg
    ═══════════════════════════ -->
    <div class="relative min-h-[75vh] flex flex-col justify-end overflow-hidden">

        <!-- BG Image -->
        <?php if ( has_post_thumbnail() ) : ?>
        <div class="absolute inset-0 z-0">
            <?php the_post_thumbnail( 'full', ['class' => 'w-full h-full object-cover'] ); ?>
            <div class="absolute inset-0 bg-gradient-to-t from-[#040814] via-[#040814]/75 to-[#040814]/20"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#040814]/50 to-transparent"></div>
        </div>
        <?php else : ?>
        <div class="absolute inset-0 z-0 bg-[#0A101F]">
            <div class="absolute inset-0 bg-gradient-to-br from-[#FF6A00]/8 via-transparent to-transparent"></div>
        </div>
        <?php endif; ?>

        <!-- Top accent line -->
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#FF6A00]/60 to-transparent z-20"></div>

        <!-- Content bottom-aligned -->
        <div class="relative z-10 container-layout pb-16 md:pb-24 pt-36">

            <?php if ( $primary_cat ) : ?>
            <div class="inline-flex items-center gap-2 bg-[#FF6A00] text-white font-body text-[10px] font-bold uppercase tracking-[0.22em] px-4 py-2 rounded-full mb-8">
                <?php echo esc_html( $primary_cat->name ); ?>
            </div>
            <?php endif; ?>

            <h1 class="font-display font-black text-4xl md:text-6xl lg:text-7xl text-white leading-[1.0] tracking-tight mb-8 max-w-4xl">
                <?php the_title(); ?>
            </h1>

            <!-- Meta row -->
            <div class="flex flex-wrap items-center gap-x-6 gap-y-2 font-body text-sm text-white/40">
                <span class="flex items-center gap-2">
                    <i class="ph-bold ph-calendar-blank text-base text-white/25"></i>
                    <?php echo get_the_date( 'F j, Y' ); ?>
                </span>
                <span class="flex items-center gap-2">
                    <i class="ph-bold ph-clock text-base text-white/25"></i>
                    <?php echo $read_time; ?> min read
                </span>
                <?php if ( get_the_author() ) : ?>
                <span class="flex items-center gap-2">
                    <i class="ph-bold ph-user-circle text-base text-white/25"></i>
                    <?php the_author(); ?>
                </span>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <!-- ══════════════════════════
         BODY — 2-col article + sticky sidebar
    ═══════════════════════════ -->
    <div class="container mx-auto max-w-7xl px-6 md:px-8 pt-20">
        <div class="flex flex-col lg:flex-row gap-12 xl:gap-20">

            <!-- Article -->
            <article class="flex-1 min-w-0">

                <!-- Content -->
                <div class="
                    [&>*:first-child]:mt-0
                    [&_h2]:font-display [&_h2]:font-bold [&_h2]:text-[28px] [&_h2]:text-white [&_h2]:mt-14 [&_h2]:mb-5 [&_h2]:leading-tight [&_h2]:tracking-tight
                    [&_h3]:font-display [&_h3]:font-bold [&_h3]:text-xl [&_h3]:text-white [&_h3]:mt-10 [&_h3]:mb-4
                    [&_h4]:font-display [&_h4]:font-semibold [&_h4]:text-lg [&_h4]:text-white/80 [&_h4]:mt-8 [&_h4]:mb-3
                    [&_p]:font-body [&_p]:text-[17px] [&_p]:text-slate-300 [&_p]:leading-[1.85] [&_p]:mb-6
                    [&_ul]:mb-8 [&_ul]:list-none [&_ul]:pl-0
                    [&_ul_li]:font-body [&_ul_li]:text-[17px] [&_ul_li]:text-slate-300 [&_ul_li]:leading-relaxed [&_ul_li]:pl-7 [&_ul_li]:relative [&_ul_li]:mb-3
                    [&_ul_li]:before:absolute [&_ul_li]:before:left-0 [&_ul_li]:before:top-[0.65em] [&_ul_li]:before:w-2 [&_ul_li]:before:h-2 [&_ul_li]:before:rounded-full [&_ul_li]:before:bg-[#FF6A00]
                    [&_ol]:mb-8 [&_ol]:pl-7 [&_ol]:space-y-3
                    [&_ol_li]:font-body [&_ol_li]:text-[17px] [&_ol_li]:text-slate-300 [&_ol_li]:leading-relaxed
                    [&_blockquote]:my-12 [&_blockquote]:pl-8 [&_blockquote]:border-l-[3px] [&_blockquote]:border-[#FF6A00] [&_blockquote]:bg-[#0A101F] [&_blockquote]:rounded-r-2xl [&_blockquote]:py-8 [&_blockquote]:pr-8
                    [&_blockquote_p]:text-white [&_blockquote_p]:text-xl [&_blockquote_p]:italic [&_blockquote_p]:font-medium [&_blockquote_p]:mb-0 [&_blockquote_p]:leading-relaxed
                    [&_a]:text-[#FF6A00] [&_a]:underline [&_a]:underline-offset-4 hover:[&_a]:text-white hover:[&_a]:transition-colors
                    [&_strong]:text-white [&_strong]:font-semibold
                    [&_img]:rounded-2xl [&_img]:border [&_img]:border-white/5 [&_img]:my-10 [&_img]:w-full
                    [&_hr]:border-white/8 [&_hr]:my-14
                    [&_code]:bg-[#0A101F] [&_code]:border [&_code]:border-white/8 [&_code]:text-[#FF6A00] [&_code]:px-2 [&_code]:py-0.5 [&_code]:rounded [&_code]:text-sm [&_code]:font-mono
                    [&_pre]:bg-[#0A101F] [&_pre]:border [&_pre]:border-white/8 [&_pre]:rounded-2xl [&_pre]:p-6 [&_pre]:mb-8 [&_pre]:overflow-x-auto
                ">
                    <?php the_content(); ?>
                </div>

                <!-- Category Tags -->
                <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
                <div class="mt-16 pt-10 border-t border-white/6 flex flex-wrap items-center gap-3">
                    <span class="font-body text-[11px] text-white/25 uppercase tracking-widest">Filed under:</span>
                    <?php foreach ( $categories as $cat ) : ?>
                    <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>"
                       class="inline-block border border-white/8 text-white/50 hover:border-[#FF6A00]/50 hover:text-[#FF6A00] font-body text-[11px] font-bold uppercase tracking-widest px-4 py-2 rounded-full transition-all duration-200">
                        <?php echo esc_html( $cat->name ); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Bottom CTA card -->
                <div class="mt-10 rounded-2xl overflow-hidden border border-white/5">
                    <div class="bg-gradient-to-r from-[#FF6A00] to-[#FF4500] px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-6">
                        <div>
                            <p class="font-display font-bold text-white text-xl leading-tight mb-1">Want advice for your business?</p>
                            <p class="font-body text-white/70 text-sm">Skip the reading — talk to us directly. Fast replies, real people.</p>
                        </div>
                        <a href="<?php echo esc_url( home_url('/contact') ); ?>"
                           class="flex-shrink-0 inline-flex items-center gap-2.5 bg-white text-[#FF4500] font-body font-bold text-[11px] uppercase tracking-[0.18em] px-7 py-4 rounded-full hover:bg-white/90 transition-colors duration-200 whitespace-nowrap">
                            <i class="ph-fill ph-chat-circle text-lg"></i> Message Us Now
                        </a>
                    </div>
                </div>

            </article>

            <!-- ── Sidebar ── -->
            <aside class="w-full lg:w-64 xl:w-72 flex-shrink-0">
                <div class="sticky top-28 space-y-6">

                    <!-- About the agency -->
                    <div class="bg-[#0A101F] border border-white/5 rounded-2xl p-6">
                        <p class="font-body text-[10px] font-bold uppercase tracking-widest text-[#FF6A00] mb-4">Kahootz Media</p>
                        <p class="font-body text-sm text-slate-400 leading-relaxed mb-5">AI-powered marketing that actually moves businesses forward. Established 2016.</p>
                        <ul class="space-y-2">
                            <?php foreach (['9+ Years Experience', '200+ Businesses Helped', 'AI-Enhanced Agency'] as $point ) : ?>
                            <li class="flex items-center gap-2 text-white/50 font-body text-xs">
                                <i class="ph-bold ph-check-circle text-[#FF6A00] text-sm flex-shrink-0"></i>
                                <?php echo esc_html( $point ); ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Topics -->
                    <?php
                    $all_cats = get_terms([ 'taxonomy' => 'insight_category', 'hide_empty' => true ]);
                    if ( ! empty( $all_cats ) && ! is_wp_error( $all_cats ) ) :
                    ?>
                    <div class="bg-[#0A101F] border border-white/5 rounded-2xl p-6">
                        <p class="font-body text-[10px] font-bold uppercase tracking-widest text-white/30 mb-5">Browse Topics</p>
                        <ul class="divide-y divide-white/5">
                            <?php foreach ( $all_cats as $cat ) :
                                $is_current = $primary_cat && $primary_cat->term_id === $cat->term_id;
                            ?>
                            <li>
                                <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>"
                                   class="flex items-center justify-between py-3 font-body text-sm transition-colors duration-200 <?php echo $is_current ? 'text-[#FF6A00]' : 'text-white/40 hover:text-[#FF6A00]'; ?>">
                                    <span><?php echo esc_html( $cat->name ); ?></span>
                                    <i class="ph-bold ph-arrow-right text-xs opacity-50"></i>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- CTA -->
                    <div class="bg-gradient-to-br from-[#FF6A00] to-[#FF4500] rounded-2xl p-6">
                        <p class="font-display font-bold text-white text-lg leading-tight mb-2">Ready to grow?</p>
                        <p class="font-body text-sm text-white/75 leading-relaxed mb-5">No lock-in. No jargon. Just results.</p>
                        <a href="<?php echo esc_url( home_url('/contact') ); ?>"
                           class="inline-flex w-full items-center justify-center gap-2 bg-white text-[#FF4500] font-body font-bold text-[11px] uppercase tracking-widest px-5 py-3.5 rounded-full hover:bg-white/90 transition-colors duration-200">
                            <i class="ph-fill ph-chat-circle text-base"></i> Message Us
                        </a>
                    </div>

                </div>
            </aside>

        </div>
    </div>


    <!-- ══════════════════════════
         RELATED ARTICLES
    ═══════════════════════════ -->
    <?php if ( $related->have_posts() ) : ?>
    <div class="container mx-auto max-w-7xl px-6 md:px-8 mt-24">
        <div class="border-t border-white/5 pt-16">

            <div class="flex items-center justify-between mb-12 flex-wrap gap-4">
                <div class="flex items-center gap-4">
                    <span class="h-px w-10 bg-[#FF6A00]"></span>
                    <span class="font-body text-[11px] font-bold uppercase tracking-[0.25em] text-[#FF6A00]">Related Insights</span>
                </div>
                <a href="<?php echo esc_url( home_url('/insights') ); ?>"
                   class="font-body text-[11px] text-white/30 hover:text-[#FF6A00] uppercase tracking-widest transition-colors flex items-center gap-1.5">
                    View All <i class="ph-bold ph-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php while ( $related->have_posts() ) : $related->the_post();
                    $rel_cats = get_the_terms( get_the_ID(), 'insight_category' );
                    $rel_cat  = ( ! empty( $rel_cats ) && ! is_wp_error( $rel_cats ) ) ? $rel_cats[0] : null;
                    $rel_words = str_word_count( wp_strip_all_tags( get_the_content() ) );
                    $rel_time  = max( 1, (int) ceil( $rel_words / 200 ) );
                ?>
                <a href="<?php echo esc_url( get_permalink() ); ?>" class="group block bg-[#0A101F] border border-white/5 rounded-2xl overflow-hidden hover:border-[#FF6A00]/25 transition-all duration-300 hover:-translate-y-0.5">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="aspect-[16/9] overflow-hidden bg-[#040814]">
                        <?php the_post_thumbnail( 'medium_large', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500'] ); ?>
                    </div>
                    <?php endif; ?>
                    <div class="p-6">
                        <?php if ( $rel_cat ) : ?>
                        <span class="inline-block font-body text-[10px] font-bold uppercase tracking-widest text-[#FF6A00] mb-3">
                            <?php echo esc_html( $rel_cat->name ); ?>
                        </span>
                        <?php endif; ?>
                        <h3 class="font-display font-bold text-base text-white leading-snug mb-4 group-hover:text-[#FF6A00] transition-colors duration-300 line-clamp-2">
                            <?php the_title(); ?>
                        </h3>
                        <span class="font-body text-xs text-white/30"><?php echo $rel_time; ?> min read</span>
                    </div>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

<?php endwhile; ?>
</main>

<?php get_footer(); ?>
