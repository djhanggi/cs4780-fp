#!/usr/bin/php
<?php
require_once __DIR__."/../../Loader.php";

/** Define whatever you want here. You can change:
 * $k
 * $test_csv_file
 * $train_csv_file
 * $transformer
 */

$k = 15;
$test_csv_file = __DIR__."/../../DataParsing/csv/randomSong_data.csv";
$train_csv_file = __DIR__."/../../DataParsing/csv/all_songs.csv";
$transformer = new KNN_VeenasRTransformation();

$test_songs = [];
$file = fopen($test_csv_file, 'r');
if (!$file) {
    exit;
}

$line = fgetcsv($file); // Discard the first line with comments
while (($line = fgetcsv($file)) !== FALSE) {
    if (count($line) === 18) {
        $test_songs[] = DataParsing_Song::withCSVLine($line);
    }
}

$KNN = new KNN_KNN($train_csv_file, $transformer);

$total_prediction_error_dance   = 0;
$total_prediction_error_valence = 0;
$total_prediction_error_energy  = 0;

foreach ($test_songs as $test_song) {
    $KNN->nearest_neighbors->sortSongs($test_song);
    $KNN->findTopK($k);
    $total_prediction_error_dance   += abs($test_song->danceability - $KNN->average_danceability);
    $total_prediction_error_valence += abs($test_song->valence - $KNN->average_valence);
    $total_prediction_error_energy  += abs($test_song->energy - $KNN->average_energy);
}

$average_prediction_error_dance   = $total_prediction_error_dance/count($test_songs);
$average_prediction_error_valence = $total_prediction_error_valence/count($test_songs);
$average_prediction_error_energy  = $total_prediction_error_energy/count($test_songs);



echo "average danceability prediction error: $average_prediction_error_dance\n";
echo "average valence prediction error: $average_prediction_error_valence\n";
echo "average energy prediction error: $average_prediction_error_energy\n";
