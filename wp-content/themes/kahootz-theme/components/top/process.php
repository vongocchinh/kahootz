<section class="bg-background py-10 relative overflow-hidden" id="process">
  <div class="container-layout relative z-10" bis_skin_checked="1">
    <p class="text-primary text-lg max-md:text-sm font-semibold uppercase tracking-widest mb-2 font-body">
      HOW IT WORKS
    </p>
    <h2 class="text-foreground text-[36px] max-md:text-[24px] font-bold font-display leading-tight mb-8">
      Simple process. Serious results.
    </h2>
    <?php
    $processes = [
      [
        'icon' => 'chat-us.png',
        'title' => 'Chat with us',
        'desc' => 'Tell us about your business and your goals — no forms, just a conversation.',
        'alt' => 'chat'
      ],
      [
        'icon' => 'dive-deep.svg',
        'title' => 'We dive deep',
        'desc' => 'We research your market, audit what\'s working (and what isn\'t), and build your custom plan.',
        'alt' => 'dive-deep'
      ],
      [
        'icon' => 'strategy.svg',
        'title' => 'We get to work',
        'desc' => 'Execute with AI-powered strategy and a hands-on expert team — content, campaigns and optimisation, live fast.',
        'alt' => 'strategy'
      ],
      [
        'icon' => 'growth-partner.png',
        'title' => 'You grow',
        'desc' => 'Track real results, monthly reporting, and we optimise and scale as you grow.',
        'alt' => 'growth-partner'
      ]
    ];
    ?>
    <div class="flex flex-row items-start gap-6 max-lg:grid max-lg:grid-cols-2 max-lg:gap-4 max-md:grid-cols-1" bis_skin_checked="1">
      <?php foreach ($processes as $index => $process) : ?>
      <div class="flex-1 flex flex-row gap-3 relative" bis_skin_checked="1">
        <div class="flex flex-col justify-start items-end gap-5 max-md:flex-row max-md:gap-2 max-md:items-start">
          <div class="w-14 h-14 flex items-center justify-end" bis_skin_checked="1">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icon/<?php echo $process['icon']; ?>" alt="<?php echo $process['alt']; ?>" class="w-full h-full" />
          </div>
          <div class="mt-2 w-7 h-7 rounded-full border border-foreground/20 flex items-center justify-center" bis_skin_checked="1">
            <span class="text-white text-md font-semibold font-body"><?php echo $index + 1; ?></span>
          </div>
        </div>
        <div class="flex flex-col gap-2">
          <h3 class="text-foreground text-sm font-bold font-body">
            <?php echo $process['title']; ?>
          </h3>
          <p class="text-muted text-[13px] font-body leading-relaxed">
            <?php echo $process['desc']; ?>
          </p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="absolute top-0 right-0 w-[26%] h-full pointer-events-none" bis_skin_checked="1">
    <img alt="Wolf profile illustration" class="w-full h-full object-cover object-left"
      src="<?php echo get_template_directory_uri(); ?>/assets/images/how-it-works-wolf.png">
  </div>
</section>