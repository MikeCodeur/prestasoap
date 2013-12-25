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
	function GetStock_mvtById($params) {
		
		$WSRestresource = 'stock_movements';
		$resource = 'stock_mvts';
		$resourceSingle = 'stock_mvt';
		return GetById($params,$resource,$resourceSingle,$WSRestresource);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetStock_mvts($params) {
	
		$WSRestresource = 'stock_movements';
		$resource = 'stock_mvts';
		$resourceSingle = 'stock_mvt';
		return GetList($params,$resource,$resourceSingle,$WSRestresource);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateStock_mvt($params) {
		
		$WSRestresource = 'stock_movements';
		$resource = 'stock_mvts';
		$resourceSingle = 'stock_mvt';
		return CreateMapper($params,$resource,$resourceSingle,$WSRestresource);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateStock_mvt($params) {
		
		$WSRestresource = 'stock_movements';
		$resource = 'stock_mvts';
		$resourceSingle = 'stock_mvt';
		return UpdateMapper($params,$resource,$resourceSingle,$WSRestresource);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteStock_mvt($params) {
		
		$WSRestresource = 'stock_movements';
		$resource = 'stock_mvts';
		$resourceSingle = 'stock_mvt';
		return DeleteMapper($params,$resource,$resourceSingle,$WSRestresource);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_stock_movements);
		
		/* Add Functions */
		$server->addFunction("GetStock_mvts");
		$server->addFunction("GetStock_mvtById");
		$server->addFunction("CreateStock_mvt");
		$server->addFunction("UpdateStock_mvt");
		$server->addFunction("DeleteStock_mvt");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 