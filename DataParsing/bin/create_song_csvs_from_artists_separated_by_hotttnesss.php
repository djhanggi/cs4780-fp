#!/usr/bin/php
<?php

require_once __DIR__."/../../Loader.php";

// If you want to store this data in a different .csv file, specify it here. Otherwise
// it will be appended to song_data.csv.
$fid = fopen('../csv/new_song_data.csv', 'a');

pullArtists($fid);

fclose($fid);

function pullArtists($fid) {
    $artists = [];
    // hotttnesss [0.95, 0.99]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.99&min_hotttnesss=0.95&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.97, 0.99]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.99&min_hotttnesss=0.97&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.95, 0.969]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.969&min_hotttnesss=0.95&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.92, 0.949]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.949&min_hotttnesss=0.92&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.90, 0.919]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.919&min_hotttnesss=0.90&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.87, 0.89]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.89&min_hotttnesss=0.87&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.85, 0.869]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.869&min_hotttnesss=0.85&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.82, 0.849]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.849&min_hotttnesss=0.82&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.80, 0.819]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.819&min_hotttnesss=0.80&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.77, 0.79]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.79&min_hotttnesss=0.77&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.75, 0.769]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.769&min_hotttnesss=0.75&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.72, 0.749]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.749&min_hotttnesss=0.72&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.70, 0.719]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.719&min_hotttnesss=0.70&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.67, 0.69]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.69&min_hotttnesss=0.67&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.65, 0.669]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.669&min_hotttnesss=0.65&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.62, 0.649]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.649&min_hotttnesss=0.62&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.60, 0.619]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.619&min_hotttnesss=0.60&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.57, 0.59]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.59&min_hotttnesss=0.57&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.50, 0.519]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.519&min_hotttnesss=0.50&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.47, 0.49]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.49&min_hotttnesss=0.47&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.45, 0.469]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.469&min_hotttnesss=0.45&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.42, 0.449]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.449&min_hotttnesss=0.42&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.40, 0.419]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.419&min_hotttnesss=0.40&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.37, 0.39]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.39&min_hotttnesss=0.37&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.35, 0.369]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.369&min_hotttnesss=0.35&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.32, 0.349]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.349&min_hotttnesss=0.32&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.30, 0.319]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.319&min_hotttnesss=0.30&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.27, 0.29]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.29&min_hotttnesss=0.27&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.25, 0.269]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.269&min_hotttnesss=0.25&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.22, 0.249]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.249&min_hotttnesss=0.22&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.20, 0.219]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.219&min_hotttnesss=0.20&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.17, 0.19]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.19&min_hotttnesss=0.17&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.15, 0.169]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.169&min_hotttnesss=0.15&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.12, 0.149]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.149&min_hotttnesss=0.12&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.10, 0.119]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.119&min_hotttnesss=0.10&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.07, 0.09]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.09&min_hotttnesss=0.07&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.05, 0.069]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.069&min_hotttnesss=0.05&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.02, 0.049]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.049&min_hotttnesss=0.02&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    // hotttnesss [0.00, 0.019]
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&max_hotttnesss=0.019&min_hotttnesss=0.00&results=100";
    $json = @file_get_contents($getURL);
    $response = json_decode($json, true);
    $artists = array_merge($artists, $response["response"]["artists"]);
    var_dump($artists);
    pullArtistsFromJSON($artists, $fid);
}

function pullArtistsFromJSON($artists, $fid) {
    foreach ($artists as $artist) {
        $artistID = $artist["id"];
        $artist = new DataParsing_Artist($artistID);
        $artist->addSongsToCSV($fid);
    }
}
