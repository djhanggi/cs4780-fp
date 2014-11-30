<?php 
// require_once($_SERVER['DOCUMENT_ROOT']."/Loader.php");
require_once __DIR__."/../Loader.php";

class KNN_KNN {

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
        $this->nearest_neighbors->sortSongs($song);
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