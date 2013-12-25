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
	function GetAddressById($params) {
		
		$resource = 'addresses';
		$resourceSingle = 'address';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function GetAddresses($params) {
	
		$resource = 'addresses';
		$resourceSingle = 'address';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function CreateAddress
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateAddress($params) {
		
		$resource = 'addresses';
		$resourceSingle = 'address';
		
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function UpdateAddress
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateAddress($params) {
		
		$resource = 'addresses';
		$resourceSingle = 'address';
		
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function UpdateAddress
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteAddress($params) {
		
		$resource = 'addresses';
		$resourceSingle = 'address';
		
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = 1;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_ADDRESSES);
		
		/* Add Functions */
		
		$server->addFunction("GetAddresses");
		$server->addFunction("GetAddressById");
		$server->addFunction("CreateAddress");
		$server->addFunction("UpdateAddress");
		$server->addFunction("DeleteAddress");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 