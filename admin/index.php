<?php  include_once 'views/header.php'; ?>
<?php require_once 'class/Routes.class.php';
require_once 'db/connection.php';
  $routes = new Routes($conn);
?>
<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Hello, admin!</h1>
    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
    <hr class="my-4">

    <ul class="nav nav-pills">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Routes</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Add</a>
          <a class="dropdown-item" href="#">Manage</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Stations</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Add</a>
          <a class="dropdown-item" href="#">Manage</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Drivers</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Add</a>
          <a class="dropdown-item" href="#">Manage</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Vehicles</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Add</a>
          <a class="dropdown-item" href="#">Manage</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Tickets</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Add</a>
          <a class="dropdown-item" href="#">Manage</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
  </div>
</div>
<?php  include_once 'views/footer.php'; ?>
