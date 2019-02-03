 <?php
 require("conn.php");
 $username= trim($_POST["username"]);
 $username= mysqli_real_escape_string($conn, $username);
 $password= hash("sha256", trim($_POST["currentPassword"]));
 $password= mysqli_real_escape_string($conn, $password);
 //$password= hash("sha256",$password);
 $messageResponse = array();

 $newPassword= trim($_POST["newPassword"]);
 $newPassword= mysqli_real_escape_string($conn, $newPassword);
   $confirmPassword= trim($_POST["confirmPassword"]);
 $confirmPassword= mysqli_real_escape_string($conn, $confirmPassword);
 //try logging in
 $login = "select * from users where Username= '$username' and Password ='$password' ";

 $res = mysqli_query($conn, $login);
 if(mysqli_num_rows($res)>0){
 $userId = 0;
 while($user = mysqli_fetch_assoc($res)){
   $userId = $user["id"]  ;
   if( $newPassword==$confirmPassword){
       $newPassword = hash("sha256",$newPassword);
        $sql ="update users set Password ='$newPassword' where id = $userId";
 //echo $sql;
 if (mysqli_query($conn,$sql)){
     echo "Your password was successfully updated";
 }else{
     echo "status could not be updated";
 }
   }else{
       echo "Password does not match confirm password";
   }

 
 
 
 
 }
 }else{
     echo "wrong credentiasls";
 }
 //echo json_encode($messageResponse);