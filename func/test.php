<?php ?>
// $key='9a13d7dc-be11-4f74-a578-25faf50b7913' ; // $id_product=1614; //
$url='https://www.deweloperserwer.eu/scripts/showproduct.ashx?key=' . $key . '&ID_Product=' . $id_product
. '&FileKind=2&FileType=21' ; // // Pobierz binarne dane obrazu // $image_data=file_get_contents($url); // if
($image_data===false || strlen($image_data) < 100) { // echo "❌ Nie udało się pobrać obrazu lub obraz jest pusty." ; //
    exit; // } // // Zakoduj binarne dane do base64 // $base64=base64_encode($image_data); // // Wyświetl jako <img>
    // echo "<h3>🖼️ Plan lokalu (ID $id_product)</h3>";
    // echo "<img src='data:image/jpeg;base64,{$base64}' style='max-width:400px; border:1px solid #ccc'>";



    // $key = '9a13d7dc-be11-4f74-a578-25faf50b7913';
    // $url = 'http://deweloperserwer.eu/scripts/getproducts.ashx?key=' . $key . '&ID_Investment=3&format=json';
    // $response = file_get_contents($url);

    // echo "<h3>✅ Odpowiedź z API (surowa):</h3>
    <pre>";
// echo htmlspecialchars($response); // pokazujemy oryginalny JSON
// echo "</pre>";


    // // // // Dekodujemy JSON do tablicy PHP
    // $data = json_decode($response, true);

    // // Wyświetlamy tablicę PHP
    // echo "<h3>✅ Dekodowany JSON (tablica PHP):</h3>
    <pre>";
// print_r($data['root']['Products']['Product']); // <-- tu było $response, powinno być $data
// echo "</pre>";