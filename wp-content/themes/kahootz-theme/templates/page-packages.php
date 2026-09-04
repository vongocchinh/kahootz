<?php
/**
 * Template Name: Packages Page
 */
get_header();

// Packages Data Mapping
$packages = [
    'social-media' => [
        'title' => 'Social Media',
        'icon'  => 'ph-chart-line-up',
        'color' => 'text-[#FF6A00]',
        'bg'    => 'bg-[#FF6A00]/10',
        'border'=> 'border-[#FF6A00]/20',
        'glow'  => 'from-[#FF6A00]/5',
        'tiers' => [
            ['name' => 'Starter', 'price_thb' => '฿15,000', 'price_usd' => '$450/mo'],
            ['name' => 'Growth', 'price_thb' => '฿25,000', 'price_usd' => '$750/mo', 'highlight' => true],
            ['name' => 'Pro', 'price_thb' => '฿40,000', 'price_usd' => '$1,200/mo'],
        ],
        'features' => [
            ['name' => 'Strategy', 'values' => [true, true, true]],
            ['name' => 'Content & design', 'values' => [true, true, true]],
            ['name' => 'Scheduling', 'values' => [true, true, true]],
            ['name' => 'Monthly management', 'values' => [true, true, true]],
            ['name' => 'Reporting', 'values' => [true, true, true]],
            ['name' => 'Increased posting frequency', 'values' => [false, true, true]],
            ['name' => 'Paid social boosting strategy', 'values' => [false, true, true]],
            ['name' => 'Full video content production', 'values' => [false, false, true]],
        ]
    ],
    'seo-ai-search' => [
        'title' => 'SEO + AI Search',
        'icon'  => 'ph-magnifying-glass',
        'color' => 'text-[#38BDF8]',
        'bg'    => 'bg-[#38BDF8]/10',
        'border'=> 'border-[#38BDF8]/20',
        'glow'  => 'from-[#38BDF8]/5',
        'tiers' => [
            ['name' => 'Starter', 'price_thb' => '฿20,000', 'price_usd' => '$600/mo'],
            ['name' => 'Growth', 'price_thb' => '฿35,000', 'price_usd' => '$1,050/mo', 'highlight' => true],
            ['name' => 'Pro', 'price_thb' => '฿55,000', 'price_usd' => '$1,650/mo'],
        ],
        'features' => [
            ['name' => 'Technical SEO', 'values' => [true, true, true]],
            ['name' => 'Keyword strategy', 'values' => [true, true, true]],
            ['name' => 'Content optimisation', 'values' => [true, true, true]],
            ['name' => 'AI search optimisation', 'values' => [true, true, true]],
            ['name' => 'Reporting', 'values' => [true, true, true]],
            ['name' => 'Expanded keyword targeting', 'values' => [false, true, true]],
            ['name' => 'Content creation included', 'values' => [false, true, true]],
            ['name' => 'Multi-location / advanced strategy', 'values' => [false, false, true]],
        ]
    ],
    'paid-ads' => [
        'title' => 'Paid Advertising',
        'icon'  => 'ph-currency-circle-dollar',
        'color' => 'text-[#FF6A00]',
        'bg'    => 'bg-[#FF6A00]/10',
        'border'=> 'border-[#FF6A00]/20',
        'glow'  => 'from-[#FF6A00]/5',
        'note'  => 'Management fee — ad spend billed separately to Google/Meta.',
        'tiers' => [
            ['name' => 'Starter', 'price_thb' => '฿15,000', 'price_usd' => '$450/mo'],
            ['name' => 'Growth', 'price_thb' => '฿25,000', 'price_usd' => '$750/mo', 'highlight' => true],
            ['name' => 'Pro', 'price_thb' => '฿40,000', 'price_usd' => '$1,200/mo'],
        ],
        'features' => [
            ['name' => 'Google Ads / Meta Ads', 'values' => [true, true, true]],
            ['name' => 'Campaign management', 'values' => [true, true, true]],
            ['name' => 'Optimisation', 'values' => [true, true, true]],
            ['name' => 'Tracking & reporting', 'values' => [true, true, true]],
            ['name' => 'Recommended ad spend', 'values' => ['Up to ฿50k/mo', '฿50k–150k/mo', '฿150k+/mo']],
            ['name' => 'Multi-platform campaigns', 'values' => [false, true, true]],
        ]
    ],
    'growth-partner' => [
        'title' => 'Growth Partner — Full Service',
        'icon'  => 'ph-rocket-launch',
        'color' => 'text-[#EF4444]',
        'bg'    => 'bg-[#EF4444]/10',
        'border'=> 'border-[#EF4444]/20',
        'glow'  => 'from-[#EF4444]/5',
        'note'  => 'Best for businesses ready to hand off marketing entirely and focus on running the business.',
        'tiers' => [
            ['name' => 'Growth Partner', 'price_thb' => '฿50,000', 'price_usd' => '$1,550/mo'],
            ['name' => 'Growth Partner Plus', 'price_thb' => '฿85,000', 'price_usd' => '$2,550/mo', 'highlight' => true],
        ],
        'features' => [
            ['name' => 'Social media', 'values' => [true, true]],
            ['name' => 'SEO + AI search', 'values' => [true, true]],
            ['name' => 'Paid advertising', 'values' => [true, true]],
            ['name' => 'Content & creative', 'values' => [true, true]],
            ['name' => 'AI-powered strategy & automation', 'values' => [true, true]],
            ['name' => 'Dedicated account lead', 'values' => [true, true]],
            ['name' => 'Monthly strategy calls', 'values' => [true, true]],
            ['name' => 'Full transparent reporting', 'values' => [true, true]],
            ['name' => 'Higher output & content volume', 'values' => [false, true]],
            ['name' => 'Multi-market / multi-brand support', 'values' => [false, true]],
        ]
    ],
    'website-design' => [
        'title' => 'Website Design',
        'icon'  => 'ph-browser',
        'color' => 'text-[#F59E0B]', // Amber
        'bg'    => 'bg-[#F59E0B]/10',
        'border'=> 'border-[#F59E0B]/20',
        'glow'  => 'from-[#F59E0B]/5',
        'tiers' => [
            ['name' => 'Essential', 'price_thb' => 'From ฿45k', 'price_usd' => '$1,350'],
            ['name' => 'Business', 'price_thb' => 'From ฿85k', 'price_usd' => '$2,550', 'highlight' => true],
            ['name' => 'Custom / E-com', 'price_thb' => 'From ฿150k', 'price_usd' => '$4,500'],
        ],
        'features' => [
            ['name' => 'Pages', 'values' => ['Up to 5', 'Up to 10', 'Custom']],
            ['name' => 'Mobile-first design', 'values' => [true, true, true]],
            ['name' => 'SEO foundations', 'values' => [true, true, true]],
            ['name' => 'Blog / Insights section', 'values' => [false, true, true]],
            ['name' => 'E-commerce / custom functionality', 'values' => [false, false, true]],
        ]
    ]
];
?>

