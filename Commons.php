<?php
// Check to ensure this file is included
defined('_PS_VERSION_') or die('Restricted access');
//defined('_JEXEC') or die('Restricted access');

/**
 * PrestaSOAP Commons method SOA Connector
 *
 * PrestaSOAP Product SOA Connector : File for upload file into components/com_PrestaSOAP/shop_image/product,
 * components/com_PrestaSOAP/shop_image/category, components/com_PrestaSOAP/shop_image/vendor
 * and other commons method , constants
 *
 * @package    com_vm_soa
 * @subpackage component
 * @author     Mickael cabanas (cabanas.mickael|at|gmail.com)
 * @copyright  2011 Mickael Cabanas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    $Id:$
 */

ob_start();//

include('config.php');

require_once('../../../config/config.inc.php');
//require_once(PRESTA_PATH.'/config/config.inc.php');

require_once('PSWebServiceLibrary.php');
require_once('CRUDMapper.php');
//require_once('lic.php');
/**
 * Class CommonReturn
 *
 * Class "CommonReturn" with attribute : returnCode, message, $returnData, 
 *
 * @author     Mickael cabanas (cabanas.mickael|at|gmail.com)
 * @copyright  Mickael cabanas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    Release:
 */
	class CommonReturn {
		public $returnCode="";
		public $message="";
		public $returnData="";

		//constructeur
		/**
		 *
		 * @param String $returnCode
		 * @param String $message
		 */
		function __construct($returnCode, $message, $returnData) {
			$this->returnCode = $returnCode;
			$this->message = $message;	
			$this->returnData = $returnData;				
		}
	}	
 /**
 * Class CommonReturn
 *
 * Class "CommonReturn" with attribute : returnCode, message, $returnData, 
 *
 * @author     Mickael cabanas (cabanas.mickael|at|gmail.com)
 * @copyright  Mickael cabanas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    Release:
 */
	class CommonXlink {
		public $id="";
		public $xlink="";
		public $type="";

		//constructeur
		/**
		 *
		 * @param String $returnCode
		 * @param String $message
		 */
		function __construct($id, $xlink, $type) {
			$this->id = $id;
			$this->xlink = $xlink;	
			$this->type = $type;				
		}
	}	
	/**
 * Class Product
 *
 * Class "Product" with attribute : returnCode, message, $returnData, 
 *
 * @author     Mickael cabanas (cabanas.mickael|at|gmail.com)
 * @copyright  Mickael cabanas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    Release:
 */
	class Product {
		public $id="";
		public $xlink="";
		public $type="";

		//constructeur
		/**
		 *
		 * @param String $returnCode
		 * @param String $message
		 */
		function __construct($id, $xlink, $type) {
			$this->id = $id;
			$this->xlink = $xlink;	
			$this->type = $type;				
		}
	}	
	
	/**
 * Class Product
 *
 * Class "Product" with attribute : returnCode, message, $returnData, 
 *
 * @author     Mickael cabanas (cabanas.mickael|at|gmail.com)
 * @copyright  Mickael cabanas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    Release:
 */
	class Image {
		public $id="";
		public $xlink="";

		//constructeur
		/**
		 *
		 * @param String $returnCode
		 * @param String $message
		 */
		function __construct($id, $xlink, $type) {
			$this->id = $id;
			$this->xlink = $xlink;		
		}
	}	
	
	/**
 * Class Category
 *
 * Class "Category" with attribute : returnCode, message, $returnData, 
 *
 * @author     Mickael cabanas (cabanas.mickael|at|gmail.com)
 * @copyright  Mickael cabanas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    Release:
 */
	class Category {
		public $id="";
		public $xlink="";
		public $type="";

		//constructeur
		/**
		 *
		 * @param String $returnCode
		 * @param String $message
		 */
		function __construct($id, $xlink, $type) {
			$this->id = $id;
			$this->xlink = $xlink;	
			$this->type = $type;				
		}
	}	
	
	
	
	
	/**
	 * 
	 * 404
	 */
	function exit404() {
		global $_SERVER;
		header ("HTTP/1.1 404 Not Found");
		exit();
	}
	
	function toArray(SimpleXMLElement $xml) {
        $array = (array)$xml;

        foreach ( array_slice($array, 0) as $key => $value ) {
            if ( $value instanceof SimpleXMLElement ) {
                $array[$key] = empty($value) ? NULL : toArray($value);
            }
        }
        return $array;
    }
	
	function xmlToObject($xml) {
		$obj = new stdclass();
		
		foreach($xml->foo[0]->attributes() as $a => $b) {
			echo $a,'="',$b,"\"\n";
		}
		
		
		/*$string = <<<XML
		<a>
		 <foo name="one" game="lonely">1</foo>
		</a>
		XML;

		$xml = simplexml_load_string($string);
		foreach($xml->foo[0]->attributes() as $a => $b) {
			echo $a,'="',$b,"\"\n";
		}*/
	}
	
	/**
	 * Echo SOAP/xml message when WS is disabled
	 * @param service name
	 * @return xml
	 */
	function echoXmlMessageWSDisabled($servicename) {
		
		$xml 	 = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml 	.= '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">';
		$xml 	.= '<SOAP-ENV:Body>';
		$xml 	.= '<SOAP-ENV:Fault>';
		$xml 	.= '<faultcode>';
		$xml 	.= 'SOAP-ENV:Server';
		$xml 	.= '</faultcode>';
		$xml 	.= '<faultstring>';
		$xml 	.= 'PrestaSOAP webservice ('.$servicename.') is disabled';
		$xml 	.= '</faultstring>';
		$xml 	.= '</SOAP-ENV:Fault>';
		$xml 	.= '</SOAP-ENV:Body>';
		$xml 	.= '</SOAP-ENV:Envelope>';
		
		header('Content-type: text/xml; charset=UTF-8'); 
		header("Content-Length: ".strlen($xml));
		
		echo $xml;
		exit();
	}	
	

	ob_end_clean();

?>
