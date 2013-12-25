<html><head><title>CRUD Tutorial - Customer's list</title></head><body>
<?php
// Here we define constants /!\ You need to replace this parameters
define('DEBUG', true);											// Debug mode
define('PS_SHOP_PATH', 'http://localhost/prestashop15');		// Root path of your PrestaShop store
define('PS_WS_AUTH_KEY', 'GIME318HTIHJCCGQS3MJ5QCG7HXIM85T');	// Auth key (Get it in your Back Office)
require_once('../PSWebServiceLibrary.php');

// Here we make the WebService Call
try
{
	$webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
	
	// Here we set the option array for the Webservice : we want customers resources
	$opt['resource'] = 'customers';
	
	// Call
	$xml = $webService->get($opt);

	// Here we get the elements from children of customers markup "customer"
	$resources = $xml->customers->children();
}
catch (PrestaShopWebserviceException $e)
{
	// Here we are dealing with errors
	$trace = $e->getTrace();
	//var_dump($trace);die;
	if ($trace[0]['args'][0] == 404) echo 'Bad ID';
	else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
	else echo 'Other error';
}

// We set the Title
echo "<h1>Customer's List</h1>";

echo '<table border="5">';
// if $resources is set we can lists element in it otherwise do nothing cause there's an error
if (isset($resources))
{
		echo '<tr><th>Id</th></tr>';
		foreach ($resources as $resource)
		{
			// Iterates on the found IDs
			echo '<tr><td>'.$resource->attributes().'</td></tr>';
		}
}
echo '</table>';
?>
</body></html>