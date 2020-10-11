<?php
$email=$name=$number=$photo="";
session_start();
include"studentconnection.php";
if($_SESSION['login']!=session_id())
{
	header("location:student.php");
}
$q1="select * from student where number='".$_SESSION['number']."'";
$sq=mysqli_query($cn,$q1);
if((mysqli_num_rows($sq)>0)==1)
{
	$row=mysqli_fetch_array($sq);
	 $id=$row['id'];
	 $_SESSION['id']=$id;
	 $name=$row['name'];
	 $email=$row['email'];
	 $num=$row['number'];
	 $photo=$row['photo'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Login</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
  	body
  	{
  		margin:0;
  		padding: 0;
  	}
    #details
    {
      margin-top: 20px;
      font-size: 20px;
    }
  </style>
</head>
<body>
<div class="container-fluid">
	<div class="col-md-12 bg-primary">
		<div class="justify-content-start">
		<img src="<?php echo $photo;?>" style="width: 100px;height: 100px;margin-left: 40px;" class="img-circle">
		<p style="font-size: 40px;text-transform: capitalize;"><span>Hello, </span><?php echo  $name;?></p>
		</div>
	</div>
    <div class="col-md-12">
      <ul class="nav nav-tabs" style="font-size: 20px;">
        <li class="nav-item"><a href="#dashboard" class="nav-link active" data-toggle="tab">Dashboard</a></li>
        <li class="nav-item"><a href="#da" class="nav-link" data-toggle="tab">Download Assignment</a></li>
        <li class="nav-item"><a href="#ua" class="nav-link" data-toggle="tab">Upload Assignment</a></li>
        <li class="nav-item"><a href="#details" class="nav-link" data-toggle="tab">Student details</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link">LogOut</a></li>
      </ul>
    </div>
</div>

    <div class="tab-content">
     
      <div class="tab-pane container active" id="dashboard" >hii i am deepak rajak</div>

      <div class="tab-pane container fade" id="ua" >
        <form method="" action="">
          <div class="form-group">
            <label for="ua" style="font-size: 20px;">Uplaod Assignment</label>
            <input type="file" class="form-control" required name=""><br>
            <span class="text-danger">File Size Must be Less Than <strong>2 MB.*</strong></span>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-success" name="submit">
          </div>
        </form>
      </div>
      <div class="tab-pane container fade" id="da" >
        <h2 class="text-info bg-danger text-center">Download Assignment</h2><br><br>
        <div class="text-center">
        <button class="btn btn-success" style="font-size: 40px;">Download Assignment  <span class=" glyphicon glyphicon-download-alt"></span></button>
          
        </div>
      </div>

      <div class="tab-pane container fade text-center mt-3" id="details" >
        <div id="">
        <div class="row">
          <div class="col-md-2">
            <p class="text-center m-4">student Id</p>
          </div>
          <div class="col-md-5">
            <input type="text" value="<?php echo $id; ?>" class="form-control " readonly name="">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-2">
            <p class="text-center m-4">Email Id</p>
          </div>
          <div class="col-md-5">
            <input type="text" value="<?php echo $email; ?>" class="form-control " readonly name="">
          </div>
        </div>
        <br>
      <div class="row">
          <div class="col-md-2">
            <p class="text-center">Phone Number</p>
          </div>
          <div class="col-md-5">
            <input type="text" value="<?php echo $num; ?>" class="form-control border-0" readonly name="">
          </div>
        </div>
<br>
        <div class="row">
          <div class="col-md-2">
            <p class="text-center">Department</p>
          </div>
          <div class="col-md-5">
            <input type="text" value="<?php   ?>" class="form-control border-0" readonly name="">
          </div>
        </div>
        <br>
        <button class="btn btn-primary text-center btn-lg"><a href="updateprofile.php" style="color: white;">Update Details</a></button>
      </div>
</body>
</html>
