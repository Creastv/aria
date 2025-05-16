<?php
function register_acf_block_types()
{
  acf_register_block_type(array(
    'name'              => 'title',
    'title'             => __('Title'),
    'render_template'   => 'blocks/title/title.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('Title'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      // wp_enqueue_style('go-title',  get_template_directory_uri() . '/blocks/title/title.min.css');
    },
  ));
  acf_register_block_type(array(
    'name'              => 'faq',
    'title'             => __('faq'),
    'render_template'   => 'blocks/faq/faq.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('faq'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-faq',  get_template_directory_uri() . '/blocks/faq/faq.min.css');
    },
  ));
  acf_register_block_type(array(
    'name'              => 'news',
    'title'             => __('news'),
    'render_template'   => 'blocks/news/news.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('news'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-news',  get_template_directory_uri() . '/blocks/news/news.min.css');
    },
  ));
  acf_register_block_type(array(
    'name'              => 'bullets',
    'title'             => __('bullets'),
    'render_template'   => 'blocks/bullets/bullets.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('bullets'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-bullets',  get_template_directory_uri() . '/blocks/bullets/bullets.min.css');
    },
  ));
  acf_register_block_type(array(
    'name'              => 'bg',
    'title'             => __('Tło - kontener'),
    'render_template'   => 'blocks/bg/bg.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('Kontener', 'bg'),
    'supports'    => [
      'align'      => false,
      'anchor'    => true,
      'customClassName'  => true,
      'jsx'       => true,
    ],
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-bg',  get_template_directory_uri() . '/blocks/bg/bg.min.css');
    }
  ));
  acf_register_block_type(array(
    'name'              => 'person',
    'title'             => __('Person contact'),
    'render_template'   => 'blocks/person/person.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('person'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-person',  get_template_directory_uri() . '/blocks/person/person.min.css');
    },
  ));
  acf_register_block_type(array(
    'name'              => 'investment',
    'title'             => __('Inwestycja'),
    'render_template'   => 'blocks/investment/investment.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('investment'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-investment',  get_template_directory_uri() . '/blocks/investment/investment.min.css');
    },
  ));
  acf_register_block_type(array(
    'name'              => 'filter-home',
    'title'             => __('Formularz filtrujący - Str. główna'),
    'render_template'   => 'blocks/filter-home/filter-home.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('filter-home'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-filter-home',  get_template_directory_uri() . '/blocks/filter-home/filter-home.min.css');
    },
  ));

  acf_register_block_type(array(
    'name'              => 'filter-inv',
    'title'             => __('Formularz filtrujący - Inwestycja'),
    'render_template'   => 'blocks/filter-inv/filter-inv.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('filter-inv'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-filter-inv',  get_template_directory_uri() . '/blocks/filter-inv/filter-inv.min.css');
    },
  ));

  acf_register_block_type(array(
    'name'              => 'kronika',
    'title'             => __('Kronika budowy - inwestycje'),
    'render_template'   => 'blocks/kronika/kronika.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('kronika'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-kronika',  get_template_directory_uri() . '/blocks/kronika/kronika.min.css');
    },
  ));

  acf_register_block_type(array(
    'name'              => 'timeline',
    'title'             => __('Linia czasu'),
    'render_template'   => 'blocks/timeline/timeline.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('timeline'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-timeline',  get_template_directory_uri() . '/blocks/timeline/timeline.min.css');
    },
  ));
  acf_register_block_type(array(
    'name'              => 'gallery',
    'title'             => __('Galeria'),
    'render_template'   => 'blocks/gallery/gallery.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'              => 'preview',
    'keywords'          => array('gallery'),
    'supports'          => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-gallery',  get_template_directory_uri() . '/blocks/gallery/gallery.min.css');
      wp_enqueue_script('go-gallery-js', get_template_directory_uri() . '/blocks/gallery/gallery.js', array('jquery'), null, true);
      wp_localize_script('go-gallery-js', 'go_gallery_ajax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
      ));
    },
  ));

  acf_register_block_type(array(
    'name'              => 'counter',
    'title'             => __('W liczbach'),
    'render_template'   => 'blocks/counter/counter.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('counter'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-counter',  get_template_directory_uri() . '/blocks/counter/counter.min.css');
      wp_enqueue_script('go-counter-js', get_template_directory_uri() . '/blocks/counter/counter.js', array('jquery'), '20', true);
    },
  ));
  acf_register_block_type(array(
    'name'              => 'calc',
    'title'             => __('Kalkulator kredytowy'),
    'render_template'   => 'blocks/calc/calc.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('calc'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-calc',  get_template_directory_uri() . '/blocks/calc/calc.min.css');
    },
  ));
  acf_register_block_type(array(
    'name'              => 'slider-box',
    'title'             => __('Slider-box'),
    'render_template'   => 'blocks/slider-box/slider-box.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('slider-box'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-slider-box',  get_template_directory_uri() . '/blocks/slider-box/slider-box.min.css');
      wp_enqueue_style('slick', get_template_directory_uri() .  '/assets/css/plugins/slick.min.css');
      wp_enqueue_script('go-slider-box-js', get_template_directory_uri() . '/blocks/slider-box/slider-box.js', array('jquery'), '20', true);
    },
  ));
  acf_register_block_type(array(
    'name'              => 'separator',
    'title'             => __('separator'),
    'render_template'   => 'blocks/separator/separator.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('Kontener', 'separator'),
    'supports'    => [
      'align'      => false,
      'anchor'    => true,
      'customClassName'  => true,
      'jsx'       => false,
    ],
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-separator',  get_template_directory_uri() . '/blocks/separator/separator.min.css');
    }
  ));
  acf_register_block_type(array(
    'name'              => 'button-cus',
    'title'             => __(' Przycisk'),
    'render_template'   => 'blocks/button/button.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('przycisk'),
    'supports' => array('align' => true),
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-button',  get_template_directory_uri() . '/blocks/button/button.min.css');
    },
  ));
  acf_register_block_type(array(
    'name'              => 'inv-localization',
    'title'             => __(' Lokalizacja  '),
    'render_template'   => 'blocks/inv-localization/inv-localization.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#c80100',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('lokalizacja'),
    'supports'    => [
      'align'      => false,
      'anchor'    => true,
      'customClassName'  => true,
      'jsx'       => true,
    ],
  ));
  function invlocalization()
  {
    wp_enqueue_style('go-inv-localization',  get_template_directory_uri() . '/blocks/inv-localization/inv-localization.min.css');
  }
  add_action('wp_enqueue_scripts', 'invlocalization');
  add_action('admin_enqueue_scripts', 'invlocalization');

  acf_register_block_type(array(
    'name'              => 'hero',
    'title'             => __('Hero'),
    'render_template'   => 'blocks/hero/hero.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#122b4f',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('Kontener', 'hero'),
    'supports'    => [
      'align'      => false,
      'anchor'    => false,
      'customClassName'  => true,
      'jsx'       => true,
    ],
  ));
  function enqueue_load_home()
  {
    wp_enqueue_style('go-hero',  get_template_directory_uri() . '/blocks/hero/hero.min.css');
    wp_enqueue_style('slick', get_template_directory_uri() .  '/assets/css/plugins/slick.min.css');
    wp_enqueue_script('go-slick', get_template_directory_uri() . '/assets/js/plugins/slick.min.js', array('jquery'), '3', true);
    wp_enqueue_script('go-hero-js', get_template_directory_uri() . '/blocks/hero/hero.js', array('jquery'), '20', true);
  }
  add_action('wp_enqueue_scripts', 'enqueue_load_home');
  add_action('admin_enqueue_scripts', 'enqueue_load_home');
}
if (function_exists('acf_register_block_type')) {
  add_action('acf/init', 'register_acf_block_types');
}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point($path)
{
  // Update path
  $path = get_template_directory() . '/blocks/acf-json';
  // Return path
  return $path;
}
