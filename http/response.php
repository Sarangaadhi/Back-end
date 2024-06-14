<?php
    function showResponse($result){
        http_response_code($result["http_code"]);
        echo($result["data"]);
        die();
    }

    function showResponseErr($err){
        $err_message = "Unknown Error";
        switch ($err) {
            case 400:
                $err_message = "Bad Request";
                break;
            case 401:
                $err_message = "Not Authorized";
                break;
            case 422:
                $err_message = "Unprocessable Content";
                break;
            case 503:
                $err_message = "Request can not be processed";
                break;     
            default:
                $err_message = "Internal Server Error";
                break;
        }
        http_response_code($err);
        echo(json_encode(['message' => $err_message]));
        die();
    }

?>