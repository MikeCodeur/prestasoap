<?php

define( '_PS_VERSION_', 1 );

/**
 * Prestashop User SOA Connector
 *
 * Prestashop User SOA Connector 
 *
 * @package    com_vm_soa
 * @subpackage modules
 * @author     Mickael cabanas (cabanas.mickael|at|gmail.com)
 * @copyright  2012 Mickael Cabanas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    $Id:$
 */

 /** loading framework **/
include_once('../Commons.php');

	
	/**
    * This function GetCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function GetguestById($params) {
		
		$resource = 'guests';
		$resourceSingle = 'guest';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function Getguests($params) {
	
		$resource = 'guests';
		$resourceSingle = 'guest';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Creategueste
	* (expose as WS)
    * @param
    * @return 
   */
	function Createguest($params) {
		
		$resource = 'guests';
		$resourceSingle = 'guest';
		
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Updategueste
	* (expose as WS)
    * @param
    * @return 
   */
	function Updateguest($params) {
		
		$resource = 'guests';
		$resourceSingle = 'guest';
		
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Updategueste
	* (expose as WS)
    * @param
    * @return 
   */
	function Deleteguest($params) {
		
		$resource = 'guests';
		$resourceSingle = 'guest';
		
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = 1;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_GUESTS);
		
		/* Add Functions */
		
		$server->addFunction("Getguests");
		$server->addFunction("GetguestById");
		$server->addFunction("Createguest");
		$server->addFunction("Updateguest");
		$server->addFunction("Deleteguest");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 