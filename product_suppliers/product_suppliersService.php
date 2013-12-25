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
	function GetProduct_supplierById($params) {
		
		$resource = 'product_suppliers';
		$resourceSingle = 'product_supplier';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetProduct_suppliers($params) {
	
		$resource = 'product_suppliers';
		$resourceSingle = 'product_supplier';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateProduct_supplier($params) {
		
		$resource = 'product_suppliers';
		$resourceSingle = 'product_supplier';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateProduct_supplier($params) {
		
		$resource = 'product_suppliers';
		$resourceSingle = 'product_supplier';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteProduct_supplier($params) {
		
		$resource = 'product_suppliers';
		$resourceSingle = 'product_supplier';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_PRODUCT_SUPPLIERS);
		
		/* Add Functions */
		$server->addFunction("GetProduct_suppliers");
		$server->addFunction("GetProduct_supplierById");
		$server->addFunction("CreateProduct_supplier");
		$server->addFunction("UpdateProduct_supplier");
		$server->addFunction("DeleteProduct_supplier");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Product_supplier');
	}
?> 