<?php
    session_start();
    $servername = "localhost";
    $mysql_username = "id19458680_root";
    $mysql_password = "Ngothanhvan1234!";
    $dbname = "id19458680_web1user";

    $conn = mysqli_connect($servername, $mysql_username, $mysql_password, $dbname);


    $username = $_POST["name"];
    $password = $_POST["pass"];



    $sql = "SELECT teacher, password, id, fullname FROM user WHERE username = '$username'";


    $result = mysqli_query($conn, $sql);


    if ($result and mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (!strcmp($row["password"], $password)) {
            $_SESSION["username"] = $username;
            $_SESSION["fullname"] = $row["fullname"];
            $_SESSION["teacher"] = $row["teacher"];
            $_SESSION["id"] = $row["id"];
            mysqli_close($conn);
            header("Location: /mainpage.php");
            exit;
        } else {
            $_SESSION["err"] = "Wrong password";
            mysqli_close($conn);
            header("Location: /index.php");
            exit;
        }
    } else {
        $_SESSION["err"] = "Invalid user";
        mysqli_close($conn);
        header("Location: /index.php");
        exit;
    }




?>
