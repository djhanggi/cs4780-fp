#!/usr/bin/php
<?php

// IMPORTANT! Change this absolute path to one that matches the absolute path to your own version of this
require_once "/Users/vesha/Desktop/cs4780-fp/data_parsing/Loader.php";

$similar_artists = ["Queen", "Bee Gees", "David Bowie", "Pink Floyd", "The Rolling Stones",
                    "Led Zeppelin", "Maroon 5", "Velvet Underground", "Beach Boys", "The Kinks", 
                    "oasis", "blur", "pulp", "the verve", "radiohead", "the byrds", 
                    "siouxsie and the banshees", "the smashing pumpkins", "franz ferdinand", 
                    "nirvana", "coldplay", "greenday", "my bloody valentine", "the chemical brothers", 
                    "u2", "deep purple", "r.e.m", "the cure", "the police", "crosby, stills & nash", 
                    "sufjan stevens", "soundgarden", "tears for fears", "the who", "the doors", 
                    "jimi hendrix", "joe cocker", "keith moon", "peter sellers", "the flaming lips", 
                    "dr. dog", "arctic monkeys", "the pixies", "fleetwood mac", "abba", "buffalo springfield", 
                    "gin blossoms", "the lovin' spoonful", "the rasberies", "the monkees", "the association", 
                    "cream", "eagles", "the hollies", "badfinger", "heart", "billy joel", "jet", "ac/dc", "vampire weekend"];

$different_artists = ["Rick Ross", "Darius Rucker", "Zac Brown Band", "Pitbull", "David Guetta", "Skrillex", "Miles Davis", 
                      "Breaking Benjamin", "Pusha T", "George Gershwin", "hardwell", "tiesto", "avicci", "steve aoki", 
                      "deadmau5", "zedd", "diplo", "krewella", "daft punk", "the chainsmokers", "fashawn", "murs", "nas", 
                      "The Notorius B.I.G", "outkast", "geto boys", "tyler. The creator", 'ke$ha', "big sean", "nicki minaj", 
                      "iggy azalea", "eminem", "rakim", "will smith", "lecrae", "ariana grande", "sia", "lorde", 
                      "black eyed peas", "colbie caillat", "bruno mars", "andrea bocelli", "passenger", "miles davis", 
                      "gregory porter", "daddy yankee", "enrique iglaseas", "three six mafia", "death grips", "brad paisley", 
                      "infected mushroom", "shaq diesel", "mary j blige", "chris brown", "ne-yo", "stevie wonder", "trey sonqz", 
                      "maroon five", "sam smith", "nico&vinz"];

$random_artists = ["Megadeth", "Blink 182", "Taylor Swift", "Guns N Roses", "The Black Keys", "Lil Wayne", "B.o.B.", "Avicii", 
                   "Demi Lovato", "Beyonce", "Ben Howard", "Ben Folds", "Lana Del Rey", "Daughter", "Britney", 
                   "Creedence Clearwater Revival", "Bonobo", "Run the Jewels", "HAIM", "Meghan Trainor", "John Legend", 
                   "Linkin Park", "MGK", "Death Cab for Cutie", "The Strokes", "Marilyn Manson", "Iron Maiden", "Interpol", 
                   "The White Stripes", "royksopp", "modest mouse", "paramore", "birdy", "the national", "joy division", "passion pit", 
                   "katy perry", "pearl jam", "magic!", "the 1975", "30 seconds to mars", "placebo", "tove lo", "caribou", 
                   "crystal castles", "lady gaga", "childish gambino", "mr. probz", "the shins", "madona", "two door cinema club", 
                   "bon jovi", "kasabian", "the lonely island", "nelly furtado", "cam'ron", "kanye west", "biz marke", "lil b", 
                   "sean kingston", "kid ink", "drake", "cris cab", "fall out boy", "panic! At the disco", "twenty one pilots", "kid cudi", 
                   "Dylan Owen", "Hoodie allen", "Jay-Z", "Train", "Jack Johnson", "Caesars"];


$fid = fopen('csv/similar_artists.csv', 'a');
foreach($similar_artists as $artistName) {
    artistSongsToCSV($artistName, $fid);
}
fclose($fid);

$fid = fopen('csv/temp_beatles.csv', 'a');
foreach($different_artists as $artistName) {
    artistSongsToCSV($artistName, $fid);
}
fclose($fid);

$fid = fopen('csv/random_artists.csv', 'a');
foreach($random_artists as $artistName) {
    artistSongsToCSV($artistName, $fid);
}
fclose($fid);

function artistSongsToCSV($artistName, $fid) {
    $url_safe_name = rawurlencode($artistName);
    $getURL = "http://developer.echonest.com/api/v4/artist/search?api_key=VBDIU9VXJEFCEQQ3T&format=json&name=$url_safe_name&results=1";
    $json = file_get_contents($getURL);
    $response = json_decode($json,true);
    $artistID = $response["response"]["artists"][0]["id"];
    $artist = new Artist($artistID);
    $artist->addSongsToCSV($fid);
}
