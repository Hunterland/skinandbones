<?php


include_once("../../../connection/connection.php");
include_once("../../../utils/hash.php");

if (isset($_POST['update'])) {

    $user_id = $_POST['id'];
    $name = strtoupper($_POST['name']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profile_name = $_POST['profile'];

    $sql_profile = "SELECT profile_id FROM tb_profile WHERE profile_name = '$profile_name'";

    
    $partial_result = $conn->query($sql_profile);
    $profile_id = mysqli_fetch_assoc($partial_result);
    
    $passHash = getHashPassword($password);

    $sqlUpdate = "UPDATE tb_user SET user_name = '$name',profile_id = '$profile_id[profile_id]' , user_email = '$email', user_password = '$passHash', updateAt = NOW() 
    WHERE user_id = '$user_id'";

    $result = $conn->query($sqlUpdate);
}

header('Location: ../index.php');
