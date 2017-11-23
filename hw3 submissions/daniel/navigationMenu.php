<?php 

	//to be able to sign out everywhere there is a menu.
	if (isset($_POST['signout'])) {
    session_destroy();
    unset($_SESSION['regUsername']);
    unset($_SESSION['adminUsername']);
    unset($_SESSION['password']);
    header("location: signin.php");
  }

	//to know in which page we are and select options accordingly
	$current = basename($_SERVER['PHP_SELF']);

	//all pages can access the menu
	echo "<ul class=\"menu\">
  		<li><a href=\"mainpage.php\">Home</a></li>";

  		if(!(isset($_SESSION['regUsername'])||(isset($_SESSION['adminUsername'])))){
  			
  			if(strcmp($current, "signin.php") != 0)
  			echo "<li><a href=\"signin.php\">Sign in</a></li>";

  			if(strcmp($current, "userReg.php") != 0)
  			echo "<li><a href=\"userReg.php\">Sign up</a></li>";
  		}else{

        echo "<li style=\"float:right;\">
                  <form class=\"menu\" method=\"post\" action=\"$current\">
                        <button type=\"submit\" name=\"signout\" value=\"Sign Out\">
                          Sign Out
                        </button>
                  </form>
              </li>";

  			//show navigation for areas
  			if((isset($_SESSION['regUsername']))||(isset($_SESSION['adminUsername']))){
  				if(strcmp($current, "user.php") != 0)
  				echo "<li style=\"float:right;\"><a href=\"user.php\">Users page</a></li>";
  			
  			}

  			if((isset($_SESSION['adminUsername']))){
  				if(strcmp($current, "admin.php") != 0)
  				echo "<li style=\"float:right;\"><a href=\"admin.php\">Admins page</a></li>";
  			}

        //print a greeting
        if((isset($_SESSION['adminUsername']))){
        echo "<li style=\"float:right;\"><strong style=\" display: block; color: orange; text-align: center; padding: 14px 16px;\">Hi " . $_SESSION['adminUsername']  . "!</strong></li>";
        
        }else{
          echo "<li style=\"float:right;\"><strong style=\" display: block; color: orange; text-align: center; padding: 14px 16px;\">Hi " . $_SESSION['regUsername']  . "</strong></li>";
        }
  		}
  		
	echo "</ul>";

?>