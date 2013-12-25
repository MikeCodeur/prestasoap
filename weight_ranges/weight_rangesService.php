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
	function GetWeight_rangeById($params) {
		
		$resource = 'weight_ranges';
		$resourceSingle = 'weight_range';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function GetWeight_ranges($params) {
	
		$resource = 'weight_ranges';
		$resourceSingle = 'weight_range';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function CreateWeight_range
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateWeight_range($params) {
		
		$resource = 'weight_ranges';
		$resourceSingle = 'weight_range';
		
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function UpdateWeight_range
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateWeight_range($params) {
		
		$resource = 'weight_ranges';
		$resourceSingle = 'weight_range';
		
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function UpdateWeight_range
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteWeight_range($params) {
		
		$resource = 'weight_ranges';
		$resourceSingle = 'weight_range';
		
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = 1;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_weight_ranges);
		
		/* Add Functions */
		
		$server->addFunction("GetWeight_ranges");
		$server->addFunction("GetWeight_rangeById");
		$server->addFunction("CreateWeight_range");
		$server->addFunction("UpdateWeight_range");
		$server->addFunction("DeleteWeight_range");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 