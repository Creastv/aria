<?php
$IdInv = get_field('projekt');
$timeline = get_field('time_line', $IdInv);
$title = get_field('tytul');
$link = get_field('link');
if ($link):
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif;

if ($IdInv):
    $total = count($timeline);
    $activeCount = 0;
    $lastActiveTitle = '';


    foreach ($timeline as $item) {
        if (!empty($item['aktywne'])) {
            $activeCount++;
            $lastActiveTitle = $item['tytul'];
        }
    }

    $percentActive = $total > 0 ? ($activeCount / $total) * 100 : 0;
endif;
?>

<?php if (!empty($IdInv)) : ?>
    <!-- =================== Timeline Area =================== -->
    <div class="timeline-area">
        <div class="header">
            <div class="title-container">
                <?php if ($title) : ?>
                    <h3><?php echo $title; ?></h3>
                <?php else: ?>
                    <h3>Kronika budowy</h3>
                <?php endif; ?>
                <p class="subtitle">Postępy prac wybranego etapu:</p>
            </div>
            <?php if ($link):  ?>
                <a class="bttn-outline-orange" href="<?php echo esc_url($link_url); ?>"
                    target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
            <?php endif; ?>
        </div>
        <div class="timeline-wrp">
            <div class="timeline">
                <div class="timeline-line"></div>
                <div class="timeline-progress"></div>
                <div class="timeline-items">
                    <?php foreach ($timeline as $item) :
                        $class = $item['aktywne'] ? 'active' : '';

                    ?>
                        <div class="timeline-item <?php echo $class; ?>">
                            <div class="timeline-dot"></div>
                            <div class="timeline-title"><?php echo $item['tytul']; ?></div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
    <!-- /.timeline-area -->

<?php endif; ?>

<script>
    (function($) {
        $(document).ready(function() {
            updateProgress();

            $(window).resize(function() {
                updateProgress();
            });

            function updateProgress() {
                var allItems = $(".timeline-item");
                var activeItems = $(".timeline-item.active");
                var totalItems = allItems.length;
                var activeItemsCount = activeItems.length;

                var lastActiveTitle = "brak danych";
                if (activeItemsCount > 0) {
                    lastActiveTitle = activeItems.last().find(".timeline-title").text().trim();
                }

                var progressPercentage = totalItems > 0 ? (activeItemsCount / totalItems) * 100 : 0;

                if ($(window).width() <= 991) {
                    $(".timeline-progress").animate({
                        height: progressPercentage + "%",
                        width: "5px",
                    }, 300);
                } else {
                    $(".timeline-progress").animate({
                        width: progressPercentage + "%",
                        height: "5px",
                    }, 300);
                }

                var subtitle =
                    "Postępy prac wybranego etapu: <b>" + lastActiveTitle + "</b> (" +
                    activeItemsCount +
                    " z " +
                    totalItems +
                    ")";
                $(".subtitle").html(subtitle);
            }
        });
    })(jQuery);
</script>