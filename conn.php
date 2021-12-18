<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "assignment2";
		
		// Create connection
		$conn = mysqli_connect($servername, $username, $password,$dbname);

        $a="yess";
		// Check connection
		if (!$conn) {
            echo($a);
			die("Connection failed: " . mysqli_connect_error());
		}
?>
