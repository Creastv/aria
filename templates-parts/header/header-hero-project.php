<?php
$slider = get_field('galeria');
$logo = get_field('logo_hero');
$title = get_field('tytul_hero');
$desc = get_field('opis_hero');
$link = get_field('link_hero');
if ($link):
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif;
?>
<?php if (!empty($slider)) : ?>
    <!-- Hero Section with Slider -->
    <section class="hero-section hero-section--project">
        <div class="hero-slider">
            <?php foreach ($slider as $slide) : ?>
                <div class=" slider-item img go-parallex" style="background-image: url(<?php echo esc_url($slide['url']); ?>);">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="container">
                <?php if ($title) : ?>
                    <div>
                        <?php echo wp_get_attachment_image($logo, "meddium"); ?>
                    </div>
                <?php endif; ?>
                <?php if ($title) : ?>
                    <h1><?php echo $title; ?></h1>
                <?php endif; ?>
                <?php if ($desc) : ?>
                    <?php echo $desc; ?>
                <?php endif; ?>
                <?php if ($link): ?>
                    <a class="bttn" href="<?php echo esc_url($link_url); ?>"
                        target="<?php echo esc_attr($link_target); ?>"><span><?php echo esc_html($link_title); ?></span></a>
                <?php endif; ?>
            </div>
        </div>


    </section>
<?php endif; ?>