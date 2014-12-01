#!/usr/bin/php
<?php
require_once __DIR__."/../../Loader.php";

// $songId = 'SOHPQGF137AD723B2A';
// $song = DataParsing_Song::withID($songId);

$transformer = new KNN_VeenasRTransformation();

$KNN = new KNN_KNN(__DIR__."/../../DataParsing/csv/all_songs.csv", $transformer);
$KNN->searchAndBegin('tik tok', 'ke$ha');
// $KNN->tryNewSongId($songId);

$KNN->findTopK(15);
// echo "\n\n\n\n\n\nFor k=15\n\n\n\n\n\n";
// var_dump($KNN->kNearest);

echo "The danceability for {$KNN->nearest_neighbors->song_to_be_classified->title} " .
     "is: {$KNN->nearest_neighbors->song_to_be_classified->danceability} and we " . 
     "predicted {$KNN->average_danceability}.";

// $KNN->findTopK(10);
// echo "\n\n\n\n\n\nFor k=10\n\n\n\n\n\n";
// var_dump($KNN->kNearest);

// echo "The danceability for {$KNN->nearest_neighbors->song_to_be_classified->title} " .
//      "is: {$KNN->nearest_neighbors->song_to_be_classified->danceability} and we " . 
//      "predicted {$KNN->average_danceability}.";

// $KNN->findTopK(5);
// echo "\n\n\n\n\n\nFor k=5\n\n\n\n\n\n";
// var_dump($KNN->kNearest);

// echo "The danceability for {$KNN->nearest_neighbors->song_to_be_classified->title} " .
//      "is: {$KNN->nearest_neighbors->song_to_be_classified->danceability} and we " . 
//      "predicted {$KNN->average_danceability}.";


// $KNN->findTopK(1);
// echo "\n\n\n\n\n\nFor k=1\n\n\n\n\n\n";
// var_dump($KNN->kNearest);

// echo "The danceability for {$KNN->nearest_neighbors->song_to_be_classified->title} " .
//      "is: {$KNN->nearest_neighbors->song_to_be_classified->danceability} and we " . 
//      "predicted {$KNN->average_danceability}.";
