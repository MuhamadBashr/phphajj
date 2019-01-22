<?php
session_start();
//$uname='u7007001';
$host="localhost";
$user="root";
$password="";
$db="logendatabase";
mysql_connect($host,$user,$password,$db);
mysql_select_db($db);
if(isset($_POST['delete'])){
	$CB=$_POST['checkbox'];
	foreach($CB as $key => $id){
	echo $id;
	$k=mysql_query("DELETE FROM pilgrims WHERE Passport_number ='".$id."'");
	}
	if($k==1){
	echo"t";
	}else{
	echo"f";
	}
	}
	header("Location:http://localhost:81/progect/add/add.php");

	
?>