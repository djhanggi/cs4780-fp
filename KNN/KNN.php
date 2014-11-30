<?php 
// require_once($_SERVER['DOCUMENT_ROOT']."/Loader.php");
require_once __DIR__."/../Loader.php";

class KNN_KNN {

    /** @var DataParsing_Song */
    public $song_to_be_classified;

    /** @var DataParsing_Song[] */
    public $kNearest;

    /** @var float */
    public $average_danceability;

    /** @var KNN_NearestNeighbor */
    public $nearest_neighbors;

    /**
     * @param String $csv_filename
     */
    public function __construct($csv, $transformer) {
        $this->nearest_neighbors = new KNN_NearestNeighbor($csv);
        $this->nearest_neighbors->setTransformer($transformer);
        $this->nearest_neighbors->setAllXandY();
    }
    
    public function tryNewSong($songId) {
        $song = DataParsing_Song::withID($songId);
        $this->song_to_be_classified = $song;
        $this->nearest_neighbors->sortSongs($song);
    }

    public function searchAndBegin($songName, $artistName) {
        $songName = rawurlencode($songName);
        $artistName = rawurlencode($artistName);
        $searchQuery = "http://developer.echonest.com/api/v4/song/search?api_key=" . 
            DataParsing_APIKeys::CURRENT_KEY . "&format=json&results=1&artist=" . 
            $artistName . "&title=" . $songName;
        // echo $searchQuery;
        $json = @file_get_contents($searchQuery);
        $response = json_decode($json,true);
        if ($response["response"]["songs"]) {
            $songId = $response["response"]["songs"][0]["id"];
            $this->tryNewSong($songId);
        } 
    }

    public function findTopK($k) {
        $this->kNearest = $this->nearest_neighbors->getKNearest($k);
        $total_danceability = 0;
        foreach ($this->kNearest as $song) {
            $total_danceability += $song->danceability; 
        }
        $this->average_danceability = $total_danceability/$k;
    }
}