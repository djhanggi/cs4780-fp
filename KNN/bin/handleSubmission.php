<?php

require_once __DIR__."/../../Loader.php";

if (isset($_POST['artist_name']) && isset($_POST['song_name'])) {
    $song_name = htmlentities($_POST['song_name']);
    $artist_name = htmlentities($_POST['artist_name']);
    $transformer = new KNN_VeenasRTransformation();

    $KNN = new KNN_KNN(__DIR__."/../../DataParsing/csv/all_songs.csv", $transformer);
    $KNN->searchAndBegin($song_name, $artist_name);

    $KNN->findTopK(15);
    echo json_encode($KNN);
} else {
    echo("failure");
}