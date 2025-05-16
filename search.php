<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <?php get_template_part('templates-parts/header/header', 'title-search');  ?>
    <div class="posts-wraper-search">
        <?php while (have_posts()) : the_post();
            get_template_part('templates-parts/content/content-search');
        endwhile; ?>
    </div>
    <?php if (paginate_links()) { ?>
        <div class="go-pagination">
            <?php pagination_bars(); ?>
        </div>
    <?php } ?>

<?php else : ?>

    <div class="container no-resoult">
        <h2 class='text-center'><?php _e('Nic nie znaleziono', 'go'); ?></h2>
    </div>


<?php endif; ?>

<?php get_footer();
