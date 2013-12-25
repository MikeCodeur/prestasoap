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
	function Search($params) {
			
		return SearchREST($params);
		
	}
	
	
	/**
    * This function GetById
	* (expose as WS)
    * @param
    * @return 
   */
	function SearchREST($params) {
		
		/*Start */
		$RESTresource = 'search';
				
		$key = $params->loginInfo->key;
		if (FORCEPASS){
			$key  = PS_WS_AUTH_KEY;
		}
		$query = $params->Search->query;
		$lang = $params->Search->language;
		
		try
		{
			$webService = new PrestaShopWebservice(PS_SHOP_PATH, $key, DEBUG);
				
			// Here we set the option array for the Webservice : we want customers resources
			$opt = array('resource' => $RESTresource);
			$opt['query'] = $query;
			$opt['language'] = $lang;
			// Call
			
			$xml = $webService->get($opt);
			$xml = toWsdlObj($xml);//convert xml to array (for soap)

				
		}
		catch (PrestaShopWebserviceException $ex)
		{
			$trace = $ex->getTrace();
		//	var_dump("toto");die;
			$httpCode = (string)$trace[0]['args'][0] ;
			if ($trace[0]['args'][0] == 404) return new SoapFault($httpCode, 'Bad ID',"PrestaShoapWSBadIDFault");
			else if ($trace[0]['args'][0] == 401) return new SoapFault($httpCode, 'Bad auth key',"PrestaShoapWSBadKeyFault");
			else return new SoapFault($httpCode, 'Other error : '.$ex->getMessage(),"PrestaShoapWSFault");
		}

		return $xml;

	}
	
	
	/**
    * Check if xml has product/category children and tranform them
	* (NOT expose as WS)
    * @param
    * @return 
   */
	function toWsdlObj($xml) {
		
		$ObjectToReturn['products'] = null;
		$ObjectToReturn['categories']= null;
		
		//prod
		$xmlElmt = $xml->products->product;
		foreach ($xmlElmt as $nodeKey => $node)
		{
			$ObjectToReturn['products'][] = convertToObj($node,'product');
		}
		
		//cat
		$xmlElmt = $xml->categories->category;
		foreach ($xmlElmt as $nodeKey => $node)
		{
			$ObjectToReturn['categories'][] = convertToObj($node,'category');
		}
		
		return $ObjectToReturn;
		
		
	}
		
	function convertToObj($xmlElmt,$type) {
		
		$id =$xmlElmt->attributes()->id ;
		$xlink = $xmlElmt->attributes('xlink', true) ;
		$xmlElmt->id = $id;
		$xmlElmt->xlink = $xlink;
		
		if ($type = "product"){
			$product = new Product();
			$product->id = $id;
			$product->xlink = $xlink;
			return $product;
		}
		if ($type = "category"){
			$category = new Category();
			$category->id = $id;
			$category->xlink = $xlink;
			return $category;
		}
		
		
	}
	
	/**
    * Check if xml has product/category children and tranform them
	* (NOT expose as WS)
    * @param
    * @return 
   */
   
	function convert($xmlElmt) {
		
		$id =$xmlElmt->attributes()->id ;
		$xlink = $xmlElmt->attributes('xlink', true) ;
		//var_dump($xmlElmt);die;
		$xmlElmt->id = $id;
		$xmlElmt->xlink = $xlink;
		
	}
	
	
	
	

	
	$soap_ws_custom_on = WSDL_SERVICES_ON;
	/* SOAP SETTINGS */
	if ($soap_ws_custom_on==1){
		$soap_ws_custom_cache_on = WSDL_CACHE_ON;
		ini_set("soap.wsdl_cache_enabled", $soap_ws_custom_cache_on); // wsdl cache settings
		$options = array('soap_version' => SOAP_1_2);
		
		/** SOAP SERVER **/
		$server = new SoapServer(WSDL_search);
		
		/* Add Functions */
		$server->addFunction("Search");


		$server->handle();
		
	}else{
		echoXmlMessageWSDisabled('Zone');
	}
?> 