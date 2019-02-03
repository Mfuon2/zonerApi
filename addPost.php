<?php
 require("conn.php");
 $username= trim($_POST["username"]);
 $username= mysqli_real_escape_string($conn, $username);
 $password= trim($_POST["password"]);
 $password= mysqli_real_escape_string($conn, $password);
  $postText= trim($_POST["postText"]);
 $postText= mysqli_real_escape_string($conn, $postText);
 //$password= hash("sha256",$password);
 $image = $_POST['image'];

 //try logging in
 $login = "select * from users where Username= '$username' and Password ='$password' ";

 $res = mysqli_query($conn, $login);
 if(mysqli_num_rows($res)>0){
 $userId = 0;
 while($result = mysqli_fetch_assoc($res)){
     $userId = $result["id"];
 }
 
 $sql= "INSERT INTO `Posts`(`Id`, `User`, `PostText`, `AddedOn`, `Status`) VALUES ('',$userId, '$postText', NOW(), 1)";
 $res = mysqli_query($conn, $sql);
 if($res){
     $id = $conn->insert_id;
     $p = "posts/post$id.png";
  file_put_contents($p,base64_decode($image));
  //update Businesses
  $sql2 = "update Posts set Image = 'post".$id.".png' where Id=$id";
  if(mysqli_query($conn, $sql2)){
 echo "Your post was successfully added";
  }else{
        echo "Your post could not be added.";  
  }
 }else{
     echo "Your post could not be added";
 }
 
 }