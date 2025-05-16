<?php
$slider = get_field('slider');

?>
<?php if (!empty($slider)) : ?>
    <!-- Hero Section with Slider -->
    <section class="hero-section">
        <div class="hero-slider">
            <?php foreach ($slider as $slide) :
                $img = $slide['zdjecie'];
                $label = $slide['etykieta'];
                $title = $slide['tytul'];
                $desc = $slide['opis'];
            ?>
                <div class="slider-item go-parallex" style="background-image: url(<?php echo $img; ?>);">
                    <div class="hero-overlay"></div>
                    <div class="container hero-content go-parallex-con">
                        <?php if (!empty($label)) : ?>
                            <h2><?php echo $label; ?></h2>
                        <?php endif; ?>
                        <?php if (!empty($title)) : ?>
                            <h1><?php echo $title; ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($desc)) : ?>
                            <p><?php echo $desc; ?></p>
                        <?php endif; ?>
                        <div class="slider-controls-area">

                            <div class="d-flex align-items-center slider-controls">
                                <button class="slider-prev">
                                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="36" height="36" rx="18" fill="black" fill-opacity="0.2" />
                                        <rect width="36" height="36" rx="18" fill="white" fill-opacity="0.2" />
                                        <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="white"
                                            stroke-opacity="0.5" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.774 12.5581C17.0181 12.8021 17.0181 13.1979 16.774 13.4419L12.8409 17.375H24.6654C25.0105 17.375 25.2904 17.6548 25.2904 18C25.2904 18.3452 25.0105 18.625 24.6654 18.625H12.8409L16.774 22.5581C17.0181 22.8021 17.0181 23.1979 16.774 23.4419C16.5299 23.686 16.1342 23.686 15.8901 23.4419L10.8901 18.4419C10.646 18.1979 10.646 17.8021 10.8901 17.5581L15.8901 12.5581C16.1342 12.314 16.5299 12.314 16.774 12.5581Z"
                                            fill="white" />
                                    </svg>

                                </button>
                                <div class="slider-progress">
                                    <div class="slider-progress-bar"></div>
                                </div>
                                <button class="slider-next">
                                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="36" height="36" rx="18" transform="matrix(-1 0 0 1 36 0)" fill="black"
                                            fill-opacity="0.2" />
                                        <rect width="36" height="36" rx="18" transform="matrix(-1 0 0 1 36 0)" fill="white"
                                            fill-opacity="0.2" />
                                        <rect x="-0.5" y="0.5" width="35" height="35" rx="17.5"
                                            transform="matrix(-1 0 0 1 35 0)" stroke="white" stroke-opacity="0.5" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19.226 12.5581C18.9819 12.8021 18.9819 13.1979 19.226 13.4419L23.1591 17.375H11.3346C10.9895 17.375 10.7096 17.6548 10.7096 18C10.7096 18.3452 10.9895 18.625 11.3346 18.625H23.1591L19.226 22.5581C18.9819 22.8021 18.9819 23.1979 19.226 23.4419C19.4701 23.686 19.8658 23.686 20.1099 23.4419L25.1099 18.4419C25.354 18.1979 25.354 17.8021 25.1099 17.5581L20.1099 12.5581C19.8658 12.314 19.4701 12.314 19.226 12.5581Z"
                                            fill="white" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>