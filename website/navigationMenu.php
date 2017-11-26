<?php 

	//to be able to sign out everywhere there is a menu.
	if (isset($_POST['signout'])) {
    
    unset($_SESSION['regUsername']);
    unset($_SESSION['adminUsername']);
    unset($_SESSION['password']);
    header("location: signin.php");
  }

	//to know in which page we are and select options accordingly
	$current = basename($_SERVER['PHP_SELF']);

	//all pages can navigate to mainpage
	echo "<ul class=\"menu\">";
  		//except mainpage
      if(strcmp($current, "mainpage.php") != 0){
      echo "<li><a href=\"mainpage.php\">Home</a></li>";
      }

      //if not signedin neither as admin or user.
  		if(!(isset($_SESSION['regUsername'])||(isset($_SESSION['adminUsername'])))){

  			//display "go to signin page" option in every page except signin.php 
  			if(strcmp($current, "signin.php") != 0)
  			echo "<li><a href=\"signin.php\">Sign in</a></li>";

        //display "go to signup page" option in every page except signup.php
  			if(strcmp($current, "signup.php") != 0)
  			echo "<li><a href=\"signup.php\">Sign up</a></li>";
  		}

      //if on mainpage, display the filtering options.
      if(strcmp($current,"mainpage.php") == 0){


      //ORDER BY PRICE DROPDOWN
      echo "
            <li>
              <ul class=\"menu\">
              <li>
                <div class=\"filterDropDown\">
                  <label>Order by</label>

                  <select form=\"sortingForm\" name=\"ordering\">
                    <option>Price: High to low</option>";
                    echo
                    "<option>Price: Low to high</option>";
                    echo 
                    "<option selected=\"selected\">None</option>
                  </select>
                </div>
              </li>
      ";


      //CATEGORY DROPDOWN
      echo "
              <li>
                <div class=\"filterDropDown\">
                  <label>Category</label>

                  <select form=\"sortingForm\" name=\"category\">
                  <option selected=\"selected\">All</option>
            ";

                  //query the database for all current categories
                  $query = "SELECT DISTINCT Category FROM inventory";
                  $result = mysqli_query($db, $query);

                  if($result){
                    while($row = $result->fetch_assoc()){
                      foreach($row as $key=>$value){
                        echo "<option>$value</option>";
                      }
                    } 
                  }else{
                    //for now
                    echo "<option>couldnt connect to db</option>";
                  }
              
      echo "
                  </select>
                </div>
              </li>
          ";

      //APPLY BUTTON
      echo "
              <li>
                <div class=\"filterDropDown\">
                  <form method=\"post\" action=\"$current\" id=\"sortingForm\" style=\"padding:0px;\">
                    <input type=\"submit\" style=\"padding:0;\" value=\"Apply\">
                  </form>
                </div>
              </li>      
          ";


      echo "</ul>
            </li>";
      }


      //OPTIONS WHEN LOGGED IN
      if((isset($_SESSION['regUsername'])||(isset($_SESSION['adminUsername'])))){

        //user is signed in, display a "signout" button.
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