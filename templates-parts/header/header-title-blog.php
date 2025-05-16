<?php
$blog_title = get_field('blog_title', 'options');
if ($blog_title) :
    $label = $blog_title['etykieta'];
    $title = $blog_title['tytul'];
    $desc = $blog_title['opis'];
endif;
?>
<?php if (!empty($blog_title)) : ?>
    <div class="section-title section-title--blog text-center ">
        <?php if (!empty($label)) : ?>
            <span><?php echo $label; ?></span>
        <?php endif; ?>
        <?php if (is_category() || is_tax()) : ?>
            <h1>
                <?php if (is_category()) :
                    single_cat_title();
                elseif (is_tax()) :
                    single_tag_title();
                endif;
                ?>
            </h1>
        <?php else : ?>
            <?php if (!empty($title)) : ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if (!empty($desc)) : ?>
                <?php echo $desc; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>