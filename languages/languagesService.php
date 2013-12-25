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
//include_once('../CRUDMapper.php');
	
	/**
    * This function GetCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function GetLanguageById($params) {
		
		$resource = 'languages';
		$resourceSingle = 'language';
		return GetById($params,$resource,$resourceSingle);
		
		/*Start */
		$resource = 'languages';
		$key = $params->loginInfo->key;
		if (DEBUG){
			$key  = PS_WS_AUTH_KEY_CUSTOMER;
		}
		$id = $params->id;
		
		try
		{
			$webService = new PrestaShopWebservice(PS_SHOP_PATH, $key, DEBUG);
			
			// Here we set the option array for the Webservice : we want customers resources
			$opt['resource'] = $resource;
			$opt['id'] = (int)$id;
			// Call
			$xml = $webService->get($opt);

			// Here we get the elements from children of customers markup "customer"
			//$resources = $xml->customers->children();
			

		}
		catch (PrestaShopWebserviceException $ex)
		{
			// Here we are dealing with errors
			$trace = $ex->getTrace();
			//var_dump($trace);die;
			if ($trace[0]['args'][0] == 404) return new SoapFault("PrestaShoapWSBadIDFault", 'Bad ID');
			else if ($trace[0]['args'][0] == 401) return new SoapFault("PrestaShoapWSBadKeyFault", 'Bad auth key');
			else return new SoapFault("PrestaShoapWSFault", 'Other error : '.$ex->getMessage());
		}

		/*$customersoap->id = $xml->customers->customer->attributes->id;
		$customersoap->xlink = "df";
		$customArray[] = $customersoap;*/
		return $xml;
		//return $customArray;

	}
	/**
    * This function GetCustomer
	* (expose as WS)
    * @param
    * @return 
   */
	function GetLanguages($params) {
	
		$resource = 'languages';
		$resourceSingle = 'language';
		return GetList($params,$resource,$resourceSingle);
		
		/*Start */
		$resource = 'languages';
		$resourceSignle = 'language';
		$key = $params->loginInfo->key;
		if (DEBUG){
			$key  = PS_WS_AUTH_KEY_CUSTOMER;
		}
		//$id = $params->id;
		
		try
		{
			$webService = new PrestaShopWebservice(PS_SHOP_PATH, $key, DEBUG);
			
			// Here we set the option array for the Webservice : we want customers resources
			$opt['resource'] = $resource;
			//$opt['id'] = (int)$id;
			// Call
			$xml = $webService->get($opt);	

			// Here we get the elements from children of customers markup "customer"
			$resources = $xml->$resource->children();
			//return $xml;
			//var_dump($xml);die;
			//$arr = toArray($xml);
			//var_dump($arr);die;*/
		}
		catch (PrestaShopWebserviceException $ex)
		{
			// Here we are dealing with errors
			$trace = $ex->getTrace();
			//var_dump($trace);die;
			if ($trace[0]['args'][0] == 404) return new SoapFault("PrestaShoapWSBadIDFault", 'Bad ID');
			else if ($trace[0]['args'][0] == 401) return new SoapFault("PrestaShoapWSBadKeyFault", 'Bad auth key');
			else return new SoapFault("PrestaShoapWSFault", 'Other error : '.$ex->getMessage());
		}
		
		foreach($resources->$resourceSignle as $elm){
			//var_dump($cust->attributes()->id);die;
			$commonXlink = new CommonXlink();
			$commonXlink->id =$elm->attributes()->id ;
			$commonXlink->xlink = $elm->attributes('xlink', true) ;
			$commonXlink->type = $opt['resource'] ;
			$commonListArray[] = $commonXlink;
		}
		
		//var_dump($id);die;
		return $commonListArray;

	}
	
	/**
    * This function CreateLanguage
	* (expose as WS)
    * @param
    * @return 
   */
	function CreateLanguage($params) {
		
		$resource = 'languages';
		$resourceSingle = 'language';
		
		return CreateMapper($params,$resource,$resourceSingle);
		
		/*Start */
		$key = $params->loginInfo->key;
		if (DEBUG){
			$key  = PS_WS_AUTH_KEY_CUSTOMER;
		}
		//$id = $params->id;
		
		// Here we use the WebService to get the schema of "customers" resource
		try
		{
			$webService = new PrestaShopWebservice(PS_SHOP_PATH, $key, DEBUG);
			$opt = array('resource' => 'languages');
			
			$xml = $webService->get(array('url' => PS_SHOP_PATH.'/api/languages?schema=blank'));
			
			//$xml = $webService->get($opt);
			$resources = $xml->children()->children();
		}
		catch (PrestaShopWebserviceException $ex)
		{
			// Here we are dealing with errors
			$trace = $ex->getTrace();
			//var_dump($trace);die;
			if ($trace[0]['args'][0] == 404) return new SoapFault("PrestaShoapWSBadIDFault", 'Bad ID');
			else if ($trace[0]['args'][0] == 401) return new SoapFault("PrestaShoapWSBadKeyFault", 'Bad auth key');
			else return new SoapFault("PrestaShoapWSFault", 'Other error : '.$ex->getMessage());
		}
		
		// Here we have XML before update, lets update XML
		foreach ($resources as $nodeKey => $node)
		{
			//if soap params empty -> get old params
			if (!empty($params->language->$nodeKey)){
				$resources->$nodeKey = $params->language->$nodeKey;
			}else{
				$resources->$nodeKey = $node;
			}
		}
		
		try
		{
			$opt = array('resource' => 'languages');
			$opt['postXml'] = $xml->asXML();
			$xml = $webService->add($opt);
			$commonReturn = new commonReturn('Successfully added.','','');
			return commonReturn;
			
		}
		catch (PrestaShopWebserviceException $ex)
		{
			// Here we are dealing with errors
			$trace = $ex->getTrace();
			//var_dump($trace);die;
			if ($trace[0]['args'][0] == 404) return new SoapFault("PrestaShoapWSBadIDFault", 'Bad ID');
			else if ($trace[0]['args'][0] == 401) return new SoapFault("PrestaShoapWSBadKeyFault", 'Bad auth key');
			else return new SoapFault("PrestaShoapWSFault", 'Other error : '.$ex->getMessage());
		}

	}
	
	/**
    * This function UpdateLanguage
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateLanguage($params) {
		
		$resource = 'languages';
		$resourceSingle = 'language';
		
		return UpdateMapper($params,$resource,$resourceSingle);
		
		/*Start */
		$key = $params->loginInfo->key;
		if (DEBUG){
			$key  = PS_WS_AUTH_KEY_CUSTOMER;
		}
		$id = $params->language->id;
		//var_dump($id);die;
		// First : We always get the customer's list or a specific one
		try
		{
			$webService = new PrestaShopWebservice(PS_SHOP_PATH, $key, DEBUG);
			$opt = array('resource' => 'languages');
			if (isset($id))
				$opt['id'] = $id;
			$xml = $webService->get($opt);
			
			// Here we get the elements from children of customer markup which is children of prestashop root markup
			$resources = $xml->children()->children();
			//var_dump($resources->id);die;
		}
		catch (PrestaShopWebserviceException $ex)
		{
			// Here we are dealing with errors
			$trace = $ex->getTrace();
			if ($trace[0]['args'][0] == 404) return new SoapFault("1PrestaShoapWSBadIDFault", 'Bad ID');
			else if ($trace[0]['args'][0] == 401) return new SoapFault("1PrestaShoapWSBadKeyFault", 'Bad auth key');
			else return new SoapFault("PrestaShoapWSFault", 'Other error : '.$ex->getMessage());
		}
		
		//NOW UPADTE
		
		// Here we have XML before update, lets update XML with new values
		foreach ($resources as $nodeKey => $node)
		{
			//if soap params empty -> get old params
			if (!empty($params->language->$nodeKey)){
				$resources->$nodeKey = $params->language->$nodeKey;
			}else{
				$resources->$nodeKey = $node;
			}
		}
		
		// And call the web service
		try
		{
			$webService = new PrestaShopWebservice(PS_SHOP_PATH, $key, DEBUG);
			$opt = array('resource' => 'languages');
			$opt['putXml'] = $xml->asXML();
			$opt['id'] = $id;
			//var_dump($opt);die;
			$xml = $webService->edit($opt);
			// if WebService don't throw an exception the action worked well and we don't show the following message
			$commonReturn = new commonReturn('df','','');
			return commonReturn;
		}
		catch (PrestaShopWebserviceException $ex)
		{
			// Here we are dealing with errors
			$trace = $ex->getTrace();
			//var_dump($ex);die;
			if ($trace[0]['args'][0] == 404) return new SoapFault("2PrestaShoapWSBadIDFault", 'Bad ID');
			else if ($trace[0]['args'][0] == 401) return new SoapFault("2PrestaShoapWSBadKeyFault", 'Bad auth key');
			else return new SoapFault("2PrestaShoapWSFault", 'Other error : '.$ex->getMessage());
		}
		$commonReturn = new commonReturn('df','','');
		return commonReturn;

	}

	
	
	
	
	$soap_ws_custom_on = 1;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = 1;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_LANG);
		
		/* Add Functions */
		
		$server->addFunction("GetLanguages");
		$server->addFunction("GetLanguageById");
		$server->addFunction("CreateLanguage");
		$server->addFunction("UpdateLanguage");

		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Customer');
	}
?> 