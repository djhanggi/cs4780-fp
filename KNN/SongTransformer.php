<?php 
// require_once($_SERVER['DOCUMENT_ROOT']."/Loader.php");
require_once __DIR__."/../Loader.php";

abstract class KNN_SongTransformer {
	
	abstract public function functionX($song);
	abstract public function functionY($song);

}
