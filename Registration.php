<?php
session_start();
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $name = $email = $phone = $avatar = $password = $confirm_password = "";
$username_err = $name_err = $email_err = $phone_err = $avatar_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	 // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter your Username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This name have been registered.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
 
    // Validate username
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your full name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name);
            
            // Set parameters
            $param_name = trim($_POST["name"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $name_err = "This name have been registered.";
                } else{
                    $name = trim($_POST["name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email have been registered.";
                } else{
                    $email = trim($_POST["email"]);
			  }

            // Close statement
            mysqli_stmt_close($stmt);
                }
			}
            
	    // Validate username
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter your phone number.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE phone = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_phone);
            
            // Set parameters
            $param_phone = trim($_POST["phone"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $phone_err = "This number have been registered.";
                } else{
                    $phone = trim($_POST["phone"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
			  }

            // Close statement
            mysqli_stmt_close($stmt);
            }
		}
		
		// Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
		 
         }
    }
    $filename = $_FILES["avatar"]["name"]; 
    $tempname = $_FILES["avatar"]["tmp_name"];
	$fileError = $_FILES["avatar"]["error"]; 
	$fileSize = $_FILES["avatar"]["size"];
	$fileType = $_FILES["avatar"]["type"];
	
	$fileExt = explode('.', $filename);
	$fileActualExt = strtolower(end($fileExt));
	$allowed = array('jpg', 'jpeg', 'png', 'gif');
          
  if(in_array($fileActualExt, $allowed)){
	  if($fileError === 0){
		  if ($fileSize < 1024000){
			  $fileNameNew = $phone.".".$fileActualExt;
			  $folder = "uploads/".$fileNameNew;
			  move_uploaded_file($tempname, $folder);
			  }else{
				  echo $avatar_err = "File size is too big, upload lower file size";
				  }
		  }else{
			  echo $avatar_err = "There was an error uploading your picture!";
			  }
	  }else{
		  echo $avatar_err = "You cannot upload file of this type, input image!";
		  }
  
        // Get all the submitted data from the form 
         
          
        // Now let's move the uploaded image into the folder: image 
       
  $result = mysqli_query($link, "SELECT * FROM users"); 
  
    // Check input errors before inserting in database
    if(empty($username_err) && empty($name_err) && empty($email_err) && empty($number_err) && empty($password_err) && empty($confirm_password_err) && empty($avatar_err)){
        
       
        $sql = "INSERT INTO users (username, name, email, phone, password, avatar) VALUES (?, ?, ?, ?, ?, ?)";
		
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_name, $param_email, $param_phone, $param_password, $param_avatar);
            
            // Set parameters
            $param_username = $username;
		    $param_name = $name;
            $param_email = $email; 
		    $param_phone = $phone;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
			$param_avatar = $fileNameNew;
		    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: welcome.php");
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <title>Sign Up</title>
    <link href="Style register.css" rel="stylesheet" type="text/css"text/css">
    </style>
</head>
<body>
    <div class="wrapper">
     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="Username" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
             <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="username" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>    
             <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="username" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
             <div class="form-group <?php echo (!empty($number_err)) ? 'has-error' : ''; ?>">
            <label>Phone number</label>
           <input type="username" id="phone" name="phone" class="form-control" value="<?php echo $phone; ?>">
                <span class="help-block"><?php echo $phone_err; ?></span>
            </div>
            <div class=""custom-file" <?php echo (!empty($avatar_err)) ? 'has-error' : ''; ?>">
            <label for="avatar">Profile Image</label>
           <input type="file" accept="image/*" id="avatar" name="avatar" class="custom-file-class" value="<?php echo $avatar; ?>">
            <span class="help-block"><?php echo $avatar_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="button" class="btn btn-secondary" value="Back" onclick="history.back()">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <b>Already have an account? <a href="login.php">Login here</a>.</b>
        </form>
        </form>
    </div>    
</body>
</html>