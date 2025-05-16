<?php
$link = get_field('button');
if ($link) :
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif;

$btnClass = 'btn-main';
$btnStyle = get_field('styl_buttona');
if ($btnStyle == 1) {
    $btnClass = 'bttn';
} elseif ($btnStyle == 2) {
    $btnClass = 'black-bttn';
} elseif ($btnStyle == 3) {
    $btnClass = 'bttn-outline-orange';
} elseif ($btnStyle == 4) {
    $btnClass = 'link';
}

$class_name = ' bc-button';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' text-' . $block['align'];
}
?>

<div class="<?php echo esc_attr($class_name); ?>">
    <?php if ($link) : ?>
        <a class="<?php echo esc_attr($btnClass); ?>" href="<?php echo esc_url($link_url); ?>"
            target="<?php echo esc_attr($link_target); ?>">
            <span><?php echo esc_html($link_title); ?></span>
            <?php if (!$btnStyle) : ?>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.226 4.55806C10.9819 4.80214 10.9819 5.19786 11.226 5.44194L15.1591 9.375H3.33464C2.98946 9.375 2.70964 9.65482 2.70964 10C2.70964 10.3452 2.98946 10.625 3.33464 10.625H15.1591L11.226 14.5581C10.9819 14.8021 10.9819 15.1979 11.226 15.4419C11.4701 15.686 11.8658 15.686 12.1099 15.4419L17.1099 10.4419C17.354 10.1979 17.354 9.80214 17.1099 9.55806L12.1099 4.55806C11.8658 4.31398 11.4701 4.31398 11.226 4.55806Z"
                        fill="white" />
                </svg>
            <?php endif; ?>
        </a>
    <?php endif; ?>
</div>