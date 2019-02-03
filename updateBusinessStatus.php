 <?php
 require("conn.php");
 $username= trim($_POST["username"]);
 $username= mysqli_real_escape_string($conn, $username);
 $password= trim($_POST["password"]);
 $password= mysqli_real_escape_string($conn, $password);
 //$password= hash("sha256",$password);
 $messageResponse = array();
  $status= trim($_POST["status"]);
 $status= mysqli_real_escape_string($conn, $status);

  
 //try logging in
 $login = "select * from users where Username= '$username' and Password ='$password' ";

 $res = mysqli_query($conn, $login);
 if(mysqli_num_rows($res)>0){
 $userId = 0;
 while($user = mysqli_fetch_assoc($res)){
   $userId = $user["id"]  ;
 $sql ="update users set BusinessStatus ='$status' where id = $userId";
 //echo $sql;
 if (mysqli_query($conn,$sql)){
     echo $status;
 }else{
     echo "status could not be updated";
 }
 }
 }else{
     echo "wrong credentiasl";
 }
 //echo json_encode($messageResponse);