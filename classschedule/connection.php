<?php
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Database Connection

if (!empty($username) || !empty($password) || !empty($email)) {
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "loaclassschedule";

    //connection
    $conn = new mysqli($email, $username, $password);

    if (mysqli_connect_error()) {
        die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
        $SELECT = "SELECT email From users Where email = ? Limit 1";
        $INSERT = "INSERT into users (email, username, password) values (?, ?, ?)";
        
        //statements
        $stmt = $conn->prepare($SELECT);
        $stml->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum==0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);

            $stmt->bind_param("sss", $email, $username, $password);
            $stmt->execute();
            echo "New User Registered Successfully";
        } else {
            "someone already registered using this email";
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "asll field are required";
    die();
}