<?php
/*$numero1 =20;

$numero2 =30;
$addition = $numero1 + $numero2;
echo $addition;

*/

//crear variables de conectividad
$servername = "localhost"; //127.0.0.1

$username = "postgres";      

$password = "unicesmag"; 

$dbname = "beta";

$port ="5432";
 
//crear conección
$conn = pg_connect(
    $dbname, 
    $host, 
    $username, 
    $password, 
    $port);

    //verificar conectividad
    if (!$conn) {
        die("Connection failed: ". pg_last_error());
    }
    else {echo "Connection successfully";
    }
    
    
    //cerrar la conexion

    pg_close($conn);

?>