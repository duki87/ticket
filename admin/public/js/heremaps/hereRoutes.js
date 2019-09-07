$(document).ready(function() {

  //HereMaps methods

   var waypoint0 = '52.5160,13.3779', waypoint1 = '52.5206,13.3862';
   $(document).on('change', '.station_from', function(event) {
      let lat0 = event.target.selectedOptions[0].dataset.lat;
      let lng0 = event.target.selectedOptions[0].dataset.lng;
      waypoint0 = String(lat0+','+lng0);
      //console.log(waypoint0);
   });

   $(document).on('change', '.station_to', function(event) {
      //console.log(event.target.selectedOptions[0].dataset.lat);
      let lat1 = event.target.selectedOptions[0].dataset.lat;
      let lng1 = event.target.selectedOptions[0].dataset.lng;
      waypoint1 = String(lat1+','+lng1);
      calculateRouteFromAtoB(platform);
      //console.log(waypoint1);
   });

   function calculateRouteFromAtoB(platform) {
       var router = platform.getRoutingService(),
         routeRequestParams = {
           mode: 'fastest;car',
           representation: 'display',
           routeattributes : 'waypoints,summary,shape,legs',
           maneuverattributes: 'direction,action',
           waypoint0: waypoint0,
           waypoint1: waypoint1
         };
       router.calculateRoute(routeRequestParams, onSuccess, onError);
   }

   function onSuccess(result) {
       var route = result.response.route[0];
      /*
       * The styling of the route response on the map is entirely under the developer's control.
       * A representitive styling can be found the full JS + HTML code of this example
       * in the functions below:
       */
       getRouteSegmentDetails(route.summary);
       addRouteShapeToMap(route);
       addManueversToMap(route);
       addWaypointsToPanel(route.waypoint);
       addManueversToPanel(route);
       addSummaryToPanel(route.summary);
   }

   function onError(error) {
       alert('Can\'t reach the remote server');
   }

   /**
    * Boilerplate map initialization code starts below:
    */

   // set up containers for the map  + panel
   var mapContainer = document.getElementById('map');
   //var routeInstructionsContainer = document.getElementById('panel');

   //Step 1: initialize communication with the platform
   // In your own code, replace variable window.apikey with your own apikey
   var platform = new H.service.Platform({
        apikey: window.apikey
   });

   var defaultLayers = platform.createDefaultLayers();

   //Step 2: initialize a map - this map is centered over Berlin
   var map = new H.Map(mapContainer,
     defaultLayers.vector.normal.map,{
     center: {lat: 44.366935496545736, lng: 20.957528244781745},
     zoom: 13,
     pixelRatio: window.devicePixelRatio || 1
   });
   // add a resize listener to make sure that the map occupies the whole container
   window.addEventListener('resize', () => map.getViewPort().resize());

   //Step 3: make the map interactive
   // MapEvents enables the event system
   // Behavior implements default interactions for pan/zoom (also on mobile touch environments)
   var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

   // Create the default UI components
   var ui = H.ui.UI.createDefault(map, defaultLayers);

   // Hold a reference to any infobubble opened
   var bubble;

   function openBubble(position, text) {
    if(!bubble) {
       bubble =  new H.ui.InfoBubble(
         position,
         // The FO property holds the province name.
         {content: text});
       ui.addBubble(bubble);
     } else {
       bubble.setPosition(position);
       bubble.setContent(text);
       bubble.open();
     }
   }

   function addRouteShapeToMap(route) {
     var lineString = new H.geo.LineString(),
       routeShape = route.shape,
       polyline;

     routeShape.forEach(function(point) {
       var parts = point.split(',');
       lineString.pushLatLngAlt(parts[0], parts[1]);
     });

     polyline = new H.map.Polyline(lineString, {
       style: {
         lineWidth: 4,
         strokeColor: 'rgba(0, 128, 255, 0.7)'
       }
     });
     // Add the polyline to the map
     map.addObject(polyline);
     // And zoom to its bounding rectangle
     map.getViewModel().setLookAtData({
       bounds: polyline.getBoundingBox()
     });
   }

   function addManueversToMap(route) {
     var svgMarkup = '',
       dotIcon = new H.map.Icon(svgMarkup, {anchor: {x:8, y:8}}),
       group = new  H.map.Group(),
       i,
       j;

     // Add a marker for each maneuver
     for (i = 0;  i < route.leg.length; i += 1) {
       for (j = 0;  j < route.leg[i].maneuver.length; j += 1) {
         // Get the next maneuver.
         maneuver = route.leg[i].maneuver[j];
         // Add a marker to the maneuvers group
         var marker =  new H.map.Marker({
           lat: maneuver.position.latitude,
           lng: maneuver.position.longitude} ,
           {icon: dotIcon});
         marker.instruction = maneuver.instruction;
         group.addObject(marker);
       }
     }

     group.addEventListener('tap', function (evt) {
       map.setCenter(evt.target.getGeometry());
       openBubble(
          evt.target.getGeometry(), evt.target.instruction);
     }, false);

     // Add the maneuvers group to the map
     map.addObject(group);
   }

   function addWaypointsToPanel(waypoints) {

     var nodeH3 = document.createElement('h3'),
       waypointLabels = [],
       i;

      for (i = 0;  i < waypoints.length; i += 1) {
        waypointLabels.push(waypoints[i].label)
      }

      nodeH3.textContent = waypointLabels.join(' - ');

     routeInstructionsContainer.innerHTML = '';
     routeInstructionsContainer.appendChild(nodeH3);
   }

   function addSummaryToPanel(summary) {
     var summaryDiv = document.createElement('div'),
          content = '';
          content += 'Total distance: ' + summary.distance  + 'm.';
          content += 'Travel Time: ' + summary.travelTime.toMMSS() + ' (in current traffic)';

     summaryDiv.style.fontSize = 'small';
     summaryDiv.style.marginLeft ='5%';
     summaryDiv.style.marginRight ='5%';
     summaryDiv.innerHTML = content;
     routeInstructionsContainer.appendChild(summaryDiv);
   }

   function getRouteSegmentDetails(summary) {
      // let data = {
      //   distance: summary.distance/1000 + ' km',
      //   time: summary.travelTime.toMMSS()
      // }
      // routeData(data);
      // travelTime = summary.travelTime.toMMSS()
      // $('.add_station').last().find('.station_from').append(stations_from);
      let min = Math.floor(summary.travelTime / 60);
      let sec = Math.floor(summary.travelTime % 60);
      travelTime = min + ':' + sec;
      $('.add_station').last().find('.time').val(travelTime);
   }

   function addManueversToPanel(route) {

     var nodeOL = document.createElement('ol'),
       i,
       j;

     nodeOL.style.fontSize = 'small';
     nodeOL.style.marginLeft ='5%';
     nodeOL.style.marginRight ='5%';
     nodeOL.className = 'directions';

    // Add a marker for each maneuver
     for (i = 0;  i < route.leg.length; i += 1) {
       for (j = 0;  j < route.leg[i].maneuver.length; j += 1) {
         // Get the next maneuver.
         maneuver = route.leg[i].maneuver[j];

         var li = document.createElement('li'),
           spanArrow = document.createElement('span'),
           spanInstruction = document.createElement('span');

         spanArrow.className = 'arrow '  + maneuver.action;
         spanInstruction.innerHTML = maneuver.instruction;
         li.appendChild(spanArrow);
         li.appendChild(spanInstruction);

         nodeOL.appendChild(li);
       }
     }
     routeInstructionsContainer.appendChild(nodeOL);
   }


   Number.prototype.toMMSS = function() {
     return  Math.floor(this / 60)  +' minutes '+ (this % 60)  + ' seconds.';
   }

   // Now use the map as required...
   //calculateRouteFromAtoB (platform);

   //Other javascript methods for this page

   get_stations();

   var stations_from = [];
   var stations_to = [];
   var travelTime;
   var startTime = new Date();

   //Get list of stations
   function get_stations(station_from = null) {
     var get_stations = true;
     $.ajax({
       url: "process/station.process.php",
       method: 'post',
       data: {get_stations:get_stations},
       dataType: 'json',
       success: function(data) {
         //console.log(data);
         load_stations(data, station_from);
         append_stations();
       },
       error: function(err) {
         console.log(err);
       }
     });
   }

   function append_stations() {
     $('.add_station').last().find('.station_from').append(stations_from);
     $('.add_station').last().find('.station_to').append(stations_to);
   }

   $(document).on('click', '#add_station_div', function(e) {
       e.preventDefault();
       add_station_div();
   });

   $(document).on('change', '.departure', function(e) {
       e.preventDefault();
       if($('.departure').length  == 1) {
         let time = ($(this).val()).split(':');
         //console.log(time[0] + ' ' + time[1]);
         startTime.setHours(time[0]);
         startTime.setMinutes(time[1]);
         startTime.setSeconds(time[2]);
         let stationsTravelTime = $(this).parent().siblings('.timegroup').find('.time').val();
         changeArrivalTime(stationsTravelTime);
       }
   });

   function changeArrivalTime(time) {
      let arrTime = new Date();
   }

   function add_station_div() {
     let station_from = $('.add_station').last().find('.station_to').val();
     let add_station_div =
     '<div class="form-row col-md-12 add_station">'+
         '<div class="col-md-12">Station</div>'+
         '<div class="input-group col-md-6 mb-3">'+
           '<div class="input-group-prepend">'+
             '<label class="input-group-text" for="inputGroupSelect01">Station from</label>'+
           '</div>'+
           '<select class="custom-select station_from" id="station_from" name="station_from[]">'+
             '<option>Choose...</option>'+
           '</select>'+
         '</div>'+
         '<div class="input-group col-md-6 mb-3">'+
           '<div class="input-group-prepend">'+
             '<label class="input-group-text" for="inputGroupSelect01">Station to</label>'+
           '</div>'+
           '<select class="custom-select station_to" id="station_to" name="station_to[]">'+
             '<option>Choose...</option>'+
           '</select>'+
         '</div>'+
         '<div class="input-group col-md-4 mb-3">'+
           '<div class="input-group-prepend">'+
             '<label class="input-group-text" for="inputGroupSelect01">Depart.</label>'+
           '</div>'+
           '<input type="time" name="departure[]" value="" class="form-control">'+
         '</div>'+
         '<div class="input-group col-md-4 mb-3">'+
           '<div class="input-group-prepend">'+
             '<label class="input-group-text" for="inputGroupSelect01">Arrival</label>'+
           '</div>'+
           '<input type="time" name="arrival[]" value="" class="form-control">'+
         '</div>'+
         '<div class="input-group col-md-4 mb-3">'+
           '<div class="input-group-prepend">'+
             '<label class="input-group-text" for="inputGroupSelect01">Time</label>'+
           '</div>'+
           '<input type="text" readonly name="arrival[]" value="" class="form-control time">'+
         '</div>'+
       '</div>';
       $('.add_station').last().after(add_station_div);
       get_stations(station_from);
   }

   function load_stations(data, station_from) {
     data.forEach(station => {
         if(station_from == station.id) {
           stations_from.push('<option selected value="'+station.id+'" data-lat="'+station.latitude+'" data-lng="'+station.longitude+'">'+station.title+'</option>');
         }
         stations_from.push('<option value="'+station.id+'" data-lat="'+station.latitude+'" data-lng="'+station.longitude+'">'+station.title+'</option>');
         stations_to.push('<option value="'+station.id+'" data-lat="'+station.latitude+'" data-lng="'+station.longitude+'">'+station.title+'</option>');
     });
   }
 });
