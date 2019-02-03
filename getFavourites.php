<?php
 require("conn.php");
 $username= trim($_GET["username"]);
 $username= mysqli_real_escape_string($conn, $username);
 $password= trim($_GET["password"]);
 $password= mysqli_real_escape_string($conn, $password);
 //$password= hash("sha256",$password);
 $id = $_GET["id"];
 $id = mysqli_real_escape_string($conn, $id);
  $results = array();
 //try logging in
 $login = "select * from users where Username= '$username' and Password ='$password' ";

 $res = mysqli_query($conn, $login);
 if(mysqli_num_rows($res)>0){
 $userId = 0;
 while($result = mysqli_fetch_assoc($res)){
     $userId = $result["id"];
 }
 //
 $sql = "select * from users where Usertype = 0 and Status = 1 and Id in (select BusinessId from Favourites where UserId = $userId)";
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
                 $results[$count]["Logo"]="https://www.kuzasystems.com/zoner/uploads/".$users["Logo"];
                  $results[$count]["Username"]=$users["Username"];
                   $results[$count]["Password"]=$users["Password"];
                    $results[$count]["Usertype"]=$users["Usertype"];
                     $results[$count]["RegistrationDate"]=$users["RegistrationDate"];
                      $results[$count]["Status"]=$users["Status"];
                   $results[$count]["BusinessStatus"]=$users["BusinessStatus"];
                      
         $count++;
     }

echo json_encode($results);
 }