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

// $lokale = new WP_Query([
//     'post_type'  => 'lokale',
//     'meta_query' => [
//         [
//             'key'     => 'status',
//             'value'   => 1,
//             'compare' => '=',
//             'type'    => 'NUMERIC'
//         ]
//     ]
// ]);

// if ($lokale->have_posts()) {
//     echo 'Znaleziono lokale ze statusem 1!';
// } else {
//     echo 'Brak lokali ze statusem 1.';
// }



$key = '9a13d7dc-be11-4f74-a578-25faf50b7913';
$id_product = 1614;

$url = 'https://www.deweloperserwer.eu/scripts/showproduct.ashx?key=' . $key . '&ID_Product=' . $id_product . '&FileKind=2&FileType=21';

// Pobierz binarne dane obrazu
$image_data = file_get_contents($url);

if ($image_data === false || strlen($image_data) < 100) {
    echo "❌ Nie udało się pobrać obrazu lub obraz jest pusty.";
    exit;
}

// Zakoduj binarne dane do base64
$base64 = base64_encode($image_data);

// Wyświetl jako <img>
echo "<h3>🖼️ Plan lokalu (ID $id_product)</h3>";
echo "<img src='data:image/jpeg;base64,{$base64}' style='max-width:400px; border:1px solid #ccc'>";



$key = '9a13d7dc-be11-4f74-a578-25faf50b7913';

$url = 'http://deweloperserwer.eu/scripts/getproducts.ashx?key=' . $key . '&ID_Investment=3&format=json';
// $key = '9a13d7dc-be11-4f74-a578-25faf50b7913';
// $url = 'https://www.deweloperserwer.eu/scripts/getproducts.ashx?key=' . $key . '&format=json&ShowAll=1';
$response = file_get_contents($url);

if ($response === false) {
    echo "❌ Błąd podczas pobierania danych.";
    exit;
}

echo "<h3>✅ Odpowiedź z API (surowa):</h3><pre>";
echo htmlspecialchars($response); // pokazujemy oryginalny JSON
echo "</pre>";


// // Dekodujemy JSON do tablicy PHP
$data = json_decode($response, true);

// Wyświetlamy tablicę PHP
echo "<h3>✅ Dekodowany JSON (tablica PHP):</h3><pre>";
print_r($data['root']['Products']['Product']); // <-- tu było $response, powinno być $data
echo "</pre>";

// if (!empty($data['Products'])) {
//     echo "<h3>✅ Produkty:</h3>";
//     foreach ($data['Products'] as $product) {
//         echo "<strong>Lokal:</strong> " . $product['Title'] . " — " . $product['InvestmentTitle'] . "<br>";
//     }
// } else {
//     echo "<p>⚠️ Brak danych w \$data['Products'].</p>";
// }

get_footer();
