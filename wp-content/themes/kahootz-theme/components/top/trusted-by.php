<?php
$trusted_brands = [
  'bangkok.png',
  'remax.png',
  'bangkok.png',
  'remax.png',
  'bangkok.png',
  'remax.png',
  'bangkok.png',
];
?>
<section class="bg-page-section mt-1" id="trusted-by">
  <style>
    @keyframes infinite-scroll {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }
    .animate-infinite-scroll {
      animation: infinite-scroll 30s linear infinite;
      width: max-content;
    }
    .animate-infinite-scroll:hover {
      animation-play-state: paused;
    }
  </style>
  <div class="container-layout py-4 border-foreground/10 border rounded-md overflow-hidden" bis_skin_checked="1">
    <p class="text-center text-[11px] font-body font-semibold tracking-[0.18em] text-muted uppercase mb-3">
      TRUSTED BY AMBITIOUS BRANDS WORLDWIDE
    </p>
    
    <!-- Marquee Wrapper -->
    <div class="relative w-full overflow-hidden flex" bis_skin_checked="1">
      <div class="flex animate-infinite-scroll" bis_skin_checked="1">
        <?php 
        // Render 2 identical blocks so that translating by -50% loops perfectly
        for ($i = 0; $i < 2; $i++) : 
        ?>
        <div class="flex items-center gap-12 pr-12 w-max flex-shrink-0" bis_skin_checked="1">
          <?php foreach ($trusted_brands as $brand) : ?>
          <div class="flex items-center w-[160px] h-[60px] flex-shrink-0" bis_skin_checked="1">
            <img alt="Brand logo" class="w-full h-full object-cover object-center opacity-80 hover:opacity-100 transition-opacity"
              src="<?php echo get_template_directory_uri(); ?>/assets/images/<?php echo $brand; ?>">
          </div>
          <?php endforeach; ?>
        </div>
        <?php endfor; ?>
      </div>
    </div>
    
  </div>
</section>