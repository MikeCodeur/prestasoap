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
	function GetSupply_order_stateById($params) {
		
		$resource = 'supply_order_states';
		$resourceSingle = 'supply_order_state';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetSupply_order_states($params) {
	
		$resource = 'supply_order_states';
		$resourceSingle = 'supply_order_state';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateSupply_order_state($params) {
		
		$resource = 'supply_order_states';
		$resourceSingle = 'supply_order_state';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateSupply_order_state($params) {
		
		$resource = 'supply_order_states';
		$resourceSingle = 'supply_order_state';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteSupply_order_state($params) {
		
		$resource = 'supply_order_states';
		$resourceSingle = 'supply_order_state';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_supply_order_states);
		
		/* Add Functions */
		$server->addFunction("GetSupply_order_states");
		$server->addFunction("GetSupply_order_stateById");
		$server->addFunction("CreateSupply_order_state");
		$server->addFunction("UpdateSupply_order_state");
		$server->addFunction("DeleteSupply_order_state");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 