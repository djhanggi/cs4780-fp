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
        $this->alldata = [];
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
        //danceability
        $song->x_dance = $this->transformer->functionX_danceability($song);
        $song->y_dance= $this->transformer->functionY_danceability($song);

        //valence
        $song->x_valence = $this->transformer->functionX_valence($song);
        $song->y_valence = $this->transformer->functionY_valence($song);

        //energy
        $song->x_energy = $this->transformer->functionX_energy($song);
        $song->y_energy = $this->transformer->functionY_energy($song);
    }

    /**
     * 
     * @param DataParsing_Song $song1 (the song to be classified)
     * @param DataParsing_Song $song2
     */
    private function setEuclideanDistance($song1, $song2) {
        $song2->euclidean_distance_dance = sqrt(pow($song2->x_dance - $song1->x_dance, 2) 
                                                + pow($song2->y_dance - $song1->y_dance, 2));
        $song2->euclidean_distance_valence = sqrt(pow($song2->x_valence - $song1->x_valence, 2) 
                                                + pow($song2->y_valence - $song1->y_valence, 2));
        $song2->euclidean_distance_energy = sqrt(pow($song2->x_energy - $song1->x_energy, 2) 
                                                + pow($song2->y_energy - $song1->y_energy, 2));
    }

    private function setEuclideanDistance8Attributes($song1, $song2) {
        $valence1          = $song1->valence;
        $tempo1            = $song1->tempo;
        $energy1           = $song1->energy;
        $liveness1         = $song1->liveness;
        $speechiness1      = $song1->speechiness;
        $loudness1         = $song1->loudness;
        $acousticness1     = $song1->acousticness;
        $instrumentalness1 = $song1->instrumentalness;
        $danceability1     = $song1->danceability;

        $valence2          = $song2->valence;
        $tempo2            = $song2->tempo;
        $energy2           = $song2->energy;
        $liveness2         = $song2->liveness;
        $speechiness2      = $song2->speechiness;
        $loudness2         = $song2->loudness;
        $acousticness2     = $song2->acousticness;
        $instrumentalness2 = $song2->instrumentalness;
        $danceability2     = $song2->danceability;


        $song2->euclidean_distance_dance =    pow($valence2 - $valence1, 2)
                                            + pow($tempo2 - $tempo1, 2)
                                            + pow($energy2 - $energy1, 2)
                                            + pow($liveness2 - $liveness1, 2)
                                            + pow($speechiness2 - $speechiness1, 2)
                                            + pow($loudness2 - $loudness1, 2)
                                            + pow($acousticness2 - $acousticness1, 2)
                                            + pow($instrumentalness2 - $instrumentalness1, 2);

        $song2->euclidean_distance_valence =  pow($tempo2 - $tempo1, 2)
                                            + pow($energy2 - $energy1, 2)
                                            + pow($liveness2 - $liveness1, 2)
                                            + pow($speechiness2 - $speechiness1, 2)
                                            + pow($loudness2 - $loudness1, 2)
                                            + pow($acousticness2 - $acousticness1, 2)
                                            + pow($instrumentalness2 - $instrumentalness1, 2)
                                            + pow($danceability2 - $danceability1, 2);

        $song2->euclidean_distance_energy =   pow($valence2 - $valence1, 2)
                                            + pow($tempo2 - $tempo1, 2)
                                            + pow($liveness2 - $liveness1, 2)
                                            + pow($speechiness2 - $speechiness1, 2)
                                            + pow($loudness2 - $loudness1, 2)
                                            + pow($acousticness2 - $acousticness1, 2)
                                            + pow($instrumentalness2 - $instrumentalness1, 2)
                                            + pow($danceability2 - $danceability1, 2);
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
    public function sortSongs($song_to_be_classified, $without_transformation = False) {
        $this->song_to_be_classified = $song_to_be_classified;
        foreach ($this->data as $song) {
            if ($without_transformation) {
                $this->setEuclideanDistance8Attributes($this->song_to_be_classified, $song);
            } else {
                $this->setXandY($this->song_to_be_classified);
                $this->setEuclideanDistance($this->song_to_be_classified, $song);
            }
        }
        // This will sort the data and store the ordered results in 3 arrays for
        // danceability, valence, and energy 

        $temp_dance = $this->data; 
        $temp_valence = $this->data;
        $temp_energy = $this->data;

        usort($temp_dance, function($song1, $song2) {
            if ($song1->euclidean_distance_dance == $song2->euclidean_distance_dance) {
                return 0;
            }
            return ($song1->euclidean_distance_dance < $song2->euclidean_distance_dance) ? -1 : 1;
        });

        usort($temp_valence, function($song1, $song2) {
            if ($song1->euclidean_distance_valence == $song2->euclidean_distance_valence) {
                return 0;
            }
            return ($song1->euclidean_distance_valence < $song2->euclidean_distance_valence) ? -1 : 1;
        });

        usort($temp_energy, function($song1, $song2) {
            if ($song1->euclidean_distance_energy == $song2->euclidean_distance_energy) {
                return 0;
            }
            return ($song1->euclidean_distance_energy < $song2->euclidean_distance_energy) ? -1 : 1;
        });

        $this->alldata = array($temp_dance, $temp_valence, $temp_energy);
    }

    /**
     * Returns the $k nearest-neighbors of the song denoted by 
     * $this->song_to_be_classified.
     * @param int $k
     */
    public function getKNearest($k) {

        $topdance = array_slice($this->alldata[0], 0, $k);
        $topvalence = array_slice($this->alldata[1], 0, $k);
        $topenergy = array_slice($this->alldata[2], 0, $k);

        return(array($topdance, $topvalence, $topenergy));
    }
}