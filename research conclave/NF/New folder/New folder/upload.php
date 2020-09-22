
<?php
require('dbconfig.php');
if(isset($_POST['submit'])){
//  	echo htmlentities($_POST['name']);
//$name=$_POST['name'];
$img=$_FILES['image']['name'];
$message=$_POST['message'];
session_start();
$username=$_SESSION['name'];
$email=$_SESSION['email'];
$password=$_SESSION['password'];
// $d='1';
//$sql='INSERT INTO img(cou,name,pat) VALUES (:cou, :name, :pat)';
//also do the event
$sql='INSERT INTO user(username,email,passwd,message,image) VALUES (:username, :email, :passwd, :message, :image)';
$stmt=$pdo->prepare($sql);
// $stmt->execute(['cou'=>$d, 'name'=>$name, 'pat'=>$img]);
$stmt->execute(['username'=>$username, 'email'=>$email, 'passwd'=>$password, 'message'=>$message, 'image'=>$img]);

 move_uploaded_file($_FILES['image']['tmp_name'], "tuts/$img");
 echo "<script>alert('File Upload SuccessFul')</script>";
 header('Location: userhome.php');
}
?>

<!doctype <!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<label>message</label>
<input type="text" name="message"><br>
<label>select file to upload</label>
<input type="file" name="image"><br>
<input type="submit" value="upload the picture" name="submit">
</form>
<?php

$sql='SELECT pat FROM img';
$stmt=$pdo->prepare($sql);
// $stmt->execute(['cou'=>$d, 'name'=>$name, 'pat'=>$img]);
$stmt->execute();
$posts=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
 foreach($posts as $post){
?>
<a href="tuts/<?php echo $post['pat'] ;?>"><?php echo $post['pat'] ;?></a><br>
<?php } ?>
</body>
</html>
