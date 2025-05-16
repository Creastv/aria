<?php
$phone = get_field('nr_telefonu', 'options');
$desc = get_field('komunikat', 'options');
$displaySome = get_field('social_media_header', 'options');
?>

<!-- Top Bar -->
<div class="top-bar">
    <div class="container d-flex justify-content-between align-items-center">
        <?php if (!empty($phone)) : ?>
            <div>
                <a class="ph-nb" href="tel:<?php echo $phone; ?>">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.68912 1.54411L5.1218 2.3194C5.51227 3.01905 5.35552 3.93688 4.74054 4.55186C4.74054 4.55187 4.74054 4.55186 4.74053 4.55187C4.74046 4.55194 3.99465 5.2979 5.34707 6.65032C6.69905 8.0023 7.44499 7.2574 7.44553 7.25686C7.44554 7.25684 7.44554 7.25685 7.44555 7.25683C8.06054 6.64187 8.97835 6.48513 9.678 6.87559L10.4533 7.30827C11.5098 7.89788 11.6345 9.37949 10.7059 10.3081C10.1479 10.8661 9.46433 11.3003 8.70867 11.329C7.43658 11.3772 5.27625 11.0552 3.1092 8.8882C0.942148 6.72114 0.620206 4.56081 0.66843 3.28872C0.697077 2.53306 1.13126 1.84949 1.68927 1.29149C2.6179 0.362852 4.09951 0.487622 4.68912 1.54411Z"
                            stroke="white" stroke-linecap="round" />
                    </svg>
                    <?php echo $phone; ?>
                </a>
            </div>
        <?php endif; ?>
        <?php if (!empty($phone)) : ?>
            <div class="nowa">
                <?php echo $desc; ?>
            </div>
        <?php endif; ?>
        <?php if ($displaySome) : ?>
            <div>
                <?php get_template_part('templates-parts/parts/social-media'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>