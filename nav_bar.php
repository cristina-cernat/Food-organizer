    <nav>
        <link rel="stylesheet" href="stylesheets/nav_bar.css">
        <div class="nav_bar">
            <div>
                <a href="home.php" class="small_logo"><img src="img/Logo_small.svg" alt="Nice Logo"></a>
                <a href="home.php" class="logo"><img src="img/Logo.svg" alt="Nice Logo"></a>
            </div>
            <ul class="nav_links">
                <li>
                    <a href="search.php">Search</a>
                </li>
                <li>
                    <a href="shopping_list.php">Shopping List</a>
                </li>
                <li>
                    <a href="statistics.php">Statistics</a>
                </li>
                <?php
                if(isset($_SESSION['admin'])){
                    echo '<li>
                        <a href="admin.php">Admin</a>
                        </li>';
                }
                if(isset($_SESSION['email']))
                {
                    echo '<li>
                            <a href="logout.php">Logout</a>
                            </li>';
                }
                else{
                    echo '<li>
                        <a href="login.php">Login</a>
                        </li>';
                }
                ?>
                
                
            </ul>
            <ul class="phone_links">
                <li>
                    <a href="search.php"><img src="img/Search.svg" alt="Search"></a>
                </li>
                <li>
                    <a href="shopping_list.php"><img src="img/Shopping_List.svg" alt="Shopping List"></a>
                </li>
                <li>
                    <a href="statistics.php"><img src="img/Statistics.svg" alt="Statistics"></a>
                </li>
                <?php
                if(isset($_SESSION['email']))
                {
                    echo '<li>
                            <a href="logout.php"><img src="img/Logout.svg" alt="Profile"></a>
                            </li>';
                }
                else{
                    echo '<li>
                    <a href="login.php"><img src="img/Login.svg" alt="Profile"></a>
                    </li>';
                }
                ?>
            </ul>
        </div>
    </nav>
