<?php
/**
 * Template Name: Contact Page
 */
get_header();
?>

<main class="bg-[#040814] min-h-screen pb-16">

    <!-- HERO -->
    <section class="relative pt-16 pb-10 overflow-hidden border-b border-white/5">
        <div class="hidden top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#FF6A00]/50 to-transparent"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 max-md:hidden  w-[900px] h-[500px] bg-[#FF6A00]/5 rounded-full blur-[160px] pointer-events-none"></div>

        <div class="container-layout px-4 sm:px-6 lg:px-8 relative z-10 text-center max-w-3xl mx-auto">
            <h1 class="font-display font-black text-[56px] lg:text-[72px] leading-none mb-6 tracking-tight uppercase">
                <span class="text-white">Let's</span> <span class="text-[#FF6A00]">talk.</span>
            </h1>
            <p class="text-slate-300 font-body text-lg lg:text-xl font-medium tracking-wide">
                Skip the email. Message us directly and get a real reply, fast.
            </p>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="container-layout px-4 sm:px-6 lg:px-8 py-24">

        <?php
        $theme_options = get_option('kahootz_settings');
        $social_line = !empty($theme_options['social_line']) ? esc_url($theme_options['social_line']) : '#';
        $social_whatsapp = !empty($theme_options['social_whatsapp']) ? esc_url($theme_options['social_whatsapp']) : '#';
        ?>
        <div class="flex items-center justify-center gap-5 mb-14 max-md:flex-col">
            <a href="<?php echo $social_whatsapp; ?>" target="_blank" class="flex items-center justify-center gap-3 bg-[#25D366] hover:bg-[#20b858] text-white font-body font-bold text-[12px] tracking-[0.2em] uppercase px-10 py-5 rounded-full transition-all duration-300 hover:shadow-[0_0_40px_rgba(37,211,102,0.35)] hover:-translate-y-0.5 w-[300px] max-md:w-full">
                <i class="ph-fill ph-whatsapp-logo text-[18px]"></i> CHAT ON WHATSAPP
            </a>
            <a href="<?php echo $social_line; ?>" target="_blank" class="flex items-center justify-center gap-3 bg-[#00C300] hover:bg-[#00a800] text-white font-body font-bold text-[12px] tracking-[0.2em] uppercase px-10 py-5 rounded-full transition-all duration-300 hover:shadow-[0_0_40px_rgba(0,195,0,0.35)] hover:-translate-y-0.5 w-[300px] max-md:w-full">
                <i class="ph-fill ph-chat-circle text-[18px]"></i> CHAT ON LINE
            </a>
        </div>

        <div class="max-w-2xl mx-auto mb-10 text-center">
            <p class="text-slate-400 font-body text-[15px] italic font-medium">
                Prefer email or a form instead? Fill in the details below and we'll get back to you within 1 business day.
            </p>
        </div>

        <!-- Form Section -->
        <div class="max-w-[700px] mx-auto bg-[#0A101F] border border-slate-800/80 rounded-2xl p-10 lg:p-12 shadow-2xl">
            <?php if ( isset($_GET['status']) && $_GET['status'] == 'success' ) : ?>
                <div class="bg-green-500/10 border border-green-500/30 text-green-400 p-4 rounded-md mb-8 text-center font-body text-sm font-medium">
                    Thank you! Your message has been sent successfully. We will get back to you soon.
                </div>
            <?php endif; ?>

            <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST" class="space-y-7">
                <input type="hidden" name="action" value="submit_contact_form">
                <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
                
                <div class="grid grid-cols-2 gap-7 max-md:grid-cols-1">
                    <div class="flex flex-col gap-2.5">
                        <label for="c_name" class="font-body text-[10px] font-bold text-slate-300 uppercase tracking-[0.15em]">Name *</label>
                        <input type="text" id="c_name" name="c_name" required class="bg-[#040814] border border-slate-800 rounded-lg px-4 py-3.5 text-white font-body text-[14px] focus:border-[#FF6A00] focus:ring-1 focus:ring-[#FF6A00] transition-all outline-none">
                    </div>
                    <div class="flex flex-col gap-2.5">
                        <label for="c_email" class="font-body text-[10px] font-bold text-slate-300 uppercase tracking-[0.15em]">Email *</label>
                        <input type="email" id="c_email" name="c_email" required class="bg-[#040814] border border-slate-800 rounded-lg px-4 py-3.5 text-white font-body text-[14px] focus:border-[#FF6A00] focus:ring-1 focus:ring-[#FF6A00] transition-all outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-7 max-md:grid-cols-1">
                    <div class="flex flex-col gap-2.5">
                        <label for="c_phone" class="font-body text-[10px] font-bold text-slate-300 uppercase tracking-[0.15em]">Phone (Optional)</label>
                        <input type="tel" id="c_phone" name="c_phone" class="bg-[#040814] border border-slate-800 rounded-lg px-4 py-3.5 text-white font-body text-[14px] focus:border-[#FF6A00] focus:ring-1 focus:ring-[#FF6A00] transition-all outline-none">
                    </div>
                    <div class="flex flex-col gap-2.5">
                        <label for="c_business" class="font-body text-[10px] font-bold text-slate-300 uppercase tracking-[0.15em]">Business Name *</label>
                        <input type="text" id="c_business" name="c_business" required class="bg-[#040814] border border-slate-800 rounded-lg px-4 py-3.5 text-white font-body text-[14px] focus:border-[#FF6A00] focus:ring-1 focus:ring-[#FF6A00] transition-all outline-none">
                    </div>
                </div>

                <div class="flex flex-col gap-2.5">
                    <label for="c_looking_for" class="font-body text-[10px] font-bold text-slate-300 uppercase tracking-[0.15em]">What are you looking for? *</label>
                    <select id="c_looking_for" name="c_looking_for" required class="bg-[#040814] border border-slate-800 rounded-lg px-4 py-3.5 text-white font-body text-[14px] focus:border-[#FF6A00] focus:ring-1 focus:ring-[#FF6A00] transition-all outline-none appearance-none cursor-pointer">
                        <option value="" disabled selected>Select an option...</option>
                        <option value="Social Media">Social Media</option>
                        <option value="SEO">SEO</option>
                        <option value="Paid Ads">Paid Ads</option>
                        <option value="Website">Website</option>
                        <option value="Growth Partner">Growth Partner</option>
                        <option value="Not Sure Yet">Not Sure Yet</option>
                    </select>
                </div>

                <div class="flex flex-col gap-2.5">
                    <label for="c_message" class="font-body text-[10px] font-bold text-slate-300 uppercase tracking-[0.15em]">Message *</label>
                    <textarea id="c_message" name="c_message" required rows="5" class="bg-[#040814] border border-slate-800 rounded-lg px-4 py-4 text-white font-body text-[14px] focus:border-[#FF6A00] focus:ring-1 focus:ring-[#FF6A00] transition-all outline-none resize-y"></textarea>
                </div>

                <button type="submit" class="w-full bg-[#FF6A00] hover:bg-[#FF5500] text-white font-body font-bold text-[12px] tracking-[0.2em] uppercase py-5 mt-2 rounded-full transition-all duration-300 hover:shadow-[0_0_40px_rgba(255,106,0,0.35)] hover:-translate-y-0.5">
                    SEND MESSAGE
                </button>
            </form>
        </div>

        <!-- Trust Line -->
        <div class="max-w-[800px] mx-auto mt-16 flex items-center justify-center flex-wrap gap-x-8 gap-y-4 font-body text-[11px] font-bold tracking-[0.15em] text-slate-400 uppercase">
            <span class="flex items-center gap-2.5"><i class="ph-fill ph-lightning text-[#FF6A00] text-base"></i> Fast response</span>
            <span class="hidden md:block text-slate-700">·</span>
            <span class="flex items-center gap-2.5"><i class="ph-bold ph-check text-[#FF6A00] text-base"></i> No lock-in contracts</span>
            <span class="hidden md:block text-slate-700">·</span>
            <span class="flex items-center gap-2.5"><i class="ph-bold ph-currency-dollar text-[#FF6A00] text-base"></i> Transparent pricing</span>
            <span class="hidden md:block text-slate-700">·</span>
            <span class="flex items-center gap-2.5"><i class="ph-fill ph-target text-[#FF6A00] text-base"></i> Results focused</span>
        </div>

    </section>
</main>

<?php get_footer(); ?>
