<?php

  require_once './db/connection.php';

  class Station
  {
      private $connection;

      public function __construct(\PDO $pdo)
      {
          //echo 'stations';
          $this->connection = $pdo;
      }

      public function add()
      {
          echo 'add';
      }
  }
