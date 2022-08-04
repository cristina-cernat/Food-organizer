<?php
    session_start();
    if(!isset($_SESSION['email']))
        {
            echo "<script>location.href = 'login.php'</script>";
            
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link rel="stylesheet" href="stylesheets/product.css">
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
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':id', $id);
        $id = $_GET['id'];
        $stmt->execute();
        
        while ($data = $stmt->fetch()) {
            echo
                "<img src=\"img/".$data['name'].".jpg\" class=\"product_img\" alt=\" \">";
            echo
                "<div class=\"info\">
                    <h1>".strtr(ucfirst($data['name']), "_", " ")."</h1>
                    <div class=\"quantity\">
                    <form method=\"POST\">
                        <label for=\"quantity\">Quantity:</label>
                        <input type=\"number\" name=\"quantity\" value=\"1\" min=\"1\"</input></div>
                        <input type=\"submit\" class=\"submit\" value=\"Add\"></input>
                    </form>
                ";
        }
        // <?php echo htmlspecialchars(\$_SERVER[\"PHP_SELF\"]);
    ?>

    <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('Includere/connection.php');
    $stmt = $dbh->prepare("SELECT id FROM `users` where email = :email;");

    $stmt->bindParam(':email', $email);
    $email = $_SESSION['email'];

    $stmt->execute();

    $usr_id =  $stmt->fetch()['id'];

    if(isset($_POST['quantity'])){


        $stmt = $dbh->prepare("SELECT quantity FROM shoping_lists WHERE product_id = :id AND user_id = :u_id;");
        $stmt->bindParam(':id', $prod_id);
        $stmt->bindParam(':u_id', $usr_id);
        $prod_id = $id;
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count) {
            $row = $stmt->fetch();
            $quantity_initial = $row['quantity'];
            
            $stmt = $dbh->prepare("UPDATE shoping_lists SET quantity = :quantity_change WHERE product_id = :id AND user_id = :u_id;");
            $stmt->bindParam(':quantity_change', $quantity_change);
            $stmt->bindParam(':id', $product_id);
            $stmt->bindParam(':u_id', $usr_id);
            $quantity_change = $quantity_initial + $_POST['quantity'];
            $product_id = $id;
            
            $stmt->execute();
            echo "<p>Item Added!</p></div>";
        }
        
        else {
            $stmt = $dbh->prepare("INSERT INTO shoping_lists VALUES (:id, :pr_id, :quantity);");

            $stmt->bindParam(':id', $user_id);
            $stmt->bindParam(':pr_id', $p_id);
            $stmt->bindParam(':quantity', $quantity);
            
            $user_id = $usr_id;
            $p_id = $id;
            $quantity = $_POST['quantity'];

            $stmt->execute();
            echo "<p>Item Added!</p></div>";
        }

        $stmt = $dbh->prepare("SELECT popularity FROM products WHERE id = :id ;");
        $stmt->bindParam(':id', $prod_id);
        $stmt->execute();

        $new_pop = $stmt->fetch()['popularity'] + 1;

        $stmt = $dbh->prepare("UPDATE products SET popularity = :pop WHERE id = :p_id ");

        $stmt->bindParam(':p_id', $prod_id);
        $stmt->bindParam(':pop', $new_pop);

        $stmt->execute();

    }
    


    $dbh = null;
    
}
    

?>
    </main>
</body>
</html>