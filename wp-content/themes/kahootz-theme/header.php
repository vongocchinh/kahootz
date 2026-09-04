<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="https://fonts.googleapis.com/" rel="preconnect">
  <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect">
  <title>MORE EYES. ON YOUR BUSINESS.</title>
  <meta content="MORE EYES. ON YOUR BUSINESS." property="og:title">
  <meta content="website" property="og:type">
  <meta content="MORE EYES. ON YOUR BUSINESS. — The world moved fast. Most businesses didn't."
    property="og:description">
  <meta content="MORE EYES. ON YOUR BUSINESS. — The world moved fast. Most businesses didn't." name="description">
  <meta content="https://c.animaapp.com/JWAr5Up3kdzDBu8iDQgO3A/snapshot.jpg" property="og:image">
  <meta content="MORE EYES. ON YOUR BUSINESS." property="og:image:alt">
  <meta content="summary_large_image" name="twitter:card">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div class="min-h-screen bg-[#020617] text-slate-100 bg-grad-page-background" bis_skin_checked="1">
    <header class="bg-background py-3 sm:py-4 border-b border-foreground/10 sticky top-0 z-50 shadow-sm" id="header">
      <!-- Bottom accent line (hidden on home) -->
      <?php if ( ! is_front_page() ) : ?>
      <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#FF6A00]/60 to-transparent"></div>
      <?php endif; ?>
      <div class="container-layout flex items-center justify-between gap-3" bis_skin_checked="1">
        <div class="flex items-center justify-start gap-20">
          <!-- Logo -->
          <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-1 flex-shrink-0"
            bis_skin_checked="1">
            <?php if (has_custom_logo()): ?>
              <?php
              $custom_logo_id = get_theme_mod('custom_logo');
              $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
              ?>
              <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                class="max-h-[40px] w-[100px]">
            <?php else: ?>
              <div class="flex flex-col leading-none" bis_skin_checked="1">
                <span
                  class="font-display font-bold text-foreground text-[24px] md:text-[22px] tracking-tight">Kahootz</span>
                <span
                  class="font-body font-medium text-muted text-[9px] md:text-[10px] tracking-[0.2em] uppercase">MEDIA</span>
              </div>
            <?php endif; ?>
          </a>
          <!-- Nav Links -->
          <nav class="hidden lg:flex items-center gap-8">
            <div class="relative group" bis_skin_checked="1">
              <a class="font-body font-semibold text-foreground text-[11px] tracking-widest uppercase hover:text-primary transition-colors flex items-center gap-1 py-2"
                href="/services">
                SERVICES <i class="ph ph-caret-down text-[10px]"></i>
              </a>
              <!-- Dropdown Menu -->
              <div
                class="absolute left-0 top-full mt-1 w-56 bg-card border border-foreground/10 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 overflow-hidden flex flex-col"
                bis_skin_checked="1">
                <?php
                $services_query = kahootz_get_services();
                if ($services_query->have_posts()):
                  while ($services_query->have_posts()):
                    $services_query->the_post(); ?>
                    <a href="<?php the_permalink(); ?>"
                      class="px-4 py-3 text-[13px] text-foreground/90 hover:bg-foreground/5 hover:text-primary transition-colors border-b border-foreground/5 last:border-0 block font-body">
                      <?php the_title(); ?>
                    </a>
                  <?php endwhile;
                  wp_reset_postdata();
                else: ?>
                  <span class="px-4 py-3 text-[13px] text-foreground/50 block font-body">No services found</span>
                <?php endif; ?>
              </div>
            </div>
            <a class="font-body font-semibold text-foreground text-[11px] tracking-widest uppercase hover:text-primary transition-colors"
              href="/stuck-vs-ai">
              AI
            </a>
            <a class="font-body font-semibold text-foreground text-[11px] tracking-widest uppercase hover:text-primary transition-colors"
              href="/packages">
              PACKAGES
            </a>
            <a class="font-body font-semibold text-foreground text-[11px] tracking-widest uppercase hover:text-primary transition-colors"
              href="/case-study">
              WORK
            </a>
            <a class="font-body font-semibold text-foreground text-[11px] tracking-widest uppercase hover:text-primary transition-colors"
              href="/about">
              ABOUT
            </a>
            <a class="font-body font-semibold text-foreground text-[11px] tracking-widest uppercase hover:text-primary transition-colors"
              href="/insights">
              INSIGHTS
            </a>
          </nav>
        </div>
        <div class="flex items-center gap-2 md:gap-3" bis_skin_checked="1">
          <!-- CTA Button -->
          <a href="<?php echo esc_url(site_url('/contact')); ?>"
            class="bg-grad-cta-primary text-foreground font-body font-bold text-[10px] md:text-[11px] tracking-widest uppercase px-3.5 md:px-4 py-2.5 rounded-md flex items-center gap-2 shadow-[0_8px_20px_rgba(255,106,0,0.25)] hover:opacity-90 transition-opacity flex-shrink-0">
            <i class="ph-fill ph-chat-circle-dots text-sm"></i>
            MESSAGE US NOW
          </a>
          <button id="open-mobile-menu" aria-label="Open menu"
            class="lg:hidden w-10 h-10 rounded-md border border-foreground/20 text-foreground flex items-center justify-center hover:border-foreground/40 transition-colors"
            type="button">
            <i class="ph-bold ph-list text-[22px]"></i>
          </button>
        </div>
      </div>
    </header>

    <!-- Mobile Sidebar Menu -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-[#020617]/80 backdrop-blur-sm z-[60] opacity-0 invisible transition-all duration-300"></div>
    <div id="mobile-menu" class="fixed top-0 right-0 h-full w-[300px] max-w-full bg-background border-l border-foreground/10 z-[70] transform translate-x-full transition-transform duration-300 flex flex-col">
      <div class="flex items-center justify-between p-4 border-b border-foreground/10" bis_skin_checked="1">
        <span class="font-display font-bold text-foreground text-[20px] tracking-tight"></span>
        <button id="close-mobile-menu" aria-label="Close menu" class="rounded-md flex items-center justify-center text-foreground hover:bg-foreground/5 transition-colors">
          <i class="ph ph-x text-[22px]"></i>
        </button>
      </div>
      <nav class="flex flex-col p-4 gap-2 overflow-y-auto">
        <!-- Services with dropdown -->
        <div class="flex flex-col" bis_skin_checked="1">
          <button id="mobile-services-toggle" class="flex items-center justify-between py-3 font-body font-semibold text-foreground text-[13px] tracking-widest uppercase border-b border-foreground/5 w-full text-left">
            SERVICES <i class="ph ph-caret-down text-[16px] transition-transform duration-200"></i>
          </button>
          <div id="mobile-services-dropdown" class="hidden flex-col pl-4 mt-2 mb-2 gap-2" bis_skin_checked="1">
            <?php
            $services_query_mobile = kahootz_get_services();
            if ($services_query_mobile->have_posts()):
              while ($services_query_mobile->have_posts()):
                $services_query_mobile->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="py-2 text-[14px] text-foreground/80 hover:text-primary transition-colors font-body">
                  <?php the_title(); ?>
                </a>
              <?php endwhile;
              wp_reset_postdata();
            endif; ?>
          </div>
        </div>
        <a class="py-3 font-body font-semibold text-foreground text-[13px] tracking-widest uppercase border-b border-foreground/5 hover:text-primary transition-colors" href="/stuck-vs-ai">AI</a>
        <a class="py-3 font-body font-semibold text-foreground text-[13px] tracking-widest uppercase border-b border-foreground/5 hover:text-primary transition-colors" href="/case-study">WORK</a>
        <a class="py-3 font-body font-semibold text-foreground text-[13px] tracking-widest uppercase border-b border-foreground/5 hover:text-primary transition-colors" href="/about">ABOUT</a>
        <a class="py-3 font-body font-semibold text-foreground text-[13px] tracking-widest uppercase border-b border-foreground/5 hover:text-primary transition-colors" href="/insights">INSIGHTS</a>
      </nav>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const openMenuBtn = document.getElementById('open-mobile-menu');
        const closeMenuBtn = document.getElementById('close-mobile-menu');
        const mobileMenu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('mobile-menu-overlay');
        const servicesToggle = document.getElementById('mobile-services-toggle');
        const servicesDropdown = document.getElementById('mobile-services-dropdown');
        const servicesIcon = servicesToggle?.querySelector('i');

        function openMenu() {
          if(!overlay || !mobileMenu) return;
          overlay.classList.remove('opacity-0', 'invisible');
          overlay.classList.add('opacity-100', 'visible');
          mobileMenu.classList.remove('translate-x-full');
          mobileMenu.classList.add('translate-x-0');
          document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
          if(!overlay || !mobileMenu) return;
          overlay.classList.remove('opacity-100', 'visible');
          overlay.classList.add('opacity-0', 'invisible');
          mobileMenu.classList.remove('translate-x-0');
          mobileMenu.classList.add('translate-x-full');
          document.body.style.overflow = '';
        }

        if(openMenuBtn) openMenuBtn.addEventListener('click', openMenu);
        if(closeMenuBtn) closeMenuBtn.addEventListener('click', closeMenu);
        if(overlay) overlay.addEventListener('click', closeMenu);

        if (servicesToggle && servicesDropdown) {
          servicesToggle.addEventListener('click', () => {
            servicesDropdown.classList.toggle('hidden');
            servicesDropdown.classList.toggle('flex');
            if (servicesIcon) {
              servicesIcon.classList.toggle('rotate-180');
            }
          });
        }
      });
    </script>