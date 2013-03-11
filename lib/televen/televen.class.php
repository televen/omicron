<?php

/**
 * MIT License
 * ===========
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 *
 * @author      Victor Acosta <vacosta@televen.com, vacostag@gmail.com>
 * @copyright	2013-02-11 Corporacion Televen.
 * @version		1.0.0
 * @link        http://www.televen.com
 */

include $_SERVER['DOCUMENT_ROOT'] . '/omicron/lib/configuration.php';
include 'manager/device.class.php';
include 'controller/controllerInterface.php';
include $GLOBALS['root'] . 'lib/templates/template.class.php';

class televen {
	
	private $device;
	
	/**
	* Class constructor, initializes the device class to store in the $_SESSION
	* variable all the information about the device for further use.
	*/
	public function __construct(){
		$this->device = new device();
	}
	
	/**
	* Get the name of the show wich is on air. It matches the show shortname with 
	* the Real name of it. Will be use to set the title of the page.
	*
	* @param string $show short name of the show
	* @return real name of the show
	*/
	private function getShowName($show){
		if(array_key_exists($show, $GLOBALS['shows_name'])){
			return $GLOBALS['shows_name'][$show];
		}else{
			return false;
		}
	}
	
	/**
	* Retrieve the name of the piece.
	* 
	* @param string $piece short name of the piece
	* @return real name of the piece
	*/
	private function getPieceTitle($show, $piece){
		include $GLOBALS['root'] . $GLOBALS['base_URI'] . $GLOBALS['show_URI'] . $show . '/configuration.php';
		if(array_key_exists($piece, $GLOBALS['pieces_title'])){
			return $GLOBALS['pieces_title'][$piece];
		}else{
			return false;
		}
	}
	
	/**
	* Return the css framework, like BootStrap used in the piece. It difference
	* between mobile or PC
	*
	* @return string containing the URL of the framework.
	* @todo Find an framework for mobiles or configure one from bootstrap.
	*/
	private function getCSSFramework(){
		$html = "";
		if($_SESSION['device']['type'] == 'phone' || $_SESSION['device']['type'] == 'tablet'){
			if($_SESSION['device']['grade']=='A'){
				$html = "";
			}
		}else{
			$html = $GLOBALS['framework_URI'] . 'css/' . $GLOBALS['css_framework_pc'];
		}
		return $html;
	}
	
	/**
	* In case we are using plugins, and those plugins had especific css rules,
	* we can import them via this method. IN THE CONFIGURATION FILE OF THE SHOW
	* HAS TO BE IN THE PLUGIN LIST, WITH THE FORM array('css' => URI, 'js' => URI)
	*
	* @param string shortname of the piece. It has to match the index in the 
	* 				plugin_list variable.
	* @return string containing the HTML of the plugins to import.If there is 
	*			no plugin to import the function will return an empty string.
	*/
	private function getCSSPlugins($piece){
		$html = ""; $dev = "";
		if(array_key_exists($piece, $GLOBALS['pieces_title']) && array_key_exists($piece, $GLOBALS['plugins_list'])){
			if($_SESSION['device']['type'] == 'phone' || $_SESSION['device']['type'] == 'tablet'){
				$dev = 'mobile';
			}else{
				$dev = 'computer';
			}
			if(array_key_exists($piece, $GLOBALS['plugins_list'])){
				//foreach($plugins_list[$piece][$dev] as $plugin){
					$html = $html . '<link rel="stylesheet" type="text/css" href="' . $GLOBALS["plugin_URI"] . 'css/' . $GLOBALS['plugins_list'][$piece] . '.css">';
				//}
			}
		}
		return $html;
	}
	
	/**
	* Import the css of the show
	* 
	* @param string $show shortname of the show.
	* @return string, URI of the css
	*
	* @todo css for mobiles (pt1)
	*/
	private function getCSS($show){
		if($_SESSION['device']['type'] == 'phone' || $_SESSION['device']['type'] == 'tablet'){
			return $GLOBALS['root'] . $GLOBALS['base_URI'] . $GLOBALS['show_URI'] . $show . 'css/' . $show . '.css'; //pt1
		}else{
			return $GLOBALS['base_URI'] . $GLOBALS['show_URI'] . $show . '/css/' . $show . '.css'; //pt1
		}	
	}
	
	/**
	* Return the JavaScript framework, like BootStrap used in the piece. It difference
	* between mobile or PC
	*
	* @return string containing the HTML to improt the framework..
	*/
	private function getJSFramework(){
		$html = "";
		if($_SESSION['device']['type'] == 'phone' || $_SESSION['device']['type'] == 'tablet'){
			if($_SESSION['device']['grade']=='A'){
				$html = '<script type="text/javascript" src="' . $GLOBALS['root'] . $framework_URI . 'js/' . $js_framework_mobile . '"></script>';
			}
		}else{
			$html = '<script type="text/javascript" src="https://www.google.com/jsapi"></script><script type="text/javascript">google.load("jquery", "1");</script>';
		}
		return $html;
	}
	
	/**
	* In case we are using plugins, and those plugins had especific css rules,
	* we can import them via this method. IN THE CONFIGURATION FILE OF THE SHOW
	* HAS TO BE IN THE PLUGIN LIST, WITH THE FORM array('css' => URI, 'js' => URI)
	*
	* @param string shortname of the piece. It has to match the index in the 
	* 				plugin_list variable.
	* @return string containing the HTML of the plugins to import.If there is 
	*			no plugin to import the function will return an empty string.
	*/
	private function getJSPlugins($piece){
		$html = ""; $dev = "";
		if(array_key_exists($piece, $GLOBALS['pieces_title']) && array_key_exists($piece, $GLOBALS['plugins_list'])){
			if($_SESSION['device']['type'] == 'phone' || $_SESSION['device']['type'] == 'tablet'){
				$dev = 'mobile';
			}else{
				$dev = 'computer';
			}
			if(array_key_exists($piece, $GLOBALS["plugins_list"])){
				///foreach($GLOBALS["plugins_list"][$piece] as $plugin){
					$html = $html . '<script type="text/javascript" src="' . $GLOBALS['plugin_URI'] . 'js/' . $GLOBALS["plugins_list"][$piece]	 . '.js"></script>';
				//}
			}
		}
		return $html;
	}
	
	private function getScripts($show){
		if($_SESSION['device']['type'] == 'phone' || $_SESSION['device']['type'] == 'tablet'){
			return $GLOBALS['root'] . $GLOBALS['base_URI'] . $GLOBALS['show_URI'] . $show . 'js/' . $show . '.js'; //pt1
		}else{
			return '<script type="text/javascript" src="' . $GLOBALS['base_URI'] . $GLOBALS['show_URI'] . $show . '/js/' . $show . '.js"></script>';
		}
	}
	
	/**
	* Set the arguments of the head and the foot of the template.
	*
	* @param string $show shortname of the show
	* @param string $piece shortname of the piece that its going to be on air.
	*
	* @return array containing the head and foot arguments.
	*
	* @todo verify HOW all the scripts will be imported
	*/
	private function setHeadAndFoot($show, $piece){
		include $GLOBALS['root'] . $GLOBALS['base_URI'] . $GLOBALS['show_URI'] . $show . '/configuration.php';
		$head = array();
		$head['show'] 				= $this->getShowName($show);
		$head['show_shortname']		= $show;
		$head['piece_title'] 		= $this->getPieceTitle($show, $piece);
		$head['css_framework'] 		= $this->getCSSFramework();
		$head['css'] 				= $this->getCSS($show);
		$head['base_css'] 			= $GLOBALS['base_URI'] . $GLOBALS['show_URI'] . 'css/televen10.css';
		$head['plugins']			= $this->getCSSPlugins($piece);
		$head['show_description'] 	= $GLOBALS['show_description'];
		$head['show_keywords'] 		= array_merge($GLOBALS['platform_keywords'], $GLOBALS['keywords']);
		$head['show_keywords'] 		= implode(', ', $head["show_keywords"]);
		
		$foot = array();
		$foot['GA_UA']				= $GLOBALS['GA_UA'];
		$foot['js_framework']		= $this->getJSFramework();
		$foot['plugins']			= $this->getJSPlugins($piece);
		$foot['scripts']			= $this->getScripts($show);
		
		return array("head" => $head, "foot" => $foot);
	}
	
	/**
	* Magic function that will load all the html and return it to the index.php
	* file. It has to have the form load[show]. i.e. loadHayCorazon(array(arguments)).
	*
	* @return string containing all HTML of piece.
	*
	* @todo handle comertial pieces (pt1)
	* @todo fallback when show doesn't exists (pt2)
	*/
	public function __call($name, $args){
		$controller = new controllerInterface();
		$key = strtolower(substr($name, 4));
		$arguments = array('head' => "", 'body' => '', 'foot' => ''); // pt2 this should be out
		if(in_array($key, $GLOBALS['show_list'])){
			$arguments = $this->setHeadAndFoot($key, $args[0]['piece']);
			$arguments['body'] = $controller->callController($key, $args);
			$piece = $args[0]['piece'];
			//pt1
		}else{
			//pt2
		}
		$template = new template();
		$template->setTemplate($key, $piece, false);
		$template->setHeader($arguments['head']);
		$template->setBody($arguments['body']);
		$template->setFooter($arguments['foot']);
		return $template->render();
	}
	
	/** UTILITIES **/
	/** 
	 * Returns the url query as associative array 
	 * 
	 * @param    string    query 
	 * @return    array    params 
	 */ 
	function convertUrlQuery($query) { 
		$params = array();
		
		if($query != ""){
			$queryParts = explode('&', $query); 
			foreach ($queryParts as $param) { 
				$item = explode('=', $param); 
				$params[$item[0]] = $item[1]; 
			}
		}else{
			$params['piece'] = 'tdd';
		}
		
		return $params; 
	}
	
	public function getAjax($args){
		$controller = new controllerInterface();
		$args = array($args);
		$ajax = $controller->callController(strtolower($args[0]['show']), $args);
		return $ajax;
	}
}

?>