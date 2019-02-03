<?php
 require("conn.php");
 $username= trim($_GET["username"]);
 $username= mysqli_real_escape_string($conn, $username);
 $password= trim($_GET["password"]);
 $password= mysqli_real_escape_string($conn, $password);
 //$password= hash("sha256",$password);
 $id = $_GET["id"];
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
 $getMessages = "SELECT A.*,B.Name as name, C.Name as name2 FROM `Messages` as A left join users as B on A.Recipient =B.id left join users as C on A.Sender =C.id where (A.Sender = $userId or A.Recipient= $userId) and A.Id>$id";
 $messageRes = mysqli_query($conn, $getMessages);
 $count= 0;
 while($messages = mysqli_fetch_assoc($messageRes)){
    $allMessages[$count]["Id"]= $messages["Id"];
     $allMessages[$count]["Sender"]= $messages["Sender"];
      $allMessages[$count]["Recipient"]= $messages["Recipient"];
       $allMessages[$count]["Message"]= mysqli_real_escape_string($conn,$messages["Message"]);
        $allMessages[$count]["Sent On"]= $messages["Sent On"];
         $allMessages[$count]["Status"]= $messages["Status"];
         if($messages["Sender"]==$userId){
             $allMessages[$count]["Name"]= mysqli_real_escape_string($conn, $messages["name"]); 
         }else{
              $allMessages[$count]["Name"]= mysqli_real_escape_string($conn,$messages["name2"]);
         }
         
    $count++; 
 }
 
}
echo json_encode($allMessages);