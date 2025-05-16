<?php
get_header();
?>
<?php
while (have_posts()) : the_post(); ?>

    <article id="page-<?php the_ID(); ?>" class="hentry page">
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </article>
<?php endwhile;
get_footer();
