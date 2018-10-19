<?php

session_start();
include("conexao.php");

if(empty($_POST['emailmodal']) || empty($_POST['pwdmodal'])) {
    header('Location: index.php');
    exit();
}

$email = $_POST['emailmodal'];
$senha = $_POST['pwdmodal'];

$sql = "select count(*) from usuario where email = '$email' and senha = sha1('$senha')";
$result = $conn->prepare($sql);
$result->execute();



$row = $result->fetchColumn();
if ($row == 1) {
    
    $sql = "select nome from usuario where email = '$email'";
    $result = $conn->query($sql);
    $result->execute();
    $nome = $result->fetchColumn();
    
    $sql = "select Id from usuario where email = '$email'";
    $result = $conn->query($sql);
    $result->execute();
    $id = $result->fetchColumn();
    
    $_SESSION['usuario'] = $nome;
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $id;
    header('Location: perfil.php');
    exit();
} else {
    header('Location: index.php');
}
?>