<?php
function lokale_favorites_shortcode()
{
    ob_start();
?>
    <div id="favorite-lokale-list"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const favorites = JSON.parse(localStorage.getItem('favoriteLokale')) || [];
            const container = document.getElementById('favorite-lokale-list');

            function loadFavorites() {
                if (favorites.length > 0) {
                    const data = new FormData();
                    data.append('action', 'get_favorite_lokale');
                    data.append('favorites', favorites.join(','));

                    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                            method: 'POST',
                            body: data
                        })
                        .then(response => response.text())
                        .then(html => {
                            container.innerHTML = html;
                            initFavoriteButtons(); // uruchom serduszka po załadowaniu
                        });
                } else {
                    container.innerHTML =
                        '<br><h2 class="text-center">Nie odznaczyłęś jeszcze żadnego mieszkania.</h2>';
                }
            }

            function initFavoriteButtons() {
                const favoriteButtons = container.querySelectorAll('.favorite-btn.grid-favorite-toggle');
                favoriteButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const postId = this.dataset.index;
                        const index = favorites.indexOf(postId);

                        if (index > -1) {
                            // Usuń z ulubionych
                            favorites.splice(index, 1);
                            localStorage.setItem('favoriteLokale', JSON.stringify(favorites));

                            // Ponownie załaduj listę z Ajaxa
                            loadFavorites();
                        }
                    });
                });
            }


            loadFavorites();
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('ulubione_lokale', 'lokale_favorites_shortcode');




function get_favorite_lokale()
{
    if (!isset($_POST['favorites'])) {
        wp_die();
    }

    $favorites = explode(',', sanitize_text_field($_POST['favorites']));

    $query = new WP_Query([
        'post_type' => 'lokale',
        'post__in'  => $favorites,
        'orderby'   => 'post__in', // Zachowaj kolejność z localStorage
    ]);

    if ($query->have_posts()) {
        echo '<div class="favorite-lokale-grid">';
        while ($query->have_posts()) {
            $query->the_post();
    ?>

            <?php get_template_part('templates-parts/content/content-local'); ?>

<?php
        }
        echo '</div>';
        wp_reset_postdata();
    } else {
        echo '<p>Nie znaleziono ulubionych lokali.</p>';
    }

    wp_die();
}
add_action('wp_ajax_get_favorite_lokale', 'get_favorite_lokale');
add_action('wp_ajax_nopriv_get_favorite_lokale', 'get_favorite_lokale');
