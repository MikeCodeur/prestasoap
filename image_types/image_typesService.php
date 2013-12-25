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
	function GetImages_typeById($params) {
		
		$resource = 'images_types';
		$resourceSingle = 'images_type';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetImages_types($params) {
	
		$resource = 'images_types';
		$resourceSingle = 'images_type';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateImages_type($params) {
		
		$resource = 'images_types';
		$resourceSingle = 'images_type';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateImages_type($params) {
		
		$resource = 'images_types';
		$resourceSingle = 'images_type';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteImages_type($params) {
		
		$resource = 'images_types';
		$resourceSingle = 'images_type';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_IMAGE_TYPES);
		
		/* Add Functions */
		$server->addFunction("GetImages_types");
		$server->addFunction("GetImages_typeById");
		$server->addFunction("CreateImages_type");
		$server->addFunction("UpdateImages_type");
		$server->addFunction("DeleteImages_type");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Images_type');
	}
?> 