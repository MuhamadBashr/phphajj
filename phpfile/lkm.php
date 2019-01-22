<?php
session_start();   ////
$uname=$_SESSION['username'];
$idl=$_SESSION['id_location'];
$N=$_SESSION['N'];
$E=$_SESSION['E'];
$host="localhost";
$user="root";//
$password="";
$db="logendatabase";
mysql_connect($host,$user,$password);
mysql_select_db($db);
//$h=1;
$my= new mysqli($host,$user,$password,$db);
if(!empty($_POST['Frist_name'])&&!empty($_POST['last_name'])&&!empty($_POST['password'])&&!empty($_POST['conutry'])){
	$FirstName=$_POST['Frist_name'];
    $LastName=$_POST['last_name'];
	$PassportNumber=$_POST['password'];
	$Countries=$_POST['conutry'];
	$insert=$my->query("INSERT INTO pilgrims (Fname,Lname,Passport_number,contries,Fkun,Flocation,N,E)VALUES('".$FirstName."','".$LastName."','".$PassportNumber."','".$Countries."','".$uname."','".$idl."','".$E."','".$N."')");
	header("Location:http://localhost:81/progect/add/add.php");
}else{
header("Location:http://localhost:81/progect/add/add.php");
}
?>

	