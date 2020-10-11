<?php
$a1=$photoerror='';
session_start();
if(isset($_SESSION['login']))
{
header("location:studentprofile.php");
}
  
  include "studentconnection.php";

if(isset($_POST['s1']))
{
  $name=$_POST['name'];
  $email=$_POST['email'];
  $number=$_POST['number'];
  
  function depart()
  {
  if($_POST['dep']!='')
  {
    return 'y';
  }
  else
  {
    return 'n';
  }
  }
  $pass=$_POST['pass'];
  function photo()
  {
    if($_FILES['studentphoto']['name']!='')
    {
      $photoname=$_FILES['studentphoto']['name'];
      $length=strlen($photoname);
      $position=strpos($photoname,'.');
      $cutposition=strtolower(substr($photoname,$position+1,$length));
      $arrayphoto=array('png','jpg','jpeg','bmp');
      if(in_array($cutposition, $arrayphoto))
      {
        return 'y';
      }
      else
      {
        return 'n';
      }
    }
    else
    {
      return 'n';
    }
  }
  if(photo()=='y')
  {
    $photoname1=$_FILES['studentphoto']['name'];
    $phototemp1=$_FILES['studentphoto']['tmp_name'];
  }
  else
  {
    $photoerror="check photo";
  }
  if(depart()=='y')
  {
    $dep=$_POST['dep'];
  }
  else
  {
    $a1='Please Select department *';
  }
  // echo $name." ".$email." "$number." ".$pass;
  if(depart()=='y'&&photo()=='y')
  {
  $uploadphoto='photo/'.uniqid().$photoname1;
  $q1="insert into student(name,email,number,department,password,photo) values('".$name."','".$email."','".$number."','".$dep."','".$pass."','".$uploadphoto."')";
  $sq=mysqli_query($cn,$q1); 
  if($sq)
  {
    move_uploaded_file($phototemp1,$uploadphoto);
    echo '<script>alert("Register successfully...")</script>';
    // header("refresh:1");
  }
  else
  {
    echo '<script>alert("Data already exits")</script>';
    header("refresh:.5");
  }
}
}
if(isset($_POST['s2']))
{
  $lnumber=$_POST['Lnumber'];
  $lpass=$_POST['Lpass'];
  $q2="select * from student where number='".$lnumber."' && password='".$lpass."'";
  $sq2=mysqli_query($cn,$q2);
  $count=mysqli_num_rows($sq2);
  if($count==1)
  {
    $_SESSION["login"]=session_id();
    $_SESSION["number"]=$_POST["Lnumber"];
    header("location:studentprofile.php");
  }
  else
  {
    echo '<script>alert("You are not register yet..please register first")</script>';
    header("refresh:.1");
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Marwari College Ranchi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <style type="text/css">
    body
    {
      padding: 0;
      margin: 0;
    }
    .h1
    {
      text-transform: capitalize;
      color: white;
    }/*
    .s1
    {
      border: 1px solid blue;
    }*/
    .navbar ul li a:hover
    {
      background-color: #000; 
    }
    .navbar ul li a
    {
      font-size: 25px;
    }
    .active
    {

    }
  </style>
</head>
<body>
<!-- 
  name 
  number 
  password
  profile photo
  email id
  after login
  number
  photo
  email id -->
<div class="container-fluid" style="margin: 0;padding: 0;">
  <div class="col-md-12" style="background-color: #2e51ff;border-radius: 15px;" >
  <h1 class="text-center  h1 ">marwari college ranchi</h1>
</div>  
</div>
<nav class="navbar bg-info navbar-dark navbar-expand-sm justify-content-end m-n2">
  
  <ul class="navbar-nav">
    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
    <li class="nav-item"><a href="studentlogin.php" class="nav-link">Student Login</a></li>
    <li class="nav-item"><a href="help.php" class="nav-link">Help</a></li>
  </ul>
</nav>
<br>
<div class="container-fluid">
  <div class="row">
  <div class="col-md-5 s1" >
    <p class="text-center text-primary" style="font-size: 30px;text-decoration: underline;">Student Registration</p>
    <form action="index.php" method="POST"  enctype="multipart/form-data">
      <div class="form-group was-validated">
      <label>Name<span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="name" required>
    </div>
    <div class="form-group was-validated">
    <label>Email Id<span class="text-danger">*</span></label>      
    <input type="email" class="form-control" name="email" required>
  </div>
  <div class="form-group was-validated">
    <label>Number<span class="text-danger">*</span></label>      
    <input type="text" class="form-control" name="number" maxlength="10" required>
  </div>
    <label>Department<span class="text-danger">*</span></label>
    <select class="form-control border-bottom" name="dep" searchable="search here" >
      <option class="" value="" selected>Select Department</option>
      <option class="" value="BCA">BCA</option>
      <option class="" value="MCA">MCA</option>
      <option class="" value="BCM">BCM</option>
      <option class="" value="IT">IT</option>
      <option class="" value="IT">BSC</option>
    </select>
    <span style="color: red"><?php echo $a1;?></span>
    <br>
    <div class="form-group was-validated">
    <label>Password<span style="color: red;">*</span></label>
    <input type="text" class="form-control" name="pass" required>
  </div>
  <div class="form-group ">
    <label>Photo<span style="color: red;">*</span></label>
    <input type="file" name="studentphoto" class="form-control">
    <span style="color: red;"><?php echo $photoerror; ?></span>
    </div>
    <input type="submit" value="submit" class="btn btn-primary" style="font-size: 20px" name="s1">

    </form>
  </div>
  <div class="col-md-5 s1" style="margin-left: 100px">
      <p class="text-center text-success" style="font-size: 30px;text-decoration: underline;">Student Login</p>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="was-validated" method="POST">
        <div class="form-group">
          <label for="number">Phone Number</label>
          <input type="text" id="" class="form-control" name="Lnumber" maxlength="10">
        </div>
      <label>Password</label>
      <input type="password" class="form-control" name="Lpass"><br>
      <input type="submit" class="btn btn-success" value="Login" name="s2" style="font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="Forget.php" style="font-size: 20px;text-decoration: underline;">Forget Password?</a>
    </form>
  </div>
</div>
</div><br><br>
<footer class="text-center bg-primary" style="padding: 20px">
  All Copyright Reserved<br>
  <script type="text/javascript">
    var n=new Date();
    document.write(n);
  </script>
</footer>
</body>
</html>
