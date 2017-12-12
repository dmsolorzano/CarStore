<?php
    include("config.php");
    $error = "";
    
    if(!$db){
        die('Could not connect: '. mysqli_error());
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $firstName = mysqli_real_escape_string($db,$_POST['firstname']);
        $lastName = mysqli_real_escape_string($db,$_POST['lastname']);
        $userName = mysqli_real_escape_string($db,$_POST['username']);
        $passwrd = mysqli_real_escape_string($db,$_POST['password']);
        $email = mysqli_real_escape_string($db,$_POST['email']);
		
        $randString = "purpleDinosaurs";	 											//password hashing
        $hashedPwd = password_hash($userName.$passwrd.$randString, PASSWORD_DEFAULT);
        $userType = "regular user";
        
        $sql = "INSERT INTO users VALUES ('$firstName','$lastName','$userName', '$hashedPwd','$email',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP(),'$userType')";
        
        if ($db->query($sql) === TRUE) {
                echo "New record created successfully";
                header("location: login.php");
            } else {
                $error=  $sql . "<br>" . $db->error;
            }
        }
    $db->close();
?>

<!DOCTYPE html>
<html>
  <body>
    <div class="page login-page">
      <div class="row">
        <div class="top">
	      <a href="mainpage.php">Home</a></h4>
          <h1>Sign-up</h1>
        </div>
        <div class="content">
          <form id="register-form" method="POST">
            <div class="form-group">
              <input id="register-firstname" type="text" name="firstname" required class="input-material">
              <label for="register-firstname" class="label-material">First Name</label>
            </div>
            <div class="form-group">
              <input id="register-lastname" type="text" name="lastname" required class="input-material">
              <label for="register-lastname" class="label-material">Last Name</label>
            </div>
            <div class="form-group">
              <input id="register-username"type="text" name="username" required class="input-material">
              <label for="register-username" class="label-material">User Name</label>
            </div>
            <div class="form-group">
              <input id="register-email"type="email" name="email" required class="input-material">
              <label for="register-email" class="label-material">Email Address</label>
            </div>
            <div class="form-group">
              <input id="register-password"type="password" name="password" required class="input-material">
              <label for="register-passowrd" class="label-material">Password</label>
            </div>
            <input id="register" type="submit" value="Register" class="btn btn-primary">
          </form>Returning user? <a href="login.php" class="signup">Login</a>
        </div>  
      </div>
    </div>
  </body>
</html>
