<?php
get_header();
$invName = get_field('nazwa_inwestycji', get_the_ID());
$localization = get_field('lokalizacja', get_the_ID());
$budynek = get_field('budynek', get_the_ID());
$floor = get_field('pietro', get_the_ID());
$size = get_field('metraz', get_the_ID());
$stears = get_field('klatka', get_the_ID());
$rooms = get_field('pokoje', get_the_ID());
$balony = get_field('rozmiar_balkonu', get_the_ID());
$status = get_field('status', get_the_ID());
$price = get_field('cena', get_the_ID());
$plan = get_field('plan_mieszkania');
$plan2d = get_field('rzut_2d');
$plan3d = get_field('rzut_3d');
$statusInfo = "";
$statusInfoClass = "";
if ($status == 1) :
    $statusInfo = 'Dostępne';
    $statusInfoClass = "available";
elseif ($status == 2) :
    $statusInfo = 'Zarezerwowane';
    $statusInfoClass = "reserved";
elseif ($status == 3) :
    $statusInfo = 'Sprzedane';
    $statusInfoClass = "sold";
endif;

if ($floor == 0) {
    $floor = "Parter";
}

$project_id = get_project_id_by_investment();
$images = [];
$titleGallery = [];
if ($project_id) {
    $images = get_field('galerialokal', $project_id);
    $titleGallery = get_field('tytul_galerii', $project_id);
}
if ($images):
    $total = count($images);
    $block_id = 'gallery-' . uniqid();

    // Przygotuj dane dla JS
    $js_images = [];
    foreach ($images as $img) {
        $js_images[] = [
            'url' => $img['url'],
            'sizes' => [
                'gallery' => $img['sizes']['gallery']
            ],
            'alt' => $img['alt'],
            'title' => $img['title']
        ];
    }
endif;

