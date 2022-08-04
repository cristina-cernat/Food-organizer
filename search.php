<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodOrg Search</title>
    <link href="stylesheets/search.css" rel="stylesheet">
    <link href="stylesheets/nav_bar.css" rel="stylesheet">
</head>
<body>
    <?php
        include("nav_bar.php");
    ?>

    <main>
        <div class="logo_big">
            <img src="img/Logo_medium.svg" alt="Big Nice Logo">
       </div>
       <form action="search_process.php" method ="GET" class="radio">
           <div class="search_div">
                <p class="main_search">Search food products</p>

                <input type="text" name="name" class="main_textbox" id="recipe_input">
                <input type="submit" class="submit" value="Search">
           </div>
           
           <div class="filters_container">
               <div class="filter">
                    <p class="filter_name">Category</p>
                    <div class="label_choice">
                        <input type="radio" id="category_all" name="category" value="all" checked>
                        <label for="category_all">All</label>
                    </div>
                    <?php 
                            $connection = mysqli_connect("localhost", "root", "", "forg");
                            if (!$connection) {
                                die("Connection failed: " . mysqli_connect_error());
                              }
                            $query = "SELECT DISTINCT category FROM PRODUCTS where category != 'All'";
                            $result = mysqli_query($connection, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_array($result)) {
                                    
                                    echo '<div class="label_choice">
                                    <input type="radio" id="'. strtolower($row['category']) .'" name="category" value="'. strtolower($row['category']) .'">
                                    <label for="'. strtolower($row['category']) .'">'. strtr(ucfirst($row['category']),"_", " ") .'</label>
                                    </div>';
                                }
                            }
                        ?>
               </div>

                <div class="filter">
                    <p class="filter_name">Price Range</p>
                    <div class="slider_container">
                        <p class="slider_values">0$</p>
                        <input type="range" name="price" min="1" max="100" value="10" class="slider" id="myRange" onchange="updateTextInput(this.value);">
                        <p class="slider_values">100$</p>
                        <p class="label_choice">Value:</p>
                        <input type="text" id="textInput" value="10" class="small_value">
                    </div>
                </div>

                <div class="filter">
                    <p class="filter_name">Season</p>
                    <div class="label_choice">
                        <input type="radio" id="season_all" name="season" value="all" checked>
                        <label for="season_all">All</label>
                    </div>
                    <div class="label_choice">
                        <input type="radio" id="winter" name="season" value="winter">
                        <label for="winter">Winter</label>
                    </div>
                    <div class="label_choice">
                        <input type="radio" id="spring" name="season" value="spring">
                        <label for="spring">Spring</label>
                    </div>
                    <div class="label_choice">
                        <input type="radio" id="summer" name="season" value="summer">
                        <label for="summer">Summer</label>
                    </div>
                    <div class="label_choice">
                        <input type="radio" id="fall" name="season" value="fall">
                        <label for="fall">Fall</label>
                    </div>
                </div>

                <div class="filter">
                    <p class="filter_name">Diet</p>
                    <div class="label_choice">
                        <input type="radio" id="diet_none" name="diet" value="none" checked>
                        <label for="diet_none">None</label>
                    </div>
                    <div class="label_choice">
                        <input type="radio" id="gluten-free" name="diet" value="gluten-free">
                        <label for="gluten-free">Gluten-free</label>
                    </div>
                    <div class="label_choice">
                        <input type="radio" id="vegan" name="diet" value="vegan">
                        <label for="vegan">Vegan</label>
                    </div>
                </div>

                <div class="filter">
                    <p class="filter_name">Alergens</p>
                        <div class="label_choice">
                            
                        </div>
                        <?php 
                            $connection = mysqli_connect("localhost", "root", "", "forg");
                            if (!$connection) {
                                die("Connection failed: " . mysqli_connect_error());
                              }
                            $query = "SELECT DISTINCT name FROM allergens;";
                            $result = mysqli_query($connection, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_array($result)) {
                                    
                                    echo '<div class="label_choice">
                                    <input type="checkbox" id="'. strtolower($row['name']) .'" name="allergens[]" value="'. strtolower($row['name']) .'">
                                    <label for="'. strtolower($row['name']) .'">'. ucfirst($row['name']) .'</label>
                                    </div>';
                                }
                            }
                        ?>
                    
                </div>

           </div>

       </form>
    </main>
    <script>
    function updateTextInput(val) {
          document.getElementById('textInput').value=val;
        }
    </script>
</body>
</html>
