<?php
// Include config file
require_once 'connect.php';
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $name = $email = $mobile = $gender = "" ;
$username_err = $password_err = $confirm_password_err = $name_err = $email_err = $mobile_err = $gender_err = "" ;
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM bndusers WHERE username = ?";
        
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
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later UserNameERROR.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    
// Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter Name.";
    }
       if ($stmt = mysqli_prepare($link)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name);

            // Set parameters
           $param_name = trim($_POST["name"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
            }
                 $name = trim($_POST["name"]);
          // Close statement
          mysqli_stmt_close($stmt);
      }

// Validate Email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter Email.";
    }
       if ($stmt = mysqli_prepare($link)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
            }
                 $email = trim($_POST["email"]);
          // Close statement
          mysqli_stmt_close($stmt);
      }

// Validate Mobile
    if(empty(trim($_POST["mobile"]))){
        $mobile_err = "Please enter Mobile.";
    }
       if ($stmt = mysqli_prepare($link)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_mobile);

            // Set parameters
            $param_mobile = trim($_POST["mobile"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
            }
                 $mobile = trim($_POST["mobile"]);
          // Close statement
          mysqli_stmt_close($stmt);
      }


// Validate Gender
    if(empty(trim($_POST["gender"]))){
        $gender_err = "Please select Gender.";
    }
       if ($stmt = mysqli_prepare($link)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_gender);

            // Set parameters
            $param_gender = trim($_POST["gender"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
            }
                 $gender = trim($_POST["gender"]);
          // Close statement
          mysqli_stmt_close($stmt);
}



    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($name_err) && empty($email_err) && empty($mobile_err) && empty($gender_err)){
        
        // Prepare an insert statement
        $sql1 = "INSERT INTO bndusers (username, password, name, email, mobile, gender) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql1)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password, $param_name, $param_email, $param_mobile, $param_gender );
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_name = $name;
	    $param_email = $email;
	    $param_mobile = $mobile;
	    $param_gender = $gender;
            

	// Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: loggin.php");
            } else{
                echo "Something went wrong. Please try again later Inpute .";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
	.error {color: #FF0000;}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please Fill this form to Create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
		<span class="error">*</span>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
		<span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <span class="error">*</span>
		<input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
		<span class="error">*</span>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
	    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <span class="error">*</span>
		<input type="text" name="name"class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>    
	    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
		<span class="error">*</span>
                <input type="text" name="email"class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
	    <div class="form-group <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>">
                <label>Mobile</label>
                <span class="error">*</span>
		<input type="text" name="mobile"class="form-control" value="<?php echo $mobile; ?>">
                <span class="help-block"><?php echo $mobile_err; ?></span>
            </div>
	    <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                <label>Gender</label>
		<span class="error">*</span>
         	<input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="male")echo "checked";?> value="male">Male
                <span class="help-block"><?php echo $gender_err; ?></span>
            </div>
            <div class="form-group">
		<input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="loggin.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
