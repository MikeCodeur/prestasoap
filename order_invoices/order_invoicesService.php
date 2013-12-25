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
	function GetOrder_invoiceById($params) {
		
		$resource = 'order_invoices';
		$resourceSingle = 'order_invoice';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetOrder_invoices($params) {
	
		$resource = 'order_invoices';
		$resourceSingle = 'order_invoice';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateOrder_invoice($params) {
		
		$resource = 'order_invoices';
		$resourceSingle = 'order_invoice';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateOrder_invoice($params) {
		
		$resource = 'order_invoices';
		$resourceSingle = 'order_invoice';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteOrder_invoice($params) {
		
		$resource = 'order_invoices';
		$resourceSingle = 'order_invoice';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_ORDER_INVOICES);
		
		/* Add Functions */
		$server->addFunction("GetOrder_invoices");
		$server->addFunction("GetOrder_invoiceById");
		$server->addFunction("CreateOrder_invoice");
		$server->addFunction("UpdateOrder_invoice");
		$server->addFunction("DeleteOrder_invoice");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Order_invoice');
	}
?> 