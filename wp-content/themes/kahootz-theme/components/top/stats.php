<?php
$top_page = get_page_by_path('top');
$page_id = $top_page ? $top_page->ID : get_queried_object_id();

$years = function_exists('get_field') && get_field('years_experience', $page_id) ? get_field('years_experience', $page_id) : get_post_meta($page_id, 'years_experience', true);
$businesses = function_exists('get_field') && get_field('businesses_helped', $page_id) ? get_field('businesses_helped', $page_id) : get_post_meta($page_id, 'businesses_helped', true);
$team = function_exists('get_field') && get_field('team_members', $page_id) ? get_field('team_members', $page_id) : get_post_meta($page_id, 'team_members', true);
$countries = function_exists('get_field') && get_field('countries', $page_id) ? get_field('countries', $page_id) : get_post_meta($page_id, 'countries', true);

$years = $years ?: '9+';
$businesses = $businesses ?: '200+';
$team = $team ?: '30+';
$countries = $countries ?: '2';

$stats = [
    [
        'icon' => 'eye-ai.png',
        'alt' => 'eye-ai',
        'icon_class' => 'w-16 h-12',
        'title' => $years,
        'subtitle' => 'YEARS EXPERIENCE',
        'extra_classes' => 'border-r border-foreground/10 max-md:flex-col'
    ],
    [
        'icon' => 'target-ai.png',
        'alt' => 'target-ai',
        'icon_class' => 'w-16 h-12',
        'title' => $businesses,
        'subtitle' => 'BUSINESSES HELPED',
        'extra_classes' => 'border-r border-foreground/10 max-md:flex-col'
    ],
    [
        'icon' => 'team-ai.png',
        'alt' => 'team-ai',
        'icon_class' => 'w-16 h-12',
        'title' => $team,
        'subtitle' => 'TEAM MEMBERS',
        'extra_classes' => 'border-r border-foreground/10 max-md:flex-col'
    ],
    [
        'icon' => 'countries-ai.png',
        'alt' => 'countries-ai',
        'icon_class' => 'w-16 h-12',
        'title' => $countries,
        'subtitle' => 'COUNTRIES',
        'extra_classes' => 'max-md:flex-col'
    ]
];
?>
<section class="bg-page-section mt-10 max-md:mt-5" id="stats">
  <div class="container-layout py-6 border-foreground/10 border rounded-md max-md:py-2.5">
    <div class="" bis_skin_checked="1">
      <div class="flex flex-row w-full items-center justify-between gap-3 lg:gap-0 max-md:flex-col" bis_skin_checked="1">
        <div class="grid grid-cols-4">
          <?php foreach ($stats as $stat) : ?>
            <div class="flex items-center gap-4 px-4 py-2 <?php echo $stat['extra_classes']; ?>" bis_skin_checked="1">
              <div class="flex-shrink-0 flex justify-center items-center" bis_skin_checked="1">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icon/<?php echo $stat['icon']; ?>" alt="<?php echo $stat['alt']; ?>" class="<?php echo $stat['icon_class']; ?>" />
              </div>
              <div bis_skin_checked="1">
                <div class="text-[28px] font-bold font-display text-foreground leading-tight max-md:text-center max-md:text-[20px] stat-number" data-text="<?php echo esc_attr($stat['title']); ?>" bis_skin_checked="1">
                  0
                </div>
                <div class="text-[10px] font-semibold tracking-widest text-muted uppercase mt-0.5 max-md:text-center" bis_skin_checked="1">
                  <?php echo $stat['subtitle']; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="relative flex items-center justify-end overflow-hidden mr-4 max-md:m-0" bis_skin_checked="1">
          <div class="relative z-20 text-left max-md:text-center max-md:flex max-md:flex-row max-md:gap-1" bis_skin_checked="1">
            <div class="text-[11px] text-left font-semibold text-foreground tracking-wide leading-snug" bis_skin_checked="1">
              UK EXPERTISE.
            </div>
            <div class="text-[11px] text-left font-semibold text-foreground tracking-wide leading-snug" bis_skin_checked="1">
              THAILAND DELIVERY.
            </div>
            <div class="text-[11px] text-left font-bold text-primary tracking-wide leading-snug" bis_skin_checked="1">
              WORLDWIDE RESULTS.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const statNumbers = document.querySelectorAll('.stat-number');
    let hasAnimated = false;

    const animateNumbers = () => {
        statNumbers.forEach(el => {
            const text = el.getAttribute('data-text');
            // Tìm phần số trong chuỗi (ví dụ: "200+" -> "200")
            const numMatch = text.match(/([\d\.]+)/);
            
            if (!numMatch) {
                el.innerText = text;
                return;
            }
            
            const endNum = parseFloat(numMatch[1]);
            const prefix = text.substring(0, numMatch.index);
            const suffix = text.substring(numMatch.index + numMatch[1].length);
            
            const duration = 2000; // Thời gian chạy animation (2 giây)
            const startTime = performance.now();
            
            const updateCounter = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                // Hiệu ứng Ease out quad (chậm dần về cuối)
                const easeOut = progress * (2 - progress);
                const currentNum = Math.floor(easeOut * endNum);
                
                el.innerText = prefix + currentNum + suffix;
                
                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                } else {
                    el.innerText = text; // Set lại giá trị chuẩn ở khung hình cuối
                }
            };
            
            requestAnimationFrame(updateCounter);
        });
    };

    // Theo dõi khi cuộn chuột đến vùng hiển thị stats
    const statsSection = document.getElementById('stats');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting && !hasAnimated) {
                hasAnimated = true;
                animateNumbers();
                observer.disconnect(); // Ngừng theo dõi sau khi đã chạy
            }
        }, { threshold: 0.3 }); // Chạy khi cuộn đến 30% khối stats
        
        observer.observe(statsSection);
    }
});
</script>