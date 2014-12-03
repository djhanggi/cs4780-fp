<?php 
// require_once($_SERVER['DOCUMENT_ROOT']."/Loader.php");
require_once __DIR__."/../Loader.php";

class KNN_VeenasRTransformation extends KNN_SongTransformer {
    
    public function __construct() {
        // empty on purpose
    }

    public function functionX_danceability($song) {
        $valence = $song->valence;
        $tempo = $song->tempo;
        $energy = $song->energy;
        $liveness = $song->liveness;
        $speechiness = $song->speechiness;
        $loudness = $song->loudness;
        $acousticness = $song->acousticness;
        $instrumentalness = $song->instrumentalness;
        $danceability = $song->danceability;

        return (-(3.279225 * 10^-6) * $valence * $tempo^2 
             +  -(8.160651 * 10^-4) * $energy * $loudness^2 
             +   (3.218223 * 10^-1) * $acousticness * $energy^2
             +  -(3.279225 * 10^-6) * $liveness * $speechiness
             +   (3.793979 * 10^-4) * $tempo * $energy
             +  -(7.492498 * 10^-3) * $loudness * $acousticness
             +   (7.001209 * 10^-2) * $instrumentalness * $valence
             +  -(6.132415 * 10^-4) * $valence * $loudness
             +   (1.359087 * 10^-2) * $energy * $loudness * $valence^2);
    }

    public function functionY_danceability($song) {
        return $song->valence;
    }

    public function functionX_valence($song) {
        $danceability = $song->danceability;
        $tempo = $song->tempo;
        $energy = $song->energy;
        $liveness = $song->liveness;
        $speechiness = $song->speechiness;
        $loudness = $song->loudness;
        $acousticness = $song->acousticness;
        $instrumentalness = $song->instrumentalness;

        return (-(3.279225 * 10^-6) * $danceability * $tempo^2 
             +  -(8.160651 * 10^-4) * $energy * $loudness^2 
             +   (3.218223 * 10^-1) * $acousticness * $energy^2
             +  -(3.279225 * 10^-6) * $liveness * $speechiness
             +   (3.793979 * 10^-4) * $tempo * $energy
             +  -(7.492498 * 10^-3) * $loudness * $acousticness
             +   (7.001209 * 10^-2) * $instrumentalness * $danceability
             +  -(6.132415 * 10^-4) * $danceability * $loudness
             +   (1.359087 * 10^-2) * $energy * $loudness * $danceability^2);
    }

    public function functionY_valence($song) {
        return $song->danceability;
    }

    public function functionX_energy($song) {
        $valence = $song->valence;
        $danceability = $song->danceability;
        $tempo = $song->tempo;
        $energy = $song->energy;
        $liveness = $song->liveness;
        $speechiness = $song->speechiness;
        $loudness = $song->loudness;
        $acousticness = $song->acousticness;
        $instrumentalness = $song->instrumentalness;

        return (-(3.126570 * 10^-1) * $acousticness 
             +  -(7.503000 * 10^-4) * $tempo 
             +   (1.719260 * 10^-2) * $loudness 
             +  -(1.399756 * 10^-1) * $valence
             +   (2.950410 * 10^-2) * $danceability 
             +  -(2.433880 * 10^-1) * $speechiness 
             +   (1.868210 * 10^-2) * $loudness * $danceability);
    }

    public function functionY_energy($song) {
        return $song->energy;
    }


}

// VESHA'S OLD CODE: 

//public function functionX($song) {
//      $valence = $song->valence;
//      $tempo = $song->tempo;
//      $energy = $song->energy;
//      $liveness = $song->liveness;
//      $speechiness = $song->speechiness;
//      $loudness = $song->loudness;
//      $acousticness = $song->acousticness;
//      $instrumentalness = $song->instrumentalness;

//      return (-(3.279225 * 10^-6) * $valence * $tempo^2 
//           +  -(8.160651 * 10^-4) * $energy * $loudness^2 
//           +   (3.218223 * 10^-1) * $acousticness * $energy^2
//           +  -(3.279225 * 10^-6) * $liveness * $speechiness
//           +   (3.793979 * 10^-4) * $tempo * $energy
//           +  -(7.492498 * 10^-3) * $loudness * $acousticness
//           +   (7.001209 * 10^-2) * $instrumentalness * $valence
//           +  -(6.132415 * 10^-4) * $valence * $loudness
//           +   (1.359087 * 10^-2) * $energy * $loudness * $valence^2);
//  }

//  public function functionY($song) {
//      return $song->valence;
//  }

// }
