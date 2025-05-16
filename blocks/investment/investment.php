<?php
$investitions = get_field('inwestycje');
?>

<!-- =================== Investment Area =================== -->
<?php if ($investitions) : ?>
    <?php foreach ($investitions as $inv) :
        $img = get_post_thumbnail_id($inv);
        $logoSm = get_field('logo_sm', $inv);
        $logoLg = get_field('logo_lg', $inv);
        $name = get_field('nazwa_inwestycji', $inv);
        $excerpt = get_field('excerpt', $inv);
        $status = get_field('status', $inv);
        if ($status) :
            $labelText = $status['tresc_etykiety'];
            $labelColor = $status['kolor_etykiety'];
        endif;
        $rooms = get_field('przedzial_pokoi', $inv);
        $size = get_field('przedzial_metrazu', $inv);
        $date = get_field('termin_oddania_inwestycji', $inv);
        $link = get_the_permalink($inv);
        $flats = get_field('mieszkania', $inv);
    ?>
        <section class="investment-area">
            <div class="investment">
                <div class="investment-img">
                    <?php echo wp_get_attachment_image($img, 'full'); ?>
                    <?php if (!empty($status)) : ?>
                        <div class="on-sale">
                            <span style="background-color: <?php echo $labelColor; ?>;"><?php echo $labelText; ?></span>
                        </div><!-- /.on-sale -->
                    <?php endif; ?>
                    <?php if (!empty($logoLg)) : ?>
                        <div class="inves-icon">
                            <a href="<?php echo $link; ?>">
                                <?php echo wp_get_attachment_image($logoLg, 'full'); ?>
                            </a>
                        </div><!-- /.inves-icon -->
                    <?php endif; ?>
                </div><!-- /.investment-img -->
                <div class="investment-text">
                    <?php if (!empty($logoSm)) : ?>
                        <div class="moja">
                            <a href="<?php echo $link; ?>">
                                <?php echo wp_get_attachment_image($logoSm, 'full'); ?>
                            </a>
                        </div><!-- /.moja -->
                    <?php endif; ?>
                    <div>
                        <?php if (!empty($name)) : ?>
                            <h3><?php echo $name; ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($excerpt)) : ?>
                            <p><?php echo $excerpt; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="deadline">
                        <?php if (!empty($rooms)) : ?>
                            <div>
                                <span>Ilość pokoi</span>
                                <p><?php echo $rooms; ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($size)) : ?>
                            <div>
                                <span>Metraże</span>
                                <p><?php echo $size; ?> m²</p>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($date)) : ?>
                            <div>
                                <span>Termin oddania</span>
                                <p><?php echo $date; ?></p>
                            </div>
                        <?php endif; ?>
                    </div><!-- /.deadline -->
                    <?php if ($flats) : ?>
                        <div class="rzut">
                            <?php foreach ($flats as $flat) :
                                $imgFlat = $flat['zdjecie_mieszkania'];
                                $titleFlat = $flat['tytul'];
                                $sizeFlat = $flat['metraz'];
                                $roomsFlat = $flat['liczba_pokoi'];

                            ?>
                                <div class="rzut-pane">
                                    <?php if (!empty($imgFlat)) : ?>
                                        <div class="rzut-img">
                                            <?php echo wp_get_attachment_image($imgFlat, 'full'); ?>
                                        </div><!-- /.rzut-img -->
                                    <?php endif; ?>
                                    <span></span>
                                    <div class="rzut-detail">
                                        <?php if (!empty($titleFlat)) : ?>
                                            <p class="rzut-head"><?php echo $titleFlat; ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($roomsFlat)) : ?>
                                            <p><?php echo $roomsFlat; ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($sizeFlat)) : ?>
                                            <p><?php echo $sizeFlat; ?> m<sup>2</sup></p>
                                        <?php endif; ?>
                                    </div>
                                </div><!-- /.rzut-pane-->
                            <?php endforeach; ?>
                        </div><!-- /.rzut -->
                    <?php endif; ?>
                    <a href="<?php echo $link; ?>" class="bttn"><span>Dowiedz się więcej</span><svg width="20" height="20"
                            viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M11.226 4.55806C10.9819 4.80214 10.9819 5.19786 11.226 5.44194L15.1591 9.375H3.33464C2.98946 9.375 2.70964 9.65482 2.70964 10C2.70964 10.3452 2.98946 10.625 3.33464 10.625H15.1591L11.226 14.5581C10.9819 14.8021 10.9819 15.1979 11.226 15.4419C11.4701 15.686 11.8658 15.686 12.1099 15.4419L17.1099 10.4419C17.354 10.1979 17.354 9.80214 17.1099 9.55806L12.1099 4.55806C11.8658 4.31398 11.4701 4.31398 11.226 4.55806Z"
                                fill="white" />
                        </svg>
                    </a>

                </div><!-- /.investment-text -->
            </div><!-- /.investment -->
        </section><!-- /.investments-area -->
    <?php endforeach; ?>
<?php endif; ?>