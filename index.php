<?php

    // Include Database handler
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
    // response Array
    $response = array("success" => 0, "error" => 0);
  

        // Request type is Register new user
        $caption = $_POST['caption'];
		$image = $_POST['image'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone= $_POST['phone'];
		$lat = $_POST['latitude'];
		$longitude = $_POST['longitude'];
		
      
            // store user
            $result = $db->storeImage($caption,$image,$name,$email,$phone,$lat,$longitude);
            if ($result) {
                // user stored successfully
            $response["success"] = 1;
			$response["image"] = $result["image"];
            
                echo json_encode($response);
            } 
			else {
                // user failed to store
                $response["error"] = 1;
                $response["error_msg"] = "JSON Error occured in Registartion";
                echo json_encode($response);
            }
        
     
        
    

?>
