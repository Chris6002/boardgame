<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <?php
        $username = "lli50";
        $password = "itJNERP%";
        $host = "localhost";
        $database = "lli50_1";
        $conn = new mysqli($host, $username, $password, $database);
            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "USE lli50_1;";
        if ($conn->query($sql) === TRUE) {
        } else {
           echo "Error using database: " . $conn->error;
        }
        session_start();
        // Query:
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password';";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows != 0) {
            // $row = $result->fetch_assoc()
            echo "Logged in successfully";
            $_SESSION['login_user'] = $result['name'];
            header("Location: http://betaweb.csug.rochester.edu/~lli50/display.php");
        } else {
            header("Location: http://betaweb.csug.rochester.edu/~lli50/add_user.php");
        } 

        $conn->close();
        ?>  

        <a href = "home.html" class = "btn btn-info">Home</a>
        <a href = "login.html" class = "btn btn-primary">Log in</a>

    </body>    
</html>