<?php
session_start();
if(!isset($_SESSION['email']))
{
     echo "<script>location.href = 'login.php'</script>";
     
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    include('Includere/connection.php');
    
    
    
            $stmt = $dbh->prepare("DELETE FROM shoping_lists WHERE user_id=:id AND product_id = :pr_id;");

            $stmt->bindParam(':id', $u_id);
            $stmt->bindParam(':pr_id', $p_id);

            $u_id = $_POST["user"];
            $p_id = $_POST["id"];

            $stmt->execute();
    
    $dbh = null;
    // echo "<script>location.href = 'shoping_list.php'</script>";
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodOrg Statistics</title>
    <link href="stylesheets/shopping_list.css" rel="stylesheet">
</head>



<body>
<script>

    function remove_item(value) {
        console.log(value);
        var user = value.split("_")[0];
        var id = value.split("_")[1];

        var list = document.getElementById("list");
        var row = document.getElementById(id);

        list.deleteRow(row.rowIndex);

        const form = document.createElement('form');
        form.method = "post";
        form.action = window.location.href;
        
        var hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = "user";
        hiddenField.value = user;
        form.appendChild(hiddenField);

        var hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = "id";
        hiddenField.value = id;
        form.appendChild(hiddenField);
        

        document.body.appendChild(form);
        form.submit();
    }

</script>
    <header>
        <?php
            include("nav_bar.php");
        ?>
    </header>

    <main>
       <div class="headlines">
            <p class="h1">Your Shopping List</p>
       
                <?php
                include('Includere/connection.php');
                $stmt = $dbh->prepare("SELECT id FROM `users` where email = :email;");

                $stmt->bindParam(':email', $email);
                $email = $_SESSION['email'];

                $stmt->execute();
                
                
                    $usr_id =  $stmt->fetch()['id'];

                    $stmt = $dbh->prepare("SELECT name, quantity, product_id  FROM shoping_lists s JOIN products p on p.id = s.product_id WHERE user_id = :id;");

                    $stmt->bindParam(':id', $id);

                    $id=$usr_id;

                    $stmt->execute();
                    if($stmt->rowCount() > 0){
                        
                        echo '<table style="width:100%" class = "statistics_table" id="list">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Checked</th>
                        </tr>';

                    $items = array();
                    while ($row = $stmt->fetch()) {
                        $items[] =  ucfirst($row['name']) . '_check';
                        if(count(explode("_", $row['name'])) > 1){
                            echo '<tr id = "'. $row['product_id'] .'">
                                <td>';
                            $words = explode("_", $row['name']);
                            for ($i = 0; $i< count($words)-1;$i++){
                                echo  ucfirst($words[$i]) . " ";
                            }
                            echo ucfirst($words[count($words) - 1]) . '</td> 
                                <td>'.$row['quantity'].'</td>
                                <td><button class="main_button" value ="'. $usr_id . '_' . $row['product_id'] . '" onclick ="remove_item(this.value);" >Remove</button></td>
                            </tr>';
                        }
                        else{
                            echo '<tr id = "'. $row['product_id'] .'">
                                <td>' .  ucfirst($row['name']) . '</td>
                                <td>'.$row['quantity'].'</td>
                                <td><button class="main_button" value ="'. $usr_id . '_' . $row['product_id'] . '" onclick ="remove_item(this.value);" >Remove</button></td>
                            </tr>';
                        }
                    }

                    $dbh = null;
                    echo ' </table> </div>';
                    
                }
                else{
                    echo '</div>
                    <div class="headlines2">
                        <p class="h3">Your Sopping List Appears to be Empty. <a href="search.php">Search</a> for what you want and add it to your list.</p>
                    </div>';
                }
                ?>
           
		    
           <form action="export_shopping_list.php">
                <input type="submit" class="submit" value="Export">
            </form>
       
    </main>

</body>
</html>

