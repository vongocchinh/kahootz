<footer class="bg-footer-bar border-t border-foreground/10 py-4" id="footer">
  <nav
    class="flex flex-wrap items-center justify-center gap-x-4 gap-y-2 font-body font-semibold text-sm text-white py-2">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-primary transition-colors">Home</a> <span
      class="text-white/20 px-1">|</span>
    <a href="<?php echo esc_url(site_url('/services')); ?>" class="hover:text-primary transition-colors">Services</a>
    <span class="text-white/20 px-1">|</span>
    <a href="<?php echo esc_url(site_url('/packages')); ?>" class="hover:text-primary transition-colors">Packages</a>
    <span class="text-white/20 px-1">|</span>
    <a href="<?php echo esc_url(site_url('/stuck-vs-ai')); ?>" class="hover:text-primary transition-colors">AI</a> <span
      class="text-white/20 px-1">|</span>
    <a href="<?php echo esc_url(site_url('/case-study')); ?>" class="hover:text-primary transition-colors">Work</a>
    <span class="text-white/20 px-1">|</span>
    <a href="<?php echo esc_url(site_url('/about')); ?>" class="hover:text-primary transition-colors">About</a> <span
      class="text-white/20 px-1">|</span>
    <a href="<?php echo esc_url(site_url('/insights')); ?>" class="hover:text-primary transition-colors">Insights</a>
    <span class="text-white/20 px-1">|</span>
    <a href="<?php echo esc_url(site_url('/contact')); ?>" class="hover:text-primary transition-colors">Contact</a>
  </nav>
  <div class="container-layout" bis_skin_checked="1">
    <div class="flex flex-wrap items-center justify-between gap-4" bis_skin_checked="1">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-1" bis_skin_checked="1">
        <?php if (has_custom_logo()): ?>
          <?php
          $custom_logo_id = get_theme_mod('custom_logo');
          $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
          ?>
          <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
            class="max-h-[40px] w-[100px]">
        <?php else: ?>
          <span class="font-display font-bold text-foreground text-sm leading-tight">Kahootz<br><span
              class="text-sm font-medium tracking-widest text-white">MEDIA</span></span>
        <?php endif; ?>
      </a>
      <p class="text-sm text-white font-body">
        © 2016–2025 Kahootz Media. All rights reserved.
      </p>
      <div class="flex items-center gap-6" bis_skin_checked="1">
        <a class="text-sm text-white hover:text-foreground font-body transition-colors"
          href="<?php echo esc_url(site_url('/privacy-policy')); ?>">Privacy Policy</a>
        <a class="text-sm text-white hover:text-foreground font-body transition-colors"
          href="<?php echo esc_url(site_url('/terms-and-conditions')); ?>">Terms &amp;
          Conditions</a>
      </div>
      <div class="flex items-center gap-4" bis_skin_checked="1">
        <?php
        $theme_options = get_option('kahootz_settings');
        $social_linkedin = !empty($theme_options['social_linkedin']) ? esc_url($theme_options['social_linkedin']) : '#';
        $social_facebook = !empty($theme_options['social_facebook']) ? esc_url($theme_options['social_facebook']) : '#';
        $social_instagram = !empty($theme_options['social_instagram']) ? esc_url($theme_options['social_instagram']) : '#';
        ?>
        <a target="_blank" aria-label="LinkedIn" class="text-white hover:text-foreground transition-colors"
          href="<?php echo $social_linkedin; ?>">
          <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Page-1" stroke="none" stroke-width="1" fill="white" fill-rule="evenodd">
              <g id="Dribbble-Light-Preview" transform="translate(-180.000000, -7479.000000)" fill="#FFFFFF">
                <g id="icons" transform="translate(56.000000, 160.000000)">
                  <path
                    d="M144,7339 L140,7339 L140,7332.001 C140,7330.081 139.153,7329.01 137.634,7329.01 C135.981,7329.01 135,7330.126 135,7332.001 L135,7339 L131,7339 L131,7326 L135,7326 L135,7327.462 C135,7327.462 136.255,7325.26 139.083,7325.26 C141.912,7325.26 144,7326.986 144,7330.558 L144,7339 L144,7339 Z M126.442,7323.921 C125.093,7323.921 124,7322.819 124,7321.46 C124,7320.102 125.093,7319 126.442,7319 C127.79,7319 128.883,7320.102 128.883,7321.46 C128.884,7322.819 127.79,7323.921 126.442,7323.921 L126.442,7323.921 Z M124,7339 L129,7339 L129,7326 L124,7326 L124,7339 Z"
                    id="linkedin-[#161]">

                  </path>
                </g>
              </g>
            </g>
          </svg>
        </a>
        <a target="_blank" aria-label="Facebook" class="text-white hover:text-foreground transition-colors"
          href="<?php echo $social_facebook; ?>">
          <svg fill="#FFFFFF" width="20px" height="20px" viewBox="0 0 512 512">
            <g id="7935ec95c421cee6d86eb22ecd11b7e3">
              <path style="display: inline;" d="M283.122,122.174c0,5.24,0,22.319,0,46.583h83.424l-9.045,74.367h-74.379
    c0,114.688,0,268.375,0,268.375h-98.726c0,0,0-151.653,0-268.375h-51.443v-74.367h51.443c0-29.492,0-50.463,0-56.302
    c0-27.82-2.096-41.02,9.725-62.578C205.948,28.32,239.308-0.174,297.007,0.512c57.713,0.711,82.04,6.263,82.04,6.263
    l-12.501,79.257c0,0-36.853-9.731-54.942-6.263C293.539,83.238,283.122,94.366,283.122,122.174z">
              </path>
            </g>
          </svg>
        </a>
        <a target="_blank" aria-label="Instagram" class="text-white hover:text-foreground transition-colors"
          href="<?php echo $social_instagram; ?>">
          <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z"
              fill="#FFFFFF" />
            <path
              d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z"
              fill="#FFFFFF" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M1.65396 4.27606C1 5.55953 1 7.23969 1 10.6V13.4C1 16.7603 1 18.4405 1.65396 19.7239C2.2292 20.8529 3.14708 21.7708 4.27606 22.346C5.55953 23 7.23969 23 10.6 23H13.4C16.7603 23 18.4405 23 19.7239 22.346C20.8529 21.7708 21.7708 20.8529 22.346 19.7239C23 18.4405 23 16.7603 23 13.4V10.6C23 7.23969 23 5.55953 22.346 4.27606C21.7708 3.14708 20.8529 2.2292 19.7239 1.65396C18.4405 1 16.7603 1 13.4 1H10.6C7.23969 1 5.55953 1 4.27606 1.65396C3.14708 2.2292 2.2292 3.14708 1.65396 4.27606ZM13.4 3H10.6C8.88684 3 7.72225 3.00156 6.82208 3.0751C5.94524 3.14674 5.49684 3.27659 5.18404 3.43597C4.43139 3.81947 3.81947 4.43139 3.43597 5.18404C3.27659 5.49684 3.14674 5.94524 3.0751 6.82208C3.00156 7.72225 3 8.88684 3 10.6V13.4C3 15.1132 3.00156 16.2777 3.0751 17.1779C3.14674 18.0548 3.27659 18.5032 3.43597 18.816C3.81947 19.5686 4.43139 20.1805 5.18404 20.564C5.49684 20.7234 5.94524 20.8533 6.82208 20.9249C7.72225 20.9984 8.88684 21 10.6 21H13.4C15.1132 21 16.2777 20.9984 17.1779 20.9249C18.0548 20.8533 18.5032 20.7234 18.816 20.564C19.5686 20.1805 20.1805 19.5686 20.564 18.816C20.7234 18.5032 20.8533 18.0548 20.9249 17.1779C20.9984 16.2777 21 15.1132 21 13.4V10.6C21 8.88684 20.9984 7.72225 20.9249 6.82208C20.8533 5.94524 20.7234 5.49684 20.564 5.18404C20.1805 4.43139 19.5686 3.81947 18.816 3.43597C18.5032 3.27659 18.0548 3.14674 17.1779 3.0751C16.2777 3.00156 15.1132 3 13.4 3Z"
              fill="#FFFFFF" />
          </svg>
        </a>
      </div>
    </div>
  </div>
</footer>
</div>
<?php wp_footer(); ?>
<script>
  document.addEventListener('click', function (e) {
    const link = e.target.closest('a');
    if (link) {
      const href = link.getAttribute('href');
      if (href && href.startsWith('#')) {
        e.preventDefault();

        if (href.length > 1) {
          const target = document.querySelector(href);
          if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
          }
        }
      }
    }
  });
</script>
</body>

</html>