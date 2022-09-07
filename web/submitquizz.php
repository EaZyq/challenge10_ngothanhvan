<?php
    session_start();
?>

<html>
    <head>
    <title>My first PHP Website</title>
    </head>
    <body>
        <form action="mainpage.php" method="post">
        <input type="submit" value="Go Back">
        </form>
    </body>
    <?php
        $servername = "localhost";
        $mysql_username = "id19458680_root";
        $mysql_password = "Ngothanhvan1234!";
        $dbname = "id19458680_web1user";

        $conn = mysqli_connect($servername, $mysql_username, $mysql_password, $dbname);

        $answer = $_POST["answer"];
        $id = $_POST["id"];

        $sql = "SELECT name FROM quizz WHERE id = $id";

        $result = mysqli_query($conn, $sql);

        if ($result and mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (strcmp($answer, $row["name"])) {
                echo "<br><br>WRONG ANSWER!!!<br><br>";
            } else {
                $file_path = "quizz/" . $row["name"] . ".txt";
                $myfile = fopen($file_path, "r") or die("Unable to open file!");

                echo "<br><br>";
                echo fread($myfile,filesize($file_path));
                echo "<br><br>";
                fclose($myfile);
            }
        }
    ?>
</html>
