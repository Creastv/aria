<?php
function import_lokale_links()
{
    $key = 'b7409fb0-88d1-4bae-b834-bfaaf7648fd8';
    $id_investment = 1; // <-- Twoje ID inwestycji
    $url = 'https://www.dws1.eu/scripts/getproducts.ashx?key=' . $key . '&format=json&ShowAll=1';


    // $key = '9a13d7dc-be11-4f74-a578-25faf50b7913';
    // $id_investment = 10; // Twoje ID inwestycji
    // $url = 'https://www.dws1.eu/scripts/getproducts.ashx?key=' . $key . '&format=json&ShowAll=1&InvestmentID=' . $id_investment;

    $response = wp_remote_get($url, ['timeout' => 20]);
    $data = json_decode(wp_remote_retrieve_body($response), true);


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
        $name = $lokal['ProductsKindTitle'];
        if ($lokal['ProductsKindTitle'] == "Lokal mieszkalny"):
            $name = "Mieszkanie";
        endif;
        $tytul =  $name . ' ' . $lokal['Number'];

        // Sprawdzenie, czy lokal już istnieje
        $existing = get_posts([
            'post_type' => 'lokale',
            'meta_key' => 'crm_id',
            'meta_value' => $crm_id,
            'posts_per_page' => 1,
            'fields' => 'ids',
        ]);

        if ($existing) {
            echo 'Lokal ' . $crm_id . ' już istnieje – pominięto<br>';
            continue;
        }

        $post_id = wp_insert_post([
            'post_title' => $tytul,
            'post_type' => 'lokale',
            'post_status' => 'publish',
        ]);

        if (is_wp_error($post_id)) {
            echo 'Błąd przy zapisie lokalu ID ' . $crm_id . ': ' . $post_id->get_error_message() . '<br>';
            continue;
        }

        // Meta dane
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
        echo 'Dodano lokal: ' . $tytul . ' (ID: ' . $post_id . ')<br>';


        $supplements =  $lokal['ProductSupplements']['Supplement'];

        if (isset($supplements[0])) {
            // Wiele dodatków
            foreach ($supplements as $supplement) {
                if ($supplement['ProductsKindTitle'] === 'Balkon') {
                    // $balcony_area = $supplement['Area'];
                    update_field('rozmiar_balkonu', $supplement['Area'], $post_id);
                    break;
                }
            }
        } else {
            // Jeden dodatek
            if ($supplements['ProductsKindTitle'] === 'Balkon') {
                // $balcony_area = $supplements['Area'];
                update_field('rozmiar_balkonu', $supplements['Area'], $post_id);
            }
        }
    }

    echo '<br><strong>Import zakończony!</strong>';
    exit;
}

add_action('init', function () {
    if (isset($_GET['import_local']) && $_GET['import_local'] === '1') {
        import_lokale_links();
        exit;
    }
});





function import_crm_featured_images_for_lokale()
{
    $key = 'b7409fb0-88d1-4bae-b834-bfaaf7648fd8';

    // Pobieramy wszystkie lokale z meta key 'crm_id'
    $lokale = get_posts([
        'post_type'      => 'lokale',
        'posts_per_page' => -1,
        'meta_key'       => 'crm_id',
        'fields'         => 'ids',
    ]);

    if (empty($lokale)) {
        echo 'Brak lokali do aktualizacji zdjęć.<br>';
        return;
    }

    foreach ($lokale as $post_id) {
        $crm_id = get_post_meta($post_id, 'crm_id', true);

        if (!$crm_id) continue;

        // Pobieramy Wizualizację 1 (FileType=2)
        $image_url = 'https://www.dws1.eu/scripts/showproduct.ashx?key=' . $key . '&ID_Product=' . $crm_id . '&FileKind=2&FileType=2';

        // Pobieramy obrazek z CRM
        $response = wp_remote_get($image_url, ['timeout' => 30]);
        if (is_wp_error($response)) {
            echo 'Błąd pobierania zdjęcia dla CRM ID ' . $crm_id . ': ' . $response->get_error_message() . '<br>';
            continue;
        }

        $image_data = wp_remote_retrieve_body($response);
        if (empty($image_data)) {
            echo 'Brak zdjęcia dla CRM ID ' . $crm_id . '<br>';
            continue;
        }

        // Zapisujemy obrazek do WordPressa
        $upload_dir = wp_upload_dir();
        $filename = 'lokal_' . $crm_id . '_wizualizacja.jpg';
        $file_path = $upload_dir['path'] . '/' . $filename;

        file_put_contents($file_path, $image_data);

        // Dodajemy obrazek do biblioteki mediów
        $attachment = [
            'post_mime_type' => 'image/jpeg',
            'post_title'     => sanitize_file_name($filename),
            'post_content'   => '',
            'post_status'    => 'inherit'
        ];

        $attach_id = wp_insert_attachment($attachment, $file_path, $post_id);
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
        wp_update_attachment_metadata($attach_id, $attach_data);

        // Ustawiamy jako zdjęcie wyróżniające
        set_post_thumbnail($post_id, $attach_id);

        echo 'Ustawiono wizualizację jako zdjęcie wyróżniające dla lokalu ID ' . $post_id . ' (CRM ID: ' . $crm_id . ')<br>';
    }

    echo '<br><strong>Import zdjęć zakończony!</strong>';
    exit;
}

add_action('init', function () {
    if (isset($_GET['import_zdjecia']) && $_GET['import_zdjecia'] === '1') {
        import_crm_featured_images_for_lokale();
        exit;
    }
});
