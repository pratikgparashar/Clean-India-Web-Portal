<?php


$id  = $_POST['idname'];
$connection = mysql_connect('localhost', 'root', ''); //The Blank string is the password
mysql_select_db('imagetest');

$query = "SELECT * FROM imgupload WHERE id ='$id'"; //You don't need a ; like you do in SQL
$result = mysql_query($query);

$row = mysql_fetch_array($result);
//$img_str = $row['image'];
// echo '<img src="data:image/jpg;base64,'.$img_str.'"/>';
//$queryInsert = "INSERT INTO confirmedrequest(id,latitude,longitude,image)VALUES(".$row['id'].",".$row['lat'].",".$row['longitude'].",".$row['image'].")";
$queryInsert = "INSERT INTO confirmedrequest(id,latitude,longitude,image)VALUES('$row[0]','$row[6]','$row[7]','$row[2]')";
$queryChngSts = "UPDATE checkstatus SET statuscode = '1' WHERE id = '$row[0]' "; 
$result = mysql_query($queryInsert);
if($result != null)
{
	$resultSts = mysql_query($queryChngSts);
	if($resultSts != null)
	{
	echo 'Your Request has been Accepted';
	}
 }
mysql_close();

?>