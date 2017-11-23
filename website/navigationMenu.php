<?php 

	//to be able to sign out everywhere there is a menu.
	if (isset($_POST['signout'])) {
    //session_destroy();
    unset($_SESSION['regUsername']);
    unset($_SESSION['adminUsername']);
    unset($_SESSION['password']);
    header("location: signin.php");
  }

	//to know in which page we are and select options accordingly
	$current = basename($_SERVER['PHP_SELF']);

	//all pages can navigate to mainpage
	echo "<ul class=\"menu\">
  		<li><a href=\"mainpage.php\">Home</a></li>";

      //if not signed in neither as admin or user.
  		if(!(isset($_SESSION['regUsername'])||(isset($_SESSION['adminUsername'])))){

  			//display "go to signin page" option in every page except signin.php 
  			if(strcmp($current, "signin.php") != 0)
  			echo "<li><a href=\"signin.php\">Sign in</a></li>";

        //display "go to signup page" option in every page except signup.php
  			if(strcmp($current, "signup.php") != 0)
  			echo "<li><a href=\"signup.php\">Sign up</a></li>";
  		}else{

        //otherwise, user is signed in, display a "signout" button.
        echo "<li style=\"float:right;\">
                  <form class=\"menu\" method=\"post\" action=\"$current\">
                        <button type=\"submit\" name=\"signout\" value=\"Sign Out\">
                          Sign Out
                        </button>
                  </form>
              </li>";

  			//both admins and regular users can visit the normal users area.
  			if((isset($_SESSION['regUsername']))||(isset($_SESSION['adminUsername']))){
  				
          //only show button if currently not in users area.
          if(strcmp($current, "user.php") != 0)
  				echo "<li style=\"float:right;\"><a href=\"user.php\">Users page</a></li>";
  			}

        //only admins can navigate to admins page.
  			if((isset($_SESSION['adminUsername']))){

          //only show button if currently not in admins page.
  				if(strcmp($current, "admin.php") != 0)
  				echo "<li style=\"float:right;\"><a href=\"admin.php\">Admins page</a></li>";
  			}

        //user is signed in, print a greeting.
        if((isset($_SESSION['adminUsername']))){
          echo "<li style=\"float:right;\"><strong style=\" display: block; color: orange; text-align: center; padding: 14px 16px;\">Hi " . $_SESSION['adminUsername']  . "!</strong></li>";
        }else{
          echo "<li style=\"float:right;\"><strong style=\" display: block; color: orange; text-align: center; padding: 14px 16px;\">Hi " . $_SESSION['regUsername']  . "</strong></li>";
        }
  		}
  		
	echo "</ul>";

?>