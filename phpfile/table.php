

<?php
session_start();
$host="localhost";
$user="root";
$password="";
$db="logendatabase";
mysql_connect($host,$user,$password);
mysql_select_db($db);
$uname=$_SESSION['username'];
$result = mysql_query("SELECT * FROM pilgrims where Fkun = '".$uname."'");
$r=mysql_num_rows($result);
echo '<h1>the count of pligrams</h1>'.$r;
while($row = mysql_fetch_array($result)){
	echo"<tr>";
    echo"<td>".$row['Fname']."</td>";
	echo"<td>".$row['Lname']."</td>";
	echo"<td>".$row['Passport_number']."</td>";
	echo"<td>".$row['contries']."</td>";
	
}
?>