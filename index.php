<?php
    include 'config/Api_Headers.php';
    include_once 'config/Auto_Loader.php';

    $method = $_SERVER['REQUEST_METHOD'];
    $accept = $_SERVER['HTTP_ACCEPT'];
    $uri = explode("/", $_SERVER['REQUEST_URI']);

    if($accept != "application/json"){
        echo("Return 404");
        die();
    }

    print_r($uri);

    // switch () {
    //     case 'value':
    //         # code...
    //         break;
        
    //     default:
    //         # code...
    //         break;
    // }
?>