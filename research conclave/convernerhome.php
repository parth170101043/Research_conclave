
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title> Student Converner Home</title>
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

$sql1='SELECT * FROM reviewer';
$stmt=$pdo->prepare($sql1);
$stmt->execute();
$posts1=$stmt->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['confirm_btn']))
			{//alert box
				//echo '<script type="text/javascript">alert("Confirm is clicked")</script>';
				//$username='pratim';
				
				
				
				$reviewer1=$_POST['reviewer1'];
				$reviewer2=$_POST['reviewer2'];
				$un=$_POST['user'];
				// $reviewer1='yutu';
				// $reviewer2='hh';
				if($reviewer2==$reviewer1)
				{
					$msg="You can't assing same reviewers for one file of user $un";
					$msgclass='alert-danger';
				}
				else
				{
					$evnt=$_POST['evnt'];
				$sql = 'UPDATE eventuser SET reviewer1 = :reviewer1, reviewer2 = :reviewer2 WHERE username= :username && event=:event'	;
				$stmt= $pdo->prepare($sql);
				$stmt->execute(['reviewer1'=>$reviewer1, 'reviewer2'=>$reviewer2, 'username'=>$un, 'event'=>$evnt]);
				header("Refresh:0");
				}
			}


?>


<h1>WELCOME  <?php echo $username ; ?> </h1>
<a href="createvent.php">Create Event</a>
<?php if($msg != ''): ?>
			<div class="alert <?php echo $msgclass; ?>"><?php echo $msg; ?></div>
		<?php endif; 
 foreach($posts as $post){
?>
<form name="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<label><h2>username</h2></label><br>
	<input name="user" type="text" class="inputvalues" value="<?php echo $post['username']; ?>"  readonly><br>
	
	<h2>event</h2><input name="evnt" type="text" class="inputvalues" value="<?php echo $post['event']; ?>"  readonly><br>
	<h2>File</h2>
	<a href="tuts/<?php echo $post['file'] ;?>"><?php echo $post['file'] ;?></a><br>
	<h2>Reviewer1 :</h2><?php echo $post['reviewer1'];?>   <h3>  Edit</h3>
		<select name="reviewer1">
		
					<?php foreach($posts1 as $post1){
						if($post1['type']==$post['event'] && $post1['approve']=='yes'){?>
						<option><?php echo $post1['username'];?></option>
					<?php } }
				?>
		</select>
	<br>
	<h2>Reviewer2 :</h2><?php echo $post['reviewer2'];?>   <h3>  Edit</h3>
		<select name="reviewer2">
		<?php foreach($posts1 as $post1){
						if($post1['type']==$post['event']){?>
						<option><?php echo $post1['username'];?></option>
					<?php } }
				?>
		</select>
	<br>
	
	<h2>Grade</h2><?php echo $post['grade'];?>

	<input name="confirm_btn" type="submit" id="confirm_btn" value="Save"><br>


</form>
<?php } ?>

</body>
</html>