<main class="bg-[#040814] pb-24">

    <!-- HERO -->
    <section class="relative pt-36 pb-20  max-md:pt-16 max-md:pb-10overflow-hidden border-b border-white/5">
        <div class="hidden top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#FF6A00]/50 to-transparent"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 max-md:hidden  w-[900px] h-[500px] bg-[#FF6A00]/5 rounded-full blur-[160px] pointer-events-none"></div>

        <div class="container-layout px-4 sm:px-6 lg:px-8 relative z-10 text-center max-w-4xl mx-auto">
            <h1 class="font-display font-black text-5xl md:text-6xl lg:text-7xl text-white leading-[0.9] tracking-tight mb-8">
                Straightforward services.<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6A00] to-[#FF8C00]">Straightforward pricing.</span>
            </h1>
            <p class="font-body text-xl md:text-2xl text-slate-400 leading-relaxed">
                Fixed-price packages for simple needs. A full Growth Partner plan if you want it all handled. No hidden fees, no surprise invoices.
            </p>
        </div>
    </section>

    <!-- PACKAGES MATRICES -->
    <section class="container-layout px-4 sm:px-6 lg:px-8 py-20 space-y-32">
        <?php foreach ( $packages as $key => $pkg ) : 
            $cols = count( $pkg['tiers'] );
        ?>
        <div class="relative">
            <!-- Glow background -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 max-md:hidden  w-[600px] h-[400px] bg-gradient-to-b <?php echo $pkg['glow']; ?> to-transparent rounded-full blur-[100px] pointer-events-none"></div>

            <div class="relative z-10">
                <!-- Section Header -->
                <div class="flex flex-col items-center justify-center text-center mb-12">
                    <div class="w-16 h-16 rounded-2xl <?php echo $pkg['bg']; ?> <?php echo $pkg['border']; ?> border flex items-center justify-center mb-6">
                        <i class="ph-bold <?php echo $pkg['icon']; ?> <?php echo $pkg['color']; ?> text-3xl"></i>
                    </div>
                    <h2 class="font-display font-black text-3xl text-white tracking-tight mb-3 uppercase">
                        <?php echo $pkg['title']; ?>
                    </h2>
                    <?php if ( ! empty( $pkg['note'] ) ) : ?>
                    <p class="font-body text-sm text-slate-400 italic">
                        <?php echo $pkg['note']; ?>
                    </p>
                    <?php endif; ?>
                </div>

                <!-- Matrix Table (Desktop layout) -->
                <div class="hidden lg:block overflow-hidden border border-white/10 rounded-3xl bg-[#0A101F] shadow-2xl">
                    <table class="w-full text-left border-collapse">
                        <!-- Table Header: Tiers -->
                        <thead>
                            <tr>
                                <th class="w-1/3 p-8 border-b border-white/5 border-r border-white/5"></th>
                                <?php foreach ( $pkg['tiers'] as $tier ) : ?>
                                <th class="p-8 border-b border-white/5 <?php echo isset( $tier['highlight'] ) ? 'bg-white/[0.02] relative' : ''; ?>">
                                    <?php if ( isset( $tier['highlight'] ) ) : ?>
                                    <div class="absolute top-0 left-0 right-0 h-1 bg-[#FF6A00]"></div>
                                    <?php endif; ?>
                                    <h3 class="font-body font-bold text-sm uppercase tracking-widest text-white/50 mb-3"><?php echo $tier['name']; ?></h3>
                                    <div class="font-display font-black text-2xl text-white leading-none mb-1"><?php echo $tier['price_thb']; ?></div>
                                    <div class="font-body text-xs text-white/40"><?php echo $tier['price_usd']; ?></div>
                                </th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <!-- Table Body: Features -->
                        <tbody class="font-body text-sm">
                            <?php foreach ( $pkg['features'] as $feature ) : ?>
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="p-5 pl-8 border-b border-white/5 border-r border-white/5 font-semibold text-white/80">
                                    <?php echo $feature['name']; ?>
                                </td>
                                <?php foreach ( $feature['values'] as $i => $val ) : 
                                    $highlight = isset( $pkg['tiers'][$i]['highlight'] );
                                ?>
                                <td class="p-5 border-b border-white/5 text-center <?php echo $highlight ? 'bg-white/[0.02]' : ''; ?>">
                                    <?php if ( $val === true ) : ?>
                                        <i class="ph-bold ph-check text-[#FF6A00] text-lg"></i>
                                    <?php elseif ( $val === false ) : ?>
                                        <i class="ph-bold ph-minus text-white/20 text-lg"></i>
                                    <?php else : ?>
                                        <span class="text-white font-semibold"><?php echo $val; ?></span>
                                    <?php endif; ?>
                                </td>
                                <?php endforeach; ?>
                            </tr>
                            <?php endforeach; ?>
                            <!-- Action Row -->
                            <tr>
                                <td class="p-8 border-r border-white/5"></td>
                                <?php foreach ( $pkg['tiers'] as $i => $tier ) : 
                                    $highlight = isset( $tier['highlight'] );
                                ?>
                                <td class="p-8 text-center <?php echo $highlight ? 'bg-white/[0.02]' : ''; ?>">
                                    <a href="<?php echo esc_url( home_url('/contact') ); ?>" class="inline-flex items-center justify-center gap-2 <?php echo $highlight ? 'bg-[#FF6A00] hover:bg-[#FF5500] text-white' : 'border border-white/10 hover:border-[#FF6A00]/40 text-white/60 hover:text-white'; ?> font-body font-bold text-[10px] uppercase tracking-widest px-6 py-3 rounded-full transition-all duration-300">
                                        Select <i class="ph-bold ph-arrow-right"></i>
                                    </a>
                                </td>
                                <?php endforeach; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Matrix Cards (Mobile layout) -->
                <div class="lg:hidden grid gap-8">
                    <?php foreach ( $pkg['tiers'] as $i => $tier ) : 
                        $highlight = isset( $tier['highlight'] );
                    ?>
                    <div class="rounded-2xl border <?php echo $highlight ? 'border-[#FF6A00]/50 bg-gradient-to-b from-[#FF6A00]/10 to-[#0A101F]' : 'border-white/10 bg-[#0A101F]'; ?> p-6">
                        <h3 class="font-body font-bold text-xs uppercase tracking-widest text-white/50 mb-3"><?php echo $tier['name']; ?></h3>
                        <div class="font-display font-black text-3xl text-white leading-none mb-1"><?php echo $tier['price_thb']; ?></div>
                        <div class="font-body text-xs text-white/40 mb-8"><?php echo $tier['price_usd']; ?></div>
                        
                        <ul class="space-y-4 mb-8">
                            <?php foreach ( $pkg['features'] as $feature ) : 
                                $val = $feature['values'][$i];
                                if ( $val === false ) continue;
                            ?>
                            <li class="flex items-start gap-3 font-body text-sm text-slate-300">
                                <?php if ( $val === true ) : ?>
                                    <i class="ph-bold ph-check text-[#FF6A00] text-base mt-0.5"></i>
                                    <span><?php echo $feature['name']; ?></span>
                                <?php else : ?>
                                    <i class="ph-bold ph-check text-[#FF6A00] text-base mt-0.5"></i>
                                    <span><strong><?php echo $feature['name']; ?>:</strong> <?php echo $val; ?></span>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <a href="<?php echo esc_url( home_url('/contact') ); ?>" class="flex items-center justify-center gap-2 <?php echo $highlight ? 'bg-[#FF6A00] text-white' : 'border border-white/20 text-white'; ?> font-body font-bold text-xs uppercase tracking-widest px-6 py-4 rounded-full">
                            Select Package
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
        <?php endforeach; ?>
    </section>

    <!-- ═══════════════════════════════
         BOTTOM CTA
    ════════════════════════════════ -->
    <section class="border-t border-white/5 py-24 md:py-32 relative overflow-hidden">
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[700px] h-[300px] bg-[#FF6A00]/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="container-layout px-4 sm:px-6 lg:px-8 relative text-center max-w-3xl mx-auto">
            <p class="font-body text-[11px] font-bold uppercase tracking-[0.25em] text-[#FF6A00] mb-6">Need something bespoke?</p>
            <h2 class="font-display font-black text-4xl md:text-5xl text-white tracking-tight leading-[1.1] mb-8">
                For complex projects, multiple markets, or larger growth plans.
            </h2>
            <p class="font-body text-xl text-slate-400 mb-10">
                We build a custom proposal around exactly what you need.
            </p>
            <a href="<?php echo esc_url( home_url('/contact') ); ?>"
               class="inline-flex items-center gap-3 bg-white text-black hover:bg-slate-200 font-body font-bold text-[12px] uppercase tracking-[0.2em] px-10 py-5 rounded-full transition-all duration-300 hover:scale-105">
                Get a Proposal <i class="ph-bold ph-arrow-right text-sm"></i>
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
