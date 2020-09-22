<?php 
require('dbconfig.php');
//echo date('d/m/y h:i:s', time());

$sql='SELECT * FROM date_table';
$stmt=$pdo->prepare($sql);
$stmt->execute();
$d=$stmt->rowcount();
if($d>=1)
{
	$posts=$stmt->fetch(PDO::FETCH_ASSOC);
	$strt_date=$posts['strt_date'];
	$end_date=$posts['end_date'];
}

$msg='';
$msgclass='';
if(isset($_POST['confirm_btn']))
			{
				$strt=new DateTime($_POST['strt']);
				$endd=new DateTime($_POST['endd']);

				if($strt>$endd)
				{
						$msg="Start date is before end date";
						$msgclass='alert-danger';

				}
			else
				{if($d>=1)
				{
					$strt=$_POST['strt'];
					$endd=$_POST['endd'];
				$sql = 'UPDATE date_table SET strt_date = :strt,end_date = :endd WHERE strt_date =:strt_date && end_date = :end_date';
					// $sql = 'UPDATE date_table SET strt_date = .$strt. ,end_date =.$endd. WHERE strt_date =.$strt_date. && end_date = .$end_date.';
					// $sql = 'UPDATE date_table SET strt_date = .strtotime($strt). ,end_date =.strtotime($endd). WHERE strt_date =.strtotime($strt_date). && end_date = .strtotime($end_date).';
				$stmt= $pdo->prepare($sql);
				 $stmt->execute(['strt'=>$strt, 'endd'=>$endd, 'strt_date'=>$strt_date, 'end_date'=>$end_date]);
				$stmt->execute();
				header("Refresh:0");

				}
				else
				{
 				$sql='INSERT INTO date_table(strt_date,end_date) VALUES (:strt, :endd)';
							 $stmt=$pdo->prepare($sql);
							 $stmt->execute(['strt'=>$strt, 'endd'=>$end]);
							 header("Refresh:0");

				}
			}
			}



?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Date Time</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<h1>SELECT START DATE AND END DATE FOR SUBMITTING FILE</h1>
<?php if($msg != ''): ?>
			<div class="alert <?php echo $msgclass; ?>"><?php echo $msg; ?></div>
		<?php endif; ?>

<form name="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<?php if($d<1){ ?>
			<label>Start Date and time</label><br>
			<input type="datetime-local" name="strt" class="inputvalues" required><br>
			<label>End Date and time</label><br>
			<input type="datetime-local" name="endd" class="inputvalues" required><br>
			<input name="confirm_btn" type="submit" id="confirm_btn" value="Save"><br>
		<?php }
		else{
		 ?>
		 <label>Start Date and time   </label>    <?php echo date('d/m/y h:i:s', strtotime($posts['strt_date'])); ?><br>
		  <label>End Date and time    </label>    <?php echo date('d/m/y h:i:s', strtotime($posts['end_date'])); ?><br>
		  <h2>Edit</h2>
		  <label>Start Date and time</label><br>
			<input type="datetime-local" name="strt" class="inputvalues" required><br>
			<label>End Date and time</label><br>
			<input type="datetime-local" name="endd" class="inputvalues"  required><br>
			<input name="confirm_btn" type="submit" id="confirm_btn" value="Save"><br>
		<?php } ?>
		</form>
</body>
</html>