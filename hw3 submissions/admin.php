<!DOCTYPE html>
<html>
<body>
  <nav>
    <ul>
      <li role="menu"><a href="admin.php">Admin</a></li>
      <li role="menu"><a href="amainpage.php">Home</a></li>
      <li role="menu"><a href="addUser.php">Add User</a></li>
      <li role="menu"><a href="logout.php">Logout</a></li>
    </ul>
  </nav>
  <div class="container">
    <h2>List of Users</h2>
<?php
    include('session.php');
    
    $user_check = $_SESSION['userName'];
    $query="SELECT * FROM users";
    $result=mysqli_query($db, $query);
    if(!$result) {
        die('Could not query: '. mysqli_error());
    }
    
    if (mysqli_num_rows($result) > 0) {
        echo "<b>Signed in As: </b>" .$user_check ."<br>"."<br>";
		//echo <h2>List of Users</h2>
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
