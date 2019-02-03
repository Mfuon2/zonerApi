<?php
 require("conn.php");
 $username= trim($_POST["username"]);
 $username= mysqli_real_escape_string($conn, $username);
 $password= trim($_POST["password"]);
 $password= mysqli_real_escape_string($conn, $password);
 //$password= hash("sha256",$password);
 $id = $_POST["id"];
 $id = mysqli_real_escape_string($conn, $id);
  $allMessages = array();
 //try logging in
 $login = "select * from users where Username= '$username' and Password ='$password' ";

 $res = mysqli_query($conn, $login);
 if(mysqli_num_rows($res)>0){
 $userId = 0;
 while($result = mysqli_fetch_assoc($res)){
     $userId = $result["id"];
 }
 //
 $sql= "INSERT INTO `Favourites`(`Id`, `UserId`, `BusinessId`) VALUES ('',$userId,$id )";
 if(@mysqli_query($conn, $sql)){
     echo "Favourite was successfully added.";
 }else{
     echo "Favourite could not be added";
 }
 }