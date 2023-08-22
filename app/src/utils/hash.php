<?php


function getHashPassword($pass){
    $options = [
        'cost' => 10,
    ];
    
   return password_hash($pass, PASSWORD_DEFAULT, $options);
}


function isMath($pass,$hash){
    return password_verify($pass,$hash);
}
