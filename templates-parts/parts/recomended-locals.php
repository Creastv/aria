<?php if (is_singular('lokale')): ?>
    <?php
    $category_object = get_the_category(get_the_ID());
    $active = get_the_ID();
    $current_id = get_the_ID();
    $current_investment = get_field('nazwa_inwestycji', $current_id);
    $args = [
        'post_type'      => 'lokale',
        'posts_per_page' => 4, // zmień ile chcesz
        'post__not_in'   => [$current_id], // wyklucz bieżący lokal
        'orderby'        => 'rand',
        'meta_query'     => [
            'relation' => 'AND',
            // [
            //     'key'     => 'status',
            //     'value'   => 1, // interesuje nas tylko status = 1
            //     'compare' => '='
            // ],
            [
                'key'     => 'nazwa_inwestycji',
                'value'   => $current_investment,
                'compare' => '='
            ]
        ]
    ];
    $articles = new WP_Query($args);
    ?>

    <div class="b-bg-apla" style="background-color:rgb(251,251,251); height:100%; top:0; "></div>
    <h3>Podobne mieszkania</h3>
    <br>
    <div class="recommended-locals">
        <div class="recommended-locals__wrap">
            <?php while ($articles->have_posts()) : $articles->the_post(); ?>
                <?php get_template_part('templates-parts/content/content-local');  ?>
            <?php endwhile;
            wp_reset_query(); ?>
        </div>
    </div>
<?php endif; ?>