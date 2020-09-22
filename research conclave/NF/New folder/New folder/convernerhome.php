
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>My first website</title>
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

$sql='SELECT * FROM user';
$stmt=$pdo->prepare($sql);
$stmt->execute();
$posts=$stmt->fetchAll(PDO::FETCH_ASSOC);

$sql1='SELECT * FROM reviewer WHERE type=? ';
$stmt=$pdo->prepare($sql1);
$stmt->execute(['poster']);
$posts1=$stmt->fetchAll(PDO::FETCH_ASSOC);

$sql1='SELECT * FROM reviewer WHERE type=? ';
$stmt=$pdo->prepare($sql1);
$stmt->execute(['oral']);
$posts2=$stmt->fetchAll(PDO::FETCH_ASSOC);
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
				$sql = 'UPDATE user SET reviewer1 = :reviewer1, reviewer2 = :reviewer2 WHERE username= :username';
				$stmt= $pdo->prepare($sql);
				$stmt->execute(['reviewer1'=>$reviewer1, 'reviewer2'=>$reviewer2, 'username'=>$un]);
				header("Refresh:0");
				}
			}


?>





<h1>WELCOME  <?php echo $username ; ?> </h1>
<?php if($msg != ''): ?>
			<div class="alert <?php echo $msgclass; ?>"><?php echo $msg; ?></div>
		<?php endif; 
 foreach($posts as $post){
?>
<form name="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<label><h2>username</h2></label><br>
	<input name="user" type="text" class="inputvalues" value="<?php echo $post['username']; ?>"  readonly><br>
	<h2>Email</h2><?php echo $post['email'];?><br>
	<h2>event</h2><?php echo $post['event'];?><br>
	<h2>File</h2>
	<a href="tuts/<?php echo $post['image'] ;?>"><?php echo $post['image'] ;?></a><br>
	<h2>Reviewer1 :</h2><?php echo $post['reviewer1'];?>   <h3>  Edit</h3>
		<select name="reviewer1">
		<?php if($post['event']=='poster')
				{ ?>
			
					<?php foreach($posts1 as $post1){?>
						<option><?php echo $post1['username'];?></option>
					<?php } 
				}
			else{
				if($post['event']=='oral'){?>
					<?php foreach($posts2 as $post2){?>
						<option><?php echo $post2['username'];?></option>
					<?php } 
				
					} 
				}?>
		</select>
	<br>
	<h2>Reviewer2 :</h2><?php echo $post['reviewer2'];?>   <h3>  Edit</h3>
		<select name="reviewer2">
		<?php if($post['event']=='poster')
				{ ?>
			
					<?php foreach($posts1 as $post1){?>
						<option><?php echo $post1['username'];?></option>
					<?php } 
				}
			else{
				if($post['event']=='oral'){?>
					<?php foreach($posts2 as $post2){?>
						<option><?php echo $post2['username'];?></option>
					<?php } 
				
					} 
				}?>
		</select>
	<br>
	<h2>message</h2><?php echo $post['message'];?>
	<h2>Grade</h2><?php echo $post['submitted'];?>

	<input name="confirm_btn" type="submit" id="confirm_btn" value="Save"><br>


</form>
<?php } ?>

</body>
</html>
