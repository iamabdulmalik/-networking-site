<?php
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phoneCode = $_POST['phoneCode'];
$phone = $_POST['phone'];


if (!empty($username) || !empty($password) || !empty($gender) || !empty($email) || 
!empty($phoneCode) || !empty($phone)); {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword= "" ;
    $dbname = "youtube";

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error('.mysqli_connect_error().')'. mysqli_connect_error());
     } else {
        $SELECT = "SELECT email From register Where email = ? Limit 1";
        $INSERT = "INSERT Into register ( username, password, gender, email,
           phoneCode, phone) values(?,?,?,?,?, ?)";

           //prepare statement
           $stmt = $conn->prepare($SELECT);
           $stmt->bind_param("s", $email);
           $stmt->execute();
           $stmt->bind=($email);
           $stmt->store=(@mysqli_connect_error());
           $rnum = $stmt->num_rows;

           if ($rnum==0) {
               $stmt->close();

               $stmt = $conn->prepare($INSERT);
               $stmt->bind_param("ssssii", $username, $password, $gender, $email,$phoneCode, $phone);
               $stmt->execute();
               header("location: index.html");
           } else {
               header("location: form.php");
           }
           $stmt->close();
           $conn->close();
        
    
    }

}
?>