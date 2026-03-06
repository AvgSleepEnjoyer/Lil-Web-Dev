<?php 

function conectarDB() : mysqli{
    $db = mysqli_connect("localhost", "root", "root", "bienesraices_crud");
    $db->set_charset("utf8");

    if (!$db){
        exit;
    }
    return $db;
}
