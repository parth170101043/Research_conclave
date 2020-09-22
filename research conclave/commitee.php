<?php
   require('dbconfig.php');
   $sql='SELECT * FROM converner';
   $stmt=$pdo->prepare($sql);
   $stmt->execute();
   $posts=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $sql1='SELECT * FROM reviewer';
   $stmt1=$pdo->prepare($sql1);
   $stmt1->execute();
   $posts1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
   
?>
<!DOCTYPE html>
<html>
<head>
	<title>Committee</title>
</head>
<body>

	<div name = "event_list">
		<label>
			<h2>
				<b> Converner Lists</b><br>
			</h2>
		</label>

				<?php foreach ($posts as $key) {
				?>
				<label>
					<?php echo $key['username'];?><br>

				</label>
			<?php }?>

			<label><br>
			<h2>
				<b> Reviewer Lists</b><br>
			</h2>
		</label>

				<?php foreach ($posts1 as $key) {
				?>
				<label>
					<?php echo $key['username'];?><br>

				</label>
			<?php }?>
	</div>

</body>
</html>