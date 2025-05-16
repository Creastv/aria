<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<meta name="theme-color" content="#fff">
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php wp_title('|', true, 'right'); ?></title>
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="header-main ">
        <?php get_template_part('templates-parts/header/header', 'top-bar'); ?>
        <?php get_template_part('templates-parts/header/header', 'main'); ?>
        <?php get_template_part('templates-parts/header/header', 'title'); ?>
    </div>
    <main id="main">
        <?php if (is_singular('projekty')) : ?>
            <?php get_template_part('templates-parts/header/header', 'hero-project'); ?>
        <?php endif; ?>
        <div class="container">
            <div class="row">