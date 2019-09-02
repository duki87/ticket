<?php

  require_once './db/connection.php';

  class Routes
  {
      private $connection;

      public function __construct(\PDO $pdo)
      {
          echo 'routes';
          $this->connection = $pdo;
      }
  }
