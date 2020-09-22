<?php
require('dbconfig.php');
$msg='';
$msgclass='';

if(isset($_POST['confirm_btn']))
			{
				$name=$_POST['name'];
				$descrip=$_POST['descrip'];
				$sql='SELECT * FROM event WHERE name= :name';
				 	$stmt=$pdo->prepare($sql);
					$stmt->execute(['name'=>$name]);
					if($stmt->rowcount()>=1)
					{
						$msg="Event of same name already exists";
						$msgclass='alert-danger';
					}
					else
					{	
						$sql='INSERT INTO event(name,descrip) VALUES (:name, :descrip)';
							 $stmt=$pdo->prepare($sql);
							 $stmt->execute(['name'=>$name, 'descrip'=>$descrip]);
					}
			}


?> 
<!DOCTYPE html>
<html>
<head>
	<!-- This how we can linl-->
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Create Event</title>
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
			<h2 style="color:#00008B">Event Creation Form</h2>
		</center>
		<?php if($msg != ''): ?>
			<div class="alert <?php echo $msgclass; ?>"><?php echo $msg; ?></div>
		<?php endif; ?>

		<form name="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label><b>Name</b></label><br>
			<input name="name" type="text" class="inputvalues" placeholder="name" required><br>
			<label><b>Description</b></label><br>
			<input name="descrip" type="text" class="inputvalues" placeholder="descrip" required><br>
			
			<center>
				<input name="confirm_btn" type="submit" id="confirm_btn" value="Confirm"><br>
				
			</center>
		</form>
	</div>	
</body>
</html>