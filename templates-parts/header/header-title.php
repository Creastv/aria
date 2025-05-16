<?php
$display = get_field('wylacz_naglowek');
$bgClass = "header-item-1";
if (has_post_thumbnail()) {
    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $bgImage = 'style="background-image:url( ' . $image_url . ' ); "';
    $bgClass = "";
}
$current_page = get_post();
?>
<?php if (!$display && !is_home() && !is_archive() && !is_search() && (!is_archive() || is_post_type_archive('lokale')) && !is_singular('lokale') && !is_singular('projekty')) : ?>
    <!-- Hero Section with Slider -->
    <section class="hero-section">
        <div class="header-item go-parallex <?php echo $bgClass; ?>" <?php echo $bgImage; ?>>
            <div class="hero-overlay"></div>
            <div class="container hero-content-flat go-parallex-con">
                <?php if (is_single()) : ?>
                    <span class="news-text__label"><?php echo get_the_date('F Y') . 'r.'; ?></span>
                <?php endif; ?>
                <h1><?php the_title(); ?></h1>
                <?php
                $post_excerpt = get_post_field('post_excerpt', get_the_ID());
                if (! empty($post_excerpt)) {
                    echo "<p>";
                    echo esc_html($post_excerpt);
                    echo "</p>";
                }
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if (is_singular('post') || is_singular('lokale') || $current_page->post_parent): ?>
    <div class="container">
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
    </div>
<?php endif; ?>