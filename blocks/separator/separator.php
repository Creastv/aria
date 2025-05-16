<?php
$haight = get_field('wysomosc');

$class_name = 'custome-separator ';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

?>

<div class="<?php echo $class_name; ?> sep-<?php echo $haight; ?>"></div>