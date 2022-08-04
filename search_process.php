<?php 
    session_start();
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

            $category_string = " AND category = :category ";
            $price_string = " AND price <= :price ";
            $season_string = " AND season = :season ";
            $diet_string = " AND diet = :diet ";
            $allergens_string = " AND id NOT IN (SELECT product_id FROM allergens WHERE name IN (";

            $category_q = $_GET['category'];
            $season_q = $_GET['season'];
            $diet_q = $_GET['diet'];


            if ($category_q == "all") {
                $category_string = "";
            }            
            if ($season_q == "all") {
                $season_string = "";
            }
            if ($diet_q == "none") {               
                $diet_string = "";
            }
            
            if(isset($_GET['allergens'])) {

                $allergens = $_GET['allergens'];
                $string = '';
            
                for($i=0; $i<count($allergens)-1; $i++) {
                    $allergens_string .= ":allergen".$i.", ";
                }
                $c = count($allergens) -1;
                
                $allergens_string .= ":allergen".$c;
                $allergens_string .= "))";

            }
           
            else $allergens_string='';
            
            // SELECT * FROM products WHERE id NOT IN (SELECT product_id FROM allergens WHERE name IN ('lactose', 'gluten'));
            
            $query = "SELECT * FROM products
                WHERE (name LIKE :name1 OR name like :name2 OR name like :name3) ". $category_string . $price_string . $season_string . $diet_string . $allergens_string . ";";
            
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':name1', $name1); 
            $stmt->bindParam(':name2', $name2); 
            $stmt->bindParam(':name3', $name3); 
            $stmt->bindParam(':price', $price);
            //$stmt->bindParam(':allergens', $string);

            if ($category_q != "all") {
                $stmt->bindParam(':category', $category);
            }
            if ($season_q != "all") {
                $stmt->bindParam(':season', $season);
            }
            if ($diet_q != "none") {               
                $stmt->bindParam(':diet', $diet);
            }
            
            // echo '|'.$_GET['name'].'|';
            // echo $query;
            $name1 = $_GET['name'].'%';
            $name2 = '%'.$_GET['name'];
            $name3 = '%'.$_GET['name'].'%';
            $category = $category_q;
            $price = $_GET['price'];
            $season = $_GET['season'];
            $diet = $_GET['diet'];
            if(isset($_GET['allergens'])) {

                $allergens = $_GET['allergens'];

            
                for($i=0; $i<count($allergens); $i++) {
                    $stmt->bindParam(':allergen'.$i, $allergens[$i]);
                    
                }
            $allergens = $_GET['allergens'];
                

                
            
            }
            else $allergens=null;

            

            $stmt->execute();

            $count = $stmt->rowCount();
            
            if($count != 0){
                //style=\"overflow-x:auto\"
                echo "
                <div >
                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Season</th>
                        <th>Diet</th>
                        <th>Perishability</th>
                        <th>See more</th>
                    </tr>
                    </thead> 
                    <tbody>";
                while ($row = $stmt->fetch()) {
                    echo 
                            "<tr>
                                <td>".strtr(ucfirst($row['name']),"_", " ")."</td>
                                <td>".$row['price']."</td>
                                <td>".strtr(ucfirst($row['category']),"_", " ")."</td>
                                <td>".ucfirst($row['season'])."</td>
                                <td>".ucfirst($row['diet'])."</td> 
                                <td>".ucfirst($row['perishability'])."</td>
                                <td><a href=\"product.php?id=".$row['id']."\" class=\"a_info\">Add to your list</a></td>
                            </tr>";
                        
                }
                echo 
                "</tbody> 
                </table>
                </div>";
            }
            else echo '<p class = "no_results">No results :(</p>';
            
            
        ?>
            
              
          
   </main>
</body>
</html>