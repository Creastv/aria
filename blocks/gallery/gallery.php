<?php
$images = get_field('gallery');
$displayTitle = get_field('wyswietlaj_tytul'); // true / false

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
?>
    <section class="gallery-area" id="<?php echo esc_attr($block_id); ?>" data-total="<?php echo esc_attr($total); ?>"
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
                    <?php if ($displayTitle && $title): ?>
                        <h3 class="gallery-title"><?php echo $title; ?></h3>
                    <?php endif; ?>
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
    </section>
<?php endif; ?>