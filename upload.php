<?php
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 require("conn.php");
 $image = $_POST['image'];

   $BusinessName = mysqli_real_escape_string($conn, trim($_POST['BusinessName']));
   $BusinessSlogan = mysqli_real_escape_string($conn, trim($_POST['BusinessSlogan']));
    $BusinessPhone = mysqli_real_escape_string($conn, trim($_POST['BusinessPhone']));
     $BusinessEmail = mysqli_real_escape_string($conn, trim($_POST['BusinessEmail']));
      $BusinessWebsite = mysqli_real_escape_string($conn, trim($_POST['BusinessWebsite']));
       $BusinessLocation = mysqli_real_escape_string($conn, trim($_POST['BusinessLocation']));
       $BusinessStatus= mysqli_real_escape_string($conn, trim($_POST['BusinessStatus']));// 
        $latitude= mysqli_real_escape_string($conn, trim($_POST['latitude']));
         $longitude= mysqli_real_escape_string($conn, trim($_POST['longitude']));
$sql ="INSERT INTO `Businesses`( `BusinessName`, `BusinessSlogan`, `BusinessPhone`, `BusinessEmail`, `BusinessWebsite`, `BusinessLocation`, `BusinessStatus`, `ExpiresOn`,`Latitude`,`Longitude`) 
VALUES ('$BusinessName','$BusinessSlogan','$BusinessPhone','$BusinessEmail','$BusinessWebsite','$BusinessLocation','$BusinessStatus',(SELECT ADDTIME(NOW(), '30 0:00:0.000000')),$latitude,$longitude)";
if(mysqli_query($conn, $sql)){
$id = $conn->insert_id;

 $p = "uploads/$id.png";
 $mainpath = "uploads/$p";
  file_put_contents($p,base64_decode($image));
  //update Businesses
  $sql2 = "update Businesses set BusinessLogo = '".$id.".png' where Id=$id";
  if(mysqli_query($conn, $sql2)){
 echo "Your business was successfully posted";
  }else{
        echo "Your business was successfully posted but the logo could not be captured. You can update your business logo from my businesses section.";  
  }
}else{
   echo "Your business could not be posted. Please try again later.".$sql;  
}
 }

?>