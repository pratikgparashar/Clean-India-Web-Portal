<?php

define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "imagetest");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
mysqli_select_db($con,DB_DATABASE);
 $id = $_POST['chkid'];
 
 $querychksts = "SELECT * FROM checkstatus WHERE id = '$id' ";
 $result = mysqli_query($con,$querychksts);
 $resultArray = mysqli_fetch_array($result,MYSQLI_ASSOC);
	if($resultArray)
	{
                // user stored successfully
            $response["success"] = 1;
			$response["image"] = $resultArray["image"];
			$response["statuscode"] = $resultArray["statuscode"];
            
                echo json_encode($response);
            } 
			else {
                // user failed to store
                $response["error"] = 1;
                $response["error_msg"] = "JSON Error occured in Requesting";
                echo json_encode($response);
            }
			
?>