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


