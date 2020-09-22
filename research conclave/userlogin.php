<?php
require('dbconfig.php');
$msg='';
$msgclass='';
if(isset($_POST['confirm_btn']))
			{
				
				//alert box
				//echo '<script type="text/javascript">alert("Confirm is clicked")</script>';
				$username=$_POST['username'];
				$password=$_POST['password'];

				$sql='SELECT * FROM user WHERE username = :username && passwd = :password';
				 	$stmt=$pdo->prepare($sql);
					$stmt->execute(['username'=>$username, 'password'=>$password]);
					
					if($stmt->rowcount()<1)
					{
						$msg="Usename or password is incorrect";
						$msgclass='alert-danger';
					}
					else
					{
						session_start();
						$_SESSION['name']=$username;
						$_SESSION['ddd']=$d;
						header('Location: userhome.php');
					}
			}



?>
<!DOCTYPE html>
<html>
<head>
	<!-- This how we can linl-->
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>User Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background-color:#808080">
	<div id="top-bar">
		<center>
			<img src="images/logo.png" class="logo">
			<h1 style="color:#DAA520">Research Conclave, 2020</h1>
			<h2  style="color:#DAA520">Indian Institute of Technology Guwahati , Assam</h2>
		</center>
	</div>
	<div id="main-wrapper" >
		<center>
			<h2 style="color:#00008B"> User Login</h2>
		</center>
		<?php if($msg != ''): ?>
			<div class="alert <?php echo $msgclass; ?>"><?php echo $msg; ?></div>
		<?php endif; ?>

		<form name="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label><b>Username</b></label><br>
			<input name="username" type="text" class="inputvalues" placeholder="username" value="<?php echo isset($_POST['username']) ? $username : '';?>" required><br>
			<label><b>Password</b></label><br>
			<input name="password" type="password" class="inputvalues" placeholder="password" required><br>
			<center>
				<input name="confirm_btn" type="submit" id="confirm_btn" value="Confirm"><br>
				<a href="index.php"><input name="back_btn" type="button" id="back_btn" value="Back">
			</center>
		</form>
	</div>	
</body>
</html>