<?php
// Connecting to the Database
      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "memo";

      // Create a connection
      $db = mysqli_connect($servername, $username, $password, $database);
      // Die if connection was not successful
      if (!$db){
          die("Sorry we failed to connect: ". mysqli_connect_error());
      }
	  else {
//echo 'connection was  successful';
	  };

 
?>
