<?php
/**
 * Closing CTA Strip Component
 * 
 * Expected variables in args:
 * - 'title' (string) The heading text
 * - 'desc' (string) Optional paragraph text
 */

$title = isset($args['title']) ? $args['title'] : 'Not sure what you need?';
$desc = isset($args['desc']) ? $args['desc'] : 'Tell us where your business is stuck — we\'ll tell you exactly what will move the needle.';
?>
<section class="border-t border-white/5 bg-[#0A101F]">
    <div class="container-layout  py-20">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-10">
            <div class="text-center lg:text-left">
                <h2 class="font-display font-bold text-3xl md:text-4xl text-white tracking-tight mb-4"><?php echo esc_html($title); ?></h2>
                <?php if (!empty($desc)) : ?>
                <p class="font-body text-slate-400 text-lg max-w-xl"><?php echo esc_html($desc); ?></p>
                <?php endif; ?>
            </div>
            <div class="flex flex-wrap items-center gap-4 flex-shrink-0 max-md:justify-center">
                <a href="<?php echo esc_url( home_url('/contact') ); ?>"
                   class="inline-flex items-center gap-3 bg-[#FF6A00] hover:bg-[#FF5500] text-white font-body font-bold text-[12px] uppercase tracking-[0.2em] px-8 py-4 rounded-full transition-all duration-300 hover:shadow-[0_0_30px_rgba(255,106,0,0.35)]">
                    <i class="ph-fill ph-chat-circle text-lg"></i> MESSAGE US NOW
                </a>
                <a href="<?php echo esc_url( home_url('/packages') ); ?>"
                   class="inline-flex items-center gap-2 border border-white/10 hover:border-[#FF6A00]/40 text-white/60 hover:text-[#FF6A00] font-body font-bold text-[12px] uppercase tracking-[0.2em] px-8 py-4 rounded-full transition-all duration-300">
                    View Packages <i class="ph-bold ph-arrow-right text-sm"></i>
                </a>
            </div>
        </div>

        <!-- Trust bar -->
        <div class="mt-12 pt-10 border-t border-white/5 flex flex-wrap items-center justify-center lg:justify-start gap-8 text-white/30 font-body text-sm">
            <span class="flex items-center gap-2"><i class="ph-bold ph-lightning text-[#FF6A00]"></i> Fast response</span>
            <span class="flex items-center gap-2"><i class="ph-bold ph-check-circle text-[#FF6A00]"></i> No lock-in contracts</span>
            <span class="flex items-center gap-2"><i class="ph-bold ph-currency-dollar text-[#FF6A00]"></i> Transparent pricing</span>
            <span class="flex items-center gap-2"><i class="ph-bold ph-target text-[#FF6A00]"></i> Results focused</span>
        </div>
    </div>
</section>
