<html><head><title>CRUD Tutorial - Retrieve example</title></head><body>
<?php
// Here we define constants /!\ You need to replace this parameters
define('DEBUG', true);											// Debug mode
define('PS_SHOP_PATH', 'http://localhost/prestashop15');							// Root path of your PrestaShop store
define('PS_WS_AUTH_KEY', 'GIME318HTIHJCCGQS3MJ5QCG7HXIM85T');	// Auth key (Get it in your Back Office)
require_once('../PSWebServiceLibrary.php');

// Here we make the WebService Call
try
{
	$webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
	// Here we set the option array for the Webservice : we want customers resources
	$opt['resource'] = 'customers';
	// We set an id if we want to retrieve infos from a customer
	if (isset($_GET['id']))
		$opt['id'] = (int)$_GET['id']; // cast string => int for security measures

	// Call
	$xml = $webService->get($opt);

	// Here we get the elements from children of customer markup which is children of prestashop root markup
	$resources = $xml->children()->children();
}
catch (PrestaShopWebserviceException $e)
{
	// Here we are dealing with errors
	$trace = $e->getTrace();
	if ($trace[0]['args'][0] == 404) echo 'Bad ID';
	else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
	else echo 'Other error';
}

// We set the Title
echo '<h1>Customers ';
if (isset($_GET['id'])) 
	echo 'Details';
else 
	echo 'List';
echo '</h1>';

// We set a link to go back to list if we are in customer's details
if (isset($_GET['id'])) 
	echo '<a href="?">Return to the list</a>';

echo '<table border="5">';
// if $resources is set we can lists element in it otherwise do nothing cause there's an error
if (isset($resources))
{
	if (!isset($_GET['id']))
	{
		echo '<tr><th>Id</th><th>More</th></tr>';
		foreach ($resources as $resource)
		{
			// Iterates on the found IDs
			echo '<tr><td>'.$resource->attributes().'</td><td>'.
			'<a href="?id='.$resource->attributes().'">Retrieve</a>'.
			'</td></tr>';
		}
	}
	else
	{
		foreach ($resources as $key => $resource)
		{
			// Iterates on customer's properties
			echo '<tr>';
			echo '<th>'.$key.'</th><td>'.$resource.'</td>';
			echo '</tr>';
		}
	}
}
echo '</table>';
?>
</body></html>