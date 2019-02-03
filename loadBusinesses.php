<?php
include("conn.php");
$earthRadius = 6371;
$radius = 10;//10kms radius
$latitude = trim($_GET["latitude"]);//37.4219983;
$longitude = trim($_GET["longitude"]);//-122.084;
$latitudeDiffrence = $radius/110.574;
$longitudeDifference =$radius/( 111*320*cos($latitude));
//echo $longitudeDifference."<br/>";
$longitudeDifference= rad2deg(asin($radius/$earthRadius) / cos(deg2rad($latitude)));
$maxLatitude = $latitude+$latitudeDiffrence;
$minLatitude = $latitude-$latitudeDiffrence;
$myLat= mysqli_real_escape_string($conn, $latitude);
$myLong = mysqli_real_escape_string($conn, $longitude);
$requests = "INSERT INTO `reuests`(`Longitude`, `Latitude`) VALUES ('$myLong','$myLat')";
mysqli_query($conn, $requests);
$longitudePart = "";
$latitudePart = "";
if($longitude<0){
$maxLongitude = $longitude-$longitudeDifference;
$minLongitude = $longitude+$longitudeDifference;

$longitudePart = "Longitude<=$minLongitude and Longitude>=$maxLongitude";
$sql = "select * from users where Usertype = 0 and Status = 1 and (  ) and ( )";

}else{
 $maxLongitude = $longitude+$longitudeDifference;
$minLongitude = $longitude-$longitudeDifference;

$longitudePart = "Longitude>=$minLongitude and Longitude<=$maxLongitude";
   
}
if($latitude<0){
    $maxLatitude = $latitude-$latitudeDiffrence;
$minLatitude = $latitude+$latitudeDiffrence;
    $latitudePart = "Latitude<=$minLatitude and Latitude>=$maxLatitude";  
}else{
  $latitudePart = "Latitude>=$minLatitude and Latitude<=$maxLatitude";  
}
$sql = "select * from users where Usertype = 0 and Status = 1 and ($latitudePart ) and ($longitudePart ) order by Name asc";

  // echo $sql;
     $res = mysqli_query($conn, $sql);
     $results = array();
     $count = 0;
     while($users = mysqli_fetch_assoc($res)){
         $results[$count]["id"]=$users["id"];
          $results[$count]["Name"]=$users["Name"];
           $results[$count]["PhoneNumber"]=$users["PhoneNumber"];
            $results[$count]["Email"]=$users["Email"];
             $results[$count]["Website"]=$users["Website"];
              $results[$count]["Location"]=$users["Location"];
               $results[$count]["Latitude"]=$users["Latitude"];
                $results[$count]["Longitude"]=$users["Longitude"];
                 $results[$count]["Logo"]="https://www.kuzasystems.com/zoner/uploads/".$users["Logo"];
                  $results[$count]["Username"]=$users["Username"];
                   $results[$count]["Password"]="";//$users["Password"];
                    $results[$count]["Usertype"]=$users["Usertype"];
                     $results[$count]["RegistrationDate"]=$users["RegistrationDate"]; 
                      $results[$count]["Status"]=$users["Status"];
                   $results[$count]["BusinessStatus"]=$users["BusinessStatus"];
                      
         $count++;
     }

echo json_encode($results);
