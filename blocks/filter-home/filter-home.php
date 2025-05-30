<?php

$lokale = get_posts([
    'post_type'      => 'lokale',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields'         => 'ids',
]);

$inwestycje = [];
$lokalizacje = [];
$pokoje = [];
$metraze = [];

if ($lokale) {
    foreach ($lokale as $post_id) {
        $inwestycja = get_field('nazwa_inwestycji', $post_id);
        $lokalizacja = get_field('lokalizacja', $post_id);
        $ilosc_pokoi = get_field('pokoje', $post_id);
        $metraz = get_field('metraz', $post_id);

        if (!empty($inwestycja)) $inwestycje[] = $inwestycja;
        if (!empty($lokalizacja)) $lokalizacje[] = $lokalizacja;
        if (!empty($ilosc_pokoi) && is_numeric($ilosc_pokoi)) $pokoje[] = (int) $ilosc_pokoi;
        if (!empty($metraz) && is_numeric($metraz)) $metraze[] = (float) $metraz;
    }
}

$inwestycje = array_unique($inwestycje);
sort($inwestycje);
$lokalizacje = array_unique($lokalizacje);
sort($lokalizacje);
$pokoje = array_unique($pokoje);
sort($pokoje, SORT_NUMERIC);

$min_metraz = !empty($metraze) ? min($metraze) : 0;
$max_metraz = !empty($metraze) ? max($metraze) : 300;

// Dla pamiętania wybranych wartości po reloadzie
$current_investment = isset($_GET['investment']) ? $_GET['investment'] : '';
$current_location = isset($_GET['location']) ? $_GET['location'] : '';
$current_rooms = isset($_GET['rooms']) ? $_GET['rooms'] : '';
?>
<div class="filter-area">
    <form id="homepage-filter-form" action="<?php echo esc_url(get_post_type_archive_link('lokale')); ?>" method="get">
        <?php if (!empty($active_filters)) : ?>
            <div class="active-filters mt-3">
                <strong>Aktywne filtry:</strong>
                <ul class="list-inline">
                    <?php foreach ($active_filters as $key => $value) : ?>
                        <li class="list-inline-item">
                            <a href="<?php echo esc_url(remove_query_arg($key)); ?>" class="btn btn-sm btn-outline-danger">
                                <?php echo ucfirst($key) . ': ' . esc_html($value); ?> ✕
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?php echo esc_url(get_post_type_archive_link('lokale')); ?>" class="btn btn-sm btn-secondary">
                    Wyczyść wszystkie
                </a>
            </div>
        <?php endif; ?>
        <div class="search-container search-inner mrt-100">

            <div class="search-title mb-3">
                <h2>Znajdź mieszkanie dla siebie</h2>
            </div>

            <div class="row">
                <!-- Inwestycja -->
                <div class="col-lg-6 col-md-6 col-xl-3">
                    <label class="form-label">Inwestycja</label>
                    <select class="form-select select2" name="investment">
                        <option value="">Wszystkie</option>
                        <?php foreach ($inwestycje as $slug): ?>
                            <option value="<?php echo esc_attr($slug); ?>" <?php selected($current_investment, $slug); ?>>
                                <?php echo esc_html($slug); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Lokalizacja -->
                <div class="col-lg-6 col-md-6 col-xl-3">
                    <label class="form-label">Lokalizacja</label>
                    <select class="form-select select2" name="location">
                        <option value="">Wszystkie</option>
                        <?php foreach ($lokalizacje as $slug): ?>
                            <option value="<?php echo esc_attr($slug); ?>" <?php selected($current_location, $slug); ?>>
                                <?php echo esc_html($slug); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Liczba pokoi -->
                <div class="col-lg-6 col-md-6 col-xl-3 ">
                    <label class="form-label">Liczba pokoi</label>
                    <input type="hidden" name="rooms" id="homepage-rooms"
                        value="<?php echo esc_attr($current_rooms); ?>">
                    <div class="homepage-rooms d-flex flex-wrap gap-1">
                        <?php foreach ($pokoje as $ilosc): ?>
                            <button type="button"
                                class="room-btn--home btn btn-outline-secondary  <?php echo ($current_rooms == $ilosc) ? 'active' : ''; ?>"
                                data-rooms="<?php echo esc_attr($ilosc); ?>">
                                <?php echo esc_html($ilosc); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Szukaj -->
                <div class="col-lg-6 col-md-6 col-xl-3">
                    <label for=""></label>
                    <button type="submit" class=" search-btn w-100">
                        ZNAJDŹ MIESZKANIE
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>