<section class="bg-page-section py-10 max-md:py-5" id="testimonials">
  <div class="container-layout" bis_skin_checked="1">
    <p class="text-primary text-lg max-md:text-sm font-semibold uppercase tracking-widest mb-5">
      WHAT OUR CLIENTS SAY
    </p>
    <?php
    $testimonials_query = kahootz_get_testimonials(4);
    $testimonials = [];
    if ( $testimonials_query->have_posts() ) {
        while ( $testimonials_query->have_posts() ) {
            $testimonials_query->the_post();
            $name = get_post_meta( get_the_ID(), 'kahootz_client_name', true );
            $rating = get_post_meta( get_the_ID(), 'kahootz_rating', true );
            if ( empty($name) ) $name = get_the_title();
            if ( empty($rating) ) $rating = 5;
            $testimonials[] = [
                'text'    => wp_strip_all_tags( get_the_content() ),
                'name'    => $name,
                'company' => get_post_meta( get_the_ID(), 'kahootz_client_company', true ),
                'rating'  => intval($rating),
                'image'   => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') : get_template_directory_uri() . '/assets/images/user.jpeg'
            ];
        }
        wp_reset_postdata();
    }
    
    if ( !empty($testimonials) ) :
    ?>
    <!-- Desktop Grid (Hidden on Mobile) -->
    <div class="hidden md:grid md:grid-cols-2 xl:grid-cols-4 gap-[16px]" bis_skin_checked="1">
      <?php foreach ($testimonials as $testimonial) : ?>
      <div class="rounded-md border border-foreground/30 p-[20px] flex flex-col gap-[12px]" bis_skin_checked="1">
        <div class="flex gap-[3px]" bis_skin_checked="1">
          <?php for ( $i = 0; $i < $testimonial['rating']; $i++ ) : ?>
            <i class="ph-fill ph-star text-primary text-sm"></i>
          <?php endfor; ?>
          <?php for ( $i = $testimonial['rating']; $i < 5; $i++ ) : ?>
            <i class="ph-regular ph-star text-primary/30 text-sm"></i>
          <?php endfor; ?>
        </div>
        <p class="text-foreground text-sm leading-relaxed flex-1">
          <?php echo $testimonial['text']; ?>
        </p>
        <div class="flex items-center gap-[10px] mt-auto" bis_skin_checked="1">
          <div class="w-14 h-14 rounded-full bg-muted/20 overflow-hidden flex-shrink-0 flex items-center justify-center"
            bis_skin_checked="1">
            <img src="<?php echo esc_url($testimonial['image']); ?>" alt="user" class="w-full h-full object-cover" />
          </div>
          <div bis_skin_checked="1">
            <p class="text-foreground text-sm font-semibold leading-tight">
              <?php echo $testimonial['name']; ?>
            </p>
            <p class="text-muted text-[11px] leading-tight">
              <?php echo $testimonial['company']; ?>
            </p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Mobile Swiper Slider (Hidden on Desktop) -->
    <style>
      .testimonials-swiper {
        width: 100%;
        padding-bottom: 40px !important;
      }
      .testimonials-swiper .swiper-pagination-bullet {
        background-color: rgba(255, 255, 255, 0.2);
        opacity: 1;
        transition: background-color 0.3s;
      }
      .testimonials-swiper .swiper-pagination-bullet-active {
        background-color: #b53afc;
      }
    </style>
    
    <div class="swiper testimonials-swiper md:!hidden">
      <div class="swiper-wrapper" bis_skin_checked="1">
        <?php foreach ($testimonials as $testimonial) : ?>
        <div class="swiper-slide h-auto" bis_skin_checked="1">
          <div class="rounded-md border border-foreground/30 p-[20px] flex flex-col gap-[12px] h-full" bis_skin_checked="1">
            <div class="flex gap-[3px]" bis_skin_checked="1">
              <?php for ( $i = 0; $i < $testimonial['rating']; $i++ ) : ?>
                <i class="ph-fill ph-star text-primary text-sm"></i>
              <?php endfor; ?>
              <?php for ( $i = $testimonial['rating']; $i < 5; $i++ ) : ?>
                <i class="ph-regular ph-star text-primary/30 text-sm"></i>
              <?php endfor; ?>
            </div>
            <p class="text-foreground text-sm leading-relaxed flex-1">
              <?php echo $testimonial['text']; ?>
            </p>
            <div class="flex items-center gap-[10px] mt-auto" bis_skin_checked="1">
              <div class="w-14 h-14 rounded-full bg-muted/20 overflow-hidden flex-shrink-0 flex items-center justify-center"
                bis_skin_checked="1">
                <img src="<?php echo esc_url($testimonial['image']); ?>" alt="user" class="w-full h-full object-cover" />
              </div>
              <div bis_skin_checked="1">
                <p class="text-foreground text-sm font-semibold leading-tight">
                  <?php echo $testimonial['name']; ?>
                </p>
                <p class="text-muted text-[11px] leading-tight">
                  <?php echo $testimonial['company']; ?>
                </p>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      
      <!-- Mobile Pagination Dots -->
      <div class="swiper-pagination"></div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        // Initialize Swiper only for mobile
        new Swiper('.testimonials-swiper', {
          slidesPerView: 1,
          spaceBetween: 16,
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
        });
      });
    </script>
    <?php endif; ?>
  </div>
</section>