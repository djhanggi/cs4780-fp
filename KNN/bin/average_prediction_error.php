#!/usr/bin/php
<?php
require_once __DIR__."/../../Loader.php";

/** Define whatever you want here. You can change:
 * $k
 * $test_csv_file
 * $train_csv_file
 * $transformer
 */

set_time_limit(0);

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


for ($k = 1; $k <= 25; $k++) {
	$total_prediction_error_dance   = 0;
	$total_prediction_error_valence = 0;
	$total_prediction_error_energy  = 0;
   foreach ($test_songs as $test_song) {
    $KNN->nearest_neighbors->sortSongs($test_song);
    $KNN->findTopK($k);
    $total_prediction_error_dance   += pow(($test_song->danceability - $KNN->average_danceability),2);
    $total_prediction_error_valence += pow(($test_song->valence - $KNN->average_valence),2);
    $total_prediction_error_energy  += pow(($test_song->energy - $KNN->average_energy),2);
}

$average_prediction_error_dance   = sqrt($total_prediction_error_dance/count($test_songs));
$average_prediction_error_valence = sqrt($total_prediction_error_valence/count($test_songs));
$average_prediction_error_energy  = sqrt($total_prediction_error_energy/count($test_songs));


echo  " ---------------------". $k . " ---------------------\n";
echo "average danceability prediction error: $average_prediction_error_dance\n";
echo "average valence prediction error: $average_prediction_error_valence\n";
echo "average energy prediction error: $average_prediction_error_energy\n";
echo "<br> <br>";

} 
