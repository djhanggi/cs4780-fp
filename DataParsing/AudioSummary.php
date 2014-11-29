<?php

// require_once($_SERVER['DOCUMENT_ROOT']."/Loader.php");
require_once __DIR__."/../Loader.php";

class DataParsing_AudioSummary {
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

    public function  __construct($audio_summary_array) {
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

}