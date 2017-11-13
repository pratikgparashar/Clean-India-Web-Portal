<?php
session_start();

$connection = mysql_connect('localhost', 'root', ''); //The Blank string is the password
mysql_select_db('imagetest');
$zipcode = $_SESSION["zipcode"];
$query ="SELECT * 
     FROM imgupload  as img, checkstatus as ck
     WHERE img.id IN (SELECT ck.id
                  FROM checkstatus 
                  WHERE statuscode = 3) AND ck.statuscode = 3 AND img.zipcode = '$zipcode' ";
//$query = "SELECT * FROM imgupload WHERE zipcode = 421202  "; //You don't need a ; like you do in SQL
$result = mysql_query($query);

echo "<HTML>";
echo "<title> View Requests</title>";
echo "<Head>";
echo "<Style> 

.mycss
{
text-shadow:5px 1px 3px rgba(203,201,255,1);font-weight:normal;color:#000000;letter-spacing:2pt;word-spacing:4pt;font-size:47px;text-align:center;font-family:palatino linotype, palatino, serif;line-height:1;margin:0px;padding:0px;
}




.myButton {
	background-color:#44c767;
	-moz-border-radius:28px;
	-webkit-border-radius:28px;
	border-radius:28px;
	border:1px solid #18ab29;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:arial;
	font-size:17px;
	padding:16px 31px;
	text-decoration:none;
	text-shadow:0px 1px 0px #2f6627;
}
.myButton:hover {
	background-color:#5cbf2a;
}
.myButton:active {
	position:relative;
	top:1px;
}  #idname {visibility : hidden;}  .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Georgia, Times New Roman, Times, serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #209912), color-stop(1, #437F45) );background:-moz-linear-gradient( center top, #209912 5%, #437F45 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#209912', endColorstr='#437F45');background-color:#209912; color:#FFFFFF; font-size: 14px; font-weight: bold; border-left: 2px solid #1C5926; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #6B6B6B; border-left: 2px solid #30991C;font-size: 17px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }</Style>";
echo "</Head>";
echo "<Body>";

echo "<p class='mycss'>Completed Requests</p>";  echo "<br>

<hr> <br>";
echo "<div class='datagrid'><table>
<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Latitude</th><th>Longitude</th><th>Postal Code</th><th>Street</th><th>City</th><th>Complete Address</th><th>Vehicle Number</th><th>Image</th></tr></thead>";
//echo "<table border=2>";  start a table tag in the HTML
echo "<tbody>";
while($row = mysql_fetch_array($result)){
   //Creates a loop to loop through results
	$data = $row['image'];
//	"</td><td><img src= 'data:image/gif;base64,'" . $data . "/>"
   echo "<tr class='alt'><td>".$row['id']."</td><td>" . $row['name'] . "</td><td>" . $row['email'] . "</td><td>". $row['phone'] . "</td><td>". $row['lat'] . "</td><td>". $row['longitude'] . "</td><td>". $row['zipcode'] . "</td><td>". $row['city'] . "</td><td>". $row['street'] . "</td><td>". $row['fulladddress'] ."</td><td>".$row['vehicle']."</td>";
     //$row['index'] the index here is a field name
echo '<td><img height= "100" width="100" src="data:image/jpg;base64,'.$data.'"/></td></tr>';
   
   }
echo "</tbody>";
echo "</table>"; //Close the table in HTML
echo "</body>";

?>