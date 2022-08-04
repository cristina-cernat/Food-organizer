<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodOrg Home</title>
    <link href="stylesheets/home.css" rel="stylesheet">
</head>
<body>
    <header>
        <?php
            include("nav_bar.php");
        ?>
    </header>

    <main>
       <div class="logo_big">
            <img src="img/Logo_Big.svg" alt="Big Nice Logo">
       </div>
       <div class="headlines">
            <p class = "h1">Organize your food. Search food products, make shopping lists, see stats</p>
            <p class = "h2">All in one place.</p>
       </div>
       <div class="buttons">
            <button type="button" class="main_button" value="SEARCH FOOD" onclick="location.href='search.php'">SEARCH FOOD</button>
            <button type="button" class="second_button" value="CREATE ACCOUNT" onclick="location.href='register.php'">CREATE ACCOUNT</button>
       </div>
    </main>

</body>
</html>
