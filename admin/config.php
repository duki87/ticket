<?php
    //Connection settings
    $servername = "localhost";
    $database = "ticket";
    $username = "root";
    $password = "";
    $connection_options = [
      \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ];

    //Document root
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'].'/ticket/admin/');
?>
