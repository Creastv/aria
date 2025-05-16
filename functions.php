<?php

add_theme_support('post-thumbnails');
add_image_size('post-futured', 450, 300, array('center', 'center'), true);
add_image_size('gallery', 420, 260, array('center', 'center'), true);
add_image_size('gallery-box', 630, 760, array('center', 'center'), true);


require_once get_template_directory() . '/func/enqueue-styles.php';
require_once get_template_directory() . '/func/enqueue-scripts.php';
require get_template_directory() . '/func/cpt.php';
require get_template_directory() . '/func/clean-up.php';
require get_template_directory() . '/blocks/blocks.php';
require get_template_directory() . '/func/nav-walker.php';
require get_template_directory() . '/func/archive-load-more.php';
require get_template_directory() . '/func/import-locals.php';
require get_template_directory() . '/func/wishlist.php';
require get_template_directory() . '/blocks/filter-home/func-filter-home.php';
require get_template_directory() . '/func/archive-filters.php';
require get_template_directory() . '/func/view-switcher.php';



if (!function_exists('go_register_nav_menu')) {
    function go_register_nav_menu()
    {
        register_nav_menus(array(
            'primary_menu' => __('Primary Menu', 'go'),
            'footer' => __('Footer', 'go'),
        ));
    }
    add_action('after_setup_theme', 'go_register_nav_menu', 0);
}


function go_widgets_init()
{
    register_sidebar(array(
        'name'          => __('sidebar', 'go'),
        'id'            => 'sidebar',
        'before_widget' => '<div id="%1$s" class="calaps widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('footer one', 'go'),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="calaps widget %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<div class="calaps__opener"> <h4 class="widget-title">',
        'after_title'   => '</h4></div><div class="calaps__list">',
    ));
    register_sidebar(array(
        'name'          => __('footer two', 'go'),
        'id'            => 'footer-2',
        'before_widget' => '<div id="%1$s" class="calaps widget %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<div class="calaps__opener"> <h4 class="widget-title">',
        'after_title'   => '</h4></div><div class="calaps__list">',
    ));
    register_sidebar(array(
        'name'          => __('footer tree', 'go'),
        'id'            => 'footer-3',
        'before_widget' => '<div id="%1$s" class="calaps widget %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<div class="calaps__opener"> <h4 class="widget-title">',
        'after_title'   => '</h4></div><div class="calaps__list">',
    ));
}
add_action('widgets_init', 'go_widgets_init');


// Paginacja
function pagination_bars()
{
    global $wp_query;

    $total_pages = $wp_query->max_num_pages;
    $big = 999999999; // need an unlikely integer
    if ($total_pages > 1) {
        $current_page = max(1, get_query_var('paged'));
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}

function enable_excerpt_for_pages()
{
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'enable_excerpt_for_pages');

// Excerpt changing 3 dots
function new_excerpt_more($more)
{
    return;
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt($length = 20, $more = '...')
{
    global $post;

    if (has_excerpt($post->ID)) {
        $excerpt = get_the_excerpt();
    } else {
        $content = get_the_content();

        // Wyciągamy tylko zawartość vc_column_text
        preg_match_all('/\[vc_column_text.*?\](.*?)\[\/vc_column_text\]/s', $content, $matches);
        $content = implode(' ', $matches[1]);

        // Czyścimy HTML i redukujemy białe znaki
        $content = wp_strip_all_tags($content);
        $content = preg_replace('/\s+/', ' ', $content);

        // Skracamy
        $words = explode(' ', $content, $length + 1);
        if (count($words) > $length) {
            array_pop($words);
            $excerpt = implode(' ', $words) . $more;
        } else {
            $excerpt = implode(' ', $words);
        }
    }

    return trim($excerpt);
}


function remove_custom_shortcodes($content)
{
    if (empty($content)) {
        return '';
    }

    // Usuń shortcody Divi
    $content = preg_replace('/\[(\/?et_pb_[a-zA-Z0-9_]+)[^\]]*\]/', '', $content);

    // Usuń shortcody VC/WPBakery
    $content = preg_replace('/\[(\/?vc_[a-zA-Z0-9_]+)[^\]]*\]/', '', $content);

    // Usuń shortcode [image_with_animation ...]
    $content = preg_replace('/\[image_with_animation[^\]]*\]/', '', $content);

    // Usuń shortcode [fancy-ul ...] (self-closing)
    $content = preg_replace('/\[fancy-ul[^\]]*\]/', '', $content);

    // Usuń shortcode [fancy-ul]...[/fancy-ul] (razem z zawartością)
    $content = preg_replace('/\[fancy-ul[^\]]*\](.*?)\[\/fancy-ul\]/s', '', $content);
    $content = preg_replace('/\[\/fancy-ul\]/', '', $content);

    // Usuń wszystkie pozostałe shortcody
    $content = strip_shortcodes($content);

    return $content;
}
add_filter('the_content', 'remove_custom_shortcodes', 20);
add_filter('get_the_excerpt', 'remove_custom_shortcodes', 20);

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Ustawienia motywu',
        'menu_title'    => 'Ustawienia motywu',
        'menu_slug'     => 'ustawienia-motywu',
        'capability'    => 'edit_theme_options',
        'redirect'      => false,
        'parent_slug'   => 'themes.php', // <-- to ustawia ją w "Wygląd"
    ));
}



