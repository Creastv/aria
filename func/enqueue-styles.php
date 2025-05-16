<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// gutenberg editor
function add_block_editor_assets()
{
    wp_enqueue_style('block_editor_css', get_template_directory_uri() . '/assets/css/admin.css');
}
add_action('enqueue_block_editor_assets', 'add_block_editor_assets', 10, 0);


function enqueue_styles()
{

    $theme_uri = get_template_directory_uri();

    wp_enqueue_style('go-style', $theme_uri  . '/style.css');
    wp_enqueue_style('bootstrap', $theme_uri  . '/assets/css/plugins/bootstrap.min.css');
    wp_enqueue_style('ion-range-slider', $theme_uri  . '/assets/css/plugins/ion.rangeSlider.min.css');
    wp_enqueue_style('select2', $theme_uri  . '/assets/css/plugins/select2.min.css');
    wp_enqueue_style('slick', $theme_uri  . '/assets/css/plugins/slick.min.css');
    wp_enqueue_style('slick-theme', $theme_uri  . '/assets/css/plugins/slick-theme.min.css');
    wp_enqueue_style('leaflet', $theme_uri  . '/assets/css/plugins/leaflet.css');
    wp_enqueue_style('fancybox', $theme_uri  . '/assets/css/plugins/fancybox.css');
    wp_enqueue_style('data-table', 'https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css');


    // Custom styles
    wp_enqueue_style('style', $theme_uri  . '/assets/css/style.css');
    wp_enqueue_style('header', $theme_uri  . '/assets/css/header.css');
    wp_enqueue_style('pzfd', $theme_uri  . '/assets/css/pzfd.css');
    wp_enqueue_style('title', $theme_uri  . '/assets/css/title.css');
    wp_enqueue_style('table', $theme_uri  . '/assets/css/table.css');
    wp_enqueue_style('filter', $theme_uri  . '/assets/css/filters.css');
    wp_enqueue_style('single-local', $theme_uri  . '/assets/css/single-local.css');
    wp_enqueue_style('news', $theme_uri  . '/assets/css/news.css');
    wp_enqueue_style('contact', $theme_uri  . '/assets/css/contact.css');
    wp_enqueue_style('footer', $theme_uri  . '/assets/css/footer.css');
    wp_enqueue_style('projekty', $theme_uri  . '/assets/css/projekty.css');
    wp_enqueue_style('expert', $theme_uri  . '/assets/css/expert.css');
    wp_enqueue_style('post', $theme_uri  . '/assets/css/post.css');
    wp_enqueue_style('search', $theme_uri  . '/assets/css/search.css');

    if (is_singular('lokale')):
        wp_enqueue_style('gallery', $theme_uri  . '/assets/css/gallery.css');
    endif;
    if (is_singular('projekty')) {
        wp_enqueue_style('slick', get_template_directory_uri() .  '/assets/css/plugins/slick.min.css');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_styles');
