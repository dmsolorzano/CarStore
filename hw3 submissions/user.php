<!DOCTYPE html>
<html>

<body>
<ul>
      <li role="menu" class="active"><a href="user.php">User</a></li>
      <li role="menu"><a href="umainpage.php">Home</a></li>
      <li role="menu"><a href="logout.php">Logout</a></li>
    </ul>

<div class>
<h2>Account Information</h2>
<?php
    include('session.php');
        
    $user_check = $_SESSION['userName'];
    $query="SELECT * FROM users WHERE userName LIKE '$user_check'";
    $result=mysqli_query($db, $query);
	
    if(!$result) {
        die('Could not query: '. mysqli_error());
    }
    echo "<b>Signed in As: </b>" .$user_check ."<br>"."<br>";
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_array($result)) {
            echo "<b>First Name:</b> " . $row["firstName"]. "  |  <b>Last Name:</b> " . $row["lastName"]. "  |  <b>UserName:</b> " . $row["userName"].  "  |  <b>Email:</b> " . $row["email"]."  |  <b>User Type:</b> " . $row["userType"]."<br>". "<b>Time of Account Creation:</b> " . $row["time_Account"]. "  |  <b>Time of last login:</b> " . $row["time_Login"]. "<br>"."<br>";
        }
    } else {
        echo "0 results";
    }
?>
</div>

</body>
</html>
