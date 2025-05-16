<article class="news-card">
    <div class="news-img">
        <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) : ?>
                <?php echo the_post_thumbnail('post-futured', array(
                    'alt' => get_the_title()
                )); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/news/1.png" alt="img">
            <?php endif; ?>
        </a>
    </div><!-- /.news-img -->
    <div class="news-text">
        <span class="news-text__label"><?php echo get_the_date('F Y') . 'r.'; ?></span>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p><?php echo custom_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="bttn black-bttn"><span>Czytaj więcej</span>
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M11.226 4.55806C10.9819 4.80214 10.9819 5.19786 11.226 5.44194L15.1591 9.375H3.33464C2.98946 9.375 2.70964 9.65482 2.70964 10C2.70964 10.3452 2.98946 10.625 3.33464 10.625H15.1591L11.226 14.5581C10.9819 14.8021 10.9819 15.1979 11.226 15.4419C11.4701 15.686 11.8658 15.686 12.1099 15.4419L17.1099 10.4419C17.354 10.1979 17.354 9.80214 17.1099 9.55806L12.1099 4.55806C11.8658 4.31398 11.4701 4.31398 11.226 4.55806Z"
                    fill="white" />
            </svg>
        </a><!-- /.bttn -->
    </div><!-- /.news-text -->
</article><!-- /.news-card -->