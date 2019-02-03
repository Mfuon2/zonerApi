<?php
include("conn.php");
$sql = "select * from Businesses";
$id = trim($_GET["id"]);
if($id!=""){
  $sql .= " where Id = $id"  ;
}

$res = mysqli_query($conn, $sql);
$result =array();
$count= 0;
//INSERT INTO `Businesses`(`Id`, `BusinessName`, `BusinessSlogan`, `BusinessPhone`, `BusinessEmail`, `BusinessWebsite`, `BusinessLocation`, `BusinessStatus`, `AddedOn`, `ExpiresOn`, `BusinessLogo`, `Longitude`, `Latitude`, `Activated`) 
while($bRes = mysqli_fetch_assoc($res)){
   $result[$count]["Id"] =$bRes["Id"];
   $result[$count]["BusinessName"] =$bRes["BusinessName"];
   $result[$count]["BusinessSlogan"] =$bRes["BusinessSlogan"];
   $result[$count]["BusinessPhone"] =$bRes["BusinessPhone"];
   $result[$count]["BusinessEmail"] =$bRes["BusinessEmail"];
   $result[$count]["BusinessWebsite"] =$bRes["BusinessWebsite"];
   $result[$count]["BusinessLocation"] =$bRes["BusinessLocation"];
   $result[$count]["BusinessStatus"] =$bRes["BusinessStatus"];
   $result[$count]["AddedOn"] =$bRes["AddedOn"];
   $result[$count]["ExpiresOn"] =$bRes["ExpiresOn"];
   $result[$count]["BusinessLogo"] ="https://www.kuzasystems.com/zoner/uploads/".$bRes["BusinessLogo"];
   $result[$count]["Longitude"] =$bRes["Longitude"];
    $result[$count]["Latitude"] =$bRes["Latitude"];
     $result[$count]["Activated"] =$bRes["Activated"];
     $count++;
   
}

echo json_encode($result);