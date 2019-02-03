<?php
 require("conn.php");
 $username= trim($_GET["username"]);
 $username= mysqli_real_escape_string($conn, $username);
 $password= trim($_GET["password"]);
 $password= mysqli_real_escape_string($conn, $password);
 //$password= hash("sha256",$password);
 $messageResponse = array();
 $sender = $_GET["sender"];
 $sender = mysqli_real_escape_string($conn, $sender);
  
 //try logging in
 $login = "select * from users where Username= '$username' and Password ='$password' ";

 $res = mysqli_query($conn, $login);
 if(mysqli_num_rows($res)>0){
 $userId = 0;
 while($user = mysqli_fetch_assoc($res)){
   $userId = $user["id"]  ;
 $sql ="update Messages set Status =1 where Sender =$sender and Recipient = $userId";
 echo $sql;
 mysqli_query($conn,$sql);
 }
 }
 echo json_encode($messageResponse);