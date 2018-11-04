<?php
    session_start();
    include "conexao.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $Tipo = $_POST["tipo"];
        $Hospital = $_POST["hospital"];
        $Medico = $_POST["medico"];
        $Horario =  $_POST["horario"];
        
        //Id do usuario atual
        $email = $_SESSION['email'];
        $sql = "select id from usuario where email = '$email'";
        $result = $conn->prepare($sql);
        $result->execute();
        $Id_Usuario = $result->fetchColumn();
        
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "insert into exacon (tipo, hospital, medico, horario, id_usuario)
            values('$Tipo','$Hospital','$Medico','$Horario', '$Id_Usuario')";
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "Sucesso!";
            header('Location: perfil.php');
        }
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    $conn = null;
?>
