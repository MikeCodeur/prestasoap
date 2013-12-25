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
	function GetStock_movement_reasonById($params) {
		
		$resource = 'stock_movement_reasons';
		$resourceSingle = 'stock_movement_reason';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetStock_movement_reasons($params) {
	
		$resource = 'stock_movement_reasons';
		$resourceSingle = 'stock_movement_reason';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateStock_movement_reason($params) {
		
		$resource = 'stock_movement_reasons';
		$resourceSingle = 'stock_movement_reason';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateStock_movement_reason($params) {
		
		$resource = 'stock_movement_reasons';
		$resourceSingle = 'stock_movement_reason';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteStock_movement_reason($params) {
		
		$resource = 'stock_movement_reasons';
		$resourceSingle = 'stock_movement_reason';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_stock_movement_reasons);
		
		/* Add Functions */
		$server->addFunction("GetStock_movement_reasons");
		$server->addFunction("GetStock_movement_reasonById");
		$server->addFunction("CreateStock_movement_reason");
		$server->addFunction("UpdateStock_movement_reason");
		$server->addFunction("DeleteStock_movement_reason");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 