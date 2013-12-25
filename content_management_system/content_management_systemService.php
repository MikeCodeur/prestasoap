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
	function GetContentById($params) {
		
		$resource = 'content_management_system';
		$resourceSingle = 'content';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetContent_management_system($params) {
	
		$resource = 'content_management_system';
		$resourceSingle = 'content';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateContent($params) {
		
		$resource = 'content_management_system';
		$resourceSingle = 'content';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateContent($params) {
		
		$resource = 'content_management_system';
		$resourceSingle = 'content';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteContent($params) {
		
		$resource = 'content_management_system';
		$resourceSingle = 'content';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_CONTENT_MANAGEMENT_SYSTEM);
		
		/* Add Functions */
		$server->addFunction("GetContent_management_system");
		$server->addFunction("GetContentById");
		$server->addFunction("CreateContent");
		$server->addFunction("UpdateContent");
		$server->addFunction("DeleteContent");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Content');
	}
?> 