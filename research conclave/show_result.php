<?php 

   require('dbconfig.php');
   $sql='SELECT * FROM eventuser';
   $stmt=$pdo->prepare($sql);
   $stmt->execute();
   $posts=$stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Result</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background-color:#808080">
<form name="myform" action="general_home.php" method="post">
	<div id="top-bar">
		<center>
			<img src="images/logo.png" class="logo">
			<h1 style="color:#DAA520">Research Conclave, 2020</h1>
			<h2  style="color:#DAA520">Indian Institute of Technology Guwahati , Assam</h2>
		</center>
	</div>
	<div name = "result">
		<label>
			<h2>
				<b> Result of abstract:</b><br>
			</h2>
		</label>
		<center>
			<label style="margin-left: 0px">User name:</label>
			<label style="margin-left: 10px">Event name:</label>
			<label style="margin-left: 10px">Grade:</label><br>
				<?php foreach ($posts as $key) {

					$temp=$key['grade'] + $key['grade1'];
					$ans=$temp/2;
				?>
				<label style="margin-left: 0px">
					<?php echo $key['username'];?><br>

				</label>
				<label style="margin-left: 10px">
					<?php echo $key['event'];?><br>

				</label>
				<label style="margin-left: 10px">
					<?php echo $ans;?><br>

				</label>
				<br>
			<?php }?>
		</center>
		
	</div>

</body>
</html>

