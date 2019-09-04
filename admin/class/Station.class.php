<?php

  //require_once '../db/connection.php';

  class Station
  {
      private $connection;

      public function __construct(\PDO $pdo)
      {
          //echo 'stations';
          $this->connection = $pdo;
      }

      public function add($stationData = array())
      {
          $query = "INSERT INTO stations (title, address, latitude, longitude, status) VALUES (?, ?, ?, ?, ?)";
          $statement = $this->connection->prepare($query);
          $statement->execute($stationData);
          $result = $statement->rowCount();
          if(isset($result)) {
            return "success";
          } else {
            return "error";
          }
      }

      public function get()
      {
          $query = "SELECT * FROM stations WHERE status = ?";
          $statement = $this->connection->prepare($query);
          $statement->execute([1]);
          $result = $statement->fetchAll();
          if(isset($result)) {
            return json_encode($result);
          } else {
            return "error";
          }
      }
  }
