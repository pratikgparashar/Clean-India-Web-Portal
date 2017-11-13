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
             
			
/* 
* Given longitude and latitude in North America, return the address using The Google Geocoding API V3
*
*/
	

$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$longitude&sensor=false";

// Make the HTTP request
$data = @file_get_contents($url);
// Parse the json response
$jsondata = json_decode($data,true);

// If the json data is invalid, return empty array
if (!check_status($jsondata))   return array();

$address = array(
    'country' => google_getCountry($jsondata),
    'province' => google_getProvince($jsondata),
    'city' => google_getCity($jsondata),
    'street' => google_getStreet($jsondata),
    'postal_code' => google_getPostalCode($jsondata),
    'country_code' => google_getCountryCode($jsondata),
    'formatted_address' => google_getAddress($jsondata),
);

$postal_code = google_getPostalCode($jsondata);
$city = google_getCity($jsondata);
$street = google_getStreet($jsondata);
$formatted_address = google_getAddress($jsondata);




/* 
* Check if the json data from Google Geo is valid 
*/

function check_status($jsondata) {
    if ($jsondata["status"] == "OK") return true;
    return false;
}

/*
* Given Google Geocode json, return the value in the specified element of the array
*/

function google_getCountry($jsondata) {
    return Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"]);
}
function google_getProvince($jsondata) {
    return Find_Long_Name_Given_Type("administrative_area_level_1", $jsondata["results"][0]["address_components"], true);
}
function google_getCity($jsondata) {
    return Find_Long_Name_Given_Type("locality", $jsondata["results"][0]["address_components"]);
}
function google_getStreet($jsondata) {
    return Find_Long_Name_Given_Type("street_number", $jsondata["results"][0]["address_components"]) . ' ' . Find_Long_Name_Given_Type("route", $jsondata["results"][0]["address_components"]);
}
function google_getPostalCode($jsondata) {
    return Find_Long_Name_Given_Type("postal_code", $jsondata["results"][0]["address_components"]);
}
function google_getCountryCode($jsondata) {
    return Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"], true);
}
function google_getAddress($jsondata) {
    return $jsondata["results"][0]["formatted_address"];
}

/*
* Searching in Google Geo json, return the long name given the type. 
* (If short_name is true, return short name)
*/

function Find_Long_Name_Given_Type($type, $array, $short_name = false) {
    foreach( $array as $value) {
        if (in_array($type, $value["types"])) {
            if ($short_name)    
                return $value["short_name"];
            return $value["long_name"];
        }
    }
}
			 
			 // store user
            $result = storeImage($con,$caption,$image,$name,$email,$phone,$lat,$longitude,$postal_code,$street,$city,$formatted_address);
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

		 function storeImage($con,$caption,$image,$name,$email,$phone,$lat,$longitude,$postal_code,$street,$city,$formatted_address) {
       
        $result = mysqli_query($con,"INSERT INTO imgupload(caption,image,name,email,phone,lat,longitude,zipcode,city,street,fulladddress) VALUES('$caption', '$image','$name','$email','$phone','$lat','$longitude','$postal_code','$street','$city','$formatted_address')");
        // check for successful store
        if ($result) {
            // get user details 
            $id = mysqli_insert_id($con); // last inserted id
		$queryChngSts = "INSERT INTO checkstatus(id,statuscode) VALUES ('$id','0')";
            mysqli_query($con,$queryChngSts);
			
		$result = mysqli_query($con,"SELECT * FROM imgupload WHERE id = $id");
            // return user details
            return mysqli_fetch_array($result,MYSQLI_ASSOC);
        } else {
            return false;
        }
    }
			
		 




?>