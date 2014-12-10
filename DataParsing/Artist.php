<?php

require_once __DIR__."/../Loader.php";

class DataParsing_Artist {

    /** @var int */
    public $artistId;

    /** @var string */
    public $artistName;

    /** @var float */
    public $familiarity;

    /** @var DataParsing_Term[] */
    public $terms;

    /** @var DataParsing_Song[] */
    public $songs;

    public function __construct($artistId) {
        $this->artistId = $artistId;
        $getURL = $this->createURL($artistId);
        $json = @file_get_contents($getURL); //suppress any warnings. If we fail, just wait a minute
        while ($json === FALSE) {
            echo("\nwaiting\n");
            // Request failed, probably due to rate limit. Wait for a minute (Echo Nest has per-minute limits) and try again
            sleep(60);
            $json = @file_get_contents($getURL);
        }
        $response = json_decode($json,true);
        $this->processGETResponse($response);
    }

    private function processGETResponse($response) {
        if ($response && $response["response"]["status"]["message"] === 'Success') {
            // GET request was successful. We can continue processing this data
            $artist = $response["response"]["artist"];

            $this->artistName = $artist["name"];

            $this->familiarity = $artist["familiarity"];

            // DataParsing_Term[] creation
            $this->terms = [];
            foreach ($artist["terms"] as $term_array) {
                $this->terms[] = new DataParsing_Term($term_array);
            }

            /** 
             * DataParsing_Song[] creation. There should only be 15 iterations--the 
             * song array returned by Echo Nest holds up to 15 songs. This 
             * won't be instantaneous--each of the songs will fire off another
             * GET request for more information about the song.
             */
            $this->ignoreDuplicateSongs($artist["songs"]);

        } else {
            // Err. Something went wrong. Display the error.
            echo "\n".$response["response"]["status"]["message"]."\n";
        }
    }

    /**
     * The Echo Nest API returns duplicate songs when bucketing artist songs.
     * This allows us to reduce the amount of duplicate data/reduce the number of
     * unnecessary GET requests.
     * @param array $songs, the song array returned from the song/artist bucket
     */
    private function ignoreDuplicateSongs($songs) {
        $unique_songs = [];
        foreach ($songs as $song) {
            $title = preg_replace('/[^a-z]+/i', '', strtolower($song["title"]));
            if (!in_array($title, $unique_songs)) {
                $unique_songs[] = $title;
                $this->songs[] = DataParsing_Song::withID($song["id"]);
            }
        }
    }

    /**
     * Returns the url for the EchoNest GET request for information on a given artist
     * @param String $artistId
     * @return String (url)
     */
    private function createURL($artistId) {
        return "http://developer.echonest.com/api/v4/artist/profile?".
               "api_key=".DataParsing_APIKeys::CURRENT_KEY."&id=$artistId&format=json".
               "&bucket=familiarity&bucket=hotttnesss&bucket=terms&bucket=songs";
   }

    /**
     * Formats each song from this artist into a line and appends it to the end of the provided .csv file.
     * The file associated with $handle is assumed to be open (and close cannot have been called yet) 
     * at the time this method is invoked.
     * @param resource $handle
     * @return bool | true if line successfully appended to csv, false otherwise
     */
    public function addSongsToCSV($handle) {
        if ($this->songs) {
            foreach ($this->songs as $song) {
                $song->addToCSV($handle);
            }
        }
    }
}