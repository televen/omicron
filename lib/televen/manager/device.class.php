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
include $GLOBALS['root'] . '/lib/Mobile-Detect-2.5.5/Mobile_Detect.php';

class device {
	
	private $device;
	
	/**
	* Constructor. Call the function to set the $_SESSION variable wich will
	* have all the information about the device.
	* 
	*/
	public function __construct(){
		$this->setDevice();
	}
	
	/**
	* Set the bowser name, version, engine and engine version
	*
	* @param object $dev Object of Mobile_Detect type
	*/
	private function setBrowser($dev){
		if($dev->isChrome()){
			$this->device['browser']['name'] = 'chrome';
			$this->device['browser']['version'] = $dev->version('Chrome');
			$this->device['browser']['engine'] = 'webkit';
			$this->device['browser']['engine_version'] = $dev->version('Webkit');
		}elseif($dev->isSafari()){
			$this->device['browser']['name'] = 'safari';
			$this->device['browser']['version'] = $dev->version('Safari');
			$this->device['browser']['engine'] = 'webkit';
			$this->device['browser']['engine_version'] = $dev->version('Webkit');
		}elseif($dev->isIE()){
			$this->device['browser']['name'] = 'ie';
			$this->device['browser']['version'] = $this->version('MSIE');
			$this->device['browser']['engine'] = 'unknown';
			$this->device['browser']['engine_version'] = 'unknown';
		}elseif($dev->isFireFox()){
			$this->device['browser']['name'] = 'firefox';
			$this->device['browser']['version'] = $dev->version('Safari');
			$this->device['browser']['engine'] = 'gecko';
			$this->device['browser']['engine_version'] = $dev->version('Gecko');
		}elseif($dev->isOpera()){
			$this->device['browser']['name'] = 'opera';
			$this->device['browser']['version'] = 'unkown';
			$this->device['browser']['engine'] = 'unknown';
			$this->device['browser']['engine_version'] = 'unknown';
		}else{
			$this->device['browser']['name'] = 'other';
			$this->device['browser']['version'] = 'unkown';
			$this->device['browser']['engine'] = 'unknown';
			$this->device['browser']['engine_version'] = 'unknown';
		}
	}
	
	/**
	* Set the iPhone version in case of the device is an iPhone
	*
	* @param object $dev Object of Mobile_Detect type
	*/
	private function setiPhoneVersion($dev){
		switch($dev->version('iPhone')){
			case 3.1 : $this->device['phone']['version'] = 'original'; break;
			case 3.2 : $this->device['phone']['version'] = '3'; break;
			case 4.3 : $this->device['phone']['version'] = '3GS'; break;
			case 5.0 : $this->device['phone']['version'] = '4'; break;
			case 5.1 : $this->device['phone']['version'] = '4S'; break;
			case 6.0 : $this->device['phone']['version'] = '4S/5'; break;
			case 6.1 : $this->device['phone']['version'] = '4S/5'; break;
			default : $this->device['phone']['version'] = 'unknown'; break;
		}
	}
	
	/**
	* Set the iPad version in case of the device is an iPad
	*
	* @param object $dev Object of Mobile_Detect type
	*/
	private function setiPadVersion($dev){
		switch($dev->version('iPad')){
			case 4.3 : $this->device['phone']['version'] = 'original'; break;
			case 5.0 : $this->device['phone']['version'] = 'original'; break;
			case 4.3 : $this->device['phone']['version'] = '2'; break;
			case 5.1 : $this->device['phone']['version'] = '3'; break;
			case 6.0 : $this->device['phone']['version'] = '3'; break;
			case 6.1 : $this->device['phone']['version'] = '3'; break;
			default : $this->device['phone']['version'] = 'unknown'; break;
		}
	}
	
	/**
	* Set the OS version of the device
	*
	* @param object $dev Object of Mobile_Detect type
	*/
	private function setOS($dev){
		if($dev->isAndroidOS()){
			$this->device['os'] = 'android';
			//$this->device['os']['version'] = $dev->version('Android');
		}elseif($dev->isBlackBerryOS()){
			$this->device['os'] = 'blackkberry';
			//$this->device['os']['version'] = $dev->version('BlackBerry');
		}elseif($dev->isiOS()){
			$this->device['os'] = 'ios';
			//$this->device['os']['version'] = (($dev->version('iPhone')==0) ? (($dev->version('iPad') == 0) ? $dev->version('iPod') : $dev->version('iPad')) : $dev->version('iPhone'));
		}elseif($dev->isWindowsPhoneOS()){
			$this->device['os'] = 'windowsphone';
			$this->device['os']['version'] = $dev->version('Windows Phone OS');
		}else{
			$this->device['os'] = 'other';
			$this->device['os']['version'] = 'unknown';
		}
	}
	
	/**
	* Put in the $_SESSION var all the information we need about the device
	*/
	private function setDevice(){
		$dev = new Mobile_Detect();
		$this->device['type'] = ($dev->isMobile() ? ($dev->isTablet() ? 'tablet' : 'phone') : 'computer');
		
		if($dev->isMobile()){
			if($dev->isiPhone()){
				$this->device['phone']['brand'] = 'apple';
				$this->device['phone']['type'] = 'iphone';
				$this->setiPhoneVersion($dev);
			}elseif($dev->isBlackBerry()){
				$this->device['phone']['brand'] = 'blackberry';
				$this->device['phone']['type'] = 'unknown';
				$this->device['phone']['version'] = $dev->version('BlackBerry');
			}elseif($dev->isSamsung()){
				$this->device['phone']['brand'] = 'samsung';
				$this->device['phone']['type'] = 'unknown';
				$this->device['phone']['version'] = 'unknown';
			}else{
				$this->device['phone']['brand'] = 'other';
				$this->device['phone']['type'] = 'unknown';
				$this->device['phone']['version'] = 'unknown';
			}
			$this->setOS($dev);
		}
		
		if($dev->isTablet()){
			if($dev->isiPad()){
				$this->device['tablet']['brand'] = 'apple';
				$this->device['tablet']['type'] = 'ipad';
				$this->setiPadVersion($dev);
			}elseif($dev->isBlackBerryTablet()){
				$this->device['tablet']['brand'] = 'blackberry';
				$this->device['tablet']['type'] = 'playbook';
				$this->device['tablet']['version'] = 'unknown';
			}elseif($dev->isSamsungTablet()){
				$this->device['tablet']['brand'] = 'samsung';
				$this->device['tablet']['type'] = 'galaxytab';
				$this->device['tablet']['version'] = 'unknown';
			}else{
				$this->device['tablet']['brand'] = 'other';
				$this->device['tablet']['type'] = 'unknown';
				$this->device['tablet']['version'] = 'unknown';
			}
			$this->setOS($dev);
		}
		
		if($this->device['type']=='computer'){
			if($dev->version('Windows NT') != 0){
				$this->device['os'] = 'windows';
			}else{
				$this->device['os'] = 'other';
			}
		}
		$this->setBrowser($dev);
		$this->device['grade'] = $dev->mobileGrade();
		$_SESSION['device'] = $this->device;
	}
}

?>