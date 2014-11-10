#!/usr/bin/php
<?php
require_once "/Users/vesha/Desktop/cs4780-fp/data_parsing/Loader.php";

// Useful for seeing the information we retrieve for a song and artist

$songId = 'SOCZMFK12AC468668F';
$song = new Song($songId);
var_dump($song);

$artistID = 'ARH6W4X1187B99274F';
$artist = new Artist($artistID);
var_dump($artist);