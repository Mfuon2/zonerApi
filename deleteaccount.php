 <?php
 require("conn.php");
 $username= trim($_POST["username"]);
 $username= mysqli_real_escape_string($conn, $username);
 $password= trim($_POST["password"]);
 $password= mysqli_real_escape_string($conn, $password);
 //$password= hash("sha256",$password);
 $messageResponse = array();


 //try logging in
 $login = "select * from users where Username= '$username' and Password ='$password' ";

 $res = mysqli_query($conn, $login);
 if(mysqli_num_rows($res)>0){
 $userId = 0;
 while($user = mysqli_fetch_assoc($res)){
   $userId = $user["id"]  ;
 
        $sql ="delete from users  where id = $userId";
 //echo $sql;
 if (mysqli_query($conn,$sql)){
     echo "deleted";
 }else{
     echo "Your account could not be deleted";
 }
   
 
 
 
 
 }
 }else{
     echo "wrong credentiasls";
 }
 //echo json_encode($messageResponse);