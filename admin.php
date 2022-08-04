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
    <title>Foodorg Admin</title>
    <link rel="stylesheet" href="/stylesheets/admin.css">
    <link rel="stylesheet" href="stylesheets/nav_bar.css">
</head>
<body>
    <header>
        <?php
            include("nav_bar.php");
        ?>
    </header>
<script>
    
    function banuser() {
        
        var ceva = document.getElementById("myuser");
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", "form_user.php", false);
        rawFile.onreadystatechange = function ()
        {
            if(rawFile.readyState === 4)
            {
                console.log("if ready");
                if(rawFile.status === 200 || rawFile.status == 0)
                {
                    var allText = rawFile.responseText;
                    ceva.innerHTML=allText;
                }
                else ceva.innerHTML = "Something wrong";
            }
        }
        rawFile.send(null);
    }

    function additem() {
        var ceva = document.getElementById("myitem");
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", "form_item.php", false);
        rawFile.onreadystatechange = function ()
        {
            if(rawFile.readyState === 4)
            {
                console.log("if ready");
                if(rawFile.status === 200 || rawFile.status == 0)
                {
                    var allText = rawFile.responseText;
                    ceva.innerHTML=allText;
                }
                else ceva.innerHTML = "Something wrong";
            }
        }
        rawFile.send(null);
    }
</script>
    <main>
        <button onclick="banuser()" class="button">Ban user</button>
        <div id="myuser">

        </div>
        <button onClick="additem()" class="button">Add Item</button>
        <div id="myitem">

        </div>
    </main>
</body>
</html>
