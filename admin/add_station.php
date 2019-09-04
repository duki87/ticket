<?php
  require_once 'config.php';
  include_once DOCUMENT_ROOT.'views/header.php';
?>

    <div class="container mx-auto" id="markers-on-the-map">
      <div class="jumbotron">
        <h1 class="display-2">Add Station</h1>
        <p class="lead">Add a new station which can be later used for routes.</p>
        <hr class="my-4">
        <div class="page-header">
            <h1>Click on a location on the map to add new station.</h1>
            <p>Latitude and longitude of a station will be automatically added.</p>
        </div>
        <div id="map"></div>
        <form class="needs-validation" action="process/station.process.php" method="post">
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
            <div class="col-md-6 mb-3">
              <label for="validationCustomUsername">Coordinates</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupPrepend">Latitude</span>
                </div>
                <input type="text" readonly class="form-control" name="lat" id="lat" placeholder="" aria-describedby="latitude" required>
                <div class="invalid-feedback">
                  Please choose latitude.
                </div>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="validationCustomUsername" style="visibility:hidden">Coordinates</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupPrepend">Longitude</span>
                </div>
                <input type="text" readonly class="form-control" name="lng" id="lng" placeholder="" aria-describedby="latitude" required>
                <div class="invalid-feedback">
                  Please choose longitude.
                </div>
              </div>
            </div>
          </div>
          <div class="form-row">

          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="active" id="active">
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
  <script type="text/javascript" src='public/js/heremaps/calculateLocation.js'></script>
  </body>
</html>
