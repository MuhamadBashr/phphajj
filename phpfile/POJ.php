<?php
session_start();
$host="localhost";
$user="root";
$password="";
$db="logendatabase";
mysql_connect($host,$user,$password);
mysql_select_db($db);
$p=$_POST['password'];
$pa=$_POST['conutry'];
$re=mysql_query("SELECT E,N FROM `pilgrims` WHERE Passport_number='".$p."'AND contries='".$pa."' ")or die (mysql_error());
$arrx=array();
$arry=array();
while($r=mysql_fetch_array($re)){
	$arrx[]=$r['E'];
	$arry[]=$r['N'];
	$e=$r['E'];
	$n=$r['N'];
	
}
print"(lacationx:".json_encode($arrx,JSON_UNESCAPED_UNICODE).")";
print"(lacationy:".json_encode($arry,JSON_UNESCAPED_UNICODE).")";

?>
<?php?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <title>Add a generated icon to the map</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.51.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.51.0/mapbox-gl.css' rel='stylesheet' />
    <style>
        body { margin:0; padding:0; }
        #map { position:absolute; top:0; bottom:0; width:100%; }
    </style>
</head>
<body>
<div id='map'style="width: 50%; height: 50%;">
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiYTcwMDcwMDEiLCJhIjoiY2pwM2Z1dGd0MDExcTNxb2MxcGx0dHdtcyJ9.DsvvdC6Y9odOpTtK8USlEQ';
var e=<?php echo $e;?>;
var n=<?php echo $n;?>;
var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v10',
  center: [e, n],
  zoom: 20
});

map.on('load', function () {

    var width = 30; // The image will be 64 pixels square
    var bytesPerPixel = 4; // Each pixel is represented by 4 bytes: red, green, blue, and alpha.
    var data = new Uint8Array(width * width * bytesPerPixel);

    for (var x = 0; x < width; x++) {
        for (var y = 0; y < width; y++) {
            var offset = (y * width + x) * bytesPerPixel;
            data[offset + 0] = y / width * 255; // red
            data[offset + 1] = x / width * 255; // green
            data[offset + 2] = 128;             // blue
            data[offset + 3] = 255;             // alpha
        }
    }

    map.addImage('gradient', {width: width, height: width, data: data});

    map.addLayer({
        "id": "points",
        "type": "symbol",
        "source": {
            "type": "geojson",
            "data": {
                "type": "FeatureCollection",
                "features": [{
                    "type": "Feature",
                    "geometry": {
                        "type": "Point",
                        "coordinates": [e, n]
                    }
                }]
            }
        },
        "layout": {
            "icon-image": "gradient"
        }
    });
});

</script>
<div>
</body>
</html>
