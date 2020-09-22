<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Approve Abstract</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<?php

require('dbconfig.php');
$msg='';
$msgclass='';
session_start();
$username=$_SESSION['name'];
$type=$_SESSION['type'];

$sql='SELECT * FROM eventuser';
$stmt=$pdo->prepare($sql);
$stmt->execute();
$posts=$stmt->fetchAll(PDO::FETCH_ASSOC);



if(isset($_POST['confirm_btn']))
			{//alert box
				//echo '<script type="text/javascript">alert("Confirm is clicked")</script>';
				//$username='pratim';
				
				$user=$_POST['user'];
				$yes='yes';
				$sql = 'UPDATE eventuser SET approve = :approve WHERE username = :username';
				$stmt= $pdo->prepare($sql);
				$stmt->execute(['approve'=>$yes, 'username'=>$user]);
				header("Refresh:0");
				
			}


?>


<h1>WELCOME  <?php echo $username ; ?> </h1>
<?php if($msg != ''): ?>
			<div class="alert <?php echo $msgclass; ?>"><?php echo $msg; ?></div>
		<?php endif; 
 foreach($posts as $post){
?>
<form name="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<label><h2>username</label><br>
	<input name="user" type="text" class="inputvalues" value="<?php echo $post['username']; ?>"  readonly></h2><br>
	
	<h2>event:  <?php echo $post['event'];?></h2><br>
	<h2>File</h2>
	<a href="tuts/<?php echo $post['file'] ;?>"><?php echo $post['file'] ;?></a><br>
	<h2>Reviewer1 :<?php echo $post['reviewer1'];?> </h2>  
	<br>
	<h2>Reviewer2 :<?php echo $post['reviewer2'];?> </h2>
		
	<br>
	<h2>Approve Status:  <?php echo $post['approve'];?></h2>
	
	<?php if($post['reviewer1']!='' && $post['reviewer2']!=''){ 
		if($post['approve']==''){?>
	<input name="confirm_btn" type="submit" id="confirm_btn" value="Save" style="display: show"><br>
	<?php }}	?>
<br><br><br>

</form>
<?php } ?>

</body>
</html>
