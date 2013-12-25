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
	function GetTax_rule_groupById($params) {
		
		$resource = 'tax_rule_groups';
		$resourceSingle = 'tax_rule_group';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetTax_rule_groups($params) {
	
		$resource = 'tax_rule_groups';
		$resourceSingle = 'tax_rule_group';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateTax_rule_group($params) {
		
		$resource = 'tax_rule_groups';
		$resourceSingle = 'tax_rule_group';
		
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateTax_rule_group($params) {
		
		$resource = 'tax_rule_groups';
		$resourceSingle = 'tax_rule_group';
		
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteTax_rule_group($params) {
		
		$resource = 'tax_rule_groups';
		$resourceSingle = 'tax_rule_group';
		
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_tax_rule_groups);
		
		/* Add Functions */
		$server->addFunction("GetTax_rule_groups");
		$server->addFunction("GetTax_rule_groupById");
		$server->addFunction("CreateTax_rule_group");
		$server->addFunction("UpdateTax_rule_group");
		$server->addFunction("DeleteTax_rule_group");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('tax_rule_groups');
	}
?> 