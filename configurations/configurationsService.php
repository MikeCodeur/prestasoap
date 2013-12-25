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
	function GetConfigurationById($params) {
		
		$resource = 'configurations';
		$resourceSingle = 'configuration';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetConfigurations($params) {
	
		$resource = 'configurations';
		$resourceSingle = 'configuration';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateConfiguration($params) {
		
		$resource = 'configurations';
		$resourceSingle = 'configuration';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateConfiguration($params) {
		
		$resource = 'configurations';
		$resourceSingle = 'configuration';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteConfiguration($params) {
		
		$resource = 'configurations';
		$resourceSingle = 'configuration';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_CONFIGURATIONS);
		
		/* Add Functions */
		$server->addFunction("GetConfigurations");
		$server->addFunction("GetConfigurationById");
		$server->addFunction("CreateConfiguration");
		$server->addFunction("UpdateConfiguration");
		$server->addFunction("DeleteConfiguration");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Configuration');
	}
?> 