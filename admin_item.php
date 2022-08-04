<?php
    session_start();
    if(!isset($_SESSION['email']) || !isset($_SESSION['admin']) ) {
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
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $stmt = $dbh->prepare("INSERT INTO products (name, price, season, category, diet, perishability) VALUES (:name, :price, :season, :category, :diet, :perishability)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':season', $season);
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':diet', $diet);
                $stmt->bindParam(':perishability', $perishability);
        
                $name = (isset($_POST['name']) ? $_POST['name'] : null);
                $price = (isset($_POST['price']) ? $_POST['price'] : null);
                $season = (isset($_POST['season']) ? $_POST['season'] : null);
                $category = (isset($_POST['category']) ? $_POST['category'] : null);
                $diet = (isset($_POST['diet']) ? $_POST['diet'] : null);
                $perishability = (isset($_POST['perishability']) ? $_POST['perishability'] : null);
        
                $stmt->execute();

                $stmt = $dbh->prepare("SELECT id FROM `products` where name = :name1;");
                $stmt->bindParam(':name1', $name1);
                $name1 = $name;
                $stmt->execute();
                $id = $stmt->fetch()['id'];

                $stmt = $dbh->prepare("INSERT INTO allergens (name, product_id) VALUES (:allergen_name, :product_id)");
                $stmt->bindParam(':allergen_name', $allergens);
                $stmt->bindParam(':product_id', $product_id);
                $product_id = $id;
                $allergens = (isset($_POST['allergens']) ? $_POST['allergens'] : null);
                $stmt->execute();

                echo "Item added";
            }
        ?>
    </main>
</body>
</html>