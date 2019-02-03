<?php
include("conn.php");
$id = mysqli_real_escape_string($conn, trim($_GET["id"]));
$businessPosts = array();
if($id!=""){
    $sql= "SELECT * FROM `Posts` where User = $id order by Id desc";
    $res = mysqli_query($conn, $sql);
    $count= 0;
    while($result=mysqli_fetch_assoc($res)){
      $businessPosts[$count]["Id"]=$result["Id"];
      $businessPosts[$count]["User"]=$result["User"];
      $businessPosts[$count]["Image"]=$result["Image"];
      $businessPosts[$count]["PostText"]=$result["PostText"];
      $added = trim($result["AddedOn"]);
      $add = explode(" ", $added );
      $businessPosts[$count]["AddedOn"]= $add[0];
      $businessPosts[$count]["Status"]=$result["Status"];
      $count++;  
    }
}
echo json_encode($businessPosts);