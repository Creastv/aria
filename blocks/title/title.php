<?php
$title = get_field('title');
$desc = get_field('description');
$label = get_field('label');
$titleTag = get_field('tag');


$class_name = 'section-title';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
    $class_name .= ' text-' . $block['align'];
}
?>

<div class="<?php echo esc_attr($class_name); ?> <?php echo $classLink; ?>">
    <?php if ($label): ?>
        <span><?php echo $label; ?></span>
    <?php endif; ?>
    <?php if ($title): ?>
        <<?php echo $titleTag; ?>> <?php echo $title; ?></<?php echo $titleTag; ?>>
    <?php endif; ?>
    <?php if ($desc): ?>
        <?php echo $desc; ?>
    <?php endif; ?>
</div>