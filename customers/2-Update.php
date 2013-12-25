<html><head><title>CRUD Tutorial - Update example</title></head><body>
<?php
// Here we define constants /!\ You need to replace this parameters
define('DEBUG', true);
define('PS_SHOP_PATH', 'http://localhost/prestashop');
define('PS_WS_AUTH_KEY', 'LQFH9NL4EOQVMHFX305JKRMWXMDFKH9T');
require_once('../PSWebServiceLibrary.php');

// First : We always get the customer's list or a specific one
try
{
	$webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
	$opt = array('resource' => 'customers');
	if (isset($_GET['id']))
		$opt['id'] = $_GET['id'];
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

// Second : We update the data and send it to the web service
if (isset($_GET['id']) && isset($_POST['id'])) // Here we check id cause in every resource there's an id
{
	// Here we have XML before update, lets update XML with new values
	foreach ($resources as $nodeKey => $node)
	{
		$resources->$nodeKey = $_POST[$nodeKey];
	}
	// And call the web service
	try
	{
		$opt = array('resource' => 'customers');
		$opt['putXml'] = $xml->asXML();
		$opt['id'] = $_GET['id'];
		$xml = $webService->edit($opt);
		// if WebService don't throw an exception the action worked well and we don't show the following message
		echo "Successfully updated.";
	}
	catch (PrestaShopWebserviceException $ex)
	{
		// Here we are dealing with errors
		$trace = $ex->getTrace();
		if ($trace[0]['args'][0] == 404) echo 'Bad ID';
		else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
		else echo 'Other error<br />'.$ex->getMessage();
	}
}

// UI

// We set the Title
echo '<h1>Customer\'s ';
if (isset($_GET['id'])) echo 'Update';
else echo 'List';
echo '</h1>';

// We set a link to go back to list if we are in customer's details
if (isset($_GET['id'])) 
	echo '<a href="?">Return to the list</a>';

if (isset($_GET['id']))
	echo '<form method="POST" action="?id='.$_GET['id'].'">';
echo '<table border="5">';
if (isset($resources))
{

echo '<tr>';
if (!isset($_GET['id']))
{
	//Show list of customers
	echo '<th>Id</th><th>More</th></tr>';
	foreach ($resources as $resource)
	{
		echo '<td>'.$resource->attributes().'</td><td>'.
		'<a href="?id='.$resource->attributes().'">Update</a>&nbsp;'.
		'</td></tr>';
	}
}
else
{
	//Show customer form
	echo '</tr>';
	foreach ($resources as $key => $resource)
	{
		echo '<tr><th>'.$key.'</th><td>';
		echo '<input type="text" name="'.$key.'" value="'.$resource.'"/>';
		echo '</td></tr>';
	}
}

}
echo '</table><br/>';

if (isset($_GET['id']))
	echo '<input type="submit" value="Update"></form>';


?>
</body></html>