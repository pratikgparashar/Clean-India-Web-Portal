<?php

define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "imagetest");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
mysqli_select_db($con,DB_DATABASE);


$caption = $_POST['caption'];
		$image = $_POST['image'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone= $_POST['phone'];
		$lat = $_POST['latitude'];
		$longitude = $_POST['longitude'];
             // store user
            $result = storeImage($con,$caption,$image,$name,$email,$phone,$lat,$longitude);
            if ($result) {
                // user stored successfully
            $response["success"] = 1;
			$response["image"] = $result["image"];
			$response["id"] = $result["id"];
            
                echo json_encode($response);
            } 
			else {
                // user failed to store
                $response["error"] = 1;
                $response["error_msg"] = "JSON Error occured in Requesting";
                echo json_encode($response);
            }

		 function storeImage($con,$caption,$image,$name,$email,$phone,$lat,$longitude) {
       
        $result = mysqli_query($con,"INSERT INTO imgupload(caption,image,name,email,phone,lat,longitude) VALUES('$caption', '$image','$name','$email','$phone','$lat','$longitude')");
        // check for successful store
        if ($result) {
            // get user details 
            $id = mysqli_insert_id($con); // last inserted id
            $result = mysqli_query($con,"SELECT * FROM imgupload WHERE id = $id");
            // return user details
            return mysqli_fetch_array($result,MYSQLI_ASSOC);
        } else {
            return false;
        }
    }
			
		 




?>