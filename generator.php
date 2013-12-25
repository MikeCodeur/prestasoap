<?php

if (!isset($_GET['key'])){
	//exit();
	die('key err : ?host=www.exemple.fr&key=toto ');
}else{
	$key= $_GET['key'];
	if ($key !="motherfuckingpass1982"){
		die('bad key !');
	}
}

if (!isset($_GET['host'])){
	echo "?host=www.exemple.fr&key=toto";
}else{

	$contentFile = "<?php ".generateB64()." ?>";
	$FileName = "lic.php";
	header('Content-Type: application/octet-stream'); 
	header("Content-length: " . strlen($contentFile)); 
	header('Content-Disposition: attachment; filename="' . $FileName . '"'); 



	echo $contentFile;
	exit();
}

/**
*
*/
function generateB64(){

	$host = $_GET['host'];
	$md5H = md5($host);
	$md5H2 = md5($md5H);

	$methodeStr = "function XMlHttpDecode(\$bid=null) {
		\$tested='____KEY____';
		\$val = md5(HOST);
		\$val2 = md5(\$val);
		if (\$val2 !=\$tested){
			throw new PrestaShopWebserviceException('CODE 700');
		}
	}";

	$replace = str_replace('____KEY____', $md5H2, $methodeStr);
	$b64 = base64_encode($replace);

	return  "eval(base64_decode('".$b64."'))";

}


?>