<?php

// function import_lokale_links($id_inwestycji = null, $lokalizacja = null)
function import_lokale_links()
{
    $id_inwestycji = 10;
    $lokalizacja = 'Legionowo';
    $key = '9a13d7dc-be11-4f74-a578-25faf50b7913';
    $url = 'http://deweloperserwer.eu/scripts/getproducts.ashx?key=' . $key . '&ID_Investment=' . $id_inwestycji . '&format=json';

    $response = wp_remote_get($url, ['timeout' => 20]);

    if (is_wp_error($response)) {
        echo 'Błąd połączenia: ' . $response->get_error_message();
        return;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    if (empty($data['root']['Products'])) {
        echo 'Brak produktów';
        return;
    }

    foreach ($data['root']['Products']['Product'] as $lokal) {
        $crm_id = $lokal['ID_Product'];
        $name = $lokal['ProductsKindTitle'] === "Lokal mieszkalny" ? "Mieszkanie" : $lokal['ProductsKindTitle'];
        $tytul =  $name . ' ' . $lokal['Number'];

        // Sprawdzenie, czy lokal już istnieje
        $existing = get_posts([
            'post_type' => 'lokale',
            'meta_query' => [
                [
                    'key'     => 'id_crm',
                    'value'   => (string) $crm_id,
                    'compare' => '=',
                ]
            ],
            'posts_per_page' => 1,
            'fields' => 'ids',
        ]);

        if ($existing) {
            echo 'Lokal ' . $crm_id . ' już istnieje – pominięto<br>';
            continue;
        }

        $post_id = wp_insert_post([
            'post_title'   => $tytul,
            'post_type'    => 'lokale',
            'post_status'  => 'publish',
        ]);

        if (is_wp_error($post_id)) {
            echo 'Błąd przy zapisie lokalu ID ' . $crm_id . ': ' . $post_id->get_error_message() . '<br>';
            continue;
        }

        // Meta dane
        update_field('lokalizacja', $lokalizacja, $post_id);
        update_field('id_crm', $lokal['ID_Product'], $post_id);
        update_field('id_inwestycji', $lokal['ID_Investment'], $post_id);
        update_field('nazwa_inwestycji', $lokal['InvestmentTitle'], $post_id);
        update_field('etap_inwestycji', $lokal['StageTitle'], $post_id);
        update_field('id_lokalu', $lokal['ID_Product'], $post_id);
        update_field('numer_lokalu', $lokal['Number'], $post_id);
        update_field('typ_lokalu', $lokal['ProductsKindTitle'], $post_id);
        update_field('nazwa_lokalu', $lokal['Title'], $post_id);
        update_field('klatka', $lokal['Stairway'], $post_id);
        update_field('budynek', $lokal['Stairway'], $post_id);
        update_field('pietro', $lokal['FloorNumber'], $post_id);
        update_field('metraz', $lokal['ConArea'], $post_id);
        update_field('pokoje', $lokal['Rooms'], $post_id);
        update_field('status', $lokal['ID_ProductStatus'], $post_id);
        update_field('cena', $lokal['TotalOfferBrutto'], $post_id);

        echo '✅ Dodano lokal: ' . $tytul . ' (ID: ' . $post_id . ')<br>';

        // Balkon (jeśli występuje)
        $supplements = $lokal['ProductSupplements']['Supplement'];
        if (isset($supplements[0])) {
            foreach ($supplements as $supplement) {
                if ($supplement['ProductsKindTitle'] === 'Balkon') {
                    update_field('rozmiar_balkonu', $supplement['Area'], $post_id);
                    break;
                }
            }
        } elseif (isset($supplements['ProductsKindTitle']) && $supplements['ProductsKindTitle'] === 'Balkon') {
            update_field('rozmiar_balkonu', $supplements['Area'], $post_id);
        }

        // Zdjęcia (2D/3D)
        if (isset($lokal['Pictures'])) {
            $upload_base = wp_upload_dir();
            $upload_dir  = trailingslashit($upload_base['basedir']) . 'plany/';
            $upload_url  = trailingslashit($upload_base['baseurl']) . 'plany/';

            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $context = stream_context_create(['http' => ['timeout' => 5]]);
            $prefix = isset($lokal['InvestmentTitle']) ? sanitize_title($lokal['InvestmentTitle']) : 'inwestycja';

            // 2D
            $filename_2d = $prefix . '_plan_' . $crm_id . '.jpg';
            $filepath_2d = $upload_dir . $filename_2d;
            $fileurl_2d  = $upload_url . $filename_2d;
            $plan2d_url = 'https://www.deweloperserwer.eu/scripts/showproduct.ashx?key=' . urlencode($key) .
                '&ID_Product=' . urlencode($crm_id) . '&FileKind=2&FileType=4';
            $plan2d_data = @file_get_contents($plan2d_url, false, $context);

            if ($plan2d_data !== false && strlen($plan2d_data) > 100) {
                $do_save_2d = true;

                if (file_exists($filepath_2d)) {
                    $existing_hash = md5_file($filepath_2d);
                    $new_hash = md5($plan2d_data);
                    if ($existing_hash === $new_hash) {
                        $do_save_2d = false;
                        echo "⏭️ RZUT 2D: Pominięto zapis – plik identyczny dla ID CRM: $crm_id<br>";
                    }
                }

                if ($do_save_2d) {
                    file_put_contents($filepath_2d, $plan2d_data);
                    update_field('rzut_2d', $fileurl_2d, $post_id);
                    echo "🖼️ RZUT 2D: Zapisano nowy plik dla ID CRM: $crm_id<br>";
                }
            } else {
                echo "⚠️ RZUT 2D: Brak planu lub nie można pobrać dla ID CRM: $crm_id<br>";
            }

            // 3D
            $filename_3d = $prefix . '_plan3d_' . $crm_id . '.jpg';
            $filepath_3d = $upload_dir . $filename_3d;
            $fileurl_3d  = $upload_url . $filename_3d;
            $plan3d_url = 'https://www.deweloperserwer.eu/scripts/showproduct.ashx?key=' . urlencode($key) .
                '&ID_Product=' . urlencode($crm_id) . '&FileKind=2&FileType=21';
            $plan3d_data = @file_get_contents($plan3d_url, false, $context);

            if ($plan3d_data !== false && strlen($plan3d_data) > 100) {
                $do_save_3d = true;

                if (file_exists($filepath_3d)) {
                    $existing_hash = md5_file($filepath_3d);
                    $new_hash = md5($plan3d_data);
                    if ($existing_hash === $new_hash) {
                        $do_save_3d = false;
                        echo "⏭️ RZUT 3D: Pominięto zapis – plik identyczny dla ID CRM: $crm_id<br>";
                    }
                }

                if ($do_save_3d) {
                    file_put_contents($filepath_3d, $plan3d_data);
                    update_field('rzut_3d', $fileurl_3d, $post_id);
                    echo "🖼️ RZUT 3D: Zapisano nowy plik dla ID CRM: $crm_id<br>";
                }
            } else {
                echo "⚠️ RZUT 3D: Brak planu lub nie można pobrać dla ID CRM: $crm_id<br>";
            }
        }
    }

    echo '<br><strong>✅ Import zakończony!</strong>';
    exit;
}

// add_action('init', function () {
//     if (isset($_GET['import_local']) && $_GET['import_local'] === '1') {
//         $id_inwestycji = isset($_GET['id_inwestycji']) ? sanitize_text_field($_GET['id_inwestycji']) : null;
//         $lokalizacja   = isset($_GET['lokalizacja']) ? sanitize_text_field($_GET['lokalizacja']) : null;
//         import_lokale_links($id_inwestycji, $lokalizacja);
//     }
// });

add_action('init', function () {
    if (isset($_GET['import_local']) && $_GET['import_local'] === '1') {
        import_lokale_links();
        exit;
    }
});


// Odświerzanie lokali statusy
add_action('init', function () {
    aktualizuj_statusy_lokali_z_crm();
});

function aktualizuj_statusy_lokali_z_crm()
{
    // ✅ Sprawdź, czy aktualizacja była niedawno – jeśli tak, pomiń
    if (false !== get_transient('lokale_statusy_zaktualizowane')) {
        error_log('⏳ Aktualizacja statusów pominięta – transient aktywny');
        return;
    }

    error_log('🔥 START: aktualizacja statusów');

    $key = '9a13d7dc-be11-4f74-a578-25faf50b7913';
    $url = 'https://www.deweloperserwer.eu/scripts/getproducts.ashx?key=' . $key . '&format=json&ShowAll=1';

    $response = wp_remote_get($url, ['timeout' => 15]);

    if (is_wp_error($response)) {
        error_log('❌ Błąd połączenia z API: ' . $response->get_error_message());
        return;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    if (empty($data['root']['Products']['Product'])) {
        error_log('⚠️ Brak produktów w odpowiedzi API');
        error_log(print_r($data, true));
        return;
    }

    foreach ($data['root']['Products']['Product'] as $lokal) {
        $crm_id = $lokal['ID_Product'];
        $status = $lokal['ID_ProductStatus'];

        $existing = get_posts([
            'post_type' => 'lokale',
            'meta_query' => [
                [
                    'key'     => 'id_crm',
                    'value'   => (string) $crm_id,
                    'compare' => '=',
                ]
            ],
            'posts_per_page' => 1,
            'fields' => 'ids',
        ]);

        if ($existing) {
            $post_id = $existing[0];
            update_field('status', $status, $post_id);
            error_log("✅ Zaktualizowano status lokalu CRM ID {$crm_id} → {$status} (post ID: {$post_id})");
        } else {
            error_log("⚠️ Nie znaleziono lokalu z id_crm: {$crm_id}");
        }
    }

    // ✅ Ustaw transient – ważny przez 5 minut
    set_transient('lokale_statusy_zaktualizowane', true, 1 * MINUTE_IN_SECONDS);

    error_log('🏁 KONIEC aktualizacji statusów');
}

// ✅ Dodaj przycisk do górnego paska admina
add_action('admin_bar_menu', function ($wp_admin_bar) {
    if (!current_user_can('manage_options') || is_admin()) return;

    $args = [
        'id'    => 'update_lokale_statusy',
        'title' => '🔄 Aktualizuj statusy lokali',
        'href'  => add_query_arg('force_update_lokale', '1', home_url()),
        'meta'  => ['title' => 'Wymuś aktualizację statusów z CRM']
    ];
    $wp_admin_bar->add_node($args);
}, 100);

// ✅ Obsługa przycisku – wykonaj aktualizację przy wejściu z parametrem
add_action('init', function () {
    if (isset($_GET['force_update_lokale']) && current_user_can('manage_options')) {
        delete_transient('lokale_statusy_zaktualizowane');
        error_log('🔁 Transient skasowany ręcznie – trwa natychmiastowa aktualizacja');
        aktualizuj_statusy_lokali_z_crm();
        wp_die('✅ Statusy lokali zostały zaktualizowane. <a href="' . home_url('/lokale/') . '">Powrót</a>');
    }
});
