<?php

$id  = $_POST['idname'];
$connection = mysql_connect('localhost', 'root', ''); //The Blank string is the password
mysql_select_db('imagetest');

$query = "SELECT * FROM imgupload WHERE id ='$id'"; //You don't need a ; like you do in SQL
$result = mysql_query($query);

$row = mysql_fetch_array($result);
echo $row['id'];
$img_str = $row['image'];

echo "<HTML>";
echo "<title> View Requests</title>";
echo "<Head>";
echo "<Style> .myButton {
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


echo '<img src="data:image/jpg;base64,'.$img_str.'"/>';
echo "<br>";
echo "<br>";
echo "<br>";
echo "<form method = 'POST' action='viewrequest.php'><input type='submit' value='Back' class ='myButton' >" ;
echo "</Body>";
 mysql_close();
 ?>