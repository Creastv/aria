<?php

// home to Archive page lokale
function filter_lokale_query($query)
{
    // Upewnij się, że jesteśmy na archive page CPT 'lokale' i to główne zapytanie
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('lokale')) {

        // Pobierz parametry GET z formularza
        $investment = isset($_GET['investment']) ? sanitize_text_field($_GET['investment']) : '';
        $location   = isset($_GET['location']) ? sanitize_text_field($_GET['location']) : '';
        $rooms      = isset($_GET['rooms']) ? intval($_GET['rooms']) : '';

        // Przygotuj meta_query, jeśli są parametry
        $meta_query = [];

        if (!empty($investment)) {
            $meta_query[] = [
                'key'     => 'nazwa_inwestycji',
                'value'   => $investment,
                'compare' => '='
            ];
        }

        if (!empty($location)) {
            $meta_query[] = [
                'key'     => 'lokalizacja',
                'value'   => $location,
                'compare' => '='
            ];
        }

        if (!empty($rooms)) {
            $meta_query[] = [
                'key'     => 'pokoje',
                'value'   => $rooms,
                'compare' => '='
            ];
        }

        // Dodaj do query
        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }
    }
}
add_action('pre_get_posts', 'filter_lokale_query');


function ajax_filter_lokale()
{
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $view = isset($_POST['view']) && in_array($_POST['view'], ['grid', 'table']) ? $_POST['view'] : 'grid';

    $args = [
        'post_type'      => 'lokale',
        'posts_per_page' => ($view === 'grid') ? 12 : -1,
        'paged'          => $paged,
        'post_status'    => 'publish',
    ];

    $meta_query = [];

    if (!empty($_POST['investment'])) {
        $meta_query[] = [
            'key'     => 'nazwa_inwestycji',
            'value'   => sanitize_text_field($_POST['investment']),
            'compare' => 'LIKE',
        ];
    }

    if (!empty($_POST['location'])) {
        $meta_query[] = [
            'key'     => 'lokalizacja',
            'value'   => sanitize_text_field($_POST['location']),
            'compare' => '=',
        ];
    }

    if (!empty($_POST['rooms'])) {
        $meta_query[] = [
            'key'     => 'pokoje',
            'value'   => intval($_POST['rooms']),
            'compare' => '=',
        ];
    }

    // UWAGA: tutaj poprawka — nie używamy empty()
    if (isset($_POST['floor']) && $_POST['floor'] !== '') {
        $meta_query[] = [
            'key'     => 'pietro',
            'value'   => intval($_POST['floor']),
            'compare' => '=',
        ];
    }

    if (!empty($_POST['metrage'])) {
        $metrage = explode(';', sanitize_text_field($_POST['metrage']));
        if ($metrage[0] != 0 || $metrage[1] != 316.46) {
            $meta_query[] = [
                'relation' => 'OR',
                [
                    'key'     => 'metraz',
                    'value'   => [$metrage[0], $metrage[1]],
                    'compare' => 'BETWEEN',
                    'type'    => 'DECIMAL(10,2)',
                ],
                [
                    'key'     => 'metraz',
                    'compare' => 'NOT EXISTS',
                ],
                [
                    'key'     => 'metraz',
                    'value'   => '',
                    'compare' => '=',
                ],
            ];
        }
    }

    if (!empty($_POST['status'])) {
        $meta_query[] = [
            'key'     => 'status',
            'value'   => intval($_POST['status']),
            'compare' => '=',
            'type'    => 'NUMERIC',
        ];
    }

    if (!empty($meta_query)) {
        $args['meta_query'] = $meta_query;
    }

    $lokale = new WP_Query($args);

    ob_start();
    echo '<div id="lokale-results" class="grid-container ' . ($view === 'table' ? 'table-view' : 'grid-view') . '">';
    if ($lokale->have_posts()) {

        if ($view === 'table') {
            echo '<table id="dataTable" class="display" style="width:100%">';
            echo '<thead><tr><th>Mieszkanie</th><th>Metraż</th><th>Piętro</th><th>Pokoje</th><th class="hide-mobile">Balkon/Ogródek</th><th>Status</th><th class="hide-mobile">Rzuty</th><th class="hide-mobile">Cena Mieszkania</th><th class="hide-mobile">Promocja</th><th class="hide-mobile">Ulubione</th></tr></thead><tbody>';
            while ($lokale->have_posts()) : $lokale->the_post();
                get_template_part('templates-parts/content/content-local-table');
            endwhile;
            echo '</tbody></table>';
        } else {
            while ($lokale->have_posts()) : $lokale->the_post();
                get_template_part('templates-parts/content/content-local');
            endwhile;
        }
    } else {
        // echo '<header class="entry-header">';
        echo ' <h1 class="text-center">Brak wyników</h1>';
        // echo ' </header>';
    }
    echo '</div>';
    $results_html = ob_get_clean();

    ob_start();
    if ($view === 'grid' && $lokale->max_num_pages > 1) {
        echo '<div class="pagination-grid">';
        echo paginate_links([
            'base'      => '%_%',
            'format'    => '?paged=%#%',
            'current'   => max(1, $paged),
            'total'     => $lokale->max_num_pages,
            'type'      => 'list',
            'prev_text' => ' &laquo; Poprzednia',
            'next_text' => 'Następna &raquo;',
        ]);
        echo '</div>';
    }
    $pagination_html = ob_get_clean();

    wp_reset_postdata();

    wp_send_json([
        'results'    => $results_html,
        'pagination' => $pagination_html,
    ]);
}
add_action('wp_ajax_filter_lokale', 'ajax_filter_lokale');
add_action('wp_ajax_nopriv_filter_lokale', 'ajax_filter_lokale');


function ajax_get_investment_filters()
{
    $investment = isset($_POST['investment']) ? sanitize_text_field($_POST['investment']) : '';

    $args_all = [
        'post_type'      => 'lokale',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => [],
    ];
    if ($investment) {
        $args_all['meta_query'][] = [
            'key'     => 'nazwa_inwestycji',
            'value'   => $investment,
            'compare' => '='
        ];
    }

    $query_all = new WP_Query($args_all);

    $all_pokoje = [];
    $all_pietra = [];
    $all_statusy = [];

    while ($query_all->have_posts()) {
        $query_all->the_post();
        $all_pokoje[] = (int) get_field('pokoje');
        $all_pietra[] = (int) get_field('pietro');
        $all_statusy[] = (int) get_field('status');
    }
    wp_reset_postdata();

    $all_pokoje = array_values(array_unique(array_filter($all_pokoje)));
    // $all_pietra = array_values(array_unique(array_filter($all_pietra)));
    $all_pietra = array_values(array_unique(array_filter($all_pietra, function ($val) {
        return $val === 0 || !empty($val);
    })));
    $all_statusy = array_values(array_unique(array_filter($all_statusy)));

    $args_filtered = $args_all;
    $meta_query = [];

    if (!empty($_POST['rooms'])) {
        $meta_query[] = ['key' => 'pokoje', 'value' => intval($_POST['rooms']), 'compare' => '='];
    }
    if (!empty($_POST['floor'])) {
        $meta_query[] = ['key' => 'pietro', 'value' => intval($_POST['floor']), 'compare' => '='];
    }
    if (!empty($_POST['status'])) {
        $meta_query[] = ['key' => 'status', 'value' => intval($_POST['status']), 'compare' => '='];
    }

    if (!empty($meta_query)) {
        $args_filtered['meta_query'] = $meta_query;
    }

    $query_filtered = new WP_Query($args_filtered);

    $filtered_pokoje = [];
    $filtered_pietra = [];
    $filtered_statusy = [];
    $metraze = [];

    while ($query_filtered->have_posts()) {
        $query_filtered->the_post();
        $filtered_pokoje[] = (int) get_field('pokoje');
        $filtered_pietra[] = (int) get_field('pietro');
        $filtered_statusy[] = (int) get_field('status');
        $metraze[] = (float) get_field('metraz');
    }
    wp_reset_postdata();

    $response = [
        'all_pokoje'  => $all_pokoje,
        'pokoje'      => array_values(array_unique(array_filter($filtered_pokoje))),
        'all_pietra'  => $all_pietra,
        'pietra'      => array_values(array_unique(array_filter($filtered_pietra))),
        'all_statusy' => $all_statusy,
        'statusy'     => array_values(array_unique(array_filter($filtered_statusy))),
        'metraz'      => [
            'min' => !empty($metraze) ? min($metraze) : 0,
            'max' => !empty($metraze) ? max($metraze) : 100,
        ],
    ];

    wp_send_json($response);
}
add_action('wp_ajax_get_investment_filters', 'ajax_get_investment_filters');
add_action('wp_ajax_nopriv_get_investment_filters', 'ajax_get_investment_filters');
