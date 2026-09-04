<section class="bg-page-section py-10 max-md:py-5" id="case-studies">
  <div class="container-layout" bis_skin_checked="1">
    <div class="flex items-center justify-between mb-6" bis_skin_checked="1">
      <div bis_skin_checked="1">
        <p class="text-primary text-lg max-md:text-sm font-semibold uppercase tracking-widest mb-1">
          OUR WORK
        </p>
        <h2 class="text-foreground font-display font-bold text-[36px] max-md:text-[24px] leading-tight">
          Real work. Real results.
        </h2>
      </div>
      <a class="flex items-center gap-2 text-primary text-sm font-semibold uppercase tracking-wide whitespace-nowrap hover:opacity-80 max-md:hidden"
        href="<?php echo esc_url(site_url('/case-study')); ?>">
        VIEW ALL CASE STUDIES <i class="ph ph-arrow-right"></i>
      </a>
    </div>
    <?php
    $case_studies_args = array(
      'post_type'      => 'case_study',
      'posts_per_page' => 4,
      'orderby'        => 'date',
      'order'          => 'DESC',
    );
    $case_studies_query = new WP_Query($case_studies_args);
    
    if ( $case_studies_query->have_posts() ) :
    ?>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-[16px]" bis_skin_checked="1">
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
          $image_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : '';
      ?>
        <div class="bg-transparent border border-foreground/30 rounded-md overflow-hidden flex flex-col max-md:flex-row max-md:gap-0"
          bis_skin_checked="1">
          <div class="relative w-full aspect-[195/91] overflow-hidden max-md:max-w-[45%] max-md:h-[110px]" bis_skin_checked="1">
            <img alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover"
              src="<?php echo esc_url($image_url); ?>">
          </div>
          <div class="p-[20px] flex flex-col gap-[8px] justify-center max-md:p-3" bis_skin_checked="1">
            <div bis_skin_checked="1" class="mb-1 max-md:mb-0">
              <p class="text-white font-body font-bold text-[16px] leading-tight max-md:text-[13px]">
                <?php the_title(); ?>
              </p>
              <p class="text-foreground/80 font-body text-[13px] leading-tight mt-1 max-md:text-[11px]">
                <?php echo esc_html($service_type); ?>
              </p>
            </div>
            <div bis_skin_checked="1">
              <p class="text-foreground font-display font-bold text-[36px] leading-none max-md:text-[26px]">
                <?php echo esc_html($stat_value); ?>
              </p>
              <p class="text-muted text-sm mt-1 max-md:text-[11px]"><?php echo esc_html($stat_label); ?></p>
            </div>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php endif; ?>
    <a class="items-center justify-start gap-2 text-white text-sm font-semibold uppercase tracking-wide whitespace-nowrap hover:opacity-80 hidden max-md:flex py-4 px-10 rounded-md mt-4 border border-primary w-max max-md:py-2 max-md:text-xs max-md:font-medium"
      href="<?php echo esc_url(site_url('/case-study')); ?>">
      VIEW ALL CASE STUDIES <i class="ph ph-arrow-right"></i>
    </a>
  </div>
</section>