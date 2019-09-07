<?php
  require_once 'config.php';
  include_once DOCUMENT_ROOT.'views/header.php';
  require_once DOCUMENT_ROOT . '/db/connection.php';
?>
    <div class="container mx-auto" id="">
      <div class="jumbotron">
        <h1 class="display-2">Add Route</h1>
        <p class="lead">Add a new route based on active stations.</p>
        <hr class="my-4">
        <div class="page-header">
            <h1>Select stations from the list to add them to route.</h1>
            <p>Add all required data to make route.</p>
        </div>
        <div id="map"></div>
        <form class="needs-validation" action="process/route.process.php" method="post">
          <div class="form-row">
            <input type="hidden" name="add_route" value="1">
            <div class="col-md-12 mb-3">
              <label for="title">Route Title</label>
              <input type="text" class="form-control" name="title" id="title" placeholder="Example: Palanka - Beograd" value="" required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>

            <div class="col-md-12">Stations <hr> </div>
            <div class="form-row col-md-12 add_station">
              <div class="col-md-12">Start station</div>
              <div class="input-group col-md-6 mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Station from</label>
                </div>
                <select class="custom-select station_from" id="station_from" name="station_from[]">
                  <option selected>Choose...</option>
                </select>
              </div>

              <div class="input-group col-md-6 mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Station to</label>
                </div>
                <select class="custom-select station_to" id="station_to" name="station_to[]">
                  <option selected>Choose...</option>
                </select>
              </div>

              <div class="input-group col-md-4 mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Depart.</label>
                </div>
                <input type="time" name="departure[]" value="00:00:00" class="form-control departure">
              </div>

              <div class="input-group col-md-4 mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Arrival</label>
                </div>
                <input type="time" name="arrival[]" value="00:00:00" class="form-control arrival">
              </div>

              <div class="input-group col-md-4 mb-3 timegroup">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Time</label>
                </div>
                <input type="text" readonly name="arrival[]" value="" class="form-control time">
              </div>
            </div>

            <div class="col-md-12">
              <button type="button" name="button" class="btn btn-primary float-right" id="add_station_div"><i class="fas fa-plus"></i> Add another station</button>
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
                Stations in opposite direction are the same.
              </label>
              <div class="invalid-feedback">
                You must agree before submitting.
              </div>
            </div>
          </div>
          <button class="btn btn-primary" type="submit">Add Route</button>
        </form>
      </div>
    </div>
    <?php  include_once 'views/footer.php'; ?>
    <script type="text/javascript" src='public/js/heremaps/hereRoutes.js'></script>
    <script type="text/javascript" src='public/js/add_routes.js'></script>
  </body>
</html>
