<?php
include_once("../../../connection/connection.php");
include_once("../../../utils/hash.php");

$user = strtoupper($_POST['usuario']);
$email = $_POST['email'];
$password = $_POST['senha'];

$pass_hash = getHashPassword($password);

$sql_check_name = "SELECT client_name FROM tb_client WHERE client_name = '$user' ";
$result_check_name = $conn->query($sql_check_name);
$isRegisteredByName = mysqli_fetch_assoc($result_check_name);

$sql_check_email = "SELECT client_email FROM tb_client WHERE client_email = '$email' ";
$result_check_email = $conn->query($sql_check_email);
$isRegisteredByEmail = mysqli_fetch_assoc($result_check_email);

if($isRegisteredByEmail['client_email'] == null && $isRegisteredByEmail['client_name'] == null){

    $sql_save = "INSERT INTO tb_client (client_name, client_email, client_password, createAt) VALUES ('$user', '$email', '$pass_hash', NOW())";
    
    $result = mysqli_query($conn, $sql_save);
    
    
    if(mysqli_insert_id($conn)){
        header('Location: ../../login/login.php');
    }else{
        header('Location: ..cadastro.php');
    }
}else{
    header('Location: ..cadastro.php?isRegistered=true');
}
