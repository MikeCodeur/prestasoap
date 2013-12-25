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
	function GetProduct_optionById($params) {
		
		$resource = 'product_options';
		$resourceSingle = 'product_option';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetProduct_options($params) {
	
		$resource = 'product_options';
		$resourceSingle = 'product_option';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateProduct_option($params) {
		
		$resource = 'product_options';
		$resourceSingle = 'product_option';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateProduct_option($params) {
		
		$resource = 'product_options';
		$resourceSingle = 'product_option';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteProduct_option($params) {
		
		$resource = 'product_options';
		$resourceSingle = 'product_option';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_product_options);
		
		/* Add Functions */
		$server->addFunction("GetProduct_options");
		$server->addFunction("GetProduct_optionById");
		$server->addFunction("CreateProduct_option");
		$server->addFunction("UpdateProduct_option");
		$server->addFunction("DeleteProduct_option");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 