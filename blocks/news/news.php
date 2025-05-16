<?php
$display = get_field('display');
if ($display == 1) :
    $po = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'ignore_sticky_posts' => 1,
    );
else :
    $cat = get_field('kategoria');
    $po = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'ignore_sticky_posts' => 1,
        'cat' => $cat,
    );
endif;
$query_posts_one = new WP_Query($po);

?>

<!-- =================== News Area =================== -->
<section class="news-area">
    <div class="news-inner">
        <?php while ($query_posts_one->have_posts()) {
            $query_posts_one->the_post();
        ?>
            <?php get_template_part('templates-parts/content/content-cart'); ?>
        <?php }
        wp_reset_postdata(); ?>
    </div><!-- /.news-inner -->
</section><!-- /.news-area -->