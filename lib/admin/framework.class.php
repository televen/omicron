<?php
include $_SERVER['DOCUMENT_ROOT'] . '/omicron/lib/configuration.php';

class framework{
	
	public function __contruct(){
	
	}
	
	public function initShow($show_name){
	
		$show_name = strtolower($show_name);
		$root = $GLOBALS['root'] . $GLOBALS['base_URI'] . $GLOBALS['show_URI'];
		
		if(mkdir($root . $show_name)){
			mkdir($root . $show_name . '/assets');
			
			if(mkdir($root . $show_name . '/css')){
				$file = fopen($root . $show_name . '/css/' . $show_name . ".css", "w+");
				fwrite($file, '/** Televen 10.0 framework */');
				fclose($file);
			}
			
			if(mkdir($root . $show_name . '/js')){
				$file = fopen($root . $show_name . '/js/' . $show_name . ".js", "w+");
				fwrite($file, '/** Televen 10.0 framework */');
				fclose($file);
			}
			
			mkdir($root . $show_name . '/fonts');
			mkdir($root . $show_name . '/media');
			mkdir($root . $show_name . '/admin');
			mkdir($root . $show_name . '/db');
			// mover el archivo de bd a esta carpeta, crear la db y ejecutar el script
			
			$file = fopen($root . $show_name . '/foot.tpl', "w+");
			fwrite($file, $this->getFootText());
			fclose($file);
			
			$file = fopen($root . $show_name . '/head.tpl', "w+");
			fwrite($file, $this->getHeadText());
			fclose($file);
			
			$file = fopen($root . $show_name . '/configuration.php', "w+");
			fwrite($file, $this->getConfigurationText());
			fclose($file);
			
			$root = $GLOBALS['root'] . "lib/televen/";
			
			$file = fopen($root . 'controller/controllers/' . $show_name . '.controller.php', "w+");
			fwrite($file, $this->getControllerText($show_name));
			fclose($file);
			
			$file = fopen($root . 'model/' . $show_name . '.model.php', "w+");
			fwrite($file, $this->getModelText($show_name));
			fclose($file);
			
			$index = $GLOBALS['root'] . 'index.php';
			$file = fopen($index, "c+");
			$data = fread($file,filesize($index));
			$data = str_replace("/*53x*/", $this->getIndexText($show_name), $data);
			fclose($file);
			file_put_contents($index, $data);
			
			$config = $GLOBALS['root'] . 'lib/configuration.php';
			$file = fopen($config, "c+");
			$data = fread($file,filesize($config));
			$data = str_replace("/*53x*/", $this->getShowListText($show_name), $data);
			$data = str_replace("/*54x*/", $this->getShowsNameText($show_name), $data);
			fclose($file);
			file_put_contents($config, $data);
		}
	}
	
	private function getIndexText($show_name){
		$return = 'case "' . $show_name . '"	: echo $televen->load' . $show_name . '($televen->convertUrlQuery($_SERVER["QUERY_STRING"])); break;';
		$return = $return . "\n\t\t\t/*53x*/";
		return $return;
	}
	
	private function getShowsNameText($show_name){
		return "'" . $show_name . "'		=> '" . $show_name . "',\n\t\t\t\t\t\t\t\t\t\t\t/*54x*/";
	}
	
	private function getShowListText($show_name){
		$return = "'" . $show_name . "',\n\t\t\t\t\t\t\t\t\t\t\t\t/*53x*/";
		return $return;
	}
	
	private function getControllerText($show_name){
		$return = "<?php\n\n";
		$return .= "include \$_SERVER[\"DOCUMENT_ROOT\"] . \"/omicron/lib/configuration.php\";\n";
		$return .= "include \$GLOBALS[\"root\"] . \"lib/televen/model/" . $show_name . ".model.php\";\n\n";
		$return .= "class " . $show_name . "{\n\n";
		$return .= "}\n\n?>";
		return $return;
	}
	
	private function getModelText($show_name){
		$return = "<?php\n\n";
		$return .= "include \$_SERVER[\"DOCUMENT_ROOT\"] . \"/omicron/lib/configuration.php\";\n";
		$return .= "include_once \$GLOBALS[\"root\"] . \"/lib/mysql/mysql.class.php\";\n";
		$return .= "include \$GLOBALS[\"root\"] . \$GLOBALS[\"base_URI\"] . \$GLOBALS[\"show_URI\"] . \"" . $show_name . "/configuration.php\";\n\n";
		$return .= "class " . $show_name . "_model{\n\n";
		$return .= "\tprivate \$db;\n\tprivate \$sql;\n\tprivate \$ret = array();\n\n";
		$return .= "\tpublic function __construct(){\n";
		$return .= "\t\t\$this->db = new MySQL(true, \"" . $show_name . "\", \$GLOBALS[\"db_host\"], \$GLOBALS[\"db_user\"], \$GLOBALS[\"db_password\"]);\n";
		$return .= "\t\tif (\$this->db->Error()) \$this->db->Kill(); // @todo not this in production\n";
		$return .= "\t}\n}\n\n?>";
		return $return;
	}
	
	private function getConfigurationText(){
		$return = "<?php\n\n";
		$return .= "\$GLOBALS[\"pieces\"] = array();\n";
		$return .= "\$GLOBALS[\"pieces_title\"] = array();\n";
		$return .= "\$GLOBALS[\"show_description\"] = \"\";\n";
		$return .= "\$GLOBALS[\"keywords\"] = array();\n";
		$return .= "\$GLOBALS[\"GA_UA\"] = \"UA-35915232-1\";\n";
		$return .= "\$GLOBALS[\"plugins_list\"] = array();\n";
		$return .= "\$GLOBALS[\"script_list\"] = array();\n";
		$return .= "?>";
		return $return;
	}
	
	private function getHeadText(){
		$return = "<!DOCTYPE html>\n";
		$return .= "<html>\n";
		$return .= "\t<head>\n";
		$return .= "\t\t<!-- PAGE TITLE -->\n\t\t<title>{show} | {piece_title}</title>\n";
		$return .= "\t\t<!-- CSS -->\n";
		$return .= "\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"{css_framework}\">\n";
		$return .= "\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"{base_css}\">\n";
		$return .= "\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"{css}\">\n";
		$return .= "\t\t{plugins}\n";
		$return .= "\t\t<!-- META TAGS -->\n";
		$return .= "\t\t<meta charset=\"utf-8\">\n";
		$return .= "\t\t<meta name=\"author\" content=\"Victor Acosta, Televen\">\n";
		$return .= "\t\t<meta name=\"application-name\" content=\"{show}\">\n";
		$return .= "\t\t<meta name=\"description\" content=\"{show_description}\">\n";
		$return .= "\t\t<meta name=\"keywords\" content=\"{show_keywords}\">\n";
		$return .= "\t</head>\n";
		$return .= "\t<body>\n";
		$return .= "\t\t<div id=\"TLVN100_wrapper\" class=\"TLVN100_wrapper {show_shortname}\">\n";
		return $return;
	}
	
	private function getFootText(){
		$return = "\t\t</div>\n";
		$return .= "\t</body>\n";
		$return .= "\t<script type=\"text/javascript\" async=\"\" src=\"http://www.google-analytics.com/ga.js\"></script>\n";
		$return .= "\t<script type=\"text/javascript\">var _gaq = _gaq || []; _gaq.push([\"_setAccount\", \"{GA_UA}\"]); _gaq.push([\"_trackPageview\"]);</script>\n";
		$return .= "\t{js_framework}\n";
		$return .= "\t{plugins}\n";
		$return .= "\t{scripts}\n";
		$return .= "</html>";
		return $return;
	}
}
?>