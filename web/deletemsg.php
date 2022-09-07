<?php
    session_start();
    $servername = "localhost";
    $mysql_username = "id19458680_root";
    $mysql_password = "Ngothanhvan1234!";
    $dbname = "id19458680_web1user";

    $conn = mysqli_connect($servername, $mysql_username, $mysql_password, $dbname);

    $msg_id = $_POST["msg_id"];
 
    $sql = "DELETE FROM msg WHERE msg_id=$msg_id";

    mysqli_query($conn, $sql);

    mysqli_close($conn);

    header("Location: /viewprofile.php");
    exit;

?>

