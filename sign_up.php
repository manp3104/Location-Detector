<?php

	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

	$dbc = mysqli_connect("localhost", "root", "");

	if(!$dbc) {
		die("Server connection failed: " .mysqli_error($dbc));
		exit();
	}

	$dbs = mysqli_select_db($dbc, "Locator");

	if(!$dbs) {
		die("Database connection failed: " .mysqli_error($dbs));
		exit();
	}

	$name = '';
	$contact = '';
	$email = '';
	$age = '';

    if($_GET['fullname']) {
        $name = $_GET['fullname'];
    }
    if($_GET['contact']) {
        $contact = $_GET['contact'];
    }
    if($_GET['email']) {
        $email = $_GET['email'];
    }
    if($_GET['age']) {
        $age = $_GET['age'];
    }


	$check = "SELECT * FROM signedup WHERE contact='$contact'";
	$raw_results = mysqli_query($dbc, $check) or trigger_error("Query MySQL Error: ".mysqli_error($raw_results)); 
	$rows = mysqli_num_rows($raw_results);

	if($rows==0) {

		$path = "user_info/".$contact;
		mkdir($path);
		$img_address = $path."/". $contact ."_image.jpg";
		$img_name = $contact."_image.jpg";
        
        
        $file= file_get_contents('php://input');
        if(!(file_put_contents($img_address,$file)==FALSE))
        {
		
            
            $file = $contact.".txt";
            $c_query = "INSERT INTO e_contacts (contact, contacts) VALUES ('$contact', '$file')";
            $res = mysqli_query($dbc, $c_query) or trigger_error("Query MySQL Error: " .mysqli_error($dbc));
            
            $query = "INSERT into SignedUp (contact, name, email, image, age) VALUES ('$contact', '$name', '$email', '$img_name', '$age')";

            $result = mysqli_query($dbc, $query) or trigger_error("Query MySQL Error: " .mysqli_error($dbc));

            if($result) {
                echo 1;
            }
            else {
                echo 3;
            }
	   }
    }
	else {

		echo 2;
	}

	mysqli_close($dbc);
?>