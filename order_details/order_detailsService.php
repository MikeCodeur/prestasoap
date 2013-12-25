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
	function GetOrder_detailById($params) {
		
		$resource = 'order_details';
		$resourceSingle = 'order_detail';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetOrder_details($params) {
	
		$resource = 'order_details';
		$resourceSingle = 'order_detail';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateOrder_detail($params) {
		
		$resource = 'order_details';
		$resourceSingle = 'order_detail';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateOrder_detail($params) {
		
		$resource = 'order_details';
		$resourceSingle = 'order_detail';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteOrder_detail($params) {
		
		$resource = 'order_details';
		$resourceSingle = 'order_detail';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_ORDER_DETAILS);
		
		/* Add Functions */
		$server->addFunction("GetOrder_details");
		$server->addFunction("GetOrder_detailById");
		$server->addFunction("CreateOrder_detail");
		$server->addFunction("UpdateOrder_detail");
		$server->addFunction("DeleteOrder_detail");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Order_detail');
	}
?> 