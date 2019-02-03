<?php
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 require("conn.php");
    $Sender = mysqli_real_escape_string($conn, trim($_POST['Sender']));
    $Recipient = mysqli_real_escape_string($conn, trim($_POST['Recipient']));
    $Message = mysqli_real_escape_string($conn, trim($_POST['Message']));
    $sql = "INSERT INTO `Messages`(`Sender`, `Recipient`, `Message`, `Sent On`, `Status`) VALUES ('$Sender','$Recipient','$Message',NOW(),0)";
    if(mysqli_query($conn, $sql)){
      echo "Your message was successfully sent";  
    }else{
        echo "Your message could not be sent";
    }
 }