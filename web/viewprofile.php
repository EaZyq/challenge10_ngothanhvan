<?php
    session_start();
?>

<html>
    <head>
    <title>My first PHP Website</title>
    </head>
    <body>
        <?php
            echo "-------- User: " . $_SESSION["username"] . " --------<br><br>";
        ?>

        <form action="mainpage.php" method="post">
        <input type="submit" value="Back to main page">
        </form>


        <?php
            $servername = "localhost";
            $mysql_username = "id19458680_root";
            $mysql_password = "Ngothanhvan1234!";
            $dbname = "id19458680_web1user";

            $conn = mysqli_connect($servername, $mysql_username, $mysql_password, $dbname);

            if (!$conn) {
                echo "<p>Cannot connect to database</p>";
            }
        ?> 

        <form action="saveprofile.php" method="post">
            <?php
                if (isset($_SESSION["viewid"])) {
                    $viewid = $_SESSION["viewid"];
                } else {
                    $viewid = $_POST["viewid"];
                    $_SESSION["viewid"] = $viewid;
                }
                $sql = "SELECT username, teacher, fullname, email, phonenumber, password FROM user WHERE id = $viewid";

                $result = mysqli_query($conn, $sql);

                if ($result and mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo "---------- USERNAME ---------";
                    echo "<br><br>";
                    if ($_SESSION["teacher"] == 1) {
                        echo "<textarea name='username' rows='1' cols='50'>";
                    
                    } else {
                        echo "<textarea name='username' rows='1' cols='50' readonly>";
                    }
                    echo $row["username"];
                    echo "</textarea>";
                    echo "<br><br>";



                    echo "---------- TEACHER ---------";
                    echo "<br><br>";
                    echo "<textarea rows='1' cols='50' readonly>";
                    echo $row["teacher"];
                    echo "</textarea>";
                    echo "<br><br>";



                    echo "---------- FULLNAME ---------";
                    echo "<br><br>";
                    if ($_SESSION["teacher"] == 1) {
                        echo "<textarea name='fullname' rows='1' cols='50'>";
                    
                    } else {
                        echo "<textarea name='fullname' rows='1' cols='50' readonly>";
                    }
                    echo $row["fullname"];
                    echo "</textarea>";
                    echo "<br><br>";



                    echo "---------- EMAIL ---------";
                    echo "<br><br>";
                    if ($_SESSION["id"] != $viewid and $_SESSION["teacher"] != 1) {
                        echo "<textarea name='email' rows='1' cols='50'readonly>";
                    
                    } else {
                        echo "<textarea name='email' rows='1' cols='50'>";
                    
                    }
                    echo $row["email"];
                    echo "</textarea>";
                    echo "<br><br>";



                    echo "---------- PHONE NUMBER ---------";
                    echo "<br><br>";
                    if ($_SESSION["id"] != $viewid and $_SESSION["teacher"] != 1) {
                        echo "<textarea name='phonenumber' rows='1' cols='50'readonly>";
                    
                    } else {
                        echo "<textarea name='phonenumber' rows='1' cols='50'>";
                    
                    }
                    echo $row["phonenumber"];
                    echo "</textarea>";
                    echo "<br><br>";



                    if ($_SESSION["id"] == $viewid or $_SESSION["teacher"] == 1) {
                        echo "---------- PASSWORD ---------";
                        echo "<br><br>";
                        echo "<textarea name='password' rows='1' cols='50'>";
                        echo $row["password"];
                    
                        echo "</textarea>";
                        echo "<br><br>";
                    }
                }
            ?>
        <?php
                if ($_SESSION["id"] == $viewid or $_SESSION["teacher"] == 1) {
                    echo "<input type='submit' value='Save'>";
                }
        ?>
        </form> 


        <?php
            if ($_SESSION["id"] != $viewid) {
                echo "<form action='sendmsg.php' method='post'>" ;
                echo "---------- SEND MESSAGE ---------";         
                echo "<br><br>";
                echo "<textarea name='content' rows='4' cols='50'>";
                echo "</textarea>";
                echo "<br><br>";
                echo "<input type='submit' value='Send'";
                echo "<form><br><br>";

            } else {
                echo "---------- YOUR MESSAGE ---------";
                echo "<br><br>";
                $sql = "SELECT * FROM msg WHERE recv_id=$viewid";
                $result = mysqli_query($conn, $sql);

                if ($result and mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "id: " . $row["msg_id"] . "<br>";
                        echo "from: " . $row["sender_name"] . "<br>";
                        echo "<textarea rows='4' cols='50' readonly>";
                        echo $row["content"];
                        echo "</textarea>";
                        echo "<br><br>";
                    }
                } else {
                    echo "No message";
                    echo "<br><br>";
                }

                echo "---------- SENT MESSAGE ---------";
                echo "<br><br>";
                $sql = "SELECT * FROM msg WHERE sender_id=$viewid";
                $result = mysqli_query($conn, $sql);

                if ($result and mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "id: " . $row["msg_id"] . "<br>";
                        echo "to: " . $row["recv_name"] . "<br>";
                        echo "<textarea rows='4' cols='50' readonly>";
                        echo $row["content"];
                        echo "</textarea>";
                        echo "<br><br>";
                    }
                } else {
                    echo "No message";
                    echo "<br><br>";
                }


                echo "---------- DELETE MESSAGE ---------";
                echo "<br><br>";
                echo "<form action='deletemsg.php' method='post'>";
                echo "ID: <input type='number' name='msg_id'><br><br>";
                echo "<input type='submit' value='Delete'>";
                echo "</form>";

                echo "---------- EDIT MESSAGE ---------";
                echo "<br><br>";
                echo "<form action='editmsg.php' method='post'>";
                echo "ID: <input type='number' name='msg_id'><br><br>";
                echo "<textarea name='content' rows='4' cols='50'>";
                echo "</textarea>";
                echo "<br><br>";
                echo "<input type='submit' value='Edit'>";
                echo "</form>";
                echo "<br><br>";
                

                
            
            
            }
            mysqli_close($conn);
        ?>
        

        
    </body>
</html>
