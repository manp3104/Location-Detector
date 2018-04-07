<?php

    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    $dbc = mysqli_connect("localhost", "root", "");
    if(!$dbc) {
        die("Server connection failed: " . mysqli_connect_error());
        exit();
    }
    
    $dbs = mysqli_select_db($dbc, "locator");
    if(!$dbs) {
        die("Database connection failed.");
        exit();
    }

    if($_GET["userid"]) {
        $username = $_GET["userid"];
    }

    $query = "SELECT requestor FROM notification WHERE userid='$username'";
    
    $result = mysqli_query($dbc, $query) or trigger_error("Query MySQL Error: " .mysqli_error($dbc));
    $rows = mysqli_fetch_array($result);
    
    if(mysqli_num_rows($rows)==0) {
        echo 1;
    }
    else {
        $list = implode(',', $rows);
        echo $list;
    }
    
    $clear = "DELETE FROM notification WHERE userid='$username'";
    $r_result = mysqli_query($dbc, $clear) or trigger_error("Query MySQL Error: ".mysqli_error($dbc)); 

    mysqli_free_result($result);

    mysqli_close($dbc);
?>