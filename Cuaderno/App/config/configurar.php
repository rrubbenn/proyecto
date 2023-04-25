<?php
//** Desarrollo */
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
//** Desarrollo */


// Ruta de la aplicacion	
define('RUTA_APP', dirname(dirname(__FILE__)));

// Ruta url, Ejemplo: http://localhost/atletismo
define('RUTA_URL', 'http://localhost/Cuaderno');

define('NOMBRE_SITIO', 'Cuaderno');


// Configuracion de la Base de Datos
define('DB_HOST', 'localhost');
define('DB_USUARIO', 'root');
define('DB_PASSWORD', 'root');
define('DB_NOMBRE', 'cuaderno');

// Configuracion de correo
// define('EmailEmisor','informatica@cpifpbajoaragon.com');
// define('EmailPass','Atenea?2122');
// define('Emisor','CPIFP Bajo Arag´´on');
// define('Host','smtp.ionos.es');
// define('SMTPSecure','TLS');
// define('Puerto',587);
