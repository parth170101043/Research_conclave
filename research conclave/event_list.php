

<?php
   require('dbconfig.php');
   $sql='SELECT * FROM event';
   $stmt=$pdo->prepare($sql);
   $stmt->execute();
   $posts=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Event List</title>
</head>
<body>

	<div name = "event_list">
		<label>
			<h2>
				<b> Events Lists</b><br>
			</h2>
		</label>

				<?php foreach ($posts as $key) {
				?>
				<label>
					<?php echo $key['name'];?><br>

				</label>
			<?php }?>
	</div>

</body>
</html>