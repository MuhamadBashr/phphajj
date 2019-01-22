<?php
session_start();
$host="localhost";
$user="root";
$password="";
$db="logendatabase";
mysql_connect($host,$user,$password);
mysql_select_db($db);
if(isset($_POST['username'])){
    $uname=$_POST['username'];
    $password=$_POST['password'];

    $sql="select * from logen where name='".$uname."'AND password='".$password."' limit 1";

    $result=mysql_query($sql);

    if(mysql_num_rows($result)==1){
		$_SESSION['username']=$uname;
		$url='http://localhost:81/progect/location/';
		$time = 5;
       header("refresh: $time; url=$url");
       exit();
    }
    else{
        echo " You Have Entered Incorrect Password";
        exit();
    }
        
}
?>
