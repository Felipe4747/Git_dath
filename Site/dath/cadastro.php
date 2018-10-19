<?php
    session_start();
    include "conexao.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $Nome = $_POST["nome"];
        $Email = $_POST["email"];
        $Senha = $_POST["pswd"];
        $Tel = $_POST["tel"];
        $CPF = $_POST["cpf"];
        $Nasc = $_POST["nasc"];
        $Sangue = $_POST["sangue"];
        $Sexo = $_POST["sexo"];

    //    Checar se já existe email ou cpf
        $sql = "select count(*) from usuario where email = '$Email'";
        $result = $conn->prepare($sql);
        $result->execute();
        $emailcount = $result->fetchColumn();

        $sql = "select count(*) from usuario where cpf = '$CPF'";
        $result = $conn->prepare($sql);
        $result->execute();
        $cpfcount = $result->fetchColumn();
        
        if ($emailcount == 0 & $cpfcount == 0) {
            try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "insert into usuario (nome, email, senha, tel, cpf, nasc, tipo_s, sexo)
            values('$Nome','$Email',sha1('$Senha'),'$Tel','$CPF','$Nasc','$Sangue','$Sexo')";
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "Sucesso!";
            
            $sql = "select Id from usuario where email = '$Email'";
            $result = $conn->prepare($sql);
            $result->execute();
            $Id = $result->fetchColumn();
            
            $_SESSION['usuario'] = $Nome;
            $_SESSION['email'] = $Email;
            $_SESSION['id'] = $Id;
            header('Location: perfil.php');
            $_SESSION["alert"] = false;
        }
        catch(PDOException $e)
        {
            echo 'erro aqui rapaz';
        }
        } else {
            
            header('Location: index.php#cadastro');
            $_SESSION["alert"] = true;
        }


        
        }
        $conn = null;
    ?>