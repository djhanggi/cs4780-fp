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

# Define any new training files using the convention <number_of_songs>_songs.csv
$train_csv_files = ["9000_songs.csv"];
foreach ($train_csv_files as $train_csv_file) {
    $file = __DIR__."/../../DataParsing/csv/".$train_csv_file;
    $num_samples = explode('_', $train_csv_file)[0] . "\n";
    run_test_with_file($num_samples, $k, $test_csv_file, $file, $transformer, $test_songs);
}


function run_test_with_file($num_samples, $k, $test_csv_file, $train_csv_file, $transformer, $test_songs) {
    $KNN = new KNN_KNN($train_csv_file, $transformer);

    $total_prediction_error_dance   = 0;
    $total_prediction_error_valence = 0;
    $total_prediction_error_energy  = 0;
    $start_time = microtime(True);

    foreach ($test_songs as $test_song) {
        $KNN->nearest_neighbors->sortSongs($test_song, True);
        $KNN->findTopK($k);
        $total_prediction_error_dance   += abs($test_song->danceability - $KNN->average_danceability);
        $total_prediction_error_valence += abs($test_song->valence - $KNN->average_valence);
        $total_prediction_error_energy  += abs($test_song->energy - $KNN->average_energy);
    }

    $average_prediction_error_dance   = $total_prediction_error_dance/count($test_songs);
    $average_prediction_error_valence = $total_prediction_error_valence/count($test_songs);
    $average_prediction_error_energy  = $total_prediction_error_energy/count($test_songs);
    $execute_time_features = microtime(True) - $start_time;

    $KNN = new KNN_KNN($train_csv_file, $transformer);

    $total_prediction_error_dance_transformation   = 0;
    $total_prediction_error_valence_transformation = 0;
    $total_prediction_error_energy_transformation  = 0;
    $start_time = microtime(True);

    foreach ($test_songs as $test_song) {
        $KNN->nearest_neighbors->sortSongs($test_song);
        $KNN->findTopK($k);
        $total_prediction_error_dance_transformation   += abs($test_song->danceability - $KNN->average_danceability);
        $total_prediction_error_valence_transformation += abs($test_song->valence - $KNN->average_valence);
        $total_prediction_error_energy_transformation  += abs($test_song->energy - $KNN->average_energy);
    }

    $average_prediction_error_dance_transformation   = $total_prediction_error_dance_transformation/count($test_songs);
    $average_prediction_error_valence_transformation = $total_prediction_error_valence_transformation/count($test_songs);
    $average_prediction_error_energy_transformation  = $total_prediction_error_energy_transformation/count($test_songs);
    $execute_time_transformation = microtime(True) - $start_time;

    echo "With $num_samples training samples\n";

    echo "Without Transformation:\n";
    echo "Execution time: $execute_time_features\n";
    echo "average danceability prediction error: $average_prediction_error_dance\n";
    echo "average valence prediction error: $average_prediction_error_valence\n";
    echo "average energy prediction error: $average_prediction_error_energy\n";


    echo "With Transformation:\n";
    echo "Execution time: $execute_time_transformation\n";
    echo "average danceability prediction error: $average_prediction_error_dance_transformation\n";
    echo "average valence prediction error: $average_prediction_error_valence_transformation\n";
    echo "average energy prediction error: $average_prediction_error_energy_transformation\n";
}
