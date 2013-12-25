<?php
/**
 * Prestashop User SOA Connector
 *
 * Print webservices links
 *
 * @package    prestasoap
 * @subpackage modules
 * @author     Mickael cabanas (cabanas.mickael|at|gmail.com)
 * @copyright  2012 Mickael Cabanas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    $Id:$
 */
 
	$services = array('addresses',
			'carriers',
			'carts',
			'categories',
			'combinations',
			'configurations',
			'content_management_system',
			'countries',
			'currencies',
			'customers',
			'deliveries',
			'employees',
			'groups',
			'guests',
			'image_types',
			'images',
			'languages',
			'manufacturers',
			'order_carriers',
			'order_details',
			'order_discounts',
			'order_histories',
			'order_invoices',
			'order_payments',
			'order_states',
			'orders',
			'price_ranges',
			'product_feature_values',
			'product_features',
			'product_option_values',
			'product_options',
			'product_suppliers',
			'products',
			'search',
			'shop_groups',
			'shops',
			'specific_price_rules',
			'specific_prices',
			'states',
			'stock_availables',
			'stock_movement_reasons',
			'stock_movements',
			'stocks',
			'stores',
			'suppliers',
			'supply_order_details',
			'supply_order_histories',
			'supply_order_receipt_histories',
			'supply_order_states',
			'supply_orders',
			'tags',
			'tax_rule_groups',
			'tax_rules',
			'taxes',
			'translated_configurations',
			'warehouse_product_locations',
			'warehouses',
			'weight_ranges',
			'zones');
	
	/*print it*/
	echo "<center>";
	
	if(!empty($_GET)) {
		if ($_GET["type"] === "wsdl"){
			printWSDLTableList($services);
		}
		if ($_GET["type"] === "rest"){
			printRESTWsTableList($services);
		}
		if ($_GET["type"] === "test"){
			printWSDLTestServices($services);
		}
		if ($_GET["type"] === "all"){
			printWSDLAndRESTTableList($services);
		}
		
	}else{
		printChooseTypeServices();
		
	}
	
	echo "</center>";
	
	/**
    * This function print WSDL list
	* (expose as WS)
    * @param
    * @return 
   */
   
	function printWSDLAndRESTTableList($services) {
		
		echo "<table border='1'>";
		echo "<tr>";
		echo "	<th>SOAP Webservices (WSDL)</th>";
		echo "	<th>REST Webservices</th>";
		echo "	<th>REST Webservices Schema</th>";
		echo "	<th>REST Webservices synopsis</th>";
		echo "</tr>";
	
		foreach ($services as $service) {
			
			
			echo "<tr>";
			
			echo "	<td>";
			echo "<a href='./$service/$service"."WSDL.php' >";
			echo "$service";
			echo "</a>";
			echo "	</td>";
			
			echo "	<td>";
			echo "<a href='../../api/$service' >";
			echo "$service";
			echo "</a>";
			echo "	</td>";
			
			echo "	<td>";
			echo "<a href='../../api/$service?schema=blank' >";
			echo "$service";
			echo "</a>";
			echo "	</td>";
			
			echo "	<td>";
			echo "<a href='../../api/$service?schema=synopsis' >";
			echo "$service";
			echo "</a>";
			echo "	</td>";
			
			
			echo "</tr>";
		}
		echo "</table>";
	
 
	}
	
	/**
    * This function print WSDL list
	* (expose as WS)
    * @param
    * @return 
   */
   
	function printWSDLTableList($services) {
		
		echo "<table border='1'>";
		
		echo "<tr>";
		echo "	<th>SOAP Webservices (WSDL)</th>";
		echo "</tr>";
		
		foreach ($services as $service) {
			echo "<tr>";
			echo "	<td>";
			echo "<a href='./$service/$service"."WSDL.php' target='blank'>";
			echo "$service";
			echo "</a>";
			echo "	</td>";
			echo "</tr>";
		}
		echo "</table>";
	
 
	}
	
	/**
    * This function print WSDL list
	* (expose as WS)
    * @param
    * @return 
   */
   
	function printRESTWsTableList($services) {
		
		echo "<table border='0'>";
	
		echo "<tr>";
			echo "	<th>REST Webservices</th>";
		echo "</tr>";
		
		foreach ($services as $service) {
			echo "<tr>";
			echo "	<td>";
			echo "<a href='../../api/$service' >";
			echo "$service";
			echo "</a>";
			echo "	</td>";
			echo "</tr>";
		}
		echo "</table>";
	
 
	}
	
	/**
    * This function print WSDL list
	* (expose as WS)
    * @param
    * @return 
   */
   
	function printWSDLTestServices($services) {
		
		echo "<table border='0'>";
		
		echo "<tr>";
		echo "	<th>TEST SOAP ENDPOINT</th>";
		echo "</tr>";
		
		foreach ($services as $service) {
			echo "<tr>";
			echo "	<td>";
			echo "<a href='./$service/$service"."Service.php?wsdl' >";
			echo "$service";
			echo "</a>";
			echo "	</td>";
			echo "</tr>";
		}
		echo "</table>";
	
 
	}
	
	/**
    * This function print WSDL list
	* (expose as WS)
    * @param
    * @return 
   */
   
	function printChooseTypeServices() {
		
		echo "<table border='1'>";
		
		echo "<tr>";
		echo "	<th>Choose WS TYPE</th>";
		echo "</tr>";
		
		echo "<tr>";
		echo "	<td>";
		echo "<a href='index.php?type=wsdl' >SOAP</a>";
		echo "	</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "	<td>";
		echo "<a href='index.php?type=rest' >REST</a>";
		echo "	</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "	<td>";
		echo "<a href='index.php?type=all' >ALL</a>";
		echo "	</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "	<td>";
		echo "<a href='index.php?type=test' >TEST ENDPOINT</a>";
		echo "	</td>";
		echo "</tr>";
		
		echo "</table>";
	
 
	}
 
 
 
?>