<?php
/*
*
*
* @module: PrestaSoap
* @file: prestasoap.php
* @version: 1.0
* @package: SOAP
* @copyright: All rights reserved. Copyright (C) 2012 virtuemart-datamanager.com
*
* @dependecies: PrestaShop 1.5+
*
* @author: virtuemart-datamanager.com - cabanas (admin@virtuemart-datamanager.com)
*
* @product page: http://www.virtuemart-datamanager.com/produits/modules-prestashop/prestasoap
* @support: http://www.virtuemart-datamanager.com/
* @licence: http://www.virtuemart-datamanager.com/
*
* READ:
********************
** 2011 virtuemart-datamanager.com
**
**
** NOTICE OF LICENSE
**
** This source file is copyrighted. All rights reserved. Do not copy, edit, share or distrubute by any means.
** This file and its package is protected by copyright law and international treaties.
** Unauthorized reproduction or distribution of this file, or any portion of it, may result in severe civil
** and criminal penalties, and will be prosecuted to the maximum extent possible under the law.
********************
*
* DO NOT REDISTRUBUTE. DO NOT COPY. DO NOT MODIFY.
*
* PROPERTY OF MICKAEL CABANAS:
*			
*
* All rights reserved. Copyright 2011 virtuemart-datamanager.com
* virtuemart-datamanager.com¦works logo, PrestaSoap logo and the O are either registered trademarks or trademarks of 
* in France and/or other countries. All other logos and trademarks belong to their respective companies.
*
*/

if (!defined('_PS_VERSION_'))
  exit;

class PrestaSoap extends Module
{
			const BACKOFFICE_PAGE_ERROR_CONTAINER_PREFIX = '<div class="alert error">';
			const BACKOFFICE_PAGE_ERROR_CONTAINER_SUFFIX = '</div>';
			const BACKOFFICE_PAGE_SUCCESS_CONTAINER_PREFIX = '<div class="conf confirm">';
			const BACKOFFICE_PAGE_SUCCESS_CONTAINER_SUFFIX = '</div>';			
			
			public function __construct()
			{
				$this->name = 'prestasoap';
				$this->tab = 'administration';
				$this->version = 1.0;
				$this->author = 'Mickael Cabanas - Olivier Ravon';
				$this->need_instance = 0;
			 
				parent::__construct();
			 
				$this->displayName = $this->l('PrestaSoap');
				$this->description = $this->l('SOAP WS FOR PRESTASHOP');

			}
			
			
			public function install()
			{
				if (parent::install() == false)
				return false;
				return true;
						
			}
			
			public function uninstall()
			{
			 if (!parent::uninstall())
				Db::getInstance()->Execute('DELETE FROM `'._DB_PREFIX_.'SOAP_WS`');
			  parent::uninstall();
					
			}
			
			public function getContent ()
			{
						$html = '';
						
						// Update values if submitted
						if (Tools::isSubmit('submit'))
						{
									
									// Validate
									$postErrors = $this->_validateAndSavePostValues ();
									
									// Check errors
									if (!sizeof($postErrors))
									{
												$html .= self::BACKOFFICE_PAGE_SUCCESS_CONTAINER_PREFIX . $this->l('Settings updated') . self::BACKOFFICE_PAGE_SUCCESS_CONTAINER_SUFFIX;
									}
									else
									{
												foreach ($postErrors as $err)
												{
															$html .= self::BACKOFFICE_PAGE_ERROR_CONTAINER_PREFIX . $err . self::BACKOFFICE_PAGE_ERROR_CONTAINER_SUFFIX;
												}
									}
						}
						
						$html .= $this->getmoduleBoCss().'<fieldset style="font-size:1em !important;padding:0 !important;">
				<legend style="min-height:138px;margin:0px 20px;background:#F0F0F0;color:#000;-moz-border-radius:15px;-webkit-border-radius:15px;border-radius:15px;border:3px solid #000;padding:10px;position:relative;display:inline-block;">
						<div style="float:left;width:463px;">
								<img src="'.$this->_path.'logo_s.png" alt="" class="middle" style="vertical-align:middle;float:left;"/>
								<h1 style="margin:10px auto;">' . $this->displayName . ' v.' . $this->version . '</h1>
								<br/><h2 style="display:inline;">'.$this->l('by').' '.$this->author.'</h2>
								<br/><h3 style="margin-top:10px;white-space:normal;">'.$this->l('For updates and other modules, visit us').': <br/><a href="http://www.virtuemart-datamanager.com/" target="_blank" style="color:darkred !important;font-weight:bold;text-decoration:underline;">www.virtuemart-datamanager.com</a></h3>
						</div>
						<div style="float:right;">
								
						</div>
						<fieldset style="float:left;font-size:0.8em;margin:10px;white-space: normal;width: 435px;">
								<legend><img src="../img/admin/cog.gif" alt="" class="middle" />' . $this->l('Help / About') . '</legend>
								<p style="color:darkgray;font-weight:bold;font-size:1.5em;">'.$this->l('SOAP Webservices for PrestaSHOP').'
										<br/>'.'<br/>
										<img src="../modules/prestasoap/assets/img/prestasoap-icone-2pro.png" width="100">
								</p>
						</fieldset>
						<br style="clear:both;height:1px;"/>
				</legend>
						<br style="clear:both;height:1px;"/>';						
						
						// Return html
						return $html . $this->_displayForm() . '</fieldset>';
			}

			private function _displayForm()
			{
						
						$prestasoap_size = Configuration::get('prestasoap_size');
						
						$prestasoap_autolang = Configuration::get('prestasoap_autolang');
						
						if(!empty($prestasoap_autolang)) $prestasoap_lang=$prestasoap_autolang;
						else $prestasoap_lang = Configuration::get('prestasoap_lang');
						
						$prestasoap_inc_count = Configuration::get('prestasoap_inc_count');
						$prestasoap_parse = Configuration::get ('prestasoap_parse');
						$prestasoap_jsCallBack = Configuration::get ('prestasoap_jsCallBack');
						$prestasoap_urlto = Configuration::get ('prestasoap_urlto');
						
						
						$this->_html .= '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
			
									<fieldset>
												<legend><img src="../img/admin/cog.gif" alt="" class="" />' . $this->l('Help and Documentation') . '</legend>
												 <p style="clear:both;"> 
												
												</p>
												<p></p>
												<ul>
													<li> Enable PHP_CURL and PHP_SOAP modules</li>
													<li> EDIT <strong>config.php</strong> file (./prestashop/modules/prestasoap/config.php) </li>
													<li> Change PRESTA_BASEDIR : (Prestashop installation directory) Ex : "prestashop" </li>
													<li> Change HOST : (Prestashop installation directory URL) Ex : "www.myshop.com" </li>
													<li> <a href="http://www.virtuemart-datamanager.com/index.php?option=com_contact&view=contact&id=2&Itemid=60" target="blanc">Contact us here to key your licence</a>   </li>
												</ul>
												<p></p>
												<p style="clear:both;"> 
													<a href="http://doc.prestashop.com/display/PS14/Chapter+1+-+Creating+Access+to+Back+Office" target="blanc" >
													Enable Prestashop REST Webservices
													</a>
													
												</p>
												<p></p>
												 <p style="clear:both;"> 
													<a href = "../modules/prestasoap/index.php?type=wsdl" target="blanc" >Show WSDL definitions here</a>
												 </p>
												 
												<div class="g-section faq" style="text-align:center;">
														<iframe src="../modules/prestasoap/index.php?type=wsdl" align="left"></iframe> 
												</div> 
												<p></p>
												 <p style="clear:both;"> 
													<a href = "http://www.soapui.org/" target="blanc" >Download SOAPui to test Webservices</a>
												 </p>
									</fieldset>
									<div>
												<!--<input type="submit" name="submit" value="' . $this->l('Update') . '" class="osubmit_button"/> -->
									</div>
									</form>
';
						return $this->_html;
			}
	
			private function _validateAndSavePostValues()
			{
						$postErrors = array();
						
						$prestasoap_size = Tools::getValue ('prestasoap_size', Configuration::get ('prestasoap_size'));
						
						$prestasoap_autolang = Tools::getValue ('prestasoap_autolang', '');
						$prestasoap_lang = Tools::getValue('prestasoap_lang',$prestasoap_autolang);
						
						$prestasoap_inc_count = Tools::getValue('prestasoap_inc_count', '');
						if($prestasoap_inc_count != 1) $prestasoap_inc_count=0;
						$prestasoap_parse = Tools::getValue('prestasoap_parse','');
						$prestasoap_jsCallBack = Tools::getValue('prestasoap_jsCallBack', '');
						$prestasoap_urlto = Tools::getValue('prestasoap_urlto', '');
						
						
						//Validate SIZE
						if (!Validate::isInt($prestasoap_size))
						{
									$postErrors[] = $this->l ('Size is invalid');
						}
						
						
						
						// Save if no errors
						if (!sizeof($postErrors))
						{
									Configuration::updateValue ('prestasoap_size', $prestasoap_size);
									Configuration::updateValue ('prestasoap_lang', $prestasoap_lang);
									Configuration::updateValue ('prestasoap_inc_count', $prestasoap_inc_count);
									Configuration::updateValue ('prestasoap_parse', $prestasoap_parse);
									Configuration::updateValue ('prestasoap_jsCallBack', $prestasoap_jsCallBack);
									Configuration::updateValue ('prestasoap_urlto', $prestasoap_urlto);
									Configuration::updateValue ('prestasoap_autolang', $prestasoap_autolang);
						}
						
						// return errors
						return $postErrors;
			}

			public function hookRightColumn($params)
			{
						return $this->commonHook($params);
			}
	
			public function hookTop($params)
			{
						return $this->commonHook($params);
			}
			public function hookFooter($params)
			{
						return $this->commonHook($params);
			}
			public function hookLeftColumn($params)
			{
						return $this->commonHook($params);
			}
			public function hookExtraLeft($params)
			{
						return $this->commonHook($params);
			}
			public function hookExtraRight($params)
			{
						return $this->commonHook($params);
			}
			public function commonHook($params)
			{
				global $smarty;
				
				$smarty->assign('prestasoap_size', Configuration::get ('prestasoap_size'));
				$smarty->assign('prestasoap_inc_count', Configuration::get ('prestasoap_inc_count'));
				$smarty->assign('prestasoap_jsCallBack', Configuration::get ('prestasoap_jsCallBack'));
				$smarty->assign('prestasoap_urlto', Configuration::get ('prestasoap_urlto'));
				$smarty->assign('prestasoap_autolang', Configuration::get ('prestasoap_autolang'));
				
				return $this->display(__FILE__, 'theme/prestasoap.tpl');
			}
			
			public function hookHeader($params)
			{
						global $smarty;
						Tools::addCSS(($this->_path).'css/prestasoap.css', 'all');
						$smarty->assign('prestasoap_lang', Configuration::get ('prestasoap_lang'));
						$smarty->assign('prestasoap_parse', Configuration::get ('prestasoap_parse'));
						return $this->display(__FILE__, 'theme/prestasoap-header.tpl');
			}
			
			private function getmoduleBoCss(){
					$size = Configuration::get ('prestasoap_size');
					$inc_count = Configuration::get ('prestasoap_inc_count');
				return '';
			}
	
			
			

}