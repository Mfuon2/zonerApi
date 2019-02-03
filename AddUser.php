<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require("conn.php");
    $userType = 0;
    $name = mysqli_real_escape_string($conn, trim($_POST['Name']));
    $PhoneNumber = mysqli_real_escape_string($conn, trim($_POST['PhoneNumber']));
    $Email = mysqli_real_escape_string($conn, trim($_POST['Email']));
    $Website = mysqli_real_escape_string($conn, trim($_POST['Website']));
    $Location = mysqli_real_escape_string($conn, trim($_POST['Location']));
    $Latitude = mysqli_real_escape_string($conn, trim($_POST['Latitude']));
    $Longitude = mysqli_real_escape_string($conn, trim($_POST['Longitude']));
    $Username = mysqli_real_escape_string($conn, trim($_POST['Username']));
    $Password = mysqli_real_escape_string($conn, trim($_POST['Password']));
    $cPassword = mysqli_real_escape_string($conn, trim($_POST['cPassword']));
    $Usertype = mysqli_real_escape_string($conn, trim($_POST['Usertype']));
    $BusinessStatus = $Usertype == 0 ? "open" : "";
    $status = $Usertype == 0 ? 0 : 1;
    //validate
    if (strlen($Username) < 4) {
        echo "Username must be greater than four characters";
    } else {
        //check that no user has the given username
        $check = "select * `users` where Username = `$Username`";
        $res = mysqli_query($conn, $check);
        if (mysqli_num_rows($res) > 0) {
            echo "There is another account with the given username. Please select another username";
        } else {

            if (false) {//strlen($name)<4){
                echo "Name must be greater than four characters";
            } else if ($cPassword != $Password) {
                echo "Password and confirm password do not match $cPassword  pass $Password";
            } else {
                $check = "select * from users where Username  ='$Username' ";
                if (mysqli_num_rows(mysqli_query($conn, $check)) > 0) {
                    echo "There is another user with the selected username. Please select a different username.";
                } else {
                    $Password = hash("sha256", $Password);
                    $sql = "INSERT INTO `users`(`Name`, `PhoneNumber`, `Email`, `Website`, `Location`, `Latitude`, `Longitude`,  `Username`, `Password`, `Usertype`, `RegistrationDate`, `Status`,`BusinessStatus`) VALUES 
('$name','$PhoneNumber','$Email','$Website','$Location','$Latitude','$Longitude','$Username','$Password','$Usertype',NOW(), '$status','$BusinessStatus')";
                    if (mysqli_query($conn, $sql)) {
                        $id = $conn->insert_id;

                        if ($Usertype == "0") {
                            $Image = $_POST['Images'];
                            $p = "uploads/$id.png";
                            file_put_contents($p, base64_decode($Image));

                            //update Businesses
                            $sql2 = "update users set Logo = '" . $id . ".png' where Id=$id";
                            if (mysqli_query($conn, $sql2)) {
                                echo "Your business was successfully added. Please proceed to make a payment of 100 KES to Paybill No: 123456 to complete registration";
                            } else {
                                echo "Your business was successfully posted but the logo could not be captured. You can update your business logo from my businesses section.";
                            }

                        } else if ($Usertype == "1") {
                            echo "Your user account was successfully created. Please proceed to login and view some businesses in your locality";
                        }
                    } else {
                        echo "Your account could not be created. Please try again later.";
                    }
                }
            }
        }
    }
}

?>