<?php
/**
 * Template Name: Terms & Conditions
 */
get_header();
?>

<main class="bg-[#040814] min-h-screen pt-24 pb-28">
    <div class="container mx-auto max-w-3xl px-6 md:px-8">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2.5 font-body text-[11px] uppercase tracking-[0.18em] text-white/30 mb-14">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-[#FF6A00] transition-colors duration-200">Home</a>
            <i class="ph-bold ph-caret-right text-[10px]"></i>
            <span class="text-white/55">Terms &amp; Conditions</span>
        </nav>

        <!-- Header -->
        <div class="mb-14 pb-12 border-b border-white/6">
            <span class="inline-block font-body text-[10px] font-bold uppercase tracking-[0.28em] text-[#FF6A00] mb-5">Legal</span>
            <h1 class="font-display font-black text-[48px] md:text-[60px] text-white leading-[0.9] tracking-[-0.025em] mb-6">
                Terms &amp;<br>Conditions
            </h1>
            <p class="font-body text-sm text-white/30 tracking-wide">Last updated: <?php echo date( 'F j, Y' ); ?></p>
        </div>

        <!-- Body Content -->
        <div class="
            [&_h2]:font-display [&_h2]:font-bold [&_h2]:text-2xl [&_h2]:text-white [&_h2]:mt-14 [&_h2]:mb-5
            [&_h3]:font-display [&_h3]:font-semibold [&_h3]:text-lg [&_h3]:text-white [&_h3]:mt-8 [&_h3]:mb-3
            [&_p]:font-body [&_p]:text-[15px] [&_p]:text-slate-400 [&_p]:leading-[1.85] [&_p]:mb-5
            [&_ul]:mb-6 [&_ul]:space-y-2.5
            [&_ul_li]:font-body [&_ul_li]:text-[15px] [&_ul_li]:text-slate-400 [&_ul_li]:leading-relaxed [&_ul_li]:pl-5 [&_ul_li]:relative
            [&_ul_li]:before:absolute [&_ul_li]:before:left-0 [&_ul_li]:before:top-[0.55em] [&_ul_li]:before:w-1.5 [&_ul_li]:before:h-1.5 [&_ul_li]:before:rounded-full [&_ul_li]:before:bg-[#FF6A00]
            [&_a]:text-[#FF6A00] [&_a]:underline [&_a]:underline-offset-2 hover:[&_a]:text-white
            [&_strong]:text-white [&_strong]:font-semibold
        ">
            <?php the_content(); ?>
        </div>

        <!-- Footer nav -->
        <div class="mt-20 pt-10 border-t border-white/6 flex items-center justify-between flex-wrap gap-4">
            <a href="<?php echo esc_url( home_url('/privacy-policy') ); ?>"
               class="inline-flex items-center gap-2 text-white/30 hover:text-[#FF6A00] font-body text-[11px] uppercase tracking-widest transition-colors duration-200">
                <i class="ph-bold ph-arrow-left text-sm"></i> Privacy Policy
            </a>
            <a href="<?php echo esc_url( home_url('/') ); ?>"
               class="inline-flex items-center gap-2 text-white/30 hover:text-white font-body text-[11px] uppercase tracking-widest transition-colors duration-200">
                Home <i class="ph-bold ph-arrow-right text-sm"></i>
            </a>
        </div>

    </div>
</main>

<?php get_footer(); ?>
