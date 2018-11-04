<?php

//Local
$usuario = "root";
$senha ="";
$bd ="dath";
$servidor ="localhost";

//DB4Free
//$usuario = "dathdatabase";
//$senha ="dathdatabase";
//$bd ="dathdatabase";
//$servidor ="db4free.net:3306";

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $senha);    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

   //UTF-8   
    $conn->exec("SET NAMES 'utf8'");
    $conn->exec('SET character_set_connection=utf8');
    $conn->exec('SET character_set_client=utf8');
    $conn->exec('SET character_set_results=utf8');

?>
