<?php
  session_start();
  require_once '../config.php';
  require_once(DOCUMENT_ROOT . '/class/Station.class.php');
  require_once(DOCUMENT_ROOT . '/db/connection.php');

  $station = new Station($conn);

  if(isset($_POST['add_station'])) {
    $result = $station->add(array(
        filter_var($_POST['title'], FILTER_SANITIZE_STRING),
        filter_var($_POST['address'], FILTER_SANITIZE_STRING),
        $_POST['lat'],
        $_POST['lng'],
        isset($_POST['active']) ? 1 : 0
    ));
    if($result == 'success') {
      $_SESSION['message'] = 'New station successfully added.';
      header('Location: ../index.php');
      exit();
    }
  }

  if(isset($_POST['get_stations'])) {
      $data = $station->get();
      echo $data;
  }
?>
