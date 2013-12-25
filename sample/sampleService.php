<?php
define( '_PS_VERSION_', 1 );

/**
 * Prestashop User SOA Connector
 *
 * Prestashop User SOA Connector 
 *
 * @package    com_vm_soa
 * @subpackage modules
 * @author     Mickael cabanas (cabanas.mickael|at|gmail.com)
 * @copyright  2012 Mickael Cabanas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    $Id:$
 */

 /** loading framework **/
include_once('../Commons.php');
//include_once('../CRUDMapper.php');
	
	/**
    * This function GetCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function GetSampleById($params) {
		
		$resource = 'languages';
		$resourceSingle = 'language';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function GetSamples($params) {
	
		$resource = 'languages';
		$resourceSingle = 'language';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function CreateSample
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateSample($params) {
		
		$resource = 'languages';
		$resourceSingle = 'language';
		
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function UpdateSample
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateSample($params) {
		
		$resource = 'languages';
		$resourceSingle = 'language';
		
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = 1;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = 1;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_SAMPLE);
		
		/* Add Functions */
		
		$server->addFunction("GetSamples");
		$server->addFunction("GetSampleById");
		$server->addFunction("CreateSample");
		$server->addFunction("UpdateSample");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Customer');
	}
?> 