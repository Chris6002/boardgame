<!DOCTYPE html>
<html>
	<?php
	   session_start();
	   if(empty($_SESSION['login_user'])) {
	   		header("Location: http://betaweb.csug.rochester.edu/~lli50/login.html");
	   		die();
	   }
	?>   
	<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>

        <div class = "row justify-content-around">
        	<div class="d-flex flex-row bd-highlight mb-3">
                <a href = "browse.php" class = "btn btn-secondary">Browse</a>
            	<a href = "logout.php" class = "btn btn-secondary">Log Out</a>
            </div>
           
            <h6 class="display-3 align-self-center text-center">
            Welcome back, <?php echo $_SESSION['login_user']; ?>

            <div class="d-flex flex-column bd-highlight mb-3">
            </div>

            </h6> 
        </div>

		<?php
		$username = "lli50";
		$password = "itJNERP%";
		$host = "localhost";
		$database = "lli50_1";

		$conn = new mysqli($host, $username, $password, $database);
		
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		// Bookmark Table
		$sql5 = "SELECT * FROM bookmark";
		$res5 = $conn->query($sql5);

		echo "<table><tr><th>Email</th><th>Game ID</th></tr>";

		if ($result->num_rows > 0) {
		    
		    // output data of each row
		    while($row = $res5->fetch_assoc()) {
		        echo "<tr><td>" . $row["email"]. "</td><td>" . $row["gameID"] . "</td></tr>";
		    }
		    
		} else {
		     echo "0 results\n";
		}
		echo "</table>";
		
		$conn->close();
		?>

	</body>
</html>