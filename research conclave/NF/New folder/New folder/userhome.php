
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>Download your file</h1>
</body>
</html>
<?php
require('dbconfig.php');
session_start();
$username=$_SESSION['name'];

$sql='SELECT image FROM user WHERE username=:username ';
$stmt=$pdo->prepare($sql);
// $stmt->execute(['cou'=>$d, 'name'=>$name, 'pat'=>$img]);
$stmt->execute(['username'=>$username]);
$posts=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
 foreach($posts as $post){
?>
<a href="tuts/<?php echo $post['image'] ;?>"><?php echo $post['image'] ;?></a><br>
<?php } ?>

<a href="logout.php">logout</a>
</body>
</html>
