When copying the module to Prestashop_install_folder/modules/ make sure that the folder name is "prestasoap"; otherwise it will not show up in the Modules section in the back office.

1- PHP_CURL and PHP_SOAP modules must be enabled

2- edit config.php file

define('PRESTA_BASEDIR'	, 'prestashop'); // directorty installation
define('HOST'	, 'www.example.fr'); // hostname : without http://

3 - Enable PrestaShop REST Webservices
http://doc.prestashop.com/display/PS14/Chapter+1+-+Creating+Access+to+Back+Office

4 - Use REST Key for SOAP Request

<loginInfo>
 <key>LFKSDLFSDFKLSDFMSDF</key>
</loginInfo>

More information can be found in the ./docs folder - there you will find how to test the Soap server with SoapUI.

In general each Soap service has 3 files. I.e. for orders:
1. orders.wsdl - template to generate the wsdl file
2. ordersWSDL.php - generates the final wsdl file using the .wsdl template and filling in the server details. You should use this file as the wsdl for the Soap service.
3. ordersService.php - service file

