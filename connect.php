<?php
	$conn = new mysqli('localhost', 'root', '', 'dulaan') or die(mysqli_error());

	if(!$conn){
		die("Fatal Error: Connection Failed!");
	}
	else{
		$conn->set_charset("utf8");
	}