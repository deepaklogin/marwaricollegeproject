<?php
$email=$name=$number=$photo="";
session_start();
include"studentconnection.php";
if($_SESSION['login']!=session_id())
{
	header("location:index.php");
}
$q1="select * from student where id='".$_SESSION['id']."'";
$sq=mysqli_query($cn,$q1);
if($sq)
{
	$row=mysqli_fetch_array($sq);
	 $name=$row['name'];
	 $email=$row['email'];
	 $number=$row['number'];
}
if(isset($_POST['s1']))
{
	$n1=$_POST['n1'];
	$e1=$_POST['e1'];
	$num1=$_POST['num1'];
	$q2="update student set email='".$e1."',number='".$num1."' where id='".$_SESSION['id']."'";
	if(mysqli_query($cn,$q2))
	{
	echo '<script>alert("update successfully...")</script>';
	header("refresh:0.2;studentprofile.php");
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile Update</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="col-md-12 text-center bg-warning">
		<div class="row">
			<div class="col-md-1">
		<button class="btn btn-primary btn-lg"><a href="studentprofile.php" class="text-decoration-none" style="color: white;">Back</a></button>
		</div>
		<div class="col-md-10"><span style="font-size: 40px;">Student Profile Update</span></div>
		</div>
	</div>
	<div class="col-md-1">
	</div>
	<div class="col-md-12">
		<form action="updateprofile.php" method="POST">
		<label>Name</label>
		<input type="text" name="n1" value="<?php echo $name; ?>" readonly class="form-control"><br>
		<label>Email Id</label>
		<input type="text" name="e1" id="email" value="<?php echo $email; ?>" readonly class="form-control"><br>
		<label>Phone Number</label>
		<input type="text" name="num1" id="number" value="<?php echo $number; ?>" readonly class="form-control" maxlength="10"><br>
		<input type="button" value="Edit Profile" class="btn btn-danger" onclick="update()" name="">
		<input type="submit" class="btn btn-primary text-center" name="s1" value="Update Profile">
		</form>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	function update()
	{
		document.getElementById('email').readOnly=false;
		document.getElementById('number').readOnly=false;
	}
</script>