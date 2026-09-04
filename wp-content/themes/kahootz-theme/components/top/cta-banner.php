<section class="relative bg-background overflow-hidden" id="cta-banner">
  <div class="relative z-10 container-layout flex flex-col md:flex-row items-center gap-8" bis_skin_checked="1">
    <div class=" w-[38%] max-md:z-10 max-md:w-full max-md:absolute max-md:top-0 max-md:left-0 max-md:right-0"
      bis_skin_checked="1">
      <img alt="Wolf with glowing orange eyes" class="w-full h-full object-cover object-center"
        src="<?php echo get_template_directory_uri(); ?>/assets/images/footer-image-left.png">
    </div>
    <div class="flex flex-col w-[62%] max-md:w-full max-md:z-20">
      <div class="flex flex-row items-start max-md:flex-col max-md:justify-center max-md:items-center">
        <div class="flex-1 min-w-0" bis_skin_checked="1">
          <h2 class="font-display font-bold text-[28px] leading-tight text-foreground mb-3 max-md:text-center">
            Still hunting for growth<br>on your own?
          </h2>
          <p class="text-sm text-muted mb-5 leading-relaxed max-md:text-center">
            Fixed-price packages for simple needs.<br>
            Bespoke solutions for everything else.
          </p>
        </div>
        <div class="flex flex-col gap-3 w-[390px] shrink-0 max-xl:w-[250px]" bis_skin_checked="1">
          <a href="<?php echo esc_url(site_url('/contact')); ?>"
            class="bg-grad-cta-primary text-foreground font-body font-bold text-[12px] md:text-[14px] tracking-widest uppercase px-6 py-4 rounded-md flex items-center justify-center gap-3 shadow-[0_8px_20px_rgba(255,106,0,0.25)] hover:opacity-90 transition-opacity w-full sm:w-auto">
            <i class="ph-fill ph-chat-circle-dots text-xl"></i>
            MESSAGE US NOW
          </a>
          <a href="<?php echo esc_url(site_url('/contact')); ?>"
            class="bg-transparent border border-foreground/20 text-foreground font-display font-semibold text-sm rounded-md px-6 py-3 flex items-center justify-center gap-2 w-full hover:border-foreground/40 transition-colors">
            START A CONVERSATION
            <i class="ph ph-arrow-right text-base"></i>
          </a>
        </div>
      </div>
      <div class="flex flex-wrap gap-x-5 gap-y-2 max-md:grid max-md:grid-cols-2 max-md:gap-2 max-md:p-4"
        bis_skin_checked="1">
        <span class="flex items-center gap-1.5 text-base text-muted max-md:text-sm">
          <i class="ph ph-check-circle text-primary text-xl"></i>
          Fast response
        </span>
        <span class="flex items-center gap-1.5 text-base text-muted max-md:text-sm">
          <i class="ph ph-check-circle text-primary text-xl"></i>
          No lock-in contracts
        </span>
        <span class="flex items-center gap-1.5 text-base text-muted max-md:text-sm">
          <i class="ph ph-currency-circle-dollar text-primary text-xl"></i>
          Transparent pricing
        </span>
        <span class="flex items-center gap-1.5 text-base text-muted max-md:text-sm">
          <i class="ph ph-check-circle text-primary text-xl"></i>
          Results focused
        </span>
      </div>
    </div>
  </div>
</section>