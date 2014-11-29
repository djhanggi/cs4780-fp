#!/usr/bin/php
<?php
// require_once($_SERVER['DOCUMENT_ROOT']."/Loader.php");

// IMPORTANT! Change this absolute path to one that matches the absolute path to your own version of this
require_once __DIR__."/../../Loader.php";

// CHANGE THIS! This array should contain the names of the artists that you want to pull data for.
$artists = ["Queen", "Bee Gees", "David Bowie", "Pink Floyd", "The Rolling Stones"];

// CHANGE THIS! If you want to store this data in a different .csv file, specify it here. Otherwise
// it will be appended to song_data.csv.
$fid = fopen('csv/song_data.csv', 'a');
foreach($artists as $artistName) {
    artistSongsToCSV($artistName, $fid);
}
fclose($fid);

function artistSongsToCSV($artistName, $fid) {
    $url_safe_name = rawurlencode($artistName);
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&name=$url_safe_name&results=1";
    $json = @file_get_contents($getURL);
    while ($json === FALSE) {
        echo "\nwaiting\n"; // Just so we know SOMETHING is happening
        // Request failed, probably due to rate limit. Wait for a minute (Echo Nest has per-minute limits) and try again
        sleep(60);
        $json = @file_get_contents($getURL);
        var_dump($json);
    } 

    $response = json_decode($json,true);
    if ($response["response"]["artists"]) {
        $artistID = $response["response"]["artists"][0]["id"];
        $artist = new DataParsing_Artist($artistID);
        $artist->addSongsToCSV($fid);
    }       
}
