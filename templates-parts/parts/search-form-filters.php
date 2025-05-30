<?php

// Pobierz wszystkie lokale
$lokale = get_posts([
    'post_type'      => 'lokale',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields'         => 'ids',
]);

$inwestycje = [];
$lokalizacje = [];
$pokoje = [];

if ($lokale) {
    foreach ($lokale as $post_id) {
        $inwestycja = get_field('nazwa_inwestycji', $post_id);
        $lokalizacja = get_field('lokalizacja', $post_id);
        $ilosc_pokoi = get_field('pokoje', $post_id);

        if (!empty($inwestycja)) $inwestycje[] = $inwestycja;
        if (!empty($lokalizacja)) $lokalizacje[] = $lokalizacja;
        if (!empty($ilosc_pokoi) && is_numeric($ilosc_pokoi)) $pokoje[] = (int) $ilosc_pokoi;
    }
}

$inwestycje = array_unique($inwestycje);
sort($inwestycje);

$lokalizacje = array_unique($lokalizacje);
sort($lokalizacje);

$pokoje = array_unique($pokoje);
sort($pokoje, SORT_NUMERIC);


$metraze = [];

if ($lokale) {
    foreach ($lokale as $post_id) {
        $metraz = get_field('metraz', $post_id); // Pobierasz z ACF pole 'metraz'
        if (!empty($metraz) && is_numeric($metraz)) {
            $metraze[] = (float) $metraz;
        }
    }
}

$min_metraz = !empty($metraze) ? min($metraze) : 0;
$max_metraz = !empty($metraze) ? max($metraze) : 100;
?>

<div class="search-container">
    <div class="row">
        <div class="col-12">
            <div class="search-inner">
                <div
                    class="d-flex  flex-wrap justify-content-center justify-content-sm-between align-items-center mb-0 mb-sm-3 ">
                    <div class="search-title mb-0">
                        <h2>Znajdź mieszkanie dla siebie</h2>
                    </div>
                    <div class="search-nav">
                        <a href="#" class="collapse-btn me-3" id="toggleAdvanced">Zwiń</a>
                        <button class="clear-btn">Wyczyść</button>
                    </div>
                </div>

                <div id="advancedSearch">

                    <!-- Inwestycja -->
                    <div class="col-12  col-md-3 col-lg-3 col-xl-3 ps-2 pe-2">
                        <label class="form-label" for="investment">INWESTYCJA</label>
                        <select class="form-select select2" id="investment" name="investment">
                            <option value="">Wszystkie</option>
                            <?php foreach ($inwestycje as $slug): ?>
                                <option value="<?php echo esc_attr($slug); ?>">
                                    <?php echo esc_html($slug); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Lokalizacja -->
                    <div class="col-12 col-md-4 col-lg-4 col-xl-3 ps-2 pe-2">
                        <label class="form-label" for="location">LOKALIZACJA</label>
                        <select class="form-select select2" id="location" name="location">
                            <option value="">Wszystkie</option>
                            <?php foreach ($lokalizacje as $slug): ?>
                                <option value="<?php echo esc_attr($slug); ?>">
                                    <?php echo esc_html($slug); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-12 col-md-4 col-lg-4 col-xl-3 ps-2 pe-2">
                        <label class="form-label" for="status">STATUS</label>
                        <select class="form-select select2" id="status" name="status">
                            <option value="">Wszystkie</option>
                            <option value="1">Dostępne</option>
                            <option value="2">Zarezerwowane</option>
                            <option value="3">Sprzedane</option>
                        </select>
                    </div>

                    <!-- Metraż -->
                    <div class="col-12 col-md-12 col-lg-12 col-xl-3 ps-2 ps-sm-3 pe-3 pe-sm-2">
                        <div class="filter-2">
                            <label class="form-label">METRAŻ [m²]</label>
                            <input type="text" class="js-range-slider" id="metrageRange" name="metrage" value=""
                                data-min="<?php echo esc_attr($min_metraz); ?>"
                                data-max="<?php echo esc_attr($max_metraz); ?>" />
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-12 col-xl-9 ps-2 pe-2 pt-2">
                        <div class="d-flex flex-wrap gap-2 gap-sm-1 gap-md-5 pb-2 pb-sm-0">
                            <!-- Liczba pokoi -->
                            <div>
                                <label class="form-label">LICZBA POKOI</label>
                                <div class="filter-rooms">
                                    <div class="d-flex flex-wrap gap-2">

                                        <?php foreach ($pokoje as $ilosc): ?>
                                            <button class="room-btn btn btn-outline-secondary"
                                                data-rooms="<?php echo esc_attr($ilosc); ?>">
                                                <?php echo esc_html($ilosc); ?>
                                            </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Piętro -->
                            <div>
                                <label class="form-label">PIĘTRO</label>
                                <div class="filter-floors">
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php for ($i = 0; $i <= 5; $i++): ?>
                                            <button class="floor-btn btn btn-outline-secondary"
                                                data-floor="<?php echo $i; ?>">
                                                <?php echo $i; ?>
                                            </button>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- Szukaj -->
                    <div class="col-12 col-md-12 col-lg-12  col-xl-3 ps-2 pe-2">
                        <button class="search-btn js-search-btn w-100 btn btn-primary">
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
        </div>
    </div>

</div>