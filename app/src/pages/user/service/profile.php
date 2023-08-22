<?php



function getProfile($profile_id){
    include_once("../../connection/connection.php");
    
    $sql_profile = "SELECT profile_name FROM tb_profile WHERE profile_id = '$profile_id'";

    $result_profile = $conn->query($sql_profile);

    return mysqli_fetch_assoc($result_profile);


}
