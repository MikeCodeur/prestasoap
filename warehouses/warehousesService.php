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
	function GetWarehouseById($params) {
		
		$resource = 'warehouses';
		$resourceSingle = 'warehouse';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function GetWarehouses($params) {
	
		$resource = 'warehouses';
		$resourceSingle = 'warehouse';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function CreateWarehouse
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateWarehouse($params) {
		
		$resource = 'warehouses';
		$resourceSingle = 'warehouse';
		
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function UpdateWarehouse
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateWarehouse($params) {
		
		$resource = 'warehouses';
		$resourceSingle = 'warehouse';
		
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function UpdateWarehouse
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteWarehouse($params) {
		
		$resource = 'warehouses';
		$resourceSingle = 'warehouse';
		
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = 1;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_warehouses);
		
		/* Add Functions */
		
		$server->addFunction("GetWarehouses");
		$server->addFunction("GetWarehouseById");
		$server->addFunction("CreateWarehouse");
		$server->addFunction("UpdateWarehouse");
		$server->addFunction("DeleteWarehouse");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 