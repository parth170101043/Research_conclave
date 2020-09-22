

<?php
require('dbconfig.php');
$msg='';
	$msgclass='';
if(isset($_POST['confirm_btn'])){
 	
	$username=$_POST['username'];
	$password=$_POST['password'];
	$type=$_POST['type'];
	$email=$_POST['email'];
	$sql='SELECT * FROM reviewer WHERE username = :username';
	$stmt=$pdo->prepare($sql);
	$stmt->execute(['username'=>$username]);
	if($stmt->rowcount()>=1)
		{
			
   	    $msg="Username Taken . Uase another name.";
		$msgclass='alert-danger';
		}
	else
		{
			$sql='INSERT INTO reviewer(type,username,passwd,email) VALUES(:type, :username, :passwd, :email)';
			$stmt=$pdo->prepare($sql);

			$stmt->execute(['type'=>$type, 'username'=>$username,  'passwd'=>$password, 'email'=>$email ]);
			 echo "<script>alert('Wow, you're registered!')</script>";
            // header('Location: revier_h.php');
			 session_start();
			 $_SESSION['name']=$username;
			 echo '<script type="text/javascript">alert("You have registered successfully.Wait for the approval.")</script>';
		}
//  	echo htmlentities($_POST['name']);
//$name=$_POST['name'];
// $d='1';
//$sql='INSERT INTO img(cou,name,pat) VALUES (:cou, :name, :pat)';
//also do the event

}
?>

<!DOCTYPE html>
<html>
<head>
	<!-- This how we can linl-->
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Reviewer Registration</title>
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
			<h2 style="color:#00008B"> Reviewer Registration </h2>
		</center>
		<?php if($msg != ''): ?>
			<div class="alert <?php echo $msgclass; ?>"><?php echo $msg; ?></div>
		<?php endif; ?>

		<form name="myform" action="revier_registration.php" method="post">
			<label><b>Username</b></label><br>
			<input name="username" type="text" class="inputvalues" placeholder="username" value="<?php echo isset($_POST['username']) ? $username : '';?>" required><br>
			<label><b>Email</b></label><br>
			<input name="email" type="text" class="inputvalues" placeholder="abc@xyz.com" value="<?php echo isset($_POST['email']) ? $email : '';?>" required><br>
			<label><b>Password</b></label><br>
			<input name="password" type="password" class="inputvalues" placeholder="password" required><br>
			<label>Confirm Password</label><br>
			<input name="confirm" type="password" class="inputvalues" placeholder="retype password" required><br>
			<label>Select Event</label><br>
			<select name = "type">
				<?php
				$sql='SELECT * FROM event';
				$stmt=$pdo->prepare($sql);
				$stmt->execute();
				$posts=$stmt->fetchAll(PDO::FETCH_ASSOC); 
				foreach($posts as $key) { ?>
				<option><?php echo $key['name'];?></option>
				<?php }?>
			</select>
			<center>
				<input name="confirm_btn" type="submit" id="confirm_btn" value="Confirm"><br>
				<a href="general_home.php"><input name="back_btn" type="button" id="back_btn" value="Back">
			</center>
			<center>already have an account</center>
			<a href="reviewer_login.php"><center>Login</center></a>
		</form>
	</div>	
</body>
</html>