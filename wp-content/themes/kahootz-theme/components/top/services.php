<section class="bg-page-section py-10 max-md:py-5" id="services">
  <div class="container-layout" bis_skin_checked="1">
    <div class="mb-6" bis_skin_checked="1">
      <p class="text-primary text-lg max-md:text-sm font-semibold uppercase tracking-widest mb-2 font-body">
        OUR SERVICES
      </p>
      <h2 class="text-foreground text-[36px] max-md:text-[24px] font-bold leading-tight font-display">
        Four ways we hunt down growth for your business.
      </h2>
    </div>
    <?php
    $services_query = kahootz_get_services(4);
    if ($services_query->have_posts()):
      ?>
      <div class="grid grid-cols-4 gap-[16px] max-lg:grid-cols-2 max-md:grid-cols-1" bis_skin_checked="1">
        <?php while ($services_query->have_posts()):
          $services_query->the_post();
          $subtitle = get_post_meta(get_the_ID(), 'hero_subtitle', true);
          $starting_price = get_post_meta(get_the_ID(), 'starting_price', true);
          $service_icon = get_post_meta(get_the_ID(), 'service_icon', true);

          // Use text-accent for SEO, text-primary for others
          $text_class = (strpos(strtolower(get_the_title()), 'seo') !== false) ? 'text-accent' : 'text-primary';
          ?>
          <!-- Desktop View -->
          <div class="hidden md:flex p-[20px] flex-col gap-[12px] border border-foreground/30 rounded-2xl h-full" bis_skin_checked="1">
            <div class="w-14 h-14 flex items-center justify-center" bis_skin_checked="1">
              <?php if (!empty($service_icon)): ?>
                <img src="<?php echo esc_url($service_icon); ?>" alt="<?php the_title_attribute(); ?>"
                  class="w-18 h-14 object-contain" />
              <?php else: ?>
                <i class="ph-bold ph-star text-[#FF6A00] text-xl"></i>
              <?php endif; ?>
            </div>
            <h3 class="text-foreground text-sm font-bold uppercase tracking-wider font-body">
              <?php the_title(); ?>
            </h3>
            <p class="text-muted text-sm font-body leading-relaxed flex-1">
              <?php echo esc_html($subtitle); ?>
            </p>
            <p class="text-foreground text-sm font-semibold font-body">
              <?php echo esc_html($starting_price); ?>
            </p>
            <a class="<?php echo esc_attr($text_class); ?> text-sm font-semibold font-body flex items-center gap-1 hover:opacity-80 transition-opacity"
              href="<?php echo esc_url(get_permalink()); ?>">
              LEARN MORE <i class="ph ph-arrow-right text-sm"></i>
            </a>
          </div>

          <!-- Mobile View -->
          <a href="<?php echo esc_url(get_permalink()); ?>" class="flex md:hidden p-4 border border-foreground/30 rounded-xl items-center gap-4 hover:border-primary transition-colors">
            <div class="w-14 h-14 flex-shrink-0 flex items-center justify-center" bis_skin_checked="1">
              <?php if (!empty($service_icon)): ?>
                <img src="<?php echo esc_url($service_icon); ?>" alt="<?php the_title_attribute(); ?>"
                  class="w-full h-full object-contain" />
              <?php else: ?>
                <i class="ph-bold ph-star text-[#FF6A00] text-xl"></i>
              <?php endif; ?>
            </div>
            
            <div class="flex-1 flex flex-col justify-center min-w-0" bis_skin_checked="1">
              <h3 class="text-foreground text-sm font-bold uppercase tracking-wider font-body mb-1 truncate">
                <?php the_title(); ?>
              </h3>
              <p class="text-muted text-[13px] font-body leading-tight mb-2 line-clamp-2">
                <?php echo esc_html($subtitle); ?>
              </p>
              <p class="text-foreground text-[13px] font-semibold font-body">
                <?php echo esc_html($starting_price); ?>
              </p>
            </div>
            
            <div class="flex-shrink-0 flex items-center justify-center pl-2" bis_skin_checked="1">
              <i class="ph ph-arrow-right <?php echo esc_attr($text_class); ?> text-xl"></i>
            </div>
          </a>
        <?php endwhile;
        wp_reset_postdata(); ?>
      </div>
    <?php endif; ?>
  </div>
</section>