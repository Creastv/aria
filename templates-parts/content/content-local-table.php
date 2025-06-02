<?php
$budynek = get_field('budynek', get_the_ID());
$floor = get_field('pietro', get_the_ID());
$size = get_field('metraz', get_the_ID());
$rooms = get_field('pokoje', get_the_ID());
$balony = get_field('rozmiar_balkonu', get_the_ID());
$status = get_field('status', get_the_ID());
$price = get_field('cena', get_the_ID());
$plan2d = get_field('rzut_2d', get_the_ID());
$plan3d = get_field('rzut_3d', get_the_ID());
$statusInfo = "";
$statusInfoClass = "";
if ($status == 1) :
    $statusInfo = 'Dostępne';
    $statusInfoClass = "available";
elseif ($status == 2) :
    $statusInfo = 'Zarezerwowane';
    $statusInfoClass = "reserved";
elseif ($status == 3) :
    $statusInfo = 'Sprzedane';
    $statusInfoClass = "sold";
endif;
if ($floor == 0) {
    $floor = "Parter";
}

?>

<tr class="odd">
    <td class="sorting_1"><?php the_title(); ?></td>
    <td><?php echo is_numeric($size) ? number_format((float) $size, 2) . ' m²' : '-'; ?></td>
    <td><?php echo $floor; ?></td>
    <td><?php echo $rooms; ?></td>
    <td class="hide-mobile">
        <?php if (!empty($balony)) : ?>
            <?php echo is_numeric($size) ? number_format((float) $size, 2) . ' m²' : '-'; ?>
        <?php else: ?>
            -
        <?php endif; ?>
    </td>
    <td><span class="status-<?php echo $statusInfoClass; ?>"><?php echo  $statusInfo; ?></span></td>
    <td class="hide-mobile">
        <?php if (!$plan2d && !$plan3d): ?>
            -
        <?php endif; ?>
        <?php if ($plan2d): ?>
            <a class="download-plan" href="<?php echo $plan2d; ?>" download="<?php the_title(); ?>-2d.jpg">2D</a>
        <?php endif; ?>
        <?php if ($plan3d): ?>
            <a class="download-plan" href="<?php echo $plan3d; ?>" download="<?php the_title(); ?>-3d.jpg">3D</a>
        <?php endif; ?>

    </td>
    <td><a href="<?php the_permalink(); ?>" class="price-btn">Zapytaj o cenę</a></td>
    <td class="hide-mobile">-</td>
    <td class="hide-mobile">
        <button class="favorite-btn grid-favorite-toggle" data-index="<?php echo get_the_ID(); ?>">
            <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill="#fff" ;
                    d="M9.33,15.59c-.42,0-.87-.14-1.38-.44-.45-.26-.9-.62-1.31-.94-.22-.17-.45-.35-.69-.54-1.04-.8-2.21-1.7-3.16-2.77-1.38-1.55-2.04-3.19-2.04-5.03C.75,3.81,1.89,1.96,3.66,1.15c.58-.26,1.19-.4,1.82-.4,1.24,0,2.49.53,3.61,1.53.07.06.16.1.25.1s.18-.03.25-.1c1.11-1,2.36-1.53,3.61-1.53.63,0,1.24.13,1.82.4,1.77.81,2.91,2.66,2.91,4.72,0,1.84-.67,3.48-2.04,5.03-.95,1.07-2.12,1.97-3.16,2.77-.24.19-.47.37-.7.54-.4.32-.86.67-1.31.94-.51.3-.96.44-1.38.44Z" />
                <path fill="#1d1d1b" ;
                    d="M13.19,1.13c.58,0,1.14.12,1.67.36,1.63.75,2.69,2.47,2.69,4.38,0,1.74-.64,3.31-1.95,4.78-.92,1.04-2.09,1.93-3.11,2.72-.24.19-.47.36-.7.54-.37.29-.83.66-1.26.91-.45.26-.84.39-1.19.39s-.74-.13-1.19-.39c-.43-.25-.89-.62-1.26-.91-.22-.17-.45-.35-.7-.54-1.02-.79-2.18-1.68-3.11-2.72-1.31-1.48-1.95-3.04-1.95-4.78,0-1.92,1.05-3.64,2.69-4.38.53-.24,1.09-.36,1.67-.36,1.15,0,2.31.49,3.36,1.43.14.13.32.19.5.19s.36-.06.5-.19c1.04-.94,2.2-1.43,3.36-1.43M13.19.38c-1.27,0-2.61.5-3.86,1.62-1.25-1.12-2.59-1.62-3.86-1.62-.69,0-1.36.15-1.98.43C1.65,1.65.38,3.61.38,5.87s.93,3.92,2.14,5.28c1.19,1.34,2.71,2.42,3.9,3.35.43.34.89.7,1.35.97.46.27.99.49,1.57.49s1.11-.22,1.57-.49c.46-.27.92-.63,1.35-.97,1.19-.94,2.71-2.01,3.9-3.35,1.21-1.37,2.14-3.06,2.14-5.28s-1.28-4.22-3.13-5.06c-.62-.28-1.29-.43-1.98-.43h0Z" />
            </svg>
        </button>
    </td>
</tr>