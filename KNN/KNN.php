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

    /** @var float */
    public $average_valence;

    /** @var float */
    public $average_energy;

    /** @var KNN_NearestNeighbor */
    public $nearest_neighbors;

    /** @var int */
    public $k;

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
        $this->k = $k;
        $this->kNearest_dance = $this->nearest_neighbors->getKNearest($k)[0];
        $this->kNearest_valence = $this->nearest_neighbors->getKNearest($k)[1];
        $this->kNearest_energy = $this->nearest_neighbors->getKNearest($k)[2];

        $total_danceability = 0; $total_valence = 0; $total_energy =0;

        foreach ($this->kNearest_dance as $song) {
            $total_danceability += $song->danceability;
            
        }

        foreach ($this->kNearest_valence as $song) {
            $total_valence += $song->valence;
            
        }

        foreach ($this->kNearest_energy as $song) {
            $total_energy += $song->energy;
            
        }

        $this->average_danceability = $total_danceability/$k;
        $this->average_valence = $total_valence/$k;
        $this->average_energy = $total_energy/$k;
    }
}