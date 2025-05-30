<?php

// Rejestracja endpointu AJAX
add_action('wp_ajax_update_filters', 'update_filters_callback_home');
add_action('wp_ajax_nopriv_update_filters', 'update_filters_callback_home');
function update_filters_callback_home()
{
    $investment = !empty($_POST['investment']) ? sanitize_text_field($_POST['investment']) : '';
    $location   = !empty($_POST['location']) ? sanitize_text_field($_POST['location']) : '';
    $rooms      = !empty($_POST['rooms']) ? (int) $_POST['rooms'] : '';

    $base_args = [
        'post_type'      => 'lokale',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'fields'         => 'ids',
    ];

    // Do budowania pełnej listy inwestycji (ignorujemy investment, uwzględniamy pozostałe)
    $args_investment = $base_args;
    $args_investment['meta_query'] = [];
    if ($location) {
        $args_investment['meta_query'][] = [
            'key'     => 'lokalizacja',
            'value'   => $location,
            'compare' => '='
        ];
    }
    if ($rooms) {
        $args_investment['meta_query'][] = [
            'key'     => 'pokoje',
            'value'   => $rooms,
            'compare' => '='
        ];
    }

    // Do budowania pełnej listy lokalizacji (ignorujemy location, uwzględniamy pozostałe)
    $args_location = $base_args;
    $args_location['meta_query'] = [];
    if ($investment) {
        $args_location['meta_query'][] = [
            'key'     => 'nazwa_inwestycji',
            'value'   => $investment,
            'compare' => '='
        ];
    }
    if ($rooms) {
        $args_location['meta_query'][] = [
            'key'     => 'pokoje',
            'value'   => $rooms,
            'compare' => '='
        ];
    }

    // Do budowania pełnej listy pokoi (ignorujemy rooms, uwzględniamy pozostałe)
    $args_rooms = $base_args;
    $args_rooms['meta_query'] = [];
    if ($investment) {
        $args_rooms['meta_query'][] = [
            'key'     => 'nazwa_inwestycji',
            'value'   => $investment,
            'compare' => '='
        ];
    }
    if ($location) {
        $args_rooms['meta_query'][] = [
            'key'     => 'lokalizacja',
            'value'   => $location,
            'compare' => '='
        ];
    }

    // Do budowania wyników (wszystkie filtry razem)
    $args_results = $base_args;
    $args_results['meta_query'] = [];
    if ($investment) {
        $args_results['meta_query'][] = [
            'key'     => 'nazwa_inwestycji',
            'value'   => $investment,
            'compare' => '='
        ];
    }
    if ($location) {
        $args_results['meta_query'][] = [
            'key'     => 'lokalizacja',
            'value'   => $location,
            'compare' => '='
        ];
    }
    if ($rooms) {
        $args_results['meta_query'][] = [
            'key'     => 'pokoje',
            'value'   => $rooms,
            'compare' => '='
        ];
    }

    $posts_investment = get_posts($args_investment);
    $posts_location   = get_posts($args_location);
    $posts_rooms      = get_posts($args_rooms);
    $posts_results    = get_posts($args_results);

    $inwestycje = [];
    $lokalizacje = [];
    $pokoje = [];

    // Inwestycje → z args_investment
    foreach ($posts_investment as $post_id) {
        $val = get_field('nazwa_inwestycji', $post_id);
        if (!empty($val)) $inwestycje[] = $val;
    }

    // Lokalizacje → z args_location
    foreach ($posts_location as $post_id) {
        $val = get_field('lokalizacja', $post_id);
        if (!empty($val)) $lokalizacje[] = $val;
    }

    // Pokoje → z args_rooms
    foreach ($posts_rooms as $post_id) {
        $val = get_field('pokoje', $post_id);
        if (!empty($val) && is_numeric($val)) $pokoje[] = (int) $val;
    }

    // Usuń duplikaty i sortuj
    $inwestycje = array_unique($inwestycje);
    sort($inwestycje);

    $lokalizacje = array_unique($lokalizacje);
    sort($lokalizacje);

    $pokoje = array_unique($pokoje);
    sort($pokoje, SORT_NUMERIC);

    $response = [
        'inwestycje'  => array_values($inwestycje),
        'lokalizacje' => array_values($lokalizacje),
        'pokoje'      => array_values($pokoje),
    ];

    wp_send_json_success($response);
}


// Rejestracja JS i ajaxurl
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('go-filter-home-js', get_template_directory_uri() . '/blocks/filter-home/filter-home.js', ['jquery'], '1.0', true);
    wp_localize_script('go-filter-home-js', 'ajax_object', ['ajaxurl' => admin_url('admin-ajax.php')]);
});
