<?php
$bg = get_field('bg_color');
$h = get_field('height');
$p = get_field('position');

$position = '';
if ($p == 1) {
    $position = 'top:0;';
} else {
    $position = 'bottom:0;';
}
$class_name = 'b-bg';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
?>

<div class="<?php echo esc_attr($class_name); ?> ">
    <div class="b-bg-apla"
        style="background-color:<?php echo $bg; ?>; height:<?php echo $h; ?>%; <?php echo $position; ?> "></div>
    <div class="container">
        <InnerBlocks />
    </div>
</div>