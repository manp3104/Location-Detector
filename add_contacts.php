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

	if($_GET["userid"]) {}
		$contact = $_GET["userid"];
	}

	if($_GET["number"]) {
		$contacts = $_GET["number"];
	}
	$file = $contact.".txt";
	$path = "user_info/".$contact. "/" . $file;
	$ret = file_put_contents($path, $contacts."\n", FILE_APPEND | LOCK_EX);
	if($ret==false) {
		echo 2;
	}	
	else {
		return 1;
	}
	
	mysqli_close($dbc);
?>