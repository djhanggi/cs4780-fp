<?php
require_once "Loader.php";
class Song {

    /** @var String */
    public $songId;

    /** @var String */
    public $title;

    /** @var String */
    public $artist_name;

    /** @var String */
    public $artist_id;

    /** @var String */
    public $song_type;

    /** @var int */
    public $key;

    /** @var float */
    public $energy;

    /** @var float */
    public $liveness;

    /** @var float */
    public $tempo;

    /** @var float */
    public $speechiness;

    /** @var float */
    public $acousticness;

    /** @var float */
    public $instrumentalness;

    /** @var float */
    public $mode;

    /** @var int */
    public $time_signature;

    /** @var float */
    public $duration;

    /** @var float */
    public $loudness;

    /** @var float */
    public $valence;

    /** @var float */
    public $danceability;

    /**
     * Queries EchoNest API to retrieve song data
     * @param int $songId
     */
    public function __construct($songId) {
        $this->songId = $songId;
        $getURL = $this->createURL($songId);
        $json = @file_get_contents($getURL); //suppress any warnings. If we fail, just wait a minute
        while ($json === FALSE) {
            echo "\nwaiting\n";
            // Request failed, probably due to rate limit. Wait for a minute (Echo Nest has per-minute limits) and try again
            sleep(60);
            $json = @file_get_contents($getURL);
        }
        $response = json_decode($json,true);
        $this->processGETResponse($response);
    }

    /**
     * Sets the fields of a song instance using the
     * response of a GET request
     * @param json decoded array $response
     * @return null
     */
    private function processGETResponse($response) {
        $song_info = $response["response"]["songs"][0];
        $this->title = $song_info["title"];
        $this->artist_name = $song_info["artist_name"];
        $this->song_type = implode(', ', $song_info["song_type"]);
        $this->artist_id = $song_info["artist_id"];

        $audio_summary_array = $song_info["audio_summary"];
        $this->key = $audio_summary_array["key"];
        $this->energy = $audio_summary_array["energy"];
        $this->liveness = $audio_summary_array["liveness"];
        $this->tempo = $audio_summary_array["tempo"];
        $this->speechiness = $audio_summary_array["speechiness"];
        $this->acousticness = $audio_summary_array["acousticness"];
        $this->instrumentalness = $audio_summary_array["instrumentalness"];
        $this->mode = $audio_summary_array["mode"];
        $this->time_signature = $audio_summary_array["time_signature"];
        $this->duration = $audio_summary_array["duration"];
        $this->loudness = $audio_summary_array["loudness"];
        $this->valence = $audio_summary_array["valence"];
        $this->danceability = $audio_summary_array["danceability"];
    }


    /**
     * Returns the url for the EchoNest GET request for information on a given song
     * @param String $songId
     * @return String (url)
     */
    private function createURL($songId) {
        return "http://developer.echonest.com/api/v4/song/profile?api_key=".APIKeys::CURRENT_KEY."&format=json&id=$songId".
        "&bucket=audio_summary&bucket=artist_discovery&bucket=artist_discovery_rank&bucket=artist_familiarity".
        "&bucket=artist_familiarity_rank&bucket=artist_hotttnesss&bucket=artist_hotttnesss_rank".
        "&bucket=artist_location&bucket=song_currency&bucket=song_currency_rank&bucket=song_discovery".
        "&bucket=song_discovery_rank&bucket=song_hotttnesss&bucket=song_hotttnesss_rank&bucket=song_type";
    }

    public function arrayifyThis() {
        return (array) $this;
    }

    /**
     * Formats this object into a line and appends it to the end of the provided .csv file.
     * $csv_filename is assumed to be open (and close cannot have been called yet) at the time
     * this method is invoked.
     * @param resource $handle
     * @return bool | true if line successfully appended to csv, false otherwise
     */
    public function addToCSV($handle) {
        $song_array = $this->arrayifyThis();
        fputcsv($handle, $song_array);
    }
}