<?php
    session_start();
?>

<html>
    <head>
    <title>My first PHP Website</title>
    </head>
    <body>
        <?php
            if (isset($_SESSION["viewid"])) {
                unset($_SESSION["viewid"]);
            }
            $servername = "localhost";
            $mysql_username = "id19458680_root";
            $mysql_password = "Ngothanhvan1234!";
            $dbname = "id19458680_web1user";

            $conn = mysqli_connect($servername, $mysql_username, $mysql_password, $dbname);

            if (!$conn) {
                echo "<p>Cannot connect to database</p>";
            }


            echo "-------- User: " . $_SESSION["username"] . " --------<br><br>";
        ?>

        <form action="index.php" method="post">
        <input type="submit"  value="Logout">
        </form><br><br>

        <form action="viewprofile.php" method="post">
        <input type="hidden" name="viewid" value="<?php echo $_SESSION["id"]; ?>">
                
        <input type="submit"  value="View Profile">
        </form><br><br>

        <?php
            echo "-------- View other user's profile --------<br><br>";
        ?>

        <form action="viewprofile.php" method="post">
        ID: <input type="number" name="viewid" required><br><br>
        <input type="submit" value="View">
        </form>


        <?php
            $sql = "SELECT id, username FROM user";

            $result = mysqli_query($conn, $sql);

            if ($result and mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "id: " . $row["id"] . " username: " . $row["username"] . "<br>";
                }
            } else {
                echo "No user";
            }
        ?>

        
        <?php
            echo "<br><br>-------- Homework --------<br><br>";

            $sql = "SELECT id, name FROM chall";

            $result = mysqli_query($conn, $sql);

            if ($result and mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $name = $row["name"];
                    $file_path = "/chall/$name.txt";
                    echo "id: " . $row["id"] . " file: ";
                    echo "<a href=$file_path download>$name</a>";
                    echo "<br>";
                }
            } else {
                echo "No homework";
            }

            echo "<br><br>-------- Quizz --------<br><br>";

            $sql = "SELECT id, hint FROM quizz";

            $result = mysqli_query($conn, $sql);

            if ($result and mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "id: " . $row["id"] . " hint: " . $row["hint"] . "<br><br>";
                }
            } else {
                echo "No quizz";
            }
        ?>

        <?php
            if ($_SESSION["teacher"] == 1) {
                echo "<br><br>-------- Upload Homework --------<br><br>";
                echo "<form action='uploadchall.php' method='post' enctype='multipart/form-data'>";
                echo "Select file to upload:<br><br>";
                echo "<input type='file' name='fileToUpload'>";
                echo "<br><br>";
                echo "<input type='submit' value='Upload Homework' name='submit'>";
                echo "</form>";

                echo "<br><br>-------- Submitted --------<br><br>";

                $sql = "SELECT chall_name, stu_name, path FROM submit";

                $result = mysqli_query($conn, $sql);

                if ($result and mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo " name: " . $row["chall_name"] . " || student name: " . $row["stu_name"] . " || download: ";
                        $file_path = $row["path"];
                        echo "<a href=$file_path download>link</a><br><br>";
                    }
                } else {
                    echo "No submit";
                } 


                echo "<br><br>-------- Add Quizz --------<br><br>";
                echo "<form action='uploadquizz.php' method='post' enctype='multipart/form-data'>";
                echo "<textarea name='hint' rows='1' cols='50' required>";
                echo "</textarea>";
                echo "<br><br>";
                echo "Select file to upload:<br><br>";
                echo "<input type='file' name='fileToUpload'>";
                echo "<br><br>";
                echo "<input type='submit' value='Upload Quizz' name='submit'>";
                echo "</form>";
            
            } else {
                echo "<br><br>-------- Submit Homework --------<br><br>";
                echo "<form action='submitfile.php' method='post' enctype='multipart/form-data'>";
                echo "Select file to submit:<br><br>";
                echo "<input type='file' name='fileToUpload'>";
                echo "<br><br>";
                echo "<input type='submit' value='Submit Homework' name='submit'>";
                echo "</form>";

                echo "<br><br>-------- Submit Quizz --------<br><br>";
                echo "<form action='submitquizz.php' method='post' enctype='multipart/form-data'>";
                echo "id: <input type='number' name='id' required>";
                echo "<br><br>";
                echo "answer: <input type='text' name='answer' required>";
                echo "<br><br>";
                echo "<input type='submit' value='Submit Quizz' name='submit'>";
                echo "</form>";

            
            
            }
        ?>

        <?php
            mysqli_close($conn);
        ?>
    </body>
</html>
