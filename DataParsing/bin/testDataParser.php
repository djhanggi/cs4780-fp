#!/usr/bin/php
<?php
require_once __DIR__."/../../Loader.php";

// Uncomment when placed on web. Provides a safe absolute path to Loader.php.
// require_once($_SERVER['DOCUMENT_ROOT']."/Loader.php");

// Useful for seeing the information we retrieve for a song and artist

$songId = 'SOCZMFK12AC468668F';
$song = DataParsing_Song::withID($songId);
var_dump($song);

$artistID = 'ARH6W4X1187B99274F';
$artist = new DataParsing_Artist($artistID);
var_dump($artist);