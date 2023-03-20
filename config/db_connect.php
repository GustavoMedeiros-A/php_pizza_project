<?php 

    	// connect to the database
	$connection = mysqli_connect('localhost', 'gustavo', 'teste1234', 'ninja_pizza', '3307');

	// check the connection
	if(!$connection) {
		echo "Connection error: " . mysqli_connect_error();
	}

?> 

