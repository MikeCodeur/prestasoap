<?php

defined('_PS_VERSION_') or die('Restricted access');

/**
 * Prestashop SOAP Connector
 *
 * Prestashop SOAP Connector
 *
 * @package    SOAP
 * @subpackage modules
 * @author     Mickael cabanas (cabanas.mickael|at|gmail.com)
 * @copyright  2012 Mickael Cabanas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    $Id:$
 */

 /** loading framework **/


	
	/**
    * This function GetById
	* (expose as WS)
    * @param
    * @return 
   */
	function GetById($params,$resource,$resourceSingle,$_RESTresource=null) {
		
		/*Start */
		$resource = $resource;
		$resourceSingle = $resourceSingle;
		$RESTresource = $_RESTresource;
		if (empty($_RESTresource)){
			$RESTresource = $resource;
		}
		
		
		$key = $params->loginInfo->key;
		if (FORCEPASS){
			$key  = PS_WS_AUTH_KEY;
		}
		$id = $params->id;
		
		try
		{
			$webService = new PrestaShopWebservice(PS_SHOP_PATH, $key, DEBUG);
			
			// Here we set the option array for the Webservice : we want customers resources
			$opt['resource'] = $RESTresource;
			$opt['id'] = (int)$id;
			// Call
			$xml = $webService->get($opt);	
			
			$xml = convertXlinkToLanguage($xml,$resource,$resourceSingle);		
					
		}
		catch (PrestaShopWebserviceException $ex)
		{
			$trace = $ex->getTrace();
			
			$httpCode = (string)$trace[0]['args'][0] ;
			if ($trace[0]['args'][0] == 404) return new SoapFault($httpCode, 'Bad ID',"PrestaShoapWSBadIDFault");
			else if ($trace[0]['args'][0] == 401) return new SoapFault($httpCode, 'Bad auth key',"PrestaShoapWSBadKeyFault");
			else return new SoapFault($httpCode, 'Other error : '.$ex->getMessage(),"PrestaShoapWSFault");
		}

		return $xml;

	}
	
	
	/**
    * This function GetCustomer
	* (expose as WS)
    * @param
    * @return 
   */
   
	function GetList($params,$resource,$resourceSingle, $_RESTresource=null) {
		
		/*Start */
		$resource = $resource;
		$resourceSingle = $resourceSingle;
		$RESTresource = $_RESTresource;
		if (empty($_RESTresource)){
			$RESTresource = $resource;
		}
		
		$key = $params->loginInfo->key;
		if (FORCEPASS){
			$key  = PS_WS_AUTH_KEY;
		}
		
		try
		{
			$webService = new PrestaShopWebservice(PS_SHOP_PATH, $key, DEBUG);
			
			// Here we set the option array for the Webservice : we want customers resources
			$opt['resource'] = $RESTresource;

			$xml = $webService->get($opt);	

			// Here we get the elements from children of customers markup "customer"
			$resources = $xml->$resource->children();
			
		}
		catch (PrestaShopWebserviceException $ex)
		{
			$trace = $ex->getTrace();
			
			$httpCode = (string)$trace[0]['args'][0] ;
			if ($trace[0]['args'][0] == 404) return new SoapFault($httpCode, 'Bad ID',"PrestaShoapWSBadIDFault");
			else if ($trace[0]['args'][0] == 401) return new SoapFault($httpCode, 'Bad auth key',"PrestaShoapWSBadKeyFault");
			else return new SoapFault($httpCode, 'Other error : '.$ex->getMessage(),"PrestaShoapWSFault");
		}
		//var_dump($resources);die;
		foreach($resources->$resourceSingle as $elm){
		
			$commonXlink = new CommonXlink();
			$commonXlink->id =$elm->attributes()->id ;
			$commonXlink->xlink = $elm->attributes('xlink', true) ;
			$commonXlink->type = $opt['resource'] ;
			$commonListArray[] = $commonXlink;
		}
		
		return $commonListArray;

	}
	
	/**
    * This function CreateLanguage
	* (expose as WS)
    * @params contains soap parameters
    * @return 
   */
	function CreateMapper($params,$resource,$resourceSingle, $_RESTresource=null) {
	
		$resource = $resource;
		$resourceSingle = $resourceSingle;
		$RESTresource = $_RESTresource;
		if (empty($_RESTresource)){
			$RESTresource = $resource;
		}
		
		//Start 
		$key = $params->loginInfo->key;
		if (FORCEPASS){
			$key  = PS_WS_AUTH_KEY;
		}
		
		// Here we use the WebService to get the schema of "customers" resource
		try
		{
			$webService = new PrestaShopWebservice(PS_SHOP_PATH, $key, DEBUG);
			$opt = array('resource' => $RESTresource);
			
			//$xml = $webService->get(array('url' => PS_SHOP_PATH.'/api/'.$RESTresource.'?schema=blank'));
			$xml = $webService->get(array('url' => PS_SHOP_PATH.'/api/'.$RESTresource.'?schema=synopsis'));
			
			$resources = $xml->children()->children();
		}
		catch (PrestaShopWebserviceException $ex)
		{
			$trace = $ex->getTrace();
			
			$httpCode = (string)$trace[0]['args'][0] ;
			if ($trace[0]['args'][0] == 404) return new SoapFault($httpCode, 'Bad ID',"PrestaShoapWSBadIDFault");
			else if ($trace[0]['args'][0] == 401) return new SoapFault($httpCode, 'Bad auth key',"PrestaShoapWSBadKeyFault");
			else return new SoapFault($httpCode, 'Other error : '.$ex->getMessage(),"PrestaShoapWSFault");
		}
		
		//We need to concert wsdl language object xlink
		$xml = convertLanguageToXlink($xml,$resource,$resourceSingle,$params);
		
		// Here we have XML before update, lets update XML
		foreach ($resources as $nodeKey => $node)
		{
			//if soap params empty -> get old params
			if (isset($params->$resourceSingle->$nodeKey)){
				$resources->$nodeKey = $params->$resourceSingle->$nodeKey;
			}else{
				$resources->$nodeKey = $node;
			}
		}
		
		//var_dump($xml->asXml());die;
		
		try
		{
			$opt = array('resource' => $resource);
			$opt['postXml'] = $xml->asXML();
			$xml = $webService->add($opt);
			$commonReturn = new commonReturn(OK_CODE,$resourceSingle.' Successfully created !','');
			return $commonReturn;
			
		}
		catch (PrestaShopWebserviceException $ex)
		{
			$trace = $ex->getTrace();
			$httpCode = (string)$trace[0]['args'][0] ;
			if ($trace[0]['args'][0] == 404) return new SoapFault($httpCode, 'Bad ID',"PrestaShoapWSBadIDFault");
			else if ($trace[0]['args'][0] == 401) return new SoapFault($httpCode, 'Bad auth key',"PrestaShoapWSBadKeyFault");
			else return new SoapFault($httpCode, 'Other error : '.$ex->getMessage(),"PrestaShoapWSFault");
		}

	}
	
	/**
    * This function UpdateLanguage
	* (expose as WS)
    * @param
    * @return 
   */
	function UpdateMapper($params,$resource,$resourceSingle, $_RESTresource=null) {
		
		$resource = $resource;
		$resourceSingle = $resourceSingle;
		$RESTresource = $_RESTresource;
		if (empty($_RESTresource)){
			$RESTresource = $resource;
		}
		
		//Start 
		$key = $params->loginInfo->key;
		if (FORCEPASS){
			$key  = PS_WS_AUTH_KEY;
		}
		$id = $params->$resourceSingle->id;
		
		// First : We always get the customer's list or a specific one
		try
		{
			$webService = new PrestaShopWebservice(PS_SHOP_PATH, $key, DEBUG);
			$opt = array('resource' => $RESTresource);
			if (isset($id))
				$opt['id'] = $id;
			$xml = $webService->get($opt);
			
			// Here we get the elements from children of customer markup which is children of prestashop root markup
			$resources = $xml->children()->children();
		}
		catch (PrestaShopWebserviceException $ex)
		{
			$trace = $ex->getTrace();
			$httpCode = (string)$trace[0]['args'][0] ;
			if ($trace[0]['args'][0] == 404) return new SoapFault($httpCode, 'Bad ID',"PrestaShoapWSBadIDFault");
			else if ($trace[0]['args'][0] == 401) return new SoapFault($httpCode, 'Bad auth key',"PrestaShoapWSBadKeyFault");
			else return new SoapFault($httpCode, 'Other error : '.$ex->getMessage(),"PrestaShoapWSFault");
		}
		
		$xml = convertLanguageToXlink($xml,$resource,$resourceSingle,$params);
		
		//NOW UPADTE
		// Here we have XML before update, lets update XML with new values
		foreach ($resources as $nodeKey => $node)
		{
			//if soap params empty -> get old params
			if (!empty($params->$resourceSingle->$nodeKey)){
				$resources->$nodeKey = $params->$resourceSingle->$nodeKey;
			}else{
				$resources->$nodeKey = $node;
			}
		}
		
		// And call the web service
		try
		{
			$webService = new PrestaShopWebservice(PS_SHOP_PATH, $key, DEBUG);
			$opt = array('resource' => $RESTresource);
			$opt['putXml'] = $xml->asXML();
			$opt['id'] = $id;
			$xml = $webService->edit($opt);
			// if WebService don't throw an exception the action worked well and we don't show the following message
			$commonReturn = new commonReturn('Successfully updated !','Successfully updated !','Successfully updated !');
			return $commonReturn;
		}
		catch (PrestaShopWebserviceException $ex)
		{
			// Here we are dealing with errors
			$trace = $ex->getTrace();
			//var_dump($ex);die;
			$httpCode = (string)$trace[0]['args'][0] ;
			if ($trace[0]['args'][0] == 404) return new SoapFault($httpCode, 'Bad ID',"PrestaShoapWSBadIDFault");
			else if ($trace[0]['args'][0] == 401) return new SoapFault($httpCode, 'Bad auth key',"PrestaShoapWSBadKeyFault");
			else return new SoapFault($httpCode, 'Other error : '.$ex->getMessage(),"PrestaShoapWSFault");
		}
		$commonReturn = new commonReturn(OK_CODE,$resourceSingle.' Successfully updated !','');
		return $commonReturn;

	}
	
	/**
    * This function UpdateLanguage
	* (expose as WS)
    * @param
    * @return 
   */
	function DeleteMapper($params,$resource,$resourceSingle, $_RESTresource=null) {
		
		$resource = $resource;
		$resourceSingle = $resourceSingle;
		$RESTresource = $_RESTresource;
		if (empty($_RESTresource)){
			$RESTresource = $resource;
		}
		
		//Start 
		$key = $params->loginInfo->key;
		if (FORCEPASS){
			$key  = PS_WS_AUTH_KEY;
		}
		
		$id = $params->id;
		try
		{
			$webService = new PrestaShopWebservice(PS_SHOP_PATH, $key, DEBUG);
			// Call for a deletion, we specify the resource name and the id of the resource in order to delete the item
			$webService->delete(array('resource' => $RESTresource, 'id' => intval($id)));
			
			// If there's an error we throw an exception
			$commonReturn = new commonReturn(OK_CODE,$resourceSingle.' Successfully deleted !','');
			return $commonReturn;
		
		}
		catch (PrestaShopWebserviceException $ex)
		{
			// Here we are dealing with errors
			$trace = $ex->getTrace();
			$httpCode = (string)$trace[0]['args'][0] ;
			if ($trace[0]['args'][0] == 404) return new SoapFault($httpCode, 'Bad ID',"PrestaShoapWSBadIDFault");
			else if ($trace[0]['args'][0] == 401) return new SoapFault($httpCode, 'Bad auth key',"PrestaShoapWSBadKeyFault");
			else return new SoapFault($httpCode, 'Other error : '.$ex->getMessage(),"PrestaShoapWSFault");
		}
		
	
	}
	
	/**
    * This function convert Xlink to language (complexType in xsd)
	* SOAP doesn't support xlink type (xlink:href) so e need to convert it to complexType
	*
	* <language id="4" xlink:href="http://localhost/prestashop/api/languages/4">Autriche</language>
	* to
	* <language id="4" xlink="http://localhost/prestashop/api/languages/4" value="Autriche"/>
	* works only for first subelelement
	* (NOT expose as WS)
    * @param
    * @return 
   */
	function convertXlinkToLanguage($xml,$resource,$resourceSingle) {
		
		//var_dump($xml->children());die;
		foreach ($xml as $nodeKey => $node)
		{
			//is there a subelement Language ?
			foreach ($node as $nodeKey2 => $node2){
				//var_dump($node);die;
				if (isset($node2->language)){//yes, now convert
					toWsdlLangObj($node2);
				}
				//other convertions here
				if (isset($node2->toto)){//yes, now convert
					//convert method
				}
				
				//var_dump($node);die;
				if (isset($node2->images)){//yes, subelebment images, recurse it
					foreach ($node2->images->image as $nodeKey3 => $node3){
						convertXlink( $node3);//ok when asXml() but soap convert only first element
					}
				}
				//combinations
				if (isset($node2->combinations)){//yes, subelebment images, recurse it
					foreach ($node2->combinations->combinations as $nodeKey3 => $node3){
						convertXlink( $node3);//ok when asXml() but soap convert only first element
					}
				}
				//product_option_values
				if (isset($node2->product_option_values)){//yes, subelebment images, recurse it
				//var_dump($node2->product_option_values->product_option_values);die;
					foreach ($node2->product_option_values->product_option_values as $nodeKey3 => $node3){
						convertXlink( $node3);//ok when asXml() but soap convert only first element
					}
				}
				//product_features
				if (isset($node2->product_features)){//yes, subelebment images, recurse it
					foreach ($node2->product_features->product_features as $nodeKey3 => $node3){
						convertXlink( $node3);//ok when asXml() but soap convert only first element
					}
				}
				//tags
				if (isset($node2->tags)){//yes, subelebment images, recurse it
					foreach ($node2->tags->tag as $nodeKey3 => $node3){
						convertXlink( $node3);//ok when asXml() but soap convert only first element
					}
				}
			}
			
		}
					
		return $xml;
		
	}
	
	/**
    * This function convert Language to xlink (inverse convertXlinkToLanguage)
	* (NOT expose as WS)
    * @param
    * @return 
   */
	function convertLanguageToXlink($xml,$resource,$resourceSingle,$params) {
				
		foreach ($xml as $nodeKey => $node)
		{
			//is there a subelement Language ?
			foreach ($node as $nodeKey2 => $node2){
				
				if (isset($node2->language)){
					mergeXMLLangObj($node2,$params->$resourceSingle->$nodeKey2);//ex: $node2=name(xmlobject) | ,$params->$resourceSingle->$nodeKey2 = $params->country->name (stdclass)
					toXMLLangObj($node2);//convert
				}
				//other convertions here
				if (isset($node2->toto)){//yes, now convert
					//convert method
				}
			}
		}
		return $xml;
	}
	
	/**
    * Check if xml has language child and tranform it
	* (NOT expose as WS)
    * @param
    * @return 
   */
	function toWsdlLangObj($xmlElmt) {
		
		if (isset($xmlElmt->language)){
			
			$id =$xmlElmt->language->attributes()->id ;
			$xlink =$xmlElmt->language->attributes('xlink', true) ;
			$lang = (string) $xmlElmt->language;
			
			$xmlElmt->language->value = $lang;
			$xmlElmt->language->id = $id;
			$xmlElmt->language->xlink = $xlink;
			
			//$xmlElmt->language[0][0] = $lang;
		}
	
	}
	/**
    * INVERSE of toWsdlLangObj
	* (NOT expose as WS)
    * @param
    * @return 
   */
	function toXMLLangObj($xmlElmt) {
		//var_dump("".$xmlElmt->children('language'));die;
		//$xmlElmt->addChild('language', "fgfgfgf");
		if (isset($xmlElmt->language)){
			$value = $xmlElmt->language->attributes()->value ; //wsdl <language id="4" xlink="http://localhost/prestashop/api/languages/4" value="ipod-nano"/>
			$id = $xmlElmt->language->attributes()->id ; 
			$xlink = (string)$xmlElmt->language->attributes()->xlink ; 
			
			$xmlElmt->language->addAttribute('xlink', $xlink);//xml <language id="4" xlink:href="http://localhost/prestashop/api/languages/4">ipod-nano</language>
			$xmlElmt->language->addAttribute('value', $value);
			$xmlElmt->language-> attributes('xlink', true) -> href = $xlink; // Works!
			$xmlElmt->language[0][0] = $value;

		}
	
	}
	
	/**
    * Check if xml has language child and tranform it
	* (NOT expose as WS)
    * @param
    * @return 
   */
	function convertXlink($xmlElmt) {
	//	var_dump($xmlElmt->asXml());die;
		if (isset($xmlElmt)){
			
			$id =(string)$xmlElmt->id ;
			$xlink =(string)$xmlElmt->attributes('xlink', true) ;
			
			$xmlElmt->xlink = $xlink;	

		}
	
	}
	/**
    * INVERSE of toWsdlLangObj
	* (NOT expose as WS)
    * @param
    * @return 
   */
	function toXMLImageObj($xmlElmt) {
		
		//TODO !!!!!!!!!!
		if (isset($xmlElmt->language)){
			/*$value = $xmlElmt->language->attributes()->value ; //wsdl <language id="4" xlink="http://localhost/prestashop/api/languages/4" value="ipod-nano"/>
			$id = $xmlElmt->language->attributes()->id ; 
			$xlink = (string)$xmlElmt->language->attributes()->xlink ; 
			
			$xmlElmt->language->addAttribute('xlink', $xlink);//xml <language id="4" xlink:href="http://localhost/prestashop/api/languages/4">ipod-nano</language>
			$xmlElmt->language->addAttribute('value', $value);
			$xmlElmt->language-> attributes('xlink', true) -> href = $xlink; // Works!
			$xmlElmt->language[0][0] = $value;*/

		}
	
	}
	/**
    * merge Lang (xml/object)
	* SOAP param overide xml
	* (NOT expose as WS)
    * @param
    * @return 
   */
	function mergeXMLLangObj($xmlElmt,$object) {

		//var_dump($object);die;
		if (isset($xmlElmt->language) && isset($object->language)){
			$lang = $object->language->value ;
			$id = $object->language->id ; 
			$xlink = $object->language->xlink ; 
			
			$xmlElmt->language->addAttribute('xlink', $xlink);
			$xmlElmt->language->addAttribute('value', $lang);

		}
	
	}
	
//end	
?> 