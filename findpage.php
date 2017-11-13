<?php
$tag = $_POST["choose"];
if($tag == 'viewRequest')
{
header("location:viewrequest.php");
}
else if($tag == 'acceptedRequest')
{
header("location:acceptedRequest.php");
}
else if($tag == 'completedRequest')
{
header("location:completedRequest.php");
}





?>