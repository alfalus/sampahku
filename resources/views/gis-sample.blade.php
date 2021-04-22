<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>ArcGIS Developer Guide: Display a map (2D)</title>
  <style>
    html,
    body,
    #viewDiv {
      padding: 0;
      margin: 0;
      height: 100%;
      width: 100%;
    }
  </style>

  <link rel="stylesheet" href="https://js.arcgis.com/4.18//esri/themes/light/main.css">
  
</head>

<body>
  <div id="viewDiv" class="" style=""></div>
</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://js.arcgis.com/4.18//"></script>

  <script>
    
  </script>
<script type="text/javascript">
$(document).ready(function(){
    var lat ;
    var long;
     // get users lat/long

     var getPosition = {
       enableHighAccuracy: true,
       timeout: 9000,
       maximumAge: 10000
     };
     
     async function success(gotPosition) {
       var uLat = gotPosition.coords.latitude;
       var uLon = gotPosition.coords.longitude;

       lat = `${uLat}`;
       long = `${uLon}`;

       console.log(`${uLat}`, `${uLon}`);
     
     };
     
     function error(err) {
       console.warn(`ERROR(${err.code}): ${err.message}`);
     };
     
     navigator.geolocation.getCurrentPosition(success, error, getPosition);

    //  success().then(
    //      function(value){
    //          console.log(value);
    //      }
    //  );
    //  console.log('tes' + lat);
    //  console.log(long);
         require([
          "esri/config",
           "esri/Map",
           "esri/views/MapView",
            "esri/geometry/Point"
         ], function (esriConfig,Map, MapView, Point) {
     
           esriConfig.apiKey= "{{env('GIS_KEY')}}";
           const map = new Map({
             basemap: "arcgis-topographic" // Basemap layer
             // basemap: "arcgis-topographic" // Basemap layer
           });
     
           const view = new MapView({
             map: map,
             center: [-107.8801, 37.2753],
             zoom: 13, // scale: 72223.819286
             container: "viewDiv",
             constraints: {
               snapToZoom: false
             }
           });

           console.log(lat);
           console.log(long);
           const pt = new Point({
               latitude: lat,
               longitude: long
           });
           view.center = pt;
        //    console.log(Point.clone(pt));

        //    console.log(point);
     
         });
});
// console.log(true);
// console.log(lat);
</script>
</html>