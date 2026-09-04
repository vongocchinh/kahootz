<section class="bg-page-section py-10 max-md:py-5 relative overflow-hidden" id="stuck-vs-ai">
  <div class="container-layout" bis_skin_checked="1">
    <div class="flex flex-row max-lg:flex-col max-lg:gap-4 relative" bis_skin_checked="1">
      <div class="w-[53%] max-lg:w-full flex flex-col justify-start">
        <p class="text-primary font-display font-bold text-[11px] tracking-widest uppercase mb-4">
          Stuck With Any Of These?
        </p>
        <ul class="flex flex-col gap-[12px]">
          <li class="flex items-start gap-3">
            <span
              class="mt-[2px] flex-shrink-0 w-5 h-5 rounded-full border border-primary/60 flex items-center justify-center">
              <i class="ph-fill ph-eye-slash text-primary text-[10px]"></i>
            </span>
            <span class="text-sm text-foreground leading-snug"><span class="font-semibold">Low visibility.</span>
              Hard to
              get noticed online.</span>
          </li>
          <li class="flex items-start gap-3">
            <span
              class="mt-[2px] flex-shrink-0 w-5 h-5 rounded-full border border-primary/60 flex items-center justify-center">
              <i class="ph-fill ph-drop text-primary text-[10px]"></i>
            </span>
            <span class="text-sm text-foreground leading-snug"><span class="font-semibold">Leads drying up.</span>
              Not
              enough quality enquiries.</span>
          </li>
          <li class="flex items-start gap-3">
            <span
              class="mt-[2px] flex-shrink-0 w-5 h-5 rounded-full border border-primary/60 flex items-center justify-center">
              <i class="ph-fill ph-currency-dollar text-primary text-[10px]"></i>
            </span>
            <span class="text-sm text-foreground leading-snug"><span class="font-semibold">Wasting money.</span> Ads
              not
              delivering real results.</span>
          </li>
          <li class="flex items-start gap-3">
            <span
              class="mt-[2px] flex-shrink-0 w-5 h-5 rounded-full border border-primary flex items-center justify-center">
              <i class="ph-bold ph-x text-primary text-[10px]"></i>
            </span>
            <span class="text-sm text-foreground leading-snug"><span class="font-semibold">No clear strategy.</span>
              No
              roadmap, just random tactics.</span>
          </li>
          <li class="flex items-start gap-3">
            <span
              class="mt-[2px] flex-shrink-0 w-5 h-5 rounded-full border border-primary flex items-center justify-center">
              <i class="ph-bold ph-x text-primary text-[10px]"></i>
            </span>
            <span class="text-sm text-foreground leading-snug"><span class="font-semibold">No time or team.</span>
              Too
              busy running the business.</span>
          </li>
        </ul>
      </div>
      <div class="block max-lg:hidden w-[2px] bg-foreground/30 mx-6 self-stretch"></div>
      <div class="max-lg:w-full flex flex-col justify-center relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[38%] aspect-[207/128] pointer-events-none opacity-100 max-lg:opacity-50"
          bis_skin_checked="1">
          <img alt="AI wolf eye glowing orange" class="w-full h-full object-cover"
            src="<?php echo get_template_directory_uri(); ?>/assets/images/ai-wolf-eye.png">
        </div>
        <div class="relative z-10" bis_skin_checked="1">
          <div class="flex flex-col w-[50%] max-md:w-[80%]">
            <p class="text-primary font-display font-bold text-[11px] tracking-widest uppercase mb-3">
              AI Is Our Advantage
            </p>
            <h2 class="font-display font-bold text-[28px] leading-[1.1] text-foreground mb-3 max-md:text-[24px]">
              While others catch up,<br>we're already ahead.
            </h2>
            <p class="text-sm text-muted leading-relaxed mb-5">
              Marketing is changing faster than most agencies can keep up.
              We build AI into everything — research, content, automation,
              optimisation — so your business moves at the speed the market
              actually demands.
            </p>
          </div>
          <?php
          $ai_features = [
            [
              'icon' => 'Smarter.png',
              'title' => 'Smarter<br>research'
            ],
            [
              'icon' => 'Better.png',
              'title' => 'Better<br>content'
            ],
            [
              'icon' => 'x-ai.png',
              'title' => 'Advanced<br>automation'
            ],
            [
              'icon' => 'optimisation.svg',
              'title' => 'Real-time<br>optimisation'
            ],
            [
              'icon' => 'Clear.png',
              'title' => 'Clear<br>reporting'
            ]
          ];
          ?>
          <div class="flex flex-wrap items-center gap-x-4 gap-y-3" bis_skin_checked="1">
            <?php foreach ($ai_features as $feature) : ?>
            <div class="flex items-center gap-[6px]" bis_skin_checked="1">
              <span class="w-10 h-10 flex items-center justify-center flex-shrink-0">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icon/<?php echo $feature['icon']; ?>" alt="icon" class="w-10 h-10 object-contain" />
              </span>
              <span class="text-[11px] text-foreground font-medium leading-tight"><?php echo $feature['title']; ?></span>
            </div>
            <?php endforeach; ?>
            <a href="<?php echo esc_url(site_url('/contact')); ?>"
              class="bg-transparent border border-primary text-white font-display font-bold text-sm px-5 py-[10px] rounded-md flex items-center gap-2 w-fit"type="button">
              EXPLORE AI
              <i class="ph-bold ph-arrow-right text-white text-sm"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>