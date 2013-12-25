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
	function GetSpecific_priceById($params) {
		
		$resource = 'specific_prices';
		$resourceSingle = 'specific_price';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetSpecific_prices($params) {
	
		$resource = 'specific_prices';
		$resourceSingle = 'specific_price';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateSpecific_price($params) {
		
		$resource = 'specific_prices';
		$resourceSingle = 'specific_price';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateSpecific_price($params) {
		
		$resource = 'specific_prices';
		$resourceSingle = 'specific_price';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteSpecific_price($params) {
		
		$resource = 'specific_prices';
		$resourceSingle = 'specific_price';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_specific_prices);
		
		/* Add Functions */
		$server->addFunction("GetSpecific_prices");
		$server->addFunction("GetSpecific_priceById");
		$server->addFunction("CreateSpecific_price");
		$server->addFunction("UpdateSpecific_price");
		$server->addFunction("DeleteSpecific_price");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 