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

	
	/**
    * This function GetCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function GetCarrierById($params) {
		
		$resource = 'carriers';
		$resourceSingle = 'carrier';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function GetCarriers($params) {
	
		$resource = 'carriers';
		$resourceSingle = 'carrier';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function CreateCarrier
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateCarrier($params) {
		
		$resource = 'carriers';
		$resourceSingle = 'carrier';
		
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function UpdateCarrier
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateCarrier($params) {
		
		$resource = 'carriers';
		$resourceSingle = 'carrier';
		
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function UpdateCarrier
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteCarrier($params) {
		
		$resource = 'carriers';
		$resourceSingle = 'carrier';
		
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = 1;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = 1;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_CARRIERS);
		
		/* Add Functions */
		
		$server->addFunction("GetCarriers");
		$server->addFunction("GetCarrierById");
		$server->addFunction("CreateCarrier");
		$server->addFunction("UpdateCarrier");
		$server->addFunction("DeleteCarrier");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 