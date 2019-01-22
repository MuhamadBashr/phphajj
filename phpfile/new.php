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
var e=<?php $e=39.89263; echo $e;?>;
var n=<?php $n=21.42416; echo $n;?>;
var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v10',
  center: [e, n],
  zoom: 9
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
