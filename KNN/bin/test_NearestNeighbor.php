#!/usr/bin/php
<?php
require_once __DIR__."/../../Loader.php";

$songId = 'SOJNMDQ144BD204420';
$song = DataParsing_Song::withID($songId);
// echo "Song that needs to be classified:\n";
// var_dump($song);

$transformer = new KNN_VeenasRTransformation();

$knn_nn = new KNN_NearestNeighbor(__DIR__."/../../DataParsing/csv/dance_6to7_data.csv");
$knn_nn->setTransformer($transformer);
$knn_nn->setAllXandY("functionX", "functionY");
$knn_nn->sortSongs($song);

$best_match = $knn_nn->getKNearest(1)[0];
echo "\nThe best match for {$song->title} is {$best_match->title}.\n";
var_dump($best_match);
