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
 * @copyright	2013-02-10 Corporacion Televen.
 * @version		1.0.0
 * @link        http://www.televen.com
 */
 
include $_SERVER['DOCUMENT_ROOT'] . '/omicron/lib/configuration.php';

class template{

	private $tpl_head_file;
	private $tpl_body_file;
	private $tpl_foot_file;
	
	private $head_vars = array();
	private $body_vars = array();
	private $foot_vars = array();
	
	private $html;
	
	/**
	* Set the URI of the template file. It identifies the show and set the head,
	* body and foot template
	*
	* @param string $program: identifies the show.
	* @param string $template_file: the body template of the piece
	* @param bool $commertial: indicates if the template piece is commertial
	*/
	public function setTemplate($program, $template_file, $commertial){
		$URI = ($commertial) ? $commertial_URI : $GLOBALS['show_URI'];
		if($this->show_exists($program)){
			$this->tpl_head_file = $GLOBALS['root'] . $GLOBALS['base_URI'] . $URI . $program. '/head.tpl';
			$this->tpl_body_file = $GLOBALS['root'] . $GLOBALS['base_URI'] . $URI . $program. '/' . $template_file . '.tpl';
			$this->tpl_foot_file = $GLOBALS['root'] . $GLOBALS['base_URI'] . $URI . $program. '/foot.tpl';
		}else{
			// @todo retornar error si el show no existe
		}
	}
	
	/**
	* Magic function that set each of the variables of the templates
	*
	* @param string name: name of the vars to set. Could be: setHeader, setBody, setFooter or setVariable
	* @param array args: variables to change in the templates. In case of setVariable, $args will be an 
	*				associative array with the form array('name'=>'name_of_the_variable', 'val'=>'value_of_the_variable')
	*/
	public function __call($name, $args){
		$args = $args[0];
		$key = strtolower(substr($name, 3));
		if(!empty($args)){
			switch($key){
				case 'header' 	: 	$this->head_vars = array_merge($this->head_vars, $args); break;
				case 'body' 	: 	$this->body_vars = array_merge($this->body_vars, $args); break;
				case 'footer' 	: 	$this->foot_vars = array_merge($this->foot_vars, $args); break;
				case 'variable'	: 	if(array_key_exists($args['name'], $this->head_vars)){
										$this->head_vars[$args['name']] = $args['val'];
									}elseif(array_key_exists($args['name'], $this->body_vars)){
										$this->body_vars[$args['name']] = $args['val'];
									}elseif(array_key_exists($args['name'], $this->foot_vars)){
										$this->foot_vars[$args['name']] = $args['val'];
									}
									break;
				// @todo default behavior
			}
		}
	}
	
	/**
	* Get the template and insert each variable in its position
	* 
	* @param string $type: type of template. Options: head, body or foot.
	* @return string html of the template.
	*/
	private function getTemplate($type){
		//print_r($type);
		switch($type){
			case 'head' : $file_to_open = $this->tpl_head_file; $args = $this->head_vars; break;
			case 'body' : $file_to_open = $this->tpl_body_file; $args = $this->body_vars; break;
			case 'foot' : $file_to_open = $this->tpl_foot_file; $args = $this->foot_vars; break;
			// @todo default behavior
		}
		
		if (!($file = @fopen($file_to_open, 'r'))) {
			//print_r($file_to_open);print_r("error");
				// @todo what to do in case of open file failed.
		}else{
			$html = fread($file, filesize($file_to_open));
			fclose($file);
			// Replace every ' to do the magic with the vars
			$html = str_replace ("'", "\'", $html);
			// Replace each {} element into a php variable.
			$html = preg_replace('#\{([a-z0-9\-_]*?)\}#is', "' . $\\1 . '", $html);
			// Put the pointer in the first position of the array
			reset($args);
			while(list($key, $val) = each($args)) {
				// Create variables with the name of the index in the associative array $args
				$$key = $val;
			}
			// Replace each element on the template file with the respective variable
			eval("\$html = '$html';");
			// Put the pointer in the first position of the array
			reset($args);
			while(list($key, $val) = each($args)) {
				// Eliminates each recently created var
				unset($$key);
			}
			// Set back the changes
			$html=str_replace ("\'", "'", $html);
			// Finally we have our HTML
			return $html;
		}
	}
	
	/**
	* Verify if the show exits in the list of synchronized programs
	*
	* @param string $show the show
	* @return bool if it exists or doesn't.
	* @todo change this function to televen.class
	*/
	private function show_exists($show){
		return in_array(strtolower($show), $GLOBALS['show_list']);
	}
	
	/**
	* Render the piece html.
	* 
	* @return string html of the piece
	*/
	function render(){
		//print_r($this->head_vars);
		return $this->getTemplate('head') . $this->getTemplate('body') . $this->getTemplate('foot');
	}
}
?>