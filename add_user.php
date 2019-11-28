<!DOCTYPE HTML>  
<html>
    <head>
        <title>Create Account</title>
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
        if ($conn->query($sql) == TRUE) {
        } else {
           echo "Error using  database: " . $conn->error;
        }

        //form validation
        $nameErr = $emailErr = $passwordErr = "";
        $name = $email = $password = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            $nameErr = "";
            if (!preg_match("/\w{4,8}/",$name)) {
            $nameErr = "Invalid name format";
            }
        }
        
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            $emailErr = "";
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            }
        }
            
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } else {
            $password = test_input($_POST["password"]);
            $passwordErr = "";
            if (!preg_match("/^([a-zA-Z0-9@*#]{8,15})$/",$password)) {
            $passwordErr = "Invalid password format";
            }
        }
        }

        function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
        ?>

        <h6 class="display-3 text-center">Create Account</h6>
        <div class = "d-flex justify-content-center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
                <div class = "form-group">
                    <label>Email</label>
                    <label style = "color: red">*</label>
                    <input type = "email" name = "email" class = "form-control" value="<?php echo $email;?>">
                    <span style = "color: red"><?php echo $emailErr;?></span>
                    <small class = "form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class = "form-group">
                    <label>User name</label>
                    <label style = "color: red">*</label>
                    <input type = "text" name = "name" class = "form-control" value="<?php echo $name;?>">
                    <span style = "color: red"><?php echo $nameErr;?></span>
                    <small class = "form-text text-muted">4-8 characters, letters and numbers only.</small>
                </div>
                <div class = "form-group">
                    <label>Password</label>
                    <label style = "color: red">*</label>
                    <input type = "password" name = "password" class = "form-control">
                    <span style = "color: red"><?php echo $passwordErr;?></span>
                    <small class = "form-text text-muted">8-12 characters, including *@#.</small>
                    <small class="form-text text-muted">We adopt industry standard for password storage (<b>NO encryption</b>).</small>
                </div>
                <input type = "submit" Value = "Create" class="btn btn-success">
                <a href = "home.html" class = "btn btn-info">Home</a>
            </form>
        </div>


        <?php
        
        // Query:
        if($email != "" && $password != "" && $name != "" && $nameErr == "" && $emailErr == "" && $passwordErr == ""){
            $check = "SELECT * FROM users WHERE email = '$email';";

            $duplicate = $conn->query($check);
            if($duplicate->num_rows != 0){ 
                echo "<h4 class = 'text-center'> Account already exist </h4><br>";
                echo "<p class = 'text-center'> Redirecting you to the log in page...</p>";
                header("refresh:2; url = http://betaweb.csug.rochester.edu/~lli50/login.html");
            }else{
                $sql = "INSERT INTO users values ('$email', '$name', '$password');";
                $result = $conn->query($sql);
                
                if ($result == TRUE) {
                    echo "New account created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                } 
            }
        }
        

        $conn->close();
        ?>  


    </body>
</html>