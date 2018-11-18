<?php
    session_start();
    include "conexao.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $Tipo = $_POST["tipo"];
        $Hospital = $_POST["hospital"];
        $Medico = $_POST["medico"];
        $Horario =  $_POST["horario"];
        $TipoExa = $_POST["tipoexa"];
        //Id do usuario atual
        $email = $_SESSION['email'];
        $sql = "select id from usuario where email = '$email'";
        $result = $conn->prepare($sql);
        $result->execute();
        $Id_Usuario = $result->fetchColumn();
        
        if ($Horario <= date("Y-m-d", strtotime(' + 1 days'))) {
            $_SESSION["alert"] = 'alert("Data inválida! Escolha uma data com pelo menos um dia de antecedência");'; 
            header("location: perfil.php");
        } else {
            try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "insert into exacon (id_hospital, id_medico, horario, id_usuario)
            values('$Hospital','$Medico','$Horario', '$Id_Usuario')";
            $conn->exec($sql);
            
            
            if ($Tipo == "Exame") {
                $sql = "select max(exacon.id) from exacon 
                inner join usuario on usuario.id = exacon.id_usuario
                where usuario.email ='$email'";
                $result = $conn->prepare($sql);
                $result->execute();
                $IdExa = $result->fetchColumn();
                
                $sql = "insert into exa values(null, '$IdExa', '$TipoExa')";
                $conn->exec($sql);
            }    
            echo "Sucesso!";
            header('Location: perfil.php');
            }
            catch(PDOException $e)
            {
                echo $sql . "<br>" . $e->getMessage();
            }
        }
        
    }
    $conn = null;
?>
