<?php

define("HOST","localhost");
define("USER","root");
define("PSWR","");
define("DBNM","ajaxcrud");

function connect(){
    
    $conn = new mysqli(HOST,USER,PSWR,DBNM);

    if($conn){

        return $conn;
    }
    return null;
}


?>