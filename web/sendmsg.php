<?php
    session_start();
    $servername = "localhost";
    $mysql_username = "id19458680_root";
    $mysql_password = "Ngothanhvan1234!";
    $dbname = "id19458680_web1user";

    $conn = mysqli_connect($servername, $mysql_username, $mysql_password, $dbname);

    $sender_id = $_SESSION["id"];
    $recv_id = $_SESSION["viewid"];
    $sender_name = $_SESSION["fullname"];
    $recv_name = "";
    $content = $_POST["content"];

    $sql_get_recv_name = "SELECT fullname FROM user WHERE id = $recv_id";
    
    $result = mysqli_query($conn, $sql_get_recv_name);

    if ($result and mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $recv_name = $row["fullname"] ;
    }

    $sql = "INSERT INTO msg (sender_id, recv_id, sender_name, recv_name, content) VALUES ($sender_id, $recv_id, '$sender_name', '$recv_name', '$content')";

    mysqli_query($conn, $sql);

    mysqli_close($conn);

    header("Location: /viewprofile.php");
    exit;




?>