?>
<?php
while (have_posts()) : the_post(); ?>
    <article id="page-<?php the_ID(); ?>" class="hentry page">
        <section class="projekt-area">
            <h2 class="projekt-name"><?php the_title(); ?></h2>
            <div class="projekt-container">
                <div class="projekt-details">
                    <ul>
                        <?php if (!empty($size)) : ?>
                            <li class="details-item item-area">
                                <span>metraż</span>
                                <p><?php echo number_format($size, 2); ?> M<sup>2</sup></p>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($floor)) : ?>
                            <li class="details-item item-floor">
                                <span>piętro</span>
                                <p><?php echo $floor; ?></p>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($rooms)) : ?>
                            <li class="details-item item-room">
                                <span>pokoje</span>
                                <p><?php echo $rooms; ?></p>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($balony)) : ?>
                            <li class="details-item item-backyard">
                                <span>balkon/ogrodek</span>
                                <p class="leaf"><?php echo $balcony; ?> M<sup>2</sup></p>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($status)) : ?>
                            <li class="details-item item-status">
                                <span>status</span>
                                <p class="status-<?php echo $statusInfoClass; ?>"><?php echo  $statusInfo; ?></p>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($stears)) : ?>
                            <li class="details-item item-stairway">
                                <span>klatka</span>
                                <p><?php echo $stears; ?></p>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($price)) : ?>
                            <li class="details-item item-offer">
                                <span>Cena</span>
                                <p><?php echo number_format($price, 2, ',', ' '); ?> zł</p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="projekt-plan">
                    <!-- Navigation -->
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <?php if ($plan2d) { ?>
                            <button class="active" id="nav-tab-lokal" data-bs-toggle="tab" data-bs-target="#tab-1" type="button"
                                role="tab" aria-controls="tab-1" aria-selected="true">
                                PLAN 2d
                            </button>
                        <?php } ?>
                        <?php if ($plan3d) { ?>
                            <button class="" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#tab-2" type="button"
                                role="tab" aria-controls="tab-2" aria-selected="false">
                                RZUT 3D
                            </button>
                        <?php } ?>
                        <?php if ($plan) { ?>
                            <a href="<?php echo $plan; ?>" class="bttn" target="_blank">Pobierz PDF</a>
                        <?php } ?>
                        <div class="favorite-btn grid-favorite-toggle" data-index="<?php echo get_the_ID(); ?>">
                            <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#fff" ;
                                    d="M9.33,15.59c-.42,0-.87-.14-1.38-.44-.45-.26-.9-.62-1.31-.94-.22-.17-.45-.35-.69-.54-1.04-.8-2.21-1.7-3.16-2.77-1.38-1.55-2.04-3.19-2.04-5.03C.75,3.81,1.89,1.96,3.66,1.15c.58-.26,1.19-.4,1.82-.4,1.24,0,2.49.53,3.61,1.53.07.06.16.1.25.1s.18-.03.25-.1c1.11-1,2.36-1.53,3.61-1.53.63,0,1.24.13,1.82.4,1.77.81,2.91,2.66,2.91,4.72,0,1.84-.67,3.48-2.04,5.03-.95,1.07-2.12,1.97-3.16,2.77-.24.19-.47.37-.7.54-.4.32-.86.67-1.31.94-.51.3-.96.44-1.38.44Z" />
                                <path fill="#1d1d1b" ;
                                    d="M13.19,1.13c.58,0,1.14.12,1.67.36,1.63.75,2.69,2.47,2.69,4.38,0,1.74-.64,3.31-1.95,4.78-.92,1.04-2.09,1.93-3.11,2.72-.24.19-.47.36-.7.54-.37.29-.83.66-1.26.91-.45.26-.84.39-1.19.39s-.74-.13-1.19-.39c-.43-.25-.89-.62-1.26-.91-.22-.17-.45-.35-.7-.54-1.02-.79-2.18-1.68-3.11-2.72-1.31-1.48-1.95-3.04-1.95-4.78,0-1.92,1.05-3.64,2.69-4.38.53-.24,1.09-.36,1.67-.36,1.15,0,2.31.49,3.36,1.43.14.13.32.19.5.19s.36-.06.5-.19c1.04-.94,2.2-1.43,3.36-1.43M13.19.38c-1.27,0-2.61.5-3.86,1.62-1.25-1.12-2.59-1.62-3.86-1.62-.69,0-1.36.15-1.98.43C1.65,1.65.38,3.61.38,5.87s.93,3.92,2.14,5.28c1.19,1.34,2.71,2.42,3.9,3.35.43.34.89.7,1.35.97.46.27.99.49,1.57.49s1.11-.22,1.57-.49c.46-.27.92-.63,1.35-.97,1.19-.94,2.71-2.01,3.9-3.35,1.21-1.37,2.14-3.06,2.14-5.28s-1.28-4.22-3.13-5.06c-.62-.28-1.29-.43-1.98-.43h0Z" />
                            </svg>
                        </div>
                    </div>
                    <div class=" plan-image-container">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="tab-1" role="tabpanel"
                                aria-labelledby="nav-tab-lokal">
                                <?php if ($plan2d) { ?>
                                    <a data-fancybox="gallery" href="<?php echo $plan2d; ?>">
                                        <img src='<?php echo $plan2d; ?>'
                                            alt='<?php echo $invName; ?> - <?php the_title(); ?> - Plan'
                                            style='max-width:100%;'>
                                    </a>
                                <?php } else { ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/local.png"
                                        alt="Floor plan">
                                <?php } ?>
                                <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/img/projekty/rzut-2d.png" alt="image"> -->
                            </div>
                            <?php if ($plan3d) { ?>
                                <div class="tab-pane fade " id="tab-2" role="tabpanel" aria-labelledby="nav-tab-lokal">
                                    <a data-fancybox="gallery" href="<?php echo $plan3d; ?>">
                                        <img src='<?php echo $plan3d; ?>'
                                            alt='<?php echo $invName; ?> - <?php the_title(); ?> - Plan 3D'
                                            style='max-width:100%;'>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- Navigation End -->
                    </div>
                </div>
                <!-- Project Plan End -->
                <!-- Project Contact -->
                <div class="projekt-contact contact-right">
                    <div class="contact-title">
                        <h3>Zapytaj o mieszkanie</h3>
                    </div>
                    <?php get_template_part('templates-parts/parts/local-form'); ?>
                </div>
            </div>
        </section>
        <section class="b-bg b-bg--recomended">
            <div class="container">
                <?php get_template_part('templates-parts/parts/recomended-locals'); ?>
                <?php if (!empty($images)) : ?>
                    <div class="custome-separator  sep-100"></div>
                    <?php if (!empty($titleGallery)) : ?>
                        <div class="section-title text-center ">
                            <?php if (!empty($titleGallery['etykieta'])) : ?>
                                <span><?php echo $titleGallery['etykieta']; ?></span>
                            <?php endif; ?>
                            <?php if (!empty($titleGallery['tytul'])) : ?>
                                <h2> <?php echo $titleGallery['tytul']; ?></h2>
                            <?php endif; ?>
                            <?php if (!empty($titleGallery['opis'])) : ?>
                                <p><?php echo $titleGallery['opis']; ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="gallery-area" data-total="<?php echo esc_attr($total); ?>"
                        data-display-title="<?php echo $displayTitle ? '1' : '0'; ?>">
                        <div class="gallery-inner go-gallery-items">
                            <?php for ($i = 0; $i < 6 && $i < $total; $i++):
                                $image = $images[$i];
                                $img_url = esc_url($image['sizes']['gallery']);
                                $full_url = esc_url($image['url']);
                                $alt = esc_attr($image['alt']);
                                $title = esc_html($image['title']);
                            ?>
                                <div class="gallery-img go-gallery-item">
                                    <a data-fancybox="gal" href="<?php echo $full_url; ?>" title="<?php echo $title; ?>">
                                        <img src="<?php echo $img_url; ?>" alt="<?php echo $alt ?: $title; ?>" />
                                    </a>
                                </div>
                            <?php endfor; ?>

                            <?php if ($total > 6): ?>
                                <div class="read-more">
                                    <a href="#" class="bttn-outline-orange go-load-more" data-offset="6"
                                        data-images='<?php echo json_encode($js_images); ?>'>
                                        Zobacz wszystkie
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

    </article>
<?php endwhile; ?>
<?php get_footer();
