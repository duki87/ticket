<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <title>Calculating a Location from a Mouse Click</title>
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <link rel="stylesheet" type="text/css" href="public/css/heremaps/demo.css" />
    <link rel="stylesheet" type="text/css" href="public/css/heremaps/styles.css" />
    <link rel="stylesheet" type="text/css" href="public/css/heremaps/template.css" />

    <style type="text/css">
      .log {
        position: absolute;
        top: 5px;
        left: 5px;
        height: 150px;
        width: 250px;
        overflow: scroll;
        background: white;
        margin: 0;
        padding: 0;
        list-style: none;
        font-size: 12px;
      }
      .log-entry {
        padding: 5px;
        border-bottom: 1px solid #d0d9e9;
      }
      .log-entry:nth-child(odd) {
          background-color: #e1e7f1;
      }
    </style>

  </head>
  <body id="markers-on-the-map">

    <div class="page-header">
        <h1>Calculating a Location from a Mouse Click</h1>
        <p>Obtain the latitude and longitude of a location within the map</p>
    </div>
    <p>This example displays a map of the world. Clicking on the map displays an alert box containing the latitude and longitude of the location pressed.</p>
    <div id="map">
      <div class="">
          <input type="text" name="" id="lat" value="">
          <input type="text" name="" id="lng" value="">
      </div>
    </div>
    <h3>Code</h3>
    <p>The <code>tap</code> event holds the x and y screen coordinates of the location clicked.
      These are converted to a latitude and longitude using the <code>map.screenToGeo()</code> method.</p>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script type="text/javascript" src='public/js/heremaps/test-credentials.js'></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    <script type="text/javascript" src='public/js/heremaps/calculateLocation.js'></script>
  </body>
</html>
