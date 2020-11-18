<?php
//This line will make the page auto-refresh each 15 seconds
$page = $_SERVER['PHP_SELF'];
$sec = "15";
?>
<?php

$link=mysqli_connect("localhost","root","");
$con = mysqli_select_db($link,"login");


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
<!--//I've used bootstrap for the tables, so I inport the CSS files for taht as well...-->
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">		
<!-- jQuery library -->
<script src="jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="bootstrap.min.js"></script>
<title>Dashboard</title>
</head>
<input type="checkbox" id="check">
<div class="content">

<?php

include("database_connect1.php");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
   
	


$result = mysqli_query($con,"SELECT * FROM ESPtable2");//table select

	
echo "<table class='table' style='font-size: 30px;'>
	<thead>
		<tr>
		<th>Value Indicators</th>	
		</tr>
	</thead>
	
    <tbody>
      <tr class='active'>
        <td>Current Value(A) </td>
        <td>Voltage Value(V) </td>
        <td>Power(KW) </td>
		<td>Energy Consumed(KWh) </td>
      </tr>  
		";
		  

while($row = mysqli_fetch_array($result)) {

 	echo "<tr class='info'>";
    
	echo "<td>" . $row['SENT_NUMBER_1'] . "</td>";
	echo "<td>" . $row['SENT_NUMBER_2'] . "</td>";
	echo "<td>" . $row['SENT_NUMBER_3'] . "</td>";
	echo "<td>" . $row['SENT_NUMBER_4'] . "</td>";

	echo "</tr>
	</tbody>"; 

	
}
echo "</table>
<br>
";
?>
<?php
include("database_connect1.php"); //We include the database_connect.php which has the data for the connection to the database


// Check the connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//Again, we grab the table out of the database, name is ESPtable2 in this case
$result = mysqli_query($con,"SELECT * FROM ESPtable2");//table select


		  
//Now we create the table with all the values from the database	  
echo "<table class='table' style='font-size: 30px;'>
	<thead>
		<tr>
		<th>Meter Control</th>	
		</tr>
	</thead>
	
    <tbody>
      <tr class='active'>
        <td>Meter ID</td>
        <td>Power control </td>
              </tr>  
		";
		  
//loop through the table and print the data into the table
while($row = mysqli_fetch_array($result)) {
	
   echo "<tr class='success'>"; 	
    $unit_id = $row['id'];
    echo "<td>" . $row['id'] . "</td>";
	
    $column1 = "RECEIVED_BOOL1";
   	
    $current_bool_1 = $row['RECEIVED_BOOL1'];

	if($current_bool_1 == 1){
    $inv_current_bool_1 = 0;
	$text_current_bool_1 = "ON";
	$color_current_bool_1 = "#6ed829";
	}
	else{
    $inv_current_bool_1 = 1;
	$text_current_bool_1 = "OFF";
	$color_current_bool_1 = "#e04141";
	}
	
	
	
	echo "<td><form action= update_values.php method= 'post'>
  	<input type='hidden' name='value2' value=$current_bool_1   size='15' >	
	<input type='hidden' name='value' value=$inv_current_bool_1  size='15' >	
  	<input type='hidden' name='unit' value=$unit_id >
  	<input type='hidden' name='column' value=$column1 >
  	<input type= 'submit' name= 'change_but' style=' margin-left: 10%; margin-top: 0; font-size: 30px; text-align:center; background-color: $color_current_bool_1' value=$text_current_bool_1></form></td>";
	
     
	
	
	echo "</tr>
	  </tbody>"; 
	
}
echo "</table>
<br>
";	
?>
	
		
<?php

include("database_connect1.php");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$result = mysqli_query($con,"SELECT * FROM ESPtable2");//table select


		
   echo "<table class='table' style='font-size: 30px;'>
	<thead>
		<tr>
		<th>Send Text to Noobix</th>	
		</tr>
	</thead>
	
    <tbody>
      <tr class='active'>
        <td>Text</td>        
      </tr>  
		";

while($row = mysqli_fetch_array($result)) {

 	 echo "<tr class='success'>";	
	
    $column11 = "TEXT_1"; 
    $current_text_1 = $row['TEXT_1'];
	
		
	echo "<td><form action= update_values.php method= 'post'>
  	<input style='width: 100%;' type='text' name='value' value=$current_text_1  size='100'>
  	<input type='hidden' name='unit' value=$unit_id >
  	<input type='hidden' name='column' value=$column11 >
  	<input type= 'submit' name= 'change_but' style='text-align:center' value='Send'></form></td>";
	
    echo "</tr>
	  </tbody>";      
	
}
echo "</table>
<br>
<br>
<hr>";
		
?>
		
		
<?php
include("database_connect1.php");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM ESPtable2");//table select

echo "<table class='table' style='font-size: 30px;'>
	<thead>
		<tr>
		<th>Phase Indicators</th>	
		</tr>
	</thead>
	
    <tbody>
      <tr class='active'>
        <td>Meter ID</td>
        <td>Red Phase Ind</td>
        <td>Yellow Phase Ind</td>
		<td>Blue Phase Ind</td>
      </tr>  
		";
	  
	
	
while($row = mysqli_fetch_array($result)) {

 	$cur_sent_bool_1 = $row['SENT_BOOL_1'];
	$cur_sent_bool_2 = $row['SENT_BOOL_2'];
	$cur_sent_bool_3 = $row['SENT_BOOL_3'];
	

	if($cur_sent_bool_1 == 1){
    $label_sent_bool_1 = "label-success";
	$text_sent_bool_1 = "Active";
	}
	else{
    $label_sent_bool_1 = "label-danger";
	$text_sent_bool_1 = "Inactive";
	}
	
	
	if($cur_sent_bool_2 == 1){
    $label_sent_bool_2 = "label-success";
	$text_sent_bool_2 = "Active";
	}
	else{
    $label_sent_bool_2 = "label-danger";
	$text_sent_bool_2 = "Inactive";
	}
	
	
	if($cur_sent_bool_3 == 1){
    $label_sent_bool_3 = "label-success";
	$text_sent_bool_3 = "Active";
	}
	else{
    $label_sent_bool_3 = "label-danger";
	$text_sent_bool_3 = "Inactive";
	}
	 
		
	  echo "<tr class='info'>";
	  $unit_id = $row['id'];
        echo "<td>" . $row['id'] . "</td>";	
		echo "<td>
		<span class='label $label_sent_bool_1'>"
			. $text_sent_bool_1 . "</td>
	    </span>";
		
		echo "<td>
		<span class='label $label_sent_bool_2'>"
			. $text_sent_bool_2 . "</td>
	    </span>";
		
		echo "<td>
		<span class='label $label_sent_bool_3'>"
			. $text_sent_bool_3 . "</td>
	    </span>";
	  echo "</tr>
	  </tbody>"; 
      

	
}
echo "</table>";
?>


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
<h4><?php echo htmlspecialchars($_SESSION["username"]);?></h4>
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




















