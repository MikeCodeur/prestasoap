<?php 
define( '_PS_VERSION_', 1 );
//if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
 * Virtuemart Users SOA Connector
 *
 * THis file generate wsdl dynamicly whith good <soap:address location = ....
 *
 * @package    mod_vm_soa
 * @subpackage classes
 * @author     Mickael cabanas (cabanas.mickael|at|gmail.com)
 * @copyright  2010 Mickael Cabanas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    $Id:$
 */

ob_start();//to prevent some bad users change codes 

 /** loading framework **/
include_once('../Commons.php');

/** WSDL file name to load**/
$wsdlFilename =  WSDL_SHOPS;
$serviceFilename = SERVICE_SHOPS;

$string = file_get_contents($wsdlFilename,"r");
$wsdlReplace = $string;

$wsdlReplace = str_replace('http://___HOST___/___BASE___/', URI_ROOT, $wsdlReplace);
$wsdlReplace = str_replace('___MODULEDIR___', MOD_DIR, $wsdlReplace);



$wsdlReplace = str_replace("___SERVICE___", $serviceFilename, $wsdlReplace);

ob_end_clean();//to prevent some bad users change code 

/** echo WSDL **/
$soap_ws_custom_on = WSDL_SERVICES_ON;
if ($soap_ws_custom_on==1){
	header('Content-type: text/xml; charset=UTF-8'); 
	header("Content-Length: ".(strlen($wsdlReplace)));
	echo $wsdlReplace;
}
else{
	echoXmlMessageWSDisabled('Zone');
}
?>