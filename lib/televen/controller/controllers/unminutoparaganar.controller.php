<?php

include $_SERVER["DOCUMENT_ROOT"] . "/omicron/lib/configuration.php";
include $GLOBALS["root"] . "lib/televen/model/unminutoparaganar.model.php";

class unminutoparaganar{

	public static function glasses($args){
		$files 	= array();
		$html  = "<ul class='min'>";
		$html2 = "<ul class='max'>";
		
		$path = $GLOBALS['base_URI'] . $GLOBALS['show_URI'] . "unminutoparaganar/assets/glasses/elements/";

		if ($handle = opendir($path . "min")) {
			while (false !== ($file = readdir($handle))) {
				array_push($files, $file);
			}
			closedir($handle);
		}
		$files = array_splice($files, 2, (count($files) - 3));
		shuffle($files);
		foreach($files as $key => $min){
			$html  = $html  . "<li data-img-src='templates/programs/unminutoparaganar/assets/glasses/elements/min/" . $min . "' data-id='" . $key . "'></li>";
			$html2 = $html2 . "<li data-img-src='templates/programs/unminutoparaganar/assets/glasses/elements/max/" . $min . "' id='max-" . $key . "'></li>";
		}
		$html  = $html  . "</ul>";
		$html2 = $html2 . "</ul>";
		return array("glasses" => $html . $html2);
	}

}

?>