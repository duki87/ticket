<?php  include_once 'views/header.php'; ?>
<?php
  require_once 'class/Station.class.php';
  require_once 'db/connection.php';
  $station = new Station($conn);
  if(isset($_POST['add_station'])) {
    $station->add();
  }

?>
<div class="container" id="markers-on-the-map">
  <div class="jumbotron">
    <h1 class="display-4">Add Station</h1>
    <p class="lead">Add a new station which can be later used for routes.</p>
    <hr class="my-4">
    <div class="page-header">
        <h1>Calculating a Location from a Mouse Click</h1>
        <p>Obtain the latitude and longitude of a location within the map</p>
    </div>
    <p>This example displays a map of the world. Clicking on the map displays an alert box containing the latitude and longitude of the location pressed.</p>
    <div id="map"></div>

    <form class="needs-validation" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
      <div class="form-row">
        <input type="hidden" name="add_station" value="1">
        <div class="col-md-6 mb-3">
          <label for="title">Station Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="Enter Station Title" value="" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="validationCustom02">Address</label>
          <input type="text" class="form-control" name="address" id="address" placeholder="Enter Station Address" value="" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="validationCustomUsername">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupPrepend">@</span>
            </div>
            <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
            <div class="invalid-feedback">
              Please choose a username.
            </div>
          </div>
        </div>
      </div>
      <div class="form-row">

      </div>
      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" name="active" id="active">
          <label class="form-check-label" for="invalidCheck">
            This station is active and can be used when making routes
          </label>
          <div class="invalid-feedback">
            You must agree before submitting.
          </div>
        </div>
      </div>
      <button class="btn btn-primary" type="submit">Add Station</button>
    </form>
  </div>
</div>
<?php  include_once 'views/footer.php'; ?>