function my_custom_sanitize_title($string)
{
    $polskie = ['ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ż', 'ź', 'Ą', 'Ć', 'Ę', 'Ł', 'Ń', 'Ó', 'Ś', 'Ż', 'Ź'];
    $zamienniki = ['a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z', 'a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z'];
    $string = str_replace($polskie, $zamienniki, $string);
    $string = mb_strtolower($string, 'UTF-8');
    $string = str_replace(' ', '', $string);
    $string = preg_replace('/[^a-z0-9]/', '', $string);
    return $string;
}





// Projekt ID
function get_project_id_by_investment($local_id = null)
{
    if (! $local_id) {
        $local_id = get_the_ID(); // Domyślnie bierze aktualny post
    }

    // 1. Pobierz nazwę inwestycji z meta
    // $investment_title = get_post_meta($local_id, 'inwestycja', true);
    $investment_title = get_field('nazwa_inwestycji', $local_id);

    if ($investment_title) {
        // 2. Znajdź term w taxonomy 'crm_inwestycje'
        $term = get_term_by('name', $investment_title, 'crm_inwestycje');

        if ($term && !is_wp_error($term)) {
            // 3. Znajdź projekt powiązany z tym termem
            $projects = get_posts([
                'post_type' => 'projekty',
                'tax_query' => [
                    [
                        'taxonomy' => 'crm_inwestycje',
                        'field'    => 'term_id',
                        'terms'    => $term->term_id,
                    ]
                ],
                'posts_per_page' => 1, // Zakładam, że jeden projekt
                'fields' => 'ids' // Zwraca tylko ID
            ]);

            if (! empty($projects)) {
                return $projects[0]; // Zwracamy ID projektu
            }
        }
    }

    return null; // Jeśli nie znajdzie projektu
}



function render_editable_post_meta_box($post)
{
    $meta = get_post_meta($post->ID);
    wp_nonce_field('save_editable_post_meta', 'editable_post_meta_nonce');

    if (!empty($meta)) {
        echo '<table class="widefat striped">';
        echo '<thead><tr><th>Klucz</th><th>Wartość</th></tr></thead><tbody>';
        foreach ($meta as $key => $values) {
            // Pomijamy pola wewnętrzne WordPressa zaczynające się od "_"
            if (strpos($key, '_') === 0) {
                continue;
            }
            foreach ($values as $i => $value) {
                $input_name = esc_attr("editable_meta[{$key}][]");
                echo '<tr>';
                echo '<td><code>' . esc_html($key) . '</code></td>';
                echo '<td><input type="text" name="' . $input_name . '" value="' . esc_attr($value) . '" class="regular-text"></td>';
                echo '</tr>';
            }
        }
        echo '</tbody></table>';
    } else {
        echo '<p>Brak meta danych do edycji.</p>';
    }
}
