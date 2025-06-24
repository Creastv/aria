<?php

$display = get_field('wylacz_naglowek');
$wishlistLinik = get_field('wishlist', 'options');
// $class = '';
// if (!$display && !is_home() && !is_archive()) :
if (!is_front_page() && $display) {
    $class = 'no-title ';
}
if (is_home() || is_search() || is_category() || is_tax() ||  is_post_type_archive('lokale') || is_singular('lokale')) {
    $class = 'no-title';
}

?>
<!-- Navigation -->
<header class="sticky-top <?php echo $class; ?>">
    <!-- Top row: Logo and buttons -->
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4 col-lg-4">
                    <div class="logo">
                        <a href=" <?php echo esc_url(home_url('/')); ?>">
                            <img class="inactive" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg"
                                alt="ARIA Development">
                            <img class="active"
                                src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-active.svg"
                                alt="ARIA Development">
                        </a>
                    </div>
                </div>
                <div class="col-8 col-lg-8">
                    <div class="header-right">
                        <div class="nav-icons  d-md-flex">
                            <a href="/lokale/" class="nav-icon ">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_9844_211)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.625 2.0625C5.00063 2.0625 2.0625 5.00063 2.0625 8.625C2.0625 12.2494 5.00063 15.1875 8.625 15.1875C12.2494 15.1875 15.1875 12.2494 15.1875 8.625C15.1875 5.00063 12.2494 2.0625 8.625 2.0625ZM0.9375 8.625C0.9375 4.37931 4.37931 0.9375 8.625 0.9375C12.8707 0.9375 16.3125 4.37931 16.3125 8.625C16.3125 10.5454 15.6083 12.3013 14.4441 13.6487L16.8977 16.1023C17.1174 16.3219 17.1174 16.6781 16.8977 16.8977C16.6781 17.1174 16.3219 17.1174 16.1023 16.8977L13.6487 14.4441C12.3013 15.6083 10.5454 16.3125 8.625 16.3125C4.37931 16.3125 0.9375 12.8707 0.9375 8.625Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_9844_211">
                                            <rect width="18" height="18" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            <?php if (!empty($wishlistLinik)) : ?>
                                <a href="<?php echo $wishlistLinik; ?>" class="nav-icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.46941 15.7591L7.85634 15.2682L7.46941 15.7591ZM10.0013 4.58386L9.551 5.01728C9.66882 5.13969 9.8314 5.20886 10.0013 5.20886C10.1712 5.20886 10.3338 5.13969 10.4516 5.01728L10.0013 4.58386ZM12.5332 15.7591L12.9201 16.2499L12.5332 15.7591ZM7.85634 15.2682C6.59329 14.2726 5.21219 13.3002 4.11654 12.0665C3.04232 10.8569 2.29297 9.44542 2.29297 7.61425H1.04297C1.04297 9.83553 1.96838 11.53 3.1819 12.8965C4.37399 14.2388 5.89361 15.3127 7.08248 16.2499L7.85634 15.2682ZM2.29297 7.61425C2.29297 5.82186 3.30578 4.31877 4.68827 3.68683C6.03136 3.0729 7.83602 3.23548 9.551 5.01728L10.4516 4.15044C8.41672 2.03627 6.05471 1.68782 4.1686 2.54997C2.3219 3.3941 1.04297 5.35419 1.04297 7.61425H2.29297ZM7.08248 16.2499C7.50935 16.5864 7.96759 16.9452 8.43199 17.2166C8.89618 17.4879 9.42597 17.7083 10.0013 17.7083V16.4583C9.7433 16.4583 9.43975 16.3577 9.06264 16.1374C8.68574 15.9171 8.2947 15.6138 7.85634 15.2682L7.08248 16.2499ZM12.9201 16.2499C14.109 15.3127 15.6286 14.2388 16.8207 12.8965C18.0342 11.53 18.9596 9.83553 18.9596 7.61425H17.7096C17.7096 9.44542 16.9603 10.8569 15.8861 12.0665C14.7904 13.3002 13.4093 14.2726 12.1463 15.2682L12.9201 16.2499ZM18.9596 7.61425C18.9596 5.35419 17.6807 3.3941 15.834 2.54997C13.9479 1.68782 11.5859 2.03627 9.551 4.15044L10.4516 5.01728C12.1666 3.23548 13.9712 3.0729 15.3143 3.68683C16.6968 4.31877 17.7096 5.82186 17.7096 7.61425H18.9596ZM12.1463 15.2682C11.7079 15.6138 11.3169 15.9171 10.94 16.1374C10.5628 16.3577 10.2593 16.4583 10.0013 16.4583V17.7083C10.5766 17.7083 11.1064 17.4879 11.5706 17.2166C12.035 16.9452 12.4933 16.5864 12.9201 16.2499L12.1463 15.2682Z"
                                            fill="white" />
                                    </svg>

                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="nav-btns d-none d-md-flex">
                            <?php get_template_part('templates-parts/parts/buttons-header'); ?>
                        </div>
                        <div class="mobile-menu-toggle d-lg-none ms-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="#fff"
                                    d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search container -->
    <div class="search-bar-container">
        <div class="container">
            <form class="search-form">
                <input type="text" class="search-input" placeholder="Wyszukaj...">
                <button type="submit" class="search-btn">Szukaj</button>
            </form>
            <div class="search-close">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>

    <!-- Bottom row: Menu -->
    <div class="header-bottom">
        <div class="container">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary_menu', // lub 'primary' jeśli to menu główne
                'menu_class'     => 'main-menu', // <ul class="main-menu">
                'container'      => false,       // usuwa <div>
                'depth'          => 2,
                'walker'         => new Custom_Nav_Walker(),
            ));
            ?>
        </div>
    </div>
</header>

</div><!-- /.header-main -->