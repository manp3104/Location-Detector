<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    
    $dbc = mysqli_connect("localhost", "root", "");
    if(!$dbc) {
        die("Server connection failed.");
        exit();
    }

    $dbs = mysqli_select_db($dbc, "Locator");
    if(!$dbs) {
        die("Database connection failed.");
        exit();
    }

    if($_GET["userid"]) {
        $username = $_GET["userid"];
    }
    
    if($_GET["contacts"]) {
        $contact = $_GET["contacts"];
    }

    $file = $username.".txt";
    $path  = "user_info/".$username."/".$file;
    
    $contents = file_get_contents($path);
    $contents = str_replace($contact, '', $contents);
    $ret = file_put_contents($path, $contents.PHP_EOL, FILE_APPEND);
    
    if($ret) {
        echo 1;
    }
    else {
        echo 2;
    }
    mysqli_close($dbc);
?>