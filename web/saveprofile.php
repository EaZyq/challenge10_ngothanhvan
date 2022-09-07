<?php
    session_start();
    $servername = "localhost";
    $mysql_username = "id19458680_root";
    $mysql_password = "Ngothanhvan1234!";
    $dbname = "id19458680_web1user";

    $conn = mysqli_connect($servername, $mysql_username, $mysql_password, $dbname);

    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenumber"];
    $password = $_POST["password"];
    $viewid = $_SESSION["viewid"];
    $sql = "UPDATE user SET username='$username', fullname='$fullname', email='$email', phonenumber='$phonenumber', password='$password' WHERE id=$viewid";

    mysqli_query($conn, $sql);

    mysqli_close($conn);
    header("Location: /viewprofile.php");
    exit;


?>
