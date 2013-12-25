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
	function GetSupply_order_detailById($params) {
		
		$resource = 'supply_order_details';
		$resourceSingle = 'supply_order_detail';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetSupply_order_details($params) {
	
		$resource = 'supply_order_details';
		$resourceSingle = 'supply_order_detail';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateSupply_order_detail($params) {
		
		$resource = 'supply_order_details';
		$resourceSingle = 'supply_order_detail';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateSupply_order_detail($params) {
		
		$resource = 'supply_order_details';
		$resourceSingle = 'supply_order_detail';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteSupply_order_detail($params) {
		
		$resource = 'supply_order_details';
		$resourceSingle = 'supply_order_detail';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_supply_order_details);
		
		/* Add Functions */
		$server->addFunction("GetSupply_order_details");
		$server->addFunction("GetSupply_order_detailById");
		$server->addFunction("CreateSupply_order_detail");
		$server->addFunction("UpdateSupply_order_detail");
		$server->addFunction("DeleteSupply_order_detail");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 