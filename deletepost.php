 <?php
 require("conn.php");
 $username= trim($_POST["username"]);
 $username= mysqli_real_escape_string($conn, $username);
 $password= trim($_POST["password"]);
 $password= mysqli_real_escape_string($conn, $password);
 //$password= hash("sha256",$password);
  $postId= trim($_POST["postId"]);
 $postId= mysqli_real_escape_string($conn, $postId);
 $messageResponse = array(); 


  
 //try logging in
 $login = "select * from users where Username= '$username' and Password ='$password' ";

 $res = mysqli_query($conn, $login);
 if(mysqli_num_rows($res)>0){
 $userId = 0;
 while($user = mysqli_fetch_assoc($res)){
   $userId = $user["id"]  ;
 $sql ="delete from Posts where User = $userId and Id = $postId";
 //echo $sql;
 $res = mysqli_query($conn,$sql);
 /*while($result = mysqli_fetch_assoc($res)){
     echo $result["BusinessStatus"];
 }*/
 }
 }else{
     echo "wrong credentiasl";
 }
 //echo json_encode($messageResponse);