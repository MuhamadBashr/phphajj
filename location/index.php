<?php
session_start();
$uname=$_SESSION['username'];
$host="localhost";
$user="root";
$password="";
$db="logendatabase";
mysql_connect($host,$user,$password);
mysql_select_db($db);
$my= new mysqli($host,$user,$password,$db);
$uname=$_SESSION['username'];
$Sx=mysql_query("SELECT ST_X (location) from location where Fkun ='".$uname."'");
while($rowx = mysql_fetch_array($Sx)){
	$e=$rowx['ST_X (location)'];
	
}
$Sy=mysql_query("SELECT ST_Y (location) from location where Fkun ='".$uname."'");
while($rowy = mysql_fetch_array($Sy)){
	$n=$rowy['ST_Y (location)'];
	
}
$Sfk=mysql_query("SELECT id_location FROM location WHERE Fkun ='".$uname."'");
while($rowl = mysql_fetch_array($Sfk)){
	$idl=$rowl['id_location'];
	
}
$_SESSION['N']=$e;
$_SESSION['E']=$n;
$_SESSION['id_location']=$idl;

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
	
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.51.0/mapbox-gl.js'></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Add a generated icon to the map</title>
	<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.51.0/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/-Login-form-Page-BS4-.css">
    <link rel="stylesheet" href="assets/css/Button-Outlines---Pretty.css">
    <link rel="stylesheet" href="assets/css/Data-Table-1.css">
    <link rel="stylesheet" href="assets/css/Data-Table.css">
    <link rel="stylesheet" href="assets/css/dh-row-text-image-right-responsive.css">
    <link rel="stylesheet" href="assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-Payment-Form.css">
    <link rel="stylesheet" href="assets/css/Highlight-Blue.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search-1.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search.css">
    <link rel="stylesheet" href="assets/css/untitled.css">

</head>

<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean">
             <div class="container"><a class="navbar-brand" href="http://localhost:81/progect/home/home_en.php" style="font-size:25px;">دليل الحاج</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="dropdown" style="width:133px;"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="http://localhost:81/progect/home/home_en.php">Language</a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="http://localhost:81/progect/home/home.php">العربية</a><a class="dropdown-item" role="presentation" href="http://localhost:81/progect/home/home_en.php">English</a><a class="dropdown-item" role="presentation" href="#"></a></div>
                        </li>
                    </ul>
            </div>
    </div>
    </nav>
	</div>
    <div class="article-list" style="padding-left: 10px;padding-right: 10px;background-color: #ffffff;padding-top: 10px;">
        <div class="dropdown" style="width: 133px;padding-left: 79%;"><button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">Services</button>
            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="http://localhost:81/progect/location/">Locate the camp</a><a class="dropdown-item" role="presentation" href="http://localhost:81/progect/add/add.php">Add pilgrims</a><a class="dropdown-item" role="presentation" href="#"></a>
                <div class="dropdown-divider" role="presentation"></div>
            </div>
        </div>
    </div>
    <div class="highlight-blue">
        <h1 style="background-color: #f0f9ff;">location of the camp</h1>
        <div class="container-fluid" style="width: 70%;height: 300px;background-color: #f0f9ff;">
            <div id='map' style="width: 100%;height: 100%;"></div>
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
        </div>
		<a href="http://localhost:81/progect/add/add.php">Continue</a>
    </div>
<div id="C1" class="footer-clean">
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    
                    <div class="col-sm-4 col-md-3 item">
                        <h3>About</h3>
                        <ul>
                            <li><a href="https://www.kku.edu.sa/">Company</a></li>
                            <li><a href="http://localhost:81/progect/teams/teams.html">Team</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                        <p class="copyright"></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/Table-With-Search.js"></script>
</body>

</html>