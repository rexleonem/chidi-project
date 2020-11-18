<?php
session_start();
// Include config file
require_once "config.php";
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
// Define variables and initialize with empty values
$name = $email = $phone = $comment = "";
$name_err = $email_err = $phone_err = $comment_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	 // Validate username
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your Fullname.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM contact_us WHERE name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name);
            
            // Set parameters
            $param_name = trim($_POST["name"]);
			
			 if(mysqli_stmt_num_rows($stmt) == 1){
                   $name = trim($_POST["name"]);
                } else{
                    $name = trim($_POST["name"]);
                }
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
               
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	
	if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your Email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM contact_us WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
			
			
			 if(mysqli_stmt_num_rows($stmt) == 1){
                   $email = trim($_POST["email"]);
                } else{
                    $email = trim($_POST["email"]);
                }
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
               
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter your phone number.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM contact_us WHERE phone = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_phone);
            
            // Set parameters
            $param_phone = trim($_POST["phone"]);
			
			
			 if(mysqli_stmt_num_rows($stmt) == 1){
                   $phone = trim($_POST["phone"]);
                } else{
                    $phone = trim($_POST["phone"]);
                }
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
               
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	if(empty(trim($_POST["comment"]))){
        $comment_err = "Please enter your message here.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM contact_us WHERE comment = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_comment);
            
            // Set parameters
            $param_comment = trim($_POST["comment"]);
			
			
			 if(mysqli_stmt_num_rows($stmt) == 1){
                   $comment = trim($_POST["comment"]);
                } else{
                    $comment = trim($_POST["comment"]);
                }
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
               
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
 
 $result = mysqli_query($link, "SELECT * FROM contact_us"); 
  
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($number_err) && empty($comment_err)){
        
       
        $sql = "INSERT INTO contact_us (name, email, phone, comment) VALUES (?, ?, ?, ?)";
		
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_email, $param_phone, $param_comment);
            
            // Set parameters
           
		    $param_name = $name;
            $param_email = $email; 
		    $param_phone = $phone;
		    $param_comment = $comment;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    
    // Close connection
    mysqli_close($link);
}
    
	

?>

<head>
    <meta charset="UTF-8"> 
    <title>Contact Us</title>
    <link href="bootstrap.min.css" rel="stylesheet" type="text/css">
     <link href="" rel="stylesheet" type="text/css">
    </style>
</head>
<body>
    <div class="Contact">
     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Contact Us</h2>
        <p>Please contact us below by filling these forms.</p>
        <form>  
             <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="input-group" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>    
             <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="input-group" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
             <div class="form-group <?php echo (!empty($number_err)) ? 'has-error' : ''; ?>">
            <label>Phone number</label>
           <style type="text/css"> input type{width:80px}  </style><input type="tel" id="phone" name="phone" class="input-group" cols="50" value="<?php echo $phone; ?>">
                <span class="help-block"><?php echo $phone_err; ?></span>
            </div>
            <div class="input-row <?php echo (!empty($comment_err)) ? 'has-error' : ''; ?>">
                <label>Message</label> 
                <span id="userMessage-info" class="info" value="<?php echo $phone; ?>"></span><br /><textarea name="comment" id="comment" class="input-field" cols="50" rows="6"></textarea>
            <span class="help-block"><?php echo $comment_err; ?></span>         
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
        </form>
    </div>    
    <div class="Social">
    <p>You can also contact us by clicking the following social media below</p>
    <a href="https://+2349032781635"><img src="Avatar/telephone-call-centurylink-email-computer-icons-phone-69df0ad0cb0a3c55d48c6f68282afd7e.png" height="100px" width="100px";></a>
    <a href="https://wa.me/2349032530932"><img src="Avatar/5bbf55eb0cc72-acf44fc9a66ba6d4423372f4cb857e8b.png" height="100px" width="100px";></a>
    <a href="https://facebook.com/nwokike.chidiebere.22"><img src="Avatar/computer-icons-facebook-clip-art-facebook-ef402e7a453e280a82ff3460d8e203db.png" height="100px" width="100px";></a>
     <a href="https://mail.google.com/nwokikechidiebere4"><img src="Avatar/5bbf49febb863-afa7df87517031884f8497d95ba17cb7.png" height="100px" width="100px";></a>
      
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


  