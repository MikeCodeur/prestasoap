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
	function GetProduct_featureById($params) {
		
		$resource = 'product_features';
		$resourceSingle = 'product_feature';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetProduct_features($params) {
	
		$resource = 'product_features';
		$resourceSingle = 'product_feature';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateProduct_feature($params) {
		
		$resource = 'product_features';
		$resourceSingle = 'product_feature';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateProduct_feature($params) {
		
		$resource = 'product_features';
		$resourceSingle = 'product_feature';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteProduct_feature($params) {
		
		$resource = 'product_features';
		$resourceSingle = 'product_feature';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_PRODUCT_FEATURES);
		
		/* Add Functions */
		$server->addFunction("GetProduct_features");
		$server->addFunction("GetProduct_featureById");
		$server->addFunction("CreateProduct_feature");
		$server->addFunction("UpdateProduct_feature");
		$server->addFunction("DeleteProduct_feature");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Product_feature');
	}
?> 