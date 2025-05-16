<article class="post post-search <?php echo $post->ID; ?>" data-aos="fade-up">
    <div class="post__content">
        <span> <?php
                $post_type = get_post_type();
                echo esc_html(get_post_type_object($post_type)->labels->singular_name);
                ?></span>
        <h2 class="entry-title ">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
        <p class="entry-content"><?php echo custom_excerpt(30); ?></p>
    </div>
    <div class="button">
        <a href="<?php the_permalink(); ?>" class="bttn-outline-orange">Czytaj więcej</a>
    </div>
</article>