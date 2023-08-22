<?php

session_start();

function verification($path)
{
    if (!$_SESSION['id']) {
        header('Location: ' . $path);
        exit;
    }
}

function endSession($path)
{
    session_destroy();
    header('Location: ' . $path);
}
