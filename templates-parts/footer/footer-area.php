<?php
$desc = get_field('krotki_opis', 'options');
$displaySome = get_field('social_media_footer', 'options');
$link = get_field('link_pod_krotkim_opisem', 'options');
if ($link):
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif;
?>
<!-- =================== Fotter Area =================== -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="footer">
                    <div class="footer-left">
                        <div class="footer-top">
                            <div class="footer-logo">
                                <a href="#"><img
                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/home/footer/footer-logo.svg"
                                        alt="logo"></a>
                            </div><!-- /.footer-logo -->
                            <?php if ($displaySome) : ?>
                                <div class="social">
                                    <?php get_template_part('templates-parts/parts/social-media'); ?>
                                </div><!-- /.social -->
                            <?php endif; ?>
                        </div><!-- /.footer-top -->
                        <div class="footer-text">
                            <?php if (!empty($desc)) : ?>
                                <p><?php echo $desc; ?></p>
                            <?php endif; ?>
                        </div><!-- /.footer-text -->
                        <?php if ($link) : ?>
                            <a class="bttn" href="<?php echo esc_url($link_url); ?>"
                                target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                        <?php endif; ?>
                    </div><!-- /.footer-left -->

                </div><!-- /.footer -->
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <div class="footer-right">
                    <div>
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                    <div>
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                    <div>
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                </div><!-- /.footer-right -->
            </div><!-- /.col-lg-6 -->
            <div class="row">
                <div class="col-12">
                    <div class="footer-bttm">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer', // lub 'primary' jeśli to menu główne
                            'container'      => false,       // usuwa <div>
                        ));
                        ?>
                        <p>&copy; 2025 ARIA Development - Wszelkie prawa zastrzeżone.</p>
                    </div><!-- /.footer-bttm -->
                </div><!-- /.col-12 -->
            </div><!-- /.row -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</footer><!-- /.footer-area -->