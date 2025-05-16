<?php
$numbers = get_field('w_liczbach');
?>
<?php if (!empty($numbers)) : ?>
    <section class="counter-area">
        <div class="counter-inner">
            <?php foreach ($numbers as $num) :
                $number = $num['numer'];
                if (!empty($number)) :
                    $suf = $number['sufix'];
                    $numb = $number['numer'];
                    $pref = $number['prefix'];
                endif;
                $desc = $num['opis'];
            ?>
                <?php if (!empty($number)) : ?>
                    <div class="single-counter">
                        <div class="counter-single counterUp">
                            <?php if (!empty($pref)) : ?>
                                <span class="counter-od"><?php echo $pref; ?></span>
                            <?php endif; ?>
                            <span class="counter" data-TargetNum="<?php echo $numb; ?> " data-Speed="600"></span>
                            <?php if (!empty($suf)) : ?>
                                <span><?php echo $suf; ?></span>
                            <?php endif; ?>
                        </div><!-- /.counter-single -->
                        <?php if (!empty($desc)) : ?>
                            <div class="counter-text">
                                <p><?php echo $desc; ?></p>
                            </div><!-- /.counter-text -->
                        <?php endif; ?>
                    </div><!-- /.single-counter -->
                <?php endif; ?>
            <?php endforeach; ?>
        </div><!-- /.counter-inner -->
    </section><!-- /.counter-area -->
<?php endif; ?>