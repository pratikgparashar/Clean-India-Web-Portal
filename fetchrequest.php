<?php 
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "imagetest");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
mysqli_select_db($con,DB_DATABASE);
$minreqId;
$tag = $_POST['tag'];
if($tag == 'viewRequest')

{
$gotlat = $_POST['latitude'];
$gotlong = $_POST['longitude'];
//$gotlat =19.2262084;

//$gotlong = 73.0850404;
$query ="SELECT * 
     FROM confirmedrequest
     WHERE id IN (SELECT id 
                  FROM checkstatus 
                  WHERE statuscode = 1)";
$i = 0;
 $result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$reqId = $row['id'];
		$reqLat = $row['latitude'];
		$reqLong = $row['longitude'];
		
		//echo $row['id'];
		
	$latitudeFrom = $gotlat;
	$longitudeFrom = $gotlong;
	$latitudeTo = $reqLat;
	$longitudeTo =$reqLong;
	
		// convert from degrees to radians
   $earthRadius = 6371000;
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  $calDistance = $angle * $earthRadius;
		
		
		
		
		
		if($i == 0)
		{
			$minDistance = $calDistance;
			$minLat = $reqLat;
			$minLong = $reqLong;
			$minreqId = $reqId;
		}
		else{
			if($calDistance<$minDistance)
			{
					$minDistance = $calDistance;
					$minLat = $reqLat;
					$minLong = $reqLong;
					$minreqId = $reqId;
			}
		}

$i = $i + 1;		
}

$result = mysqli_query($con,"SELECT * FROM confirmedrequest WHERE id = '$minreqId' ");

$resultArray = mysqli_fetch_array($result,MYSQLI_ASSOC);
	if($resultArray)
	{
                // user stored successfully
            $response["success"] = 1;
			$response["requestId"] = $resultArray['id'];
			$response["latitude"] = $resultArray['latitude'];
			$response["longitude"] = $resultArray['longitude'];
            
                echo json_encode($response);
    } 
			else {
                // user failed to store
                $response["error"] = 1;
                $response["error_msg"] = "JSON Error occured in Requesting";
                echo json_encode($response);
            }
	  
/*  function vincentyGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
{
  // convert from degrees to radians
   $earthRadius = 6371000;
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return $angle * $earthRadius;
}*/		  

}

else if($tag == 'acceptRequest')
{
		
		
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
mysqli_select_db($con,DB_DATABASE);
		$id = $_POST['id'];
		$vehicle = $_POST['vehicle'];
	
		$query1 ="UPDATE checkstatus SET statuscode = '2' , vehicle = '$vehicle' WHERE id = '$id' "; 
try{	
	$result1= mysqli_query($con,$query1) or die ('Error updating database: '.mysql_error());;
	
	}
	catch(exception $e) {
  echo "ex: ".$e; 
}
		
	if($result1)
	{
                // user stored successfully
            $response["success1"] = 1;
			
                echo json_encode($response);
            } 
			else {
                // user failed to store
                $response["error"] = 1;
                $response["error_msg"] = "JSON Error occured in Requesting";
                echo json_encode($response);
            }
		
}

else if($tag == 'completeRequest')
{
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
mysqli_select_db($con,DB_DATABASE);
		$vehicle = $_POST['vehicle'];
		
		//$id = $_POST['id'];
		$image = $_POST['image'];
		$query3 = "SELECT * FROM checkstatus WHERE vehicle = '$vehicle' AND statuscode = 2 ";
		$result3 =  mysqli_query($con,$query3) or die ('Error updating database: '.mysql_error());
		
		while($row = mysqli_fetch_array($result3,MYSQLI_ASSOC)){
					$id11 = $row['id'];
		}
		
		$query2 = "UPDATE checkstatus SET statuscode = '3' , image = '$image' WHERE id = '$id11' " ;
	$result2= mysqli_query($con,$query2) or die ('Error updating database: '.mysql_error());;
	
	if($result2)
	{
                // user stored successfully
            $response["success2"] = 1;
			
                echo json_encode($response);
            } 
			else {
                // user failed to store
                $response["error"] = 1;
                $response["error_msg"] = "JSON Error occured in Requesting";
                echo json_encode($response);
            }


}

?>