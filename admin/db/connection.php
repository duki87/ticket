<?php
  //require_once './config.php';

  try {
       $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password, $connection_options);
       // set the PDO error mode to exception
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       //echo "Connected successfully";
     }
  catch(PDOException $e)
     {
       echo "Connection failed: " . $e->getMessage();
     }
?>
