<?php
$investitions = get_field('inwestycje');
?>
<?php if (!empty($investitions)) : ?>
<div class="inv__wrap">
    <?php foreach ($investitions as $inv) :
            $img = get_post_thumbnail_id($inv);
            $logoSm = get_field('logo_sm', $inv);
            $name = get_field('nazwa_inwestycji', $inv);
            $excerpt = get_field('excerpt', $inv);
            $status = get_field('status', $inv);
            if ($status) :
                $labelText = $status['tresc_etykiety'];
                $labelColor = $status['kolor_etykiety'];
            endif;
            $link = get_field('kronika', $inv);
        ?>
    <article class="inv-card">
        <div class="inv-img">
            <a href="<?php echo $link; ?>">
                <?php echo wp_get_attachment_image($img, 'full'); ?>
                <?php if (!empty($status)) : ?>
                <div class="inv-label">
                    <span style="background-color: <?php echo $labelColor; ?>;"><?php echo $labelText; ?></span>
                </div><!-- /.on-sale -->
                <?php endif; ?>
            </a>
        </div><!-- /.inv-img -->
        <div class="inv-text">
            <?php if (!empty($logoSm)) : ?>
            <div class="inv-logo">
                <a href="<?php echo $link; ?>">
                    <?php echo wp_get_attachment_image($logoSm, 'full'); ?>
                </a>
            </div><!-- /.moja -->
            <?php endif; ?>
            <?php if (!empty($name)) : ?>
            <h2><a href="<?php echo $link; ?>"><?php echo $name; ?></a></h2>
            <?php endif; ?>
            <?php if (!empty($excerpt)) : ?>
            <p><?php echo $excerpt; ?></p>
            <?php endif; ?>
            <a href="<?php echo $link; ?>" class="bttn black-bttn"><span>Zobacz kronikę</span>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.226 4.55806C10.9819 4.80214 10.9819 5.19786 11.226 5.44194L15.1591 9.375H3.33464C2.98946 9.375 2.70964 9.65482 2.70964 10C2.70964 10.3452 2.98946 10.625 3.33464 10.625H15.1591L11.226 14.5581C10.9819 14.8021 10.9819 15.1979 11.226 15.4419C11.4701 15.686 11.8658 15.686 12.1099 15.4419L17.1099 10.4419C17.354 10.1979 17.354 9.80214 17.1099 9.55806L12.1099 4.55806C11.8658 4.31398 11.4701 4.31398 11.226 4.55806Z"
                        fill="white" />
                </svg>

            </a><!-- /.bttn -->
        </div><!-- /.inv-text -->
    </article><!-- /.inv-card -->
    <?php endforeach; ?>
</div>
<?php endif; ?>