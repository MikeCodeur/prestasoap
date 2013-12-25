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
	function GetCustomerById($params) {
		
		$resource = 'customers';
		$resourceSingle = 'customer';
		return GetById($params,$resource,$resourceSingle);

	}
	/**
    * This function GetCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function GetCustomers($params) {
		
		/*Start */
		$resource = 'customers';
		$resourceSingle = 'customer';
		return GetList($params,$resource,$resourceSingle);

	}
	
	/**
    * This function CreateCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateCustomer($params) {
		
		/*Start */
		$resource = 'customers';
		$resourceSingle = 'customer';
		
		return CreateMapper($params,$resource,$resourceSingle);

	}
	
	/**
    * This function UpdateCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateCustomer($params) {
		
		$resource = 'customers';
		$resourceSingle = 'customer';
		
		return UpdateMapper($params,$resource,$resourceSingle);

	}

	
	
	
	
	$soap_ws_custom_on = 1;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = 1;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_CUSTOMER);
		
		/* Add Functions */
		
		$server->addFunction("GetCustomers");
		$server->addFunction("GetCustomerById");
		$server->addFunction("CreateCustomer");
		$server->addFunction("UpdateCustomer");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Customer');
	}
?> 