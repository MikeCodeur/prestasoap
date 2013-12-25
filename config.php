<?php
defined('_PS_VERSION_') or die('Restricted access');

/**
 * PrestaSOAP Config
 *
 * PrestaSOAP Config file
 *
 * @package    prestasoap
 * @subpackage module
 * @author     Mickael cabanas (cabanas.mickael|at|gmail.com)
 * @copyright  2012 Mickael Cabanas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    $Id:$
 */

/******* CHANGE IT ******/
define('PRESTA_BASEDIR'	, 'prestashop'); // prestashop installation directory
define('HOST'	, 'localhost'); // hostname
define('PS_SHOP_PATH'	, 'http://'.HOST.'/'.PRESTA_BASEDIR);	//URL to the shop
define('FORCEPASS', true);	//DO NOT SET IN PRODUCTION MODE !!!
/************************/

define('MOD_PATH' 		, dirname(__FILE__));
define('DEBUG', false);	
define('DS', DIRECTORY_SEPARATOR);
define('MOD_DIR' 		, 'modules/prestasoap');		
define('PS_WS_AUTH_KEY'	, 'LQFH9NL4EOQVMHFX305JKRMWXMDFKH9T');	// Auth key (Get it in your Back Office) // used if FORCEPASS is true
define('URI_ROOT' 		, PS_SHOP_PATH.'/');
define('WSDL_CACHE_ON' 	, 0);
define('WSDL_SERVICES_ON' 	, 1);

define ("OK_CODE" 	, 1);

//default services files name
define ("WSDL_CUSTOMER" 	, 'customers.wsdl');
define ("SERVICE_CUSTOMER" 	, 'customersService.php');

define ("WSDL_LANG" 		, 'languages.wsdl');
define ("SERVICE_LANG" 		, 'languagesService.php');

define ("WSDL_SAMPLE" 		, 'sample.wsdl');
define ("SERVICE_SAMPLE"	, 'sampleService.php');

define ("WSDL_ZONES" 		, 'zones.wsdl');
define ("SERVICE_ZONES"		, 'zonesService.php');

define ("WSDL_ADDRESSES" 	, 'addresses.wsdl');
define ("SERVICE_ADDRESSES"	, 'addressesService.php');

define ("WSDL_CARRIERS" 	, 'carriers.wsdl');
define ("SERVICE_CARRIERS"	, 'carriersService.php');

define ("WSDL_weight_ranges" 	, 'weight_ranges.wsdl');
define ("SERVICE_weight_ranges"	, 'weight_rangesService.php');

define ("WSDL_warehouses" 	, 'warehouses.wsdl');
define ("SERVICE_warehouses"	, 'warehousesService.php');

define ("WSDL_GUESTS" 	, 'guests.wsdl');         //olive
define ("SERVICE_GUESTS", 'guestsService.php');

define ("WSDL_countries" 	, 'countries.wsdl');    
define ("SERVICE_countries", 'countriesService.php');

define ("WSDL_TAXES" 	, 'taxes.wsdl');    
define ("SERVICE_TAXES", 'taxesService.php');

define ("WSDL_TAGS" 	, 'tags.wsdl');       
define ("SERVICE_TAGS", 'tagsService.php');

define ("WSDL_SHOPS" 	, 'shops.wsdl');      
define ("SERVICE_SHOPS", 'shopsService.php');

define ("WSDL_CURRENCIES" 	, 'currencies.wsdl');      
define ("SERVICE_CURRENCIES", 'currenciesService.php');

define ("WSDL_DELIVERIES" 	, 'deliveries.wsdl');    
define ("SERVICE_DELIVERIES", 'deliveriesService.php');

define ("WSDL_STORES" 	, 'stores.wsdl');    
define ("SERVICE_STORES", 'storesService.php');

define ("WSDL_warehouse_product_locations" 	, 'warehouse_product_locations.wsdl');    
define ("SERVICE_warehouse_product_locations", 'warehouse_product_locationsService.php');

define ("WSDL_EMPLOYEES" 	, 'employees.wsdl');    
define ("SERVICE_EMPLOYEES", 'employeesService.php');

define ("WSDL_GROUPS" 	, 'groups.wsdl');    
define ("SERVICE_GROUPS", 'groupsService.php');

define ("WSDL_IMAGE_TYPES" 	, 'image_types.wsdl');    		
define ("SERVICE_IMAGE_TYPES", 'image_typesService.php');

define ("WSDL_IMAGES" 	, 'images.wsdl');    		
define ("SERVICE_IMAGES", 'imagesService.php');

define ("WSDL_ORDER_CARRIERS" 	, 'order_carriers.wsdl');    		
define ("SERVICE_ORDER_CARRIERS", 'order_carriersService.php');

define ("WSDL_ORDER_HISTORIES" 	, 'order_histories.wsdl');    		
define ("SERVICE_ORDER_HISTORIES", 'order_historiesService.php');

define ("WSDL_ORDER_INVOICES" 	, 'order_invoices.wsdl');    		
define ("SERVICE_ORDER_INVOICES", 'order_invoicesService.php');

define ("WSDL_ORDER_PAYMENTS" 	, 'order_payments.wsdl');    		
define ("SERVICE_ORDER_PAYMENTS", 'order_paymentsService.php');

define ("WSDL_ORDER_STATES" 	, 'order_states.wsdl');    		
define ("SERVICE_ORDER_STATES", 'order_statesService.php');

define ("WSDL_PRICE_RANGES" 	, 'price_ranges.wsdl');    		
define ("SERVICE_PRICE_RANGES", 'price_rangesService.php');

define ("WSDL_PRODUCT_FEATURE_VALUES" 	, 'product_feature_values.wsdl');    		
define ("SERVICE_PRODUCT_FEATURE_VALUES", 'product_feature_valuesService.php');

define ("WSDL_PRODUCT_FEATURES" 	, 'product_features.wsdl');    		
define ("SERVICE_PRODUCT_FEATURES", 'product_featuresService.php');

define ("WSDL_PRODUCT_OPTION_VALUES" 	, 'product_option_values.wsdl');    		
define ("SERVICE_PRODUCT_OPTION_VALUES", 'product_option_valuesService.php');

define ("WSDL_PRODUCT_SUPPLIERS" 	, 'product_suppliers.wsdl');    		
define ("SERVICE_PRODUCT_SUPPLIERS", 'product_suppliersService.php');

define ("WSDL_SHOP_GROUPS" 	, 'shop_groups.wsdl');    		
define ("SERVICE_SHOP_GROUPS", 'shop_groupsService.php');

define ("WSDL_SPECIFIC_PRICE_RULES" 	, 'specific_price_rules.wsdl');    		
define ("SERVICE_SPECIFIC_PRICE_RULES", 'specific_price_rulesService.php');

define ("WSDL_SPECIFIC_PRICES" 	, 'specific_prices.wsdl');    		
define ("SERVICE_SPECIFIC_PRICES", 'specific_pricesService.php');

define ("WSDL_CONFIGURATIONS" 	, 'configurations.wsdl');    		
define ("SERVICE_CONFIGURATIONS", 'configurationsService.php');

define ("WSDL_CONTENT_MANAGEMENT_SYSTEM" 	, 'content_management_system.wsdl');    		
define ("SERVICE_CONTENT_MANAGEMENT_SYSTEM", 'content_management_systemService.php');

define ("WSDL_ORDER_DISCOUNTS" 	, 'order_discounts.wsdl');    		
define ("SERVICE_ORDER_DISCOUNTS", 'order_discountsService.php');

define ("WSDL_CARTS" 	, 'carts.wsdl');    		
define ("SERVICE_CARTS", 'cartsService.php');

define ("WSDL_COMBINATIONS" 	, 'combinations.wsdl');    		
define ("SERVICE_COMBINATIONS", 'combinationsService.php');

define ("WSDL_ORDER_DETAILS" 	, 'order_details.wsdl');    		
define ("SERVICE_ORDER_DETAILS", 'order_detailsService.php');

define ("WSDL_CATEGORIES" 	, 'categories.wsdl');    		
define ("SERVICE_CATEGORIES", 'categoriesService.php');

define ("WSDL_translated_configurations" 	, 'translated_configurations.wsdl');    
define ("SERVICE_translated_configurations", 'translated_configurationsService.php');

define ("WSDL_tax_rules" 	, 'tax_rules.wsdl');    
define ("SERVICE_tax_rules", 'tax_rulesService.php');

define ("WSDL_tax_rule_groups" 	, 'tax_rule_groups.wsdl');    
define ("SERVICE_tax_rule_groups", 'tax_rule_groupsService.php');

define ("WSDL_supply_orders" 	, 'supply_orders.wsdl');    
define ("SERVICE_supply_orders", 'supply_ordersService.php');

define ("WSDL_supply_order_states" 	, 'supply_order_states.wsdl');    
define ("SERVICE_supply_order_states", 'supply_order_statesService.php');

define ("WSDL_supply_order_receipt_histories" 	, 'supply_order_receipt_histories.wsdl');    
define ("SERVICE_supply_order_receipt_histories", 'supply_order_receipt_historiesService.php');

define ("WSDL_supply_order_histories" 	, 'supply_order_histories.wsdl');    
define ("SERVICE_supply_order_histories", 'supply_order_historiesService.php');

define ("WSDL_supply_order_details" 	, 'supply_order_details.wsdl');    
define ("SERVICE_supply_order_details", 'supply_order_detailsService.php');

define ("WSDL_suppliers" 	, 'suppliers.wsdl');    
define ("SERVICE_suppliers", 'suppliersService.php');

define ("WSDL_stocks" 	, 'stocks.wsdl');    
define ("SERVICE_stocks", 'stocksService.php');

define ("WSDL_stock_movements" 	, 'stock_movements.wsdl');    
define ("SERVICE_stock_movements", 'stock_movementsService.php');

define ("WSDL_stock_movement_reasons" 	, 'stock_movement_reasons.wsdl');    
define ("SERVICE_stock_movement_reasons", 'stock_movement_reasonsService.php');

define ("WSDL_stock_availables" 	, 'stock_availables.wsdl');    
define ("SERVICE_stock_availables", 'stock_availablesService.php');

define ("WSDL_states" 	, 'states.wsdl');    
define ("SERVICE_states", 'statesService.php');

define ("WSDL_specific_prices" 	, 'specific_prices.wsdl');    
define ("SERVICE_specific_prices", 'specific_pricesService.php');

define ("WSDL_search" 	, 'search.wsdl');    
define ("SERVICE_search", 'searchService.php');

define ("WSDL_products" 	, 'products.wsdl');    
define ("SERVICE_products", 'productsService.php');

define ("WSDL_manufacturers" 	, 'manufacturers.wsdl');    
define ("SERVICE_manufacturers", 'manufacturersService.php');

define ("WSDL_product_options" 	, 'product_options.wsdl');    
define ("SERVICE_product_options", 'product_optionsService.php');

define ("WSDL_orders" 	, 'orders.wsdl');    
define ("SERVICE_orders", 'ordersService.php');

?>