
/**
 * An event listener is added to listen to tap events on the map.
 * Clicking on the map displays an alert box containing the latitude and longitude
 * of the location pressed.
 * @param  {H.Map} map      A HERE Map instance within the application
 */
function setUpClickListener(map) {

  // Attach an event listener to map display
  // obtain the coordinates and display in an alert box.
  map.addEventListener('tap', function (evt) {
    map.removeObjects(map.getObjects());
    var coord = map.screenToGeo(evt.currentPointer.viewportX,
            evt.currentPointer.viewportY);
    logEvent('Clicked at ' + Math.abs(coord.lat.toFixed(4)) +
        ((coord.lat > 0) ? 'N' : 'S') +
        ' ' + Math.abs(coord.lng.toFixed(4)) +
         ((coord.lng > 0) ? 'E' : 'W'));
    document.getElementById('lat').value = Math.abs(coord.lat.toFixed(4)) + ((coord.lat > 0) ? 'N' : 'S');
    document.getElementById('lng').value = Math.abs(coord.lng.toFixed(4)) + ((coord.lng > 0) ? 'N' : 'S');
    let lat = coord.lat.toFixed(4);
    let lng = coord.lng.toFixed(4);
    addInfoBubble(map, lat, lng, evt);
    let prox = String(lat+','+lng);
    var addressData = reverseGeocode(platform, prox);
    console.log(addressData);
    document.getElementById('address').value = addressData.label;
  });
}


/**
 * Boilerplate map initialization code starts below:
 */

//Step 1: initialize communication with the platform
// In your own code, replace variable window.apikey with your own apikey
var platform = new H.service.Platform({
  apikey: window.apikey
});
var defaultLayers = platform.createDefaultLayers();

//Step 2: initialize a map
var map = new H.Map(document.getElementById('map'),
  defaultLayers.vector.normal.map,{
  center: {lat: 44.366935496545736, lng: 20.957528244781745},
  zoom: 15,
  pixelRatio: window.devicePixelRatio || 1
});
// add a resize listener to make sure that the map occupies the whole container
window.addEventListener('resize', () => map.getViewPort().resize());

//Step 3: make the map interactive
// MapEvents enables the event system
// Behavior implements default interactions for pan/zoom (also on mobile touch environments)
var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
var ui = H.ui.UI.createDefault(map, defaultLayers);
// Step 4: create custom logging facilities
var logContainer = document.createElement('ul');
logContainer.className ='log';
logContainer.innerHTML = '<li class="log-entry">Try clicking on the map</li>';
map.getElement().appendChild(logContainer);

// Helper for logging events
function logEvent(str) {
  var entry = document.createElement('li');
  entry.className = 'log-entry';
  entry.textContent = str;
  logContainer.insertBefore(entry, logContainer.firstChild);
}

// function addMarkersToMap(map, lat, lng) {
//     var marker = new H.map.Marker({lat:lat, lng:lng});
//     map.addObject(marker);
// }

setUpClickListener(map);

//SETTING AND REMOVING getBubbles

/**
 * Creates a new marker and adds it to a group
 * @param {H.map.Group} group       The group holding the new marker
 * @param {H.geo.Point} coordinate  The location of the marker
 * @param {String} html             Data associated with the marker
 */
function addMarkerToGroup(group, coordinate, html) {
  var marker = new H.map.Marker(coordinate);
  // add custom data to the marker
  marker.setData(html);
  group.addObject(marker);
}

function addInfoBubble(map, lat, lng, evt) {
  var group = new H.map.Group();

  map.addObject(group);

  // add 'tap' event listener, that opens info bubble, to the group
  group.addEventListener('tap', function (evt) {
    // event target is the marker itself, group is a parent event target
    // for all objects that it contains
    var bubble =  new H.ui.InfoBubble(evt.target.getGeometry(), {
      // read custom data
      content: evt.target.getData()
    });
    //remove infobubbles
    ui.getBubbles().forEach(bub => ui.removeBubble(bub));
    // show info bubble
    ui.addBubble(bubble);
  }, false);

  addMarkerToGroup(group, {lat:lat, lng:lng}, '<div>Location:<br> <span>Latitude: '+lat+'</span><br><span>Longitude: '+lng+'</span></div>');

  // addMarkerToGroup(group, {lat:53.430, lng:-2.961}, 'sdfsdfsdf');

}

addInfoBubble(map);

//REVERSE GEOCODING

function reverseGeocode(platform, prox) {
  var geocoder = platform.getGeocodingService(),
    reverseGeocodingParameters = {
      prox: prox,
      mode: 'retrieveAddresses',
      maxresults: '1',
      jsonattributes : 1
    };

  return geocoder.reverseGeocode(reverseGeocodingParameters, onSuccess,
    //onError
  );
}

function onSuccess(result) {
  var locations = result.response.view[0].result;
 /*
  * The styling of the geocoding response on the map is entirely under the developer's control.
  * A representitive styling can be found the full JS + HTML code of this example
  * in the functions below:
  */
  // console.log(locations[0].location.address);
  return locations[0].location.address;
  // ... etc.
}

function onError(error) {
  alert('Can\'t reach the remote server');
}
