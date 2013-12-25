<?php

define( '_PS_VERSION_', 1 );

/**
 * Prestashop SOAP Connector
 *
 * Prestashop SOAP Connector 
 *
 * @package    prestasoap
 * @subpackage modules
 * @author     Mickael cabanas (cabanas.mickael|at|gmail.com)
 * @copyright  2012 Mickael Cabanas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    $Id:$
 */

 /** loading framework **/
include_once('../Commons.php');

	
	/**
    * This function getByID
	* (expose as WS)
    * @param
    * @return 
   */
	function GetWarehouse_product_locationById($params) {
		
		$resource = 'warehouse_product_locations';
		$resourceSingle = 'warehouse_product_location';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetWarehouse_product_locations($params) {
	
		$resource = 'warehouse_product_locations';
		$resourceSingle = 'warehouse_product_location';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateWarehouse_product_location($params) {
		
		$resource = 'warehouse_product_locations';
		$resourceSingle = 'warehouse_product_location';
		
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateWarehouse_product_location($params) {
		
		$resource = 'warehouse_product_locations';
		$resourceSingle = 'warehouse_product_location';
		
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteWarehouse_product_location($params) {
		
		$resource = 'warehouse_product_locations';
		$resourceSingle = 'warehouse_product_location';
		
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_warehouse_product_locations);
		
		/* Add Functions */
		$server->addFunction("GetWarehouse_product_locations");
		$server->addFunction("GetWarehouse_product_locationById");
		$server->addFunction("CreateWarehouse_product_location");
		$server->addFunction("UpdateWarehouse_product_location");
		$server->addFunction("DeleteWarehouse_product_location");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 