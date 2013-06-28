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

class  controllerInterface{
	
	/**
	* Magic function that will call the correct controller for the calling piece
	*
	* @param string $show show shortname
	* @param array $args arguments to the controller. i.e. gender
	* 
	* @return array containing all the arguments for the body template
	*/
	public function callController($show, $args){
		include 'controllers/' . $show . '.controller.php';
		return call_user_func($show . '::' . $args[0]['piece'], $args);
	}
	
	public function callControllerAjax($show, $action, $args){
		include 'controllers/' . $show . '.controller.php';
		return call_user_func($show . '::' . $action, $args);
	}
	
}

?>