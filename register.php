<?php
session_start();
if(isset($_SESSION['email']))
{
	 echo "<script>location.href = 'home.php'</script>";
}
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel='stylesheet' href='stylesheets/register.css'>
		<title>Forg Register</title>
	</head>
	<body>
		<header>
				<?php
						include("nav_bar.php");
				?>
		</header>

		<div class="right-side">
		<p class="h1">Register</p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">


		<div class="form-group">
		<label>First Name:</label>
		<br>

		<input class="form-control" type="text" name="firstname" placeholder="First Name">

		</div>
		<div class="form-group">
		<label>Last Name:</label>
		<br>

		<input class="form-control" type="text" name="lastname" placeholder="Last Name">

		</div>

		<div class="form-group">
		<label>Email:</label>
		<br>
		<input class="form-control" type="text" name="email" placeholder="Email">

		</div>

		<div class="form-group">
		  <label>Password:</label>
		  <br>
		<input class="form-control" type="password" name="password" placeholder="Password">
		</div>

		<div class="form-group">
		  <label>Repeat Password:</label>
		  <br>
		<input class="form-control" type="password" name="re_password" placeholder="Repeat Password">
		</div>

		<div class="filter">
			<label class="filter_name">Admin?</label>
			<div class="label_choice">
				<input type="checkbox" id="admin" name="admin" value= 1 >
				<label for="admin">Yes</label>
			</div>
		</div>

		<br>
		<input class="btn btn-primary" type="submit" name="submit" value="Register">
		  <br>
		  <p>You already have an account?</p>
		  <a href="login.php">Login here!</a>
		</form>
		</div>
	</body>
</html>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$re_password = $_POST["re_password"];

		include('Includere/connection.php');

		$stmt = $dbh->prepare("SELECT `email` FROM `banned_users` WHERE `email`=:email");
		$stmt->bindParam(':email', $email);

		$email = $_POST["email"];

		$count = $stmt->rowCount();

		if ($count != 0){
			echo '<script type="text/javascript">alert("Thie email adress has been banned from our sebsite")</script>';
			echo "<script>location.href = 'home.php'</script>";
		}
		else
		{
			if($password == $re_password){	
				if(strlen($email) < 5 || strlen($password) < 5 || strlen($firstname) < 2 || strlen($lastname) < 2 || !strpos($email,'@'))
				{
					echo '<script type="text/javascript">alert("E-mail must be valid and must have at least 5 characters.  The password must contain at least 5 characters.")</script>';
					echo "<script>location.href = 'register.php'</script>";
				}
				else
				{
					
					$stmt = $dbh->prepare("SELECT `email` FROM `users` WHERE `email`=:email");
					$stmt->bindParam(':email', $email);
					$email = $_POST["email"];
					$stmt->execute();
					$count = $stmt->rowCount();
					if ($count == 0)
					{
						$stmt =  $dbh->prepare("INSERT INTO `users` (email, password, first_name, last_name, isAdmin) VALUES (:email, :password, :first_name, :last_name, :isAdmin)");

						$stmt->bindParam(':email', $email);
						$stmt->bindParam(':password', $password);
						$stmt->bindParam(':first_name', $firstname);
						$stmt->bindParam(':last_name', $lastname);
						$stmt->bindParam(':isAdmin', $is_admin);

						$is_admin = $_POST["admin"];
						if(isset($_POST["admin"])){
							$is_admin = $_POST["admin"];
						}
						else
							$is_admin = 0;
						
						$email = $_POST["email"];
						$password = $_POST["password"];
						$password = strtoupper(hash('whirlpool', $password));
						$firstname = $_POST["firstname"];
						$lastname = $_POST["lastname"];

						$stmt->execute();

						echo '<script type="text/javascript">alert("Account was succesfully created!")</script>';
						echo "<script>location.href = 'login.php'</script>";
					}
					else
					{
						echo '<script type="text/javascript">alert("An account with this email already exists")</script>';
						echo "<script>location.href = 'register.php'</script>";
					}
				}
				$dbh = null;
			}
			else{
				echo '<script type="text/javascript">alert("Passwords must match.")</script>';
				echo "<script>location.href = 'register.php'</script>";
			}
		}

	}
  ?>
