<?php

$csv_filename = __DIR__."/../csv/song_artist.csv";
$write_filename = __DIR__."/../csv/genres.csv";

$song_artists = [];
$file = fopen($csv_filename, 'r');
$handle = fopen($write_filename, 'w');
while (($line = fgetcsv($file)) !== FALSE) {
    $url = create_URL($line[1]);
    $genre = find_genre($url);
    $line[2] = $genre;
    fputcsv($handle, $line);
}
fclose($file);
fclose($handle);

function find_genre($url) {
    $json = @file_get_contents($url); //suppress any warnings. If we fail, just wait a minute
    $response = json_decode($json,true);
    if ($response["resultCount"] === 0) {
        // Handle failed attempt
        return '';
    }
    return $response["results"][0]["primaryGenreName"];
}

function create_URL($artist) {
    $artist = rawurlencode($artist);
    return "https://itunes.apple.com/search?term=$artist&entity=allArtist&attribute=allArtistTerm&limit=1";
}