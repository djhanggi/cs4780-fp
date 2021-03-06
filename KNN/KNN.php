<?php 
// require_once($_SERVER['DOCUMENT_ROOT']."/Loader.php");
require_once __DIR__."/../Loader.php";

class KNN_KNN {

    /** @var DataParsing_Song */
    public $song_to_be_classified;

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

    public function tryNewSong($song) {
        $this->song_to_be_classified = $song;
        $this->nearest_neighbors->sortSongs($song);
    }
    
    public function tryNewSongId($songId) {
        $song = DataParsing_Song::withID($songId);
        $this->song_to_be_classified = $song;
        $this->nearest_neighbors->sortSongs($song);
    }

    public function searchAndBegin($songName, $artistName, $without_transformation = False) {
        $songName = rawurlencode($songName);
        $artistName = rawurlencode($artistName);
        $searchQuery = "http://developer.echonest.com/api/v4/song/search?api_key=" . 
            DataParsing_APIKeys::CURRENT_KEY . "&format=json&results=5&artist=" . 
            $artistName . "&title=" . $songName;
        $json = @file_get_contents($searchQuery);
        $response = json_decode($json,true);
        if ($response["response"]["songs"]) {
            $songIds = array_column($response["response"]["songs"],"id");
            $song = DataParsing_Song::withIDs($songIds);
            $this->song_to_be_classified = $song;
            $this->nearest_neighbors->sortSongs($song, $without_transformation);
        } 
    }

    public function findTopK($k) {
        $this->k = $k;
        $kNearest = $this->nearest_neighbors->getKNearest($k);
        $this->kNearest_dance = $kNearest[0];
        $this->kNearest_valence = $kNearest[1];
        $this->kNearest_energy = $kNearest[2];

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