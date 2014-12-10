#!/usr/bin/php
<?php
require_once __DIR__."/../../Loader.php";

$transformer = new KNN_VeenasRTransformation();

$KNN = new KNN_KNN(__DIR__."/../../DataParsing/csv/all_songs.csv", $transformer);
$KNN->searchAndBegin('tik tok', 'ke$ha');

$KNN->findTopK(15);

echo "The danceability for {$KNN->nearest_neighbors->song_to_be_classified->title} " .
     "is: {$KNN->nearest_neighbors->song_to_be_classified->danceability} and we " . 
     "predicted {$KNN->average_danceability}.";
