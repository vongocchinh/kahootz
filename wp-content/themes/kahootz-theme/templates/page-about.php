<?php
/**
 * Template Name: About Page
 */
get_header();
?>

<main class="bg-[#040814] min-h-screen pb-32">

    <!-- HERO -->
    <section class="relative pt-36 pb-20  max-md:pt-16 max-md:pb-10overflow-hidden border-b border-white/5">
        <div class="hidden top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#FF6A00]/50 to-transparent"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 max-md:hidden  w-[900px] h-[500px] bg-[#FF6A00]/5 rounded-full blur-[160px] pointer-events-none"></div>

        <div class="container-layout px-4 sm:px-6 lg:px-8 relative z-10 text-center max-w-4xl mx-auto">
            <h1 class="font-display font-black text-[48px] lg:text-[64px] leading-[1.1] mb-8 tracking-tight uppercase text-white">
                More capability.<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6A00] to-[#FF8C00]">Better results.</span><br>
                Better value.
            </h1>
            
            <p class="text-white font-body text-xl lg:text-2xl font-medium leading-relaxed mb-6">
                Kahootz Media was built on one idea: businesses deserve marketing that actually works — without the bloated retainers, the jargon, or the guesswork.
            </p>
            <p class="text-slate-400 font-body text-lg leading-relaxed max-w-3xl mx-auto">
                We combine experienced UK & European marketers, a talented Thailand-based team, and AI built into everything we do, to help businesses grow — wherever they are in the world.
            </p>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="container-layout px-4 sm:px-6 lg:px-8 py-24">
        
        <!-- Why Kahootz & Leader Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto mb-20">
            
            <!-- Why Kahootz -->
            <div class="bg-[#0A101F] border border-slate-800/80 rounded-2xl p-10 lg:p-12 shadow-2xl">
                <h2 class="font-display font-bold text-3xl text-white mb-8">Why Kahootz</h2>
                <ul class="space-y-6">
                    <li class="flex items-start gap-4">
                        <i class="ph-bold ph-check text-[#FF6A00] text-xl mt-1"></i>
                        <span class="text-slate-300 font-body text-lg">UK & European strategists and specialists</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <i class="ph-bold ph-check text-[#FF6A00] text-xl mt-1"></i>
                        <span class="text-slate-300 font-body text-lg">Thailand-based creative and delivery team</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <i class="ph-bold ph-check text-[#FF6A00] text-xl mt-1"></i>
                        <span class="text-slate-300 font-body text-lg">AI technology used in everything we do</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <i class="ph-bold ph-check text-[#FF6A00] text-xl mt-1"></i>
                        <span class="text-slate-300 font-body text-lg">Global network of specialist professionals</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <i class="ph-bold ph-check text-[#FF6A00] text-xl mt-1"></i>
                        <span class="text-slate-300 font-body text-lg">The right team for the right project, every time</span>
                    </li>
                </ul>
            </div>

            <!-- Meet the Leader -->
            <div class="bg-[#0A101F] border border-slate-800/80 rounded-2xl p-10 lg:p-12 shadow-2xl">
                <h2 class="font-display font-bold text-3xl text-white mb-2">Meet the Leader</h2>
                <h3 class="font-display font-bold text-xl text-[#FF6A00] mb-2">Lewis Murawski</h3>
                <p class="text-slate-400 font-body text-sm font-bold uppercase tracking-widest mb-6 italic">Founder & Managing Director — The Wolf Behind the Results</p>
                
                <p class="text-slate-300 font-body text-base leading-relaxed mb-8">
                    Vastly experienced marketer with over 20 years in the industry. Former senior executive at global media giant Emap, with C-level roles across public listed companies. Lewis steers every project, recruits the right people, and speaks the language of business. That's how great marketing gets real results.
                </p>

                <ul class="space-y-4">
                    <li class="flex items-center gap-3">
                        <i class="ph-fill ph-check-circle text-[#FF6A00] text-lg"></i>
                        <span class="text-slate-300 font-body text-sm font-medium">20+ years marketing experience</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="ph-fill ph-check-circle text-[#FF6A00] text-lg"></i>
                        <span class="text-slate-300 font-body text-sm font-medium">Former Emap senior executive</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="ph-fill ph-check-circle text-[#FF6A00] text-lg"></i>
                        <span class="text-slate-300 font-body text-sm font-medium">C-level roles in public listed companies</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="ph-fill ph-check-circle text-[#FF6A00] text-lg"></i>
                        <span class="text-slate-300 font-body text-sm font-medium">Entrepreneur & business operator</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="ph-fill ph-check-circle text-[#FF6A00] text-lg"></i>
                        <span class="text-slate-300 font-body text-sm font-medium">Builds the right team for every project</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- CTA Section -->
        <div class="max-w-3xl mx-auto text-center">
            <div class="flex items-center justify-center gap-5 max-md:flex-col">
                <a href="#" class="flex items-center justify-center gap-3 bg-[#FF6A00] hover:bg-[#FF5500] text-white font-body font-bold text-[12px] uppercase tracking-[0.2em] px-10 py-5 rounded-full transition-all duration-300 hover:shadow-[0_0_40px_rgba(255,106,0,0.35)] hover:-translate-y-0.5 w-[300px] max-md:w-full">
                    <i class="ph-fill ph-chat-circle text-[18px]"></i> MESSAGE US NOW
                </a>
                <a href="<?php echo esc_url(home_url('/case-study')); ?>" class="flex items-center justify-center gap-3 bg-transparent border border-[#FF6A00] text-[#FF6A00] hover:bg-[#FF6A00] hover:text-white font-body font-bold text-[12px] tracking-[0.2em] uppercase px-10 py-5 rounded-full transition-all duration-300 hover:shadow-[0_0_40px_rgba(255,106,0,0.35)] hover:-translate-y-0.5 w-[300px] max-md:w-full">
                    VIEW OUR WORK <i class="ph-bold ph-arrow-right text-[16px]"></i>
                </a>
            </div>
        </div>

    </section>
</main>

<?php get_footer(); ?>
