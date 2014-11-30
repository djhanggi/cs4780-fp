<?php 
// require_once($_SERVER['DOCUMENT_ROOT']."/Loader.php");
require_once __DIR__."/../Loader.php";

class KNN_NearestNeighbor {

    /** @var DataParsing_Song[] */
    private $data;

    /** @var DataParsing_Song[] */
    public $song_to_be_classified;

    /** @var KNN_SongTransformer */
    private $transformer;

    public function __construct($csv_filename) {
        $this->data = [];
        $this->getAllNeighbors($csv_filename);
    }

    /**
     * Reads all lines of a file and creates a DataParsing_Song[]
     * of all included files.
     * @param String $csv_filename
     */
    private function getAllNeighbors($csv_filename) {
        $file = fopen($csv_filename, 'r');
        $line = fgetcsv($file); // Discard the first line with comments
        while (($line = fgetcsv($file)) !== FALSE) {
            if (count($line) === 18) {
                $this->data[] = DataParsing_Song::withCSVLine($line);
            }
        }
    }

    /** 
     * Transforms the multidimensional song data in $this->data
     * into two dimensions.
     * @var callable $functionX
     * @var callable $functionY
     */
    public function setAllXandY() {
        foreach ($this->data as $song) {
            $this->setXandY($song);
        }
    }

    public function setXandY($song) {
        $song->x = $this->transformer->functionX($song);
        $song->y = $this->transformer->functionY($song);
    }

    /**
     * 
     * @param DataParsing_Song $song1 (the song to be classified)
     * @param DataParsing_Song $song2
     */
    private function setEuclideanDistance($song1, $song2) {
        $song2->euclidean_distance = sqrt(pow($song2->x - $song1->x, 2) + pow($song2->y - $song1->y, 2));
    }

    /** 
     * @param KNN_SongTransformer $transfomer
     */
    public function setTransformer($transformer) {
        $this->transformer = $transformer;
    }

    /**
     * Sorts transformed songs by euclidean distance to the
     * song that is to be classified.
     * @param DataParsing_Song $song_to_be_classified
     */
    public function sortSongs($song_to_be_classified) {
        $this->song_to_be_classified = $song_to_be_classified;
        $this->setXandY($this->song_to_be_classified);
        foreach ($this->data as $song) {
            $this->setEuclideanDistance($this->song_to_be_classified, $song);
        }
        // This will sort the data and 
        usort($this->data, function($song1, $song2) {
            if ($song1->euclidean_distance == $song2->euclidean_distance) {
                return 0;
            }
            return ($song1->euclidean_distance < $song2->euclidean_distance) ? -1 : 1;
        });
    }

    /**
     * Returns the $k nearest-neighbors of the song denoted by 
     * $this->song_to_be_classified.
     * @param int $k
     */
    public function getKNearest($k) {
        return array_slice($this->data, 0, $k);
    }
}