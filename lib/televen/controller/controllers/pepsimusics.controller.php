<?php

include $_SERVER["DOCUMENT_ROOT"] . "/omicron/lib/configuration.php";
include $GLOBALS["root"] . "lib/televen/model/pepsimusics.model.php";

class pepsimusics{

	public static function photo_gallery($args){
		$files = array();
		$model = new pepsimusics_model();
		$folder = $model->getPhotoFolderByBlack($args[0]['black'])['folder'];
		
		$path = $GLOBALS['base_URI'] . $GLOBALS['show_URI'] . "pepsimusics/assets/" . $folder;

		if ($handle = opendir($path)) {
			while (false !== ($file = readdir($handle))) {
				array_push($files, $file);
			}
			closedir($handle);
		}
		
		shuffle($files);
		$i = 2; $indexes = count($files) - 1;
		$html = "";
		while($i < $indexes){
			$position = rand(0,3);
			$html .= '<div class="photo-block' . (($position==0) ? "-0" : "-1") . '"><ul>';
			switch($position){
				case 0: $html .= '<li class="block-0" data-img="' . $folder . '/' . $files[$i] . '"></li>';
						$html .= (($indexes - ($i+1)) > 0) ? '<li class="block-0" data-img="' . $folder . '/' . $files[$i+1] . '"></li>' : ' ';
						$html .= (($indexes - ($i+2)) > 0) ? '<li class="block-0" data-img="' . $folder . '/' . $files[$i+2] . '"></li>' : ' ';
						$html .= (($indexes - ($i+3)) > 0) ? '<li class="block-0" data-img="' . $folder . '/' . $files[$i+3] . '"></li>' : ' ';
						$i = $i+4;
						break;
				case 1: $html .= '<li class="big" data-img="' . $folder . '/' . $files[$i] . '"></li>';
						$html .= (($indexes - ($i+1)) > 0) ? '<li class="block-0" data-img="' . $folder . '/' . $files[$i+1] . '"></li>' : ' ';
						$html .= (($indexes - ($i+2)) > 0) ? '<li class="block-0" data-img="' . $folder . '/' . $files[$i+2] . '"></li>' : ' ';
						$html .= (($indexes - ($i+3)) > 0) ? '<li class="block-0" data-img="' . $folder . '/' . $files[$i+3] . '"></li>' : ' ';
						$html .= (($indexes - ($i+4)) > 0) ? '<li class="block-0" data-img="' . $folder . '/' . $files[$i+4] . '"></li>' : ' ';
						$i = $i+5;
						break;
				case 2: $html .= '<li class="block-0" data-img="' . $folder . '/' . $files[$i] . '"></li>';
						$html .= (($indexes - ($i+1)) > 0) ? '<li class="big" data-img="' . $folder . '/' . $files[$i+1] . '"></li>' : ' ';
						$html .= (($indexes - ($i+2)) > 0) ? '<li class="block-0" data-img="' . $folder . '/' . $files[$i+2] . '"></li>' : ' ';
						$html .= (($indexes - ($i+3)) > 0) ? '<li class="block-0" data-img="' . $folder . '/' . $files[$i+3] . '"></li>' : ' ';
						$html .= (($indexes - ($i+4)) > 0) ? '<li class="block-1" data-img="' . $folder . '/' . $files[$i+4] . '"></li>' : ' ';
						$i = $i+5;
						break;
				case 3: $html .= '<li class="block-0" data-img="' . $folder . '/' . $files[$i] . '"></li>';
						$html .= (($indexes - ($i+1)) > 0) ? '<li class="block-0" data-img="' . $folder . '/' . $files[$i+1] . '"></li>' : ' ';
						$html .= (($indexes - ($i+2)) > 0) ? '<li class="big" data-img="' . $folder . '/' . $files[$i+2] . '"></li>' : ' ';
						$html .= (($indexes - ($i+3)) > 0) ? '<li class="block-1" data-img="' . $folder . '/' . $files[$i+3] . '"></li>' : ' ';
						$html .= (($indexes - ($i+4)) > 0) ? '<li class="block-1" data-img="' . $folder . '/' . $files[$i+4] . '"></li>' : ' ';
						$i = $i+5;
						break;
				default:  	$html .= '<li class="block-0" data-img="' . $folder . '/' . $files[$i] . '"></li>';
							$html .= (($indexes - ($i+1)) > 0) ? '<li class="block-0" data-img="' . $folder . '/' . $files[$i+1] . '"></li>' : ' ';
							$html .= (($indexes - ($i+2)) > 0) ? '<li class="block-0" data-img="' . $folder . '/' . $files[$i+2] . '"></li>' : ' ';
							$html .= (($indexes - ($i+3)) > 0) ? '<li class="block-0" data-img="' . $folder . '/' . $files[$i+3] . '"></li>' : ' ';
							$i = $i+4;
							break;
			}
			$html .= "</ul></div>";
		}
		
		return array("photos" => $html);
	}
}

?>