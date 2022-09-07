<?php
    session_start();
    $target_dir = "quizz/";
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

    $hint = $_POST["hint"];

    $sql = "INSERT INTO quizz (name, path, hint) VALUES ('$target_name', '$target_file', '$hint')";

    mysqli_query($conn, $sql);
    mysqli_close($conn);

    header("Location: /mainpage.php");
    exit;

?>


