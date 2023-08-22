<?php

include_once("../../connection/connection.php");
include_once("../../utils/hash.php");

$type = $_POST['type'];
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$password = $_POST['password'];

$sql = "";

if ($type == "client") {
    

    $sql = "SELECT * FROM tb_client WHERE client_email = '$email'";
    $result = $conn->query($sql);

    $client = mysqli_fetch_assoc($result);

    if (!empty($client)) {
        if (isMath($password, $client['client_password'])) {

            session_start();

            $_SESSION['client_id'] = $client['client_id'];
            $_SESSION['client_name'] = $client['client_name'];
            $_SESSION['client_email'] = $client['client_email'];

            header("Location: ../../../index.php?client_id=$client[client_id]");
        } else {
            header("Location: ../../pages/login/login.php?fail_login=true");
        }
    } else {
        header("Location: ../../pages/login/login.php?fail_client=true");
    }
} else {

    

    $sql = "SELECT * FROM tb_user WHERE user_email = '$email'";
    $result = $conn->query($sql);

    $user = mysqli_fetch_assoc($result);

    if (!empty($user)) {
        if (isMath($password, $user['user_password'])) {

            session_start();

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_email'] = $user['user_email'];

            header("Location: ../../pages/user/index.php");
        } else {
            header("Location: ../../pages/login/login.php?fail_login=true");
        }
    } else {
        header("Location: ../../pages/login/login.php?fail_user=true");
    }
}
