

<?php

	$msg='';
	$msgclass='';
   require('dbconfig.php');
   $sql='SELECT * FROM date_table';
   $stmt=$pdo->prepare($sql);
   $stmt->execute();
   $posts=$stmt->fetch(PDO::FETCH_ASSOC);

?>


<?php
if(isset($_POST['login_btn']))
{
	$name=$_POST['login'];
	$FC ="Faculty Converner";
	$SC = "Student Converner";
	$RV ="Reviewer";
	$PR ="Participant";
	if($name==$FC)
	{
		header('Location:convernerlogin.php');
	}
	if($name==$SC)
	{
		header('Location:convernerlogin.php');
	}
	if($name==$RV)
	{
		header('Location:reviewer_login.php');
	}
	if($name==$PR)
	{
		header('Location:userlogin.php');
	}
}

if(isset($_POST['register_btn']))
{
	$name=$_POST['register'];
	$RV ="Reviewer";
	$PR ="Participant";
	if($name==$RV)
	{
		header('Location:revier_registration.php');
	}
	if($name==$PR)
	{
		header('Location:registration.php');
	}
}
if(isset($_POST['event']))
{
	header('Location:event_list.php');

}
if(isset($_POST['committee']))
{
	header('Location:commitee.php');
}
if(isset($_POST['show_result']))
{
   $sql='SELECT * FROM yes_no';
   $stmt=$pdo->prepare($sql);
   $stmt->execute();
   $posts1=$stmt->fetch(PDO::FETCH_ASSOC);

   $yes_no='no';

   if($posts1['yesno'] == $yes_no)
   {
   	    $msg="Result is not ready yet.";
		$msgclass='alert-danger';
   }
   else
   {	
   		header('Location:show_result.php');
   }
}
?>

<!DOCTYPE html>
<html>
<head>
	<!-- This how we can linl-->
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Home</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background-color:#808080">
	<?php if($msg != ''): ?>
			<div class="alert <?php echo $msgclass; ?>"><?php echo $msg; ?></div>
		<?php endif; ?>

	<form name="myform" action="general_home.php" method="post">
	<div id="top-bar">
		<center>
			<img src="images/logo.png" class="logo">
			<h1 style="color:#DAA520">Research Conclave, 2020</h1>
			<h2  style="color:#DAA520">Indian Institute of Technology Guwahati , Assam</h2>
		</center>
	</div>
	<div id="second-bar" style="background-color: blue;height: 40px;border-radius: 10px;margin-top: 5px">
		<center>
		<label>
			<b>Login as</b>
		</label>
		<select name="login" style="border-radius: 10px;margin-top: 6px">
			<option>Faculty Converner</option>
			<option>Student Converner</option>
			<option>Reviewer</option>
			<option>Participant</option>
		</select>
		<input type="submit" name="login_btn" value="Go" style="border-radius: 10px">

		<label style="margin-left: 10px">
			<b>Register as</b>
		</label>
		<select name="register" style="border-radius: 10px;margin-top: 6px">
			<option>Reviewer</option>
			<option>Participant</option>
		</select>
		<input type="submit" name="register_btn" value="Go" style="border-radius: 10px">
		</center>
	
	</div>
	<div id="left-bar" style="background-color: lightblue;border-radius:10px;width: 20%;height:500px;margin-top: 5px;float: left">
		<center>
			<input type="submit" name="event" value="EVENTS" style="margin-top: 20px;width: 90%;height: 50px"><br>

			<input type="submit" name="committee" value="COMMITTEE" style="margin-top: 20px;width: 90%;height: 50px"><br>
			<input type="submit" name="show_result" value="Result" style="margin-top: 20px;width: 90%;height: 50px"><br>
			
		</center>
	</div>
	<div id="right-baar" style="background-color: lightyellow;border-radius: 10px;width: 70%;height: 500px;float: left;margin-top: 5px;margin-left: 5px">
		<center>
			<h4 style="color: red;margin-top: 10px" id="Notice">Notice Board</h4>
			<h>
				<b id="submission">Last date of abstract submission is <?php echo $posts['end_date'];?></b>
			</h><br>
			<h4>Hello world</h4>
			
		</center>
	</div>
</body>

</html>
