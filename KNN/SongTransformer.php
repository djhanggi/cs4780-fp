<?php 
// require_once($_SERVER['DOCUMENT_ROOT']."/Loader.php");
require_once __DIR__."/../Loader.php";

abstract class KNN_SongTransformer {
	
	abstract public function functionX_danceability($song);
	abstract public function functionY_danceability($song);

	abstract public function functionX_valence($song);
	abstract public function functionY_valence($song);

	abstract public function functionX_energy($song);
	abstract public function functionY_energy($song);

}
