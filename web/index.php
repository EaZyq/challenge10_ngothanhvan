<?php
    session_start();
?>

<html>
    <head>
    <title>My first PHP Website</title>
    </head>
    <body>
        
        <form action="logincheck.php" method="post">
        Username: <input type="text" name="name" required><br><br>
        Password: <input type="text" name="pass" required><br><br>
        <input type="submit" value="Login">
        </form>
    </body>
    <?php
        if (isset($_SESSION["err"])) {
            echo $_SESSION["err"];
            echo "<br><br>";
        }
        session_destroy();
    ?>
</html>
