<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <?php get_template_part('templates-parts/header/header', 'title-blog'); ?>
    <div class="custome-separator  sep-50"></div>
    <div id="posts-container" class="news-inner--archive">
        <?php while (have_posts()) : the_post();
            get_template_part('templates-parts/content/content-cart');
        endwhile; ?>

    </div>
    <?php if ($wp_query->max_num_pages > 1) : ?>
        <div class="read-more-archive">
            <button class="bttn-outline-orange" id="load-more" data-page="1" data-max="<?php echo $wp_query->max_num_pages; ?>">
                Wczytaj więcej
            </button>
        </div>
    <?php endif; ?>

<?php else : ?>
    <heder class="entry-header">
        <h1 class='text-center'><?php _e('Nic nie znaleziono', 'go'); ?></h1>
    </heder>
<?php endif; ?>

<?php get_footer(); ?>