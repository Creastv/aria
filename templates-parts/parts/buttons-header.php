<?php
$link = get_field('button_1', 'options');

if ($link):
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif;

$linkTwo = get_field('button_2', 'options');

if ($linkTwo):
    $linkTwo_url = $linkTwo['url'];
    $linkTwo_title = $linkTwo['title'];
    $linkTwo_target = $linkTwo['target'] ? $linkTwo['target'] : '_self';
endif;

?>


<?php if ($link): ?>
    <a class="btn btn-outline-light d-none d-md-inline-block" href="<?php echo esc_url($link_url); ?>"
        target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
<?php endif; ?>
<?php if ($linkTwo): ?>
    <a class="btn btn-primary" href="<?php echo esc_url($linkTwo_url); ?>"
        target="<?php echo esc_attr($linkTwo_target); ?>"><?php echo esc_html($linkTwo_title); ?></a>
<?php endif; ?>