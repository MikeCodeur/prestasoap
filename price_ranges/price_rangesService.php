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
	function GetPrice_rangeById($params) {
		
		$resource = 'price_ranges';
		$resourceSingle = 'price_range';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetPrice_ranges($params) {
	
		$resource = 'price_ranges';
		$resourceSingle = 'price_range';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreatePrice_range($params) {
		
		$resource = 'price_ranges';
		$resourceSingle = 'price_range';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdatePrice_range($params) {
		
		$resource = 'price_ranges';
		$resourceSingle = 'price_range';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeletePrice_range($params) {
		
		$resource = 'price_ranges';
		$resourceSingle = 'price_range';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_PRICE_RANGES);
		
		/* Add Functions */
		$server->addFunction("GetPrice_ranges");
		$server->addFunction("GetPrice_rangeById");
		$server->addFunction("CreatePrice_range");
		$server->addFunction("UpdatePrice_range");
		$server->addFunction("DeletePrice_range");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Price_range');
	}
?> 