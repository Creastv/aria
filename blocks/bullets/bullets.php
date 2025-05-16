<?php
$bullets = get_field('bullets');
$col = get_field('kolumny');
$size = get_field('rozmiar');
?>
<?php if (!empty($bullets)) : ?>
    <!-- =================== content Area =================== -->
    <section class="content-area">
        <div class="content-inner content-inner-<?php echo $col; ?> size-<?php echo $size; ?>">
            <?php
            foreach ($bullets as $bulllet) :
                $icon = $bulllet['ikona'];
                $ti = $bulllet['tytul'];
            ?>
                <!-- content-card -->
                <div class="content-card">
                    <?php if (!empty($icon)) : ?>
                        <div class="content-icon">
                            <?php echo wp_get_attachment_image($icon, 'full'); ?>
                        </div><!-- /.content-icon -->
                    <?php endif; ?>

                    <div class="content-text">
                        <p><?php echo $ti; ?></p>
                    </div><!-- /.content-text -->

                </div><!-- /.content-card -->
            <?php endforeach; ?>
        </div><!-- /.content-inner -->
    </section><!-- /.content-area -->
<?php endif; ?>