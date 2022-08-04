<?php
    session_start();
    if(!isset($_SESSION['email']) || !isset($_SESSION['admin'])) {
	    echo "<script>location.href = 'home.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search results</title>
    <link rel="stylesheet" href="stylesheets/search_process.css">
</head>
<body>
    <header>
            <?php
            include("nav_bar.php");
        ?>
    </header>
    <main>
        <?php
            include('Includere/connection.php');
            if (isset($_POST['email'])) {
                
                
                $stmt = $dbh->prepare("INSERT INTO banned_users (email) VALUES (:email);");
                $stmt->bindParam(':email', $email);
                $email = $_POST['email'];
                $stmt->execute();

                $stmt = $dbh->prepare("DELETE FROM users WHERE email = :email1");
                $stmt->bindParam(':email1', $email1);
                $email1 = $_POST['email'];
                $stmt->execute();
                
                echo "User banned";
            }
          $dbh = null;
        ?>

    </main>
</body>
</html>