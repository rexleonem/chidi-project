<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: Login.php");
    exit;
}
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style.css"><link href="bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="style.css"><link href="fontawesome/css/all.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<input type="checkbox" id="check">
<div class="content">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="Style login 1.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; color:#fff;}
		
    </style>
</head>
<body>
    <div class="page-header">
    <p><?php
$con = mysqli_connect('localhost', 'root', '', 'login');
$sql = "SELECT * FROM users where id = '$_SESSION[id]'";
$q = mysqli_query($con, $sql);
$result1 = $con->query($sql);
while($row = mysqli_fetch_assoc($result1)){
	echo "<img src='uploads/".$row['avatar']."' class='profile_image' alt=''>";
	}
?></p>
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome.</h1>
    </div>
    
</body>
</div>	

	

<body>




<header>
<label for="check"><i class="fas fa-bars" id="sidebar_btn"></i></label>

<div class="left_area">
<h3>MALI<span>TECH</span></h3>
</div>
<div class="right_area">
<a href="logout.php" class="logout_btn">Logout</a>
</div>
</header>




<div class="sidebar">
<center>
<?php
$con = mysqli_connect('localhost', 'root', '', 'login');
$sql = "SELECT * FROM users where id = '$_SESSION[id]'";
$q = mysqli_query($con, $sql);
$result1 = $con->query($sql);
while($row = mysqli_fetch_assoc($result1)){
	echo "<img src='uploads/".$row['avatar']."' class='profile_image' alt=''>";
	}
?>
<h4><?php echo htmlspecialchars($_SESSION["username"]); ?></h4>
</center>
<a href="welcome.php"><i class="fas fa-home"></i><span>Home</span></a>
<a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
<a href="#"><i class="fas fa-user"></i><span>Profile</span></a>
<a href="contact_us.php"><i class="fa fa-phone"></i><span>Contact Us</span></a>
<a href="reset-password1.php"><i class="fas fa-key"></i><span>Reset Password</span></a>
<a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Sign Out</span></a>
</div>

</body>
</html>
