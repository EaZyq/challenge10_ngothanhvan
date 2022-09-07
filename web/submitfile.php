<?php
    session_start();
    $target_dir = "submit/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_name = pathinfo($target_file,PATHINFO_FILENAME);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploadOk = 1;

    if ($_FILES["fileToUpload"]["size"] > 500000 or $_FILES["fileToUpload"]["size"] == 0) {
        $uploadOk = 0;
    }

    if($imageFileType != "txt" ) {
        $uploadOk = 0;
    }


    if ($uploadOk == 0) {
        header("Location: /mainpage.php");
        exit;
    }

    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    $servername = "localhost";
    $mysql_username = "id19458680_root";
    $mysql_password = "Ngothanhvan1234!";
    $dbname = "id19458680_web1user";

    $conn = mysqli_connect($servername, $mysql_username, $mysql_password, $dbname);

    $stu_name = $_SESSION["fullname"];
    $sql = "INSERT INTO submit (chall_name, stu_name, path) VALUES ('$target_name', '$stu_name', '$target_file')";

    mysqli_query($conn, $sql);
    mysqli_close($conn);

    header("Location: /mainpage.php");
    exit;

?>

