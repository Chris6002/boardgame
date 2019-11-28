<!DOCTYPE html>
<html>
	<head>
		<style>
			table, th, td {
			    border: 1px solid black;
			}
		</style>
	</head>
	<body>

		<ul>
            <li><a href = "home.html">Home</a></li>
            <li><a href = "login.html">Log in</a></li>
        </ul>

		<?php
		$username = "lli50";
		$password = "itJNERP%";
		$host = "localhost";
		$database = "lli50_1";

		$conn = new mysqli($host, $username, $password, $database);
		
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		// Board Game Table
		$sql0 = "SELECT * FROM games";
		$res0 = $conn->query($sql0);

		// schema
		    echo "<table><tr><th>Game ID</th><th>Name</th><th>Image URL</th><th>Mechanic</th><th>Purchase URL</th><th>Cat_ID</th></tr>";
		    
		if ($res0->num_rows > 0) {

			
		    
		    while($row = $res0->fetch_assoc()) {
		        echo "<tr><td>" . $row["gameID"]. "</td><td>" . $row["name"]. "</td><td>". $row["image_url"]. "</td><td>" . $row["mechanic"] . "</td><td>" . $row["bgg_url"] . "</td><td>" . $row["cat_id"] . "</td></tr>";
		    }
		    
		} else {
		     echo "0 results\n";
		}

		echo "</table>";

		// Player Table
		$sql1 = "SELECT * FROM player";
		$res1 = $conn->query($sql1);

		echo "<table><tr><th>Game ID</th><th>Min Player</th><th>Max Player</th><th>age</th></tr>";
		if ($res1->num_rows > 0) {
		    
		    
		    while($row = $res1->fetch_assoc()) {
		        echo "<tr><td>" . $row["gameID"]. "</td><td>" . $row["min_player"]. "</td><td>". $row["max_player"]. "</td><td>" . $row["age"] . "</td></tr>";
		    }
		   
		} else {
		    echo "0 results\n";
		}
		echo "</table>";

		// Information Table
		$sql2 = "SELECT * FROM information";
		$res2 = $conn->query($sql2);
		
		echo "<table><tr><th>Game ID</th><th>Avg Rating</th><th>Geek Rating</th><th>Max Time</th><th>Min Time</th><th>Avg Time</th></tr>";
		if ($res2->num_rows > 0) {
		    

		    while($row = $res2->fetch_assoc()) {
		        echo "<tr><td>" . $row["gameID"]. "</td><td>" . $row["avg_rating"]. "</td><td>". $row["geek_rating"]. "</td><td>" . $row["max_time"] . "</td><td>" . $row["min_time"] . "</td><td>" . $row["avg_time"] . "</td></tr>";
		    }
		   
		} else {
		     echo "0 results\n";
		}
		echo "</table>";

		// User Table
		$sql3 = "SELECT * FROM users";
		$res3 = $conn->query($sql3);
		
		echo "<table><tr><th>Email</th><th>Name</th><th>Password</th></tr>";
		if ($res3->num_rows > 0) {
		    
		    // output data of each row
		    while($row = $res3->fetch_assoc()) {
		        echo "<tr><td>" . $row["email"]. "</td><td>" . $row["name"]. "</td><td>" . $row["password"]. "</td></tr>";
		    }
		    
		} else {
		     echo "0 results\n";
		}
		echo "</table>";

		// Category Table
		$sql4 = "SELECT * FROM category";
		$res4 = $conn->query($sql4);

		echo "<table><tr><th>ID</th><th>Name</th><th>Reco Cat</th></tr>";
		if ($res4->num_rows > 0) {
		    
		    // output data of each row
		    while($row = $res4->fetch_assoc()) {
		        echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["name"]. "</td><td>" . $row["reco_cat"]. "</td></tr>";
		    }
		} else {
		     echo "0 results\n";
		}
		echo "</table>";

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