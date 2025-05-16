<?php
add_action('wp_ajax_change_view_local', 'ajax_change_view_local');
add_action('wp_ajax_nopriv_change_view', 'ajax_change_view_local');

function ajax_change_view_local()
{
    $view = $_POST['view'] ?? 'grid';

    $args = array(
        'post_type' => 'lokale',
        'posts_per_page' => -1,
    );

    $lokale = new WP_Query($args);

    ob_start();
    if ($lokale->have_posts()) :
        while ($lokale->have_posts()) : $lokale->the_post();
            if ($view === 'table') {
                get_template_part('templates-parts/content/content-local-table');
            } else {
                get_template_part('templates-parts/content/content-local');
            }
        endwhile;
    else :
        echo '<p>Brak wyników.</p>';
    endif;

    wp_reset_postdata();

    $output = ob_get_clean();
    wp_send_json_success($output);
}

function enqueue_view_switcher_scripts()
{
    wp_enqueue_script('view-switcher', get_template_directory_uri() . '/assets/js/view-switcher.js', array('jquery'), null, true);
    wp_localize_script('view-switcher', 'my_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_view_switcher_scripts');
