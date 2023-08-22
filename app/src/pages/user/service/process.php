<?php

include_once("../../../connection/connection.php");
include_once("../../../utils/hash.php");


$name = strtoupper($_POST['name']);
$email = $_POST['email'];
$password = $_POST['password'];
$profile_name = $_POST['profile'];

// echo "Name:".$profile_name;

$sql_profile = "SELECT profile_id FROM tb_profile WHERE profile_name = '$profile_name'";

$partial_result = $conn->query($sql_profile);
$profile_id = mysqli_fetch_assoc($partial_result);


$pass_hash = getHashPassword($password);

$sql_insert_user = "INSERT INTO tb_user (user_name,profile_id, user_email, user_password, createAt,updateAt) VALUES ('$name', '$profile_id[profile_id]', '$email', '$pass_hash', NOW(),NOW())";

// echo "\n".$sql_insert_user;

$result = mysqli_query($conn, $sql_insert_user);

if (mysqli_insert_id($conn)) {
    header("Location: ../index.php");
} else {
    header("Location: ../index.php");
}
