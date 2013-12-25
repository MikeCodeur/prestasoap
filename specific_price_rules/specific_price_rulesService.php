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
	function GetSpecific_price_ruleById($params) {
		
		$resource = 'specific_price_rules';
		$resourceSingle = 'specific_price_rule';
		return GetById($params,$resource,$resourceSingle);
		
	}
	/**
    * This function GetALL
	* (expose as WS)
    * @param
    * @return 
   */
	function GetSpecific_price_rules($params) {
	
		$resource = 'specific_price_rules';
		$resourceSingle = 'specific_price_rule';
		return GetList($params,$resource,$resourceSingle);
		
	}
	
	/**
    * This function Crete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateSpecific_price_rule($params) {
		
		$resource = 'specific_price_rules';
		$resourceSingle = 'specific_price_rule';
		return CreateMapper($params,$resource,$resourceSingle);
	}
	
	/**
    * This function Update Object
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateSpecific_price_rule($params) {
		
		$resource = 'specific_price_rules';
		$resourceSingle = 'specific_price_rule';
		return UpdateMapper($params,$resource,$resourceSingle);
	
	}
	
	/**
    * This function Delete Object
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteSpecific_price_rule($params) {
		
		$resource = 'specific_price_rules';
		$resourceSingle = 'specific_price_rule';
		return DeleteMapper($params,$resource,$resourceSingle);
	
	}

	
	
	
	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_SPECIFIC_PRICE_RULES);
		
		/* Add Functions */
		$server->addFunction("GetSpecific_price_rules");
		$server->addFunction("GetSpecific_price_ruleById");
		$server->addFunction("CreateSpecific_price_rule");
		$server->addFunction("UpdateSpecific_price_rule");
		$server->addFunction("DeleteSpecific_price_rule");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 