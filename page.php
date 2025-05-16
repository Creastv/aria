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


// $key = '9a13d7dc-be11-4f74-a578-25faf50b7913';
// $id_investment = 10; // Twoje ID inwestycji
// // $url = 'https://www.dws1.eu/scripts/getproducts.ashx?key=' . $key . '&ID_Investment=' . $id_investment;
// $url = 'http://www.dws1.eu/scripts/getproducts.ashx?key=9a13d7dc-be11-4f74-a578-25faf50b7913&ID_Investment=10&format=json';

// $response = file_get_contents($url);
// $data = json_decode($response, true);
// // var_dump($response);

// echo '<pre>';
// print_r($data);
// echo '</pre>';

get_footer();
