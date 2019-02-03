 <?php
  if($_SERVER['REQUEST_METHOD']=='GET'){
 require("conn.php");
  $username = mysqli_real_escape_string($conn, trim($_GET['username']));
     $password= mysqli_real_escape_string($conn, trim($_GET['password']));
     $password = hash("sha256",$password);
     $sql = "select * from users where (username ='$username' or Email= '$username' ) and Password = '$password'";
     $res = mysqli_query($conn, $sql);
     $results = array();
     $count = 0;
     while($users = mysqli_fetch_assoc($res)){
   
         $results[$count]["id"]=$users["id"];
          $results[$count]["Name"]=$users["Name"];
           $results[$count]["PhoneNumber"]=$users["PhoneNumber"];
            $results[$count]["Email"]=$users["Email"];
             $results[$count]["Website"]=$users["Website"];
              $results[$count]["Location"]=$users["Location"];
               $results[$count]["Latitude"]=$users["Latitude"];
                $results[$count]["Longitude"]=$users["Longitude"];
                 $results[$count]["Logo"]=$users["Logo"];
                  $results[$count]["Username"]=$users["Username"];
                   $results[$count]["Password"]=$users["Password"];
                    $results[$count]["Usertype"]=$users["Usertype"];
                     $results[$count]["RegistrationDate"]=$users["RegistrationDate"];
                      $results[$count]["Status"]=$users["Status"];
                      
         $count++;
     }
     echo json_encode($results);
  }