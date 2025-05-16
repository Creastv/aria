<?php if (is_singular('post')): ?>
    <?php
    $category_object = get_the_category(get_the_ID());
    $category_name = $category_object[0]->name;
    $active = get_the_ID();

    $articles = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'order' => 'DESC',
        'category_name' => $category_name,
        'orderby'        => 'rand',
        'post__not_in' => array($active),

    ));
    ?>
    <div class="b-bg b-bg--recomended">
        <div class="b-bg-apla" style="background-color:rgb(251,251,251); height:100%; top:0; "></div>
        <div class="container">
            <h3>Poznaj kolejne artykuły</h3>
            <br>
            <div class="recommended-posts">
                <div class="recommended-posts__wrap">
                    <?php while ($articles->have_posts()) : $articles->the_post(); ?>
                        <?php get_template_part('templates-parts/content/content-cart');  ?>
                    <?php endwhile;
                    wp_reset_query(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>