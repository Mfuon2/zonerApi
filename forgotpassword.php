<?php

 if($_SERVER['REQUEST_METHOD']=='POST'){
include("conn.php");
$Username = mysqli_real_escape_string($conn, trim($_POST["Username"]));
$sql = "select * from users where Username = '$Username'";
$res = mysqli_query($conn, $sql);
$exists = false;
while($result = mysqli_fetch_assoc($res)){
    $exists = true;
    $password = rand(1000,9999);
    $token = $password;
    $password = hash("sha256", $password);
    $sql = "update users set Password = '$password' where Username = '$Username'";
    if(mysqli_query($conn, $sql)){
       $to_admin =$result["Email"];  
$message = '
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  
background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">
We have received a request to change your password. Please use the password below to log in. <br/>
Your password is <br/><strong>
'
.$token.
'
</strong>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
Zoner, <br>
<strong><i></i></strong><br>
</span>
</div>

</body>
</html>
';
//to admin 
    $from ="info@kuzasystems.com";
   
   
    $subject = "Password Reset"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
   $sent = @mail($to_admin, $subject, $message, $headers.
    "X-Mailer: PHP/" . phpversion());
        if($sent){
        echo "Your password was successfully updated. Please use the password sent to your email address to log in.";
        }else{
            echo "Your password was updated but we could not send you an email. Please try again later $to_admin $subject $message";
        }
    }else{
        echo "Your password could not be updated. Please try again later";
    }
    
}
if(!$exists){
   echo "An account with the entered username does not exist"; 
}
}