<?php
/**
 * Template Name: AI Page
 */
get_header();
?>

<main class="bg-[#040814] pb-24">

    <!-- HERO -->
    <section class="relative pt-36 pb-20  max-md:pt-16 max-md:pb-10overflow-hidden border-b border-white/5">
        <div class="hidden top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#FF6A00]/50 to-transparent"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 max-md:hidden  w-[900px] h-[500px] bg-[#FF6A00]/10 rounded-full blur-[160px] pointer-events-none"></div>

        <div class="container-layout px-4 sm:px-6 lg:px-8 relative z-10 text-center max-w-4xl mx-auto">
            <h1 class="font-display font-black text-5xl md:text-6xl lg:text-7xl text-white leading-[0.9] tracking-tight mb-8">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6A00] to-[#FF8C00]">AI is our advantage.</span><br>
                While others catch up, we're already ahead.
            </h1>
            <p class="font-body text-lg md:text-xl text-slate-400 leading-relaxed max-w-3xl mx-auto mb-10">
                Marketing is changing faster than most agencies can keep up. We build AI into everything we do — research, content, automation, optimisation — so your business moves at the speed the market actually demands.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="<?php echo esc_url( home_url('/contact') ); ?>"
                   class="inline-flex items-center gap-3 bg-[#FF6A00] hover:bg-[#FF5500] text-white font-body font-bold text-[12px] uppercase tracking-[0.2em] px-10 py-5 rounded-full transition-all duration-300 hover:shadow-[0_0_40px_rgba(255,106,0,0.35)] hover:-translate-y-0.5">
                    <i class="ph-fill ph-chat-circle text-lg"></i> Message Us Now
                </a>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="container-layout px-4 sm:px-6 lg:px-8 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 xl:gap-24 items-start">
            
            <!-- How We Use AI -->
            <div class="relative">
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-[#FF6A00]/5 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="flex items-center gap-4 mb-10">
                    <span class="h-px w-10 bg-[#FF6A00]"></span>
                    <span class="font-body text-[11px] font-bold uppercase tracking-[0.25em] text-[#FF6A00]">How We Use AI</span>
                </div>
                
                <ul class="space-y-8">
                    <?php 
                    $ai_features = [
                        ['title' => 'Smarter research', 'desc' => 'Market and competitor insights in a fraction of the time.'],
                        ['title' => 'Better content', 'desc' => 'AI-assisted, human-refined, never generic.'],
                        ['title' => 'Advanced automation', 'desc' => 'Systems that save time and reduce cost.'],
                        ['title' => 'Real-time optimisation', 'desc' => 'Campaigns adjusted as data comes in, not once a month.'],
                        ['title' => 'Clear reporting', 'desc' => 'AI-powered insights explained in plain English.'],
                    ];
                    foreach ( $ai_features as $feature ) :
                    ?>
                    <li class="flex items-start gap-5 group">
                        <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center flex-shrink-0 group-hover:bg-[#FF6A00]/10 group-hover:border-[#FF6A00]/30 transition-colors duration-300">
                            <i class="ph-bold ph-lightning text-[#FF6A00] text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-body font-bold text-white text-lg mb-1"><?php echo esc_html( $feature['title'] ); ?></h3>
                            <p class="font-body text-[15px] text-slate-400 leading-relaxed"><?php echo esc_html( $feature['desc'] ); ?></p>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Why It Matters -->
            <div class="bg-[#0A101F] border border-white/5 rounded-3xl p-10 lg:p-14 sticky top-32">
                <div class="flex items-center gap-4 mb-8">
                    <span class="h-px w-10 bg-[#FF6A00]"></span>
                    <span class="font-body text-[11px] font-bold uppercase tracking-[0.25em] text-[#FF6A00]">Why It Matters</span>
                </div>
                <h3 class="font-display font-black text-3xl text-white tracking-tight mb-6 leading-snug">
                    Being "AI-enhanced" isn't a buzzword for us.
                </h3>
                <p class="font-body text-[16px] text-slate-400 leading-[1.8] mb-10">
                    It's how we deliver results faster and cheaper than agencies still doing everything manually. You get senior-level strategic thinking, backed by tools that make execution faster.
                </p>
                <div class="pt-8 border-t border-white/5">
                    <a href="<?php echo esc_url( home_url('/contact') ); ?>" class="inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-200 text-black font-body font-bold text-[11px] uppercase tracking-widest px-8 py-4 rounded-full transition-all duration-300 w-full sm:w-auto hover:scale-105">
                        Message Us Now <i class="ph-bold ph-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
