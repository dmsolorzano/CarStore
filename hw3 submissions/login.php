<?php
    include("config.php");
    $error = "";

    session_start();
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      
        $myusername = mysqli_real_escape_string($db,$_POST['username']);
        $mypassword = mysqli_real_escape_string($db,$_POST['password']);
       
        $sql = "SELECT * FROM users WHERE userName = '$myusername'";
       
        $result = mysqli_query($db,$sql);
       
        $row = mysqli_fetch_assoc($result);
       
        $randString = "purpleDinosaurs";
        $hashedPasswordCheck = password_verify($myusername.$mypassword.$randString, $row['passWord']);
        echo "$hashedPasswordCheck";
        $type = $row['userType'];
        
        if($hashedPasswordCheck == true) {
                $_SESSION['userName'] = $myusername;
                $login_time = "UPDATE users SET time_Login = CURRENT_TIMESTAMP WHERE userName = '$myusername'";
                mysqli_query($db,$login_time);
                
                if($type == "admin") {
                    header("location: admin.php");
                }
                else {
                    header("location: user.php");
                }
        }
        else {
            $error = "Your Username or Password is invalid";
        }
    }
?>

<!DOCTYPE html>
<html>
  <body>
    <div class="page login">
      <div class="top">
        <a href="mainpage.php">Home</a>
        <h1>Login</h1>                    
      </div>          
      <div class="content">
        <form id="login-form" method="post" action="login.php">
          <div class="form-group">
            <input id="login-username" type="text" name="username" required="" class="input-material">
            <label for="login-username" class="label-material">Username</label>
          </div>
          <div class="form-group">
            <input id="login-password" type="password" name="password" required="" class="input-material">
            <label for="login-password" class="label-material">Password</label>
          </div>
          <input type="submit" class="btn btn-primary" value="Login">
        </form>
		Create an account <a href="register.php" class="signup">Sign-up</a>
      </div>
    </div>
  </body>
</html>
