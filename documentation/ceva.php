<?php

    $allergens_string = " AND id NOT IN (SELECT product_id FROM allergens WHERE name IN (";
    if(isset($_GET['allergens'])) {
   

    $allergens = $_GET['allergens'];
    $string = '';

    for($i=0; $i<count($allergens)-1; $i++) {
        $allergens_string .= ":alergen".$i.", ";
        // $string .= "'".$allergens[$i] . "', ";
    }
    $allergens_string .= ":alergen".count($allergens);
    $allergens_string .= "))";



    for($i=0; $i<count($allergens); $i++) {
        $stmt->bindParam(':allergens'.$i, $allergens[i]);
    }




    }


?>