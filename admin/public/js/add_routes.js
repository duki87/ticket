$(document).ready(function() {
    get_stations();
    var stations = [];

    //Get list of stations
    function get_stations() {
      var get_stations = true;
      $.ajax({
        url: "process/station.process.php",
        method: 'post',
        data: {get_stations:get_stations},
        dataType: 'json',
        success: function(data) {
          //console.log(data);
          data.forEach(station => {
              stations.push('<option value="'+station.id+'" data-lat="'+station.latitude+'" data-lng="'+station.longitude+'">'+station.title+'</option>');
          });
          $('#station_from').append(stations);
          $('#station_to').append(stations);
        },
        error: function(err) {
          console.log(err);
        }
      });
    }

    function add_stations(stations) {

    }
});
