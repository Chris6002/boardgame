<!DOCTYPE HTML>  
<html>
    <head>
        <title>Boardgame Browsing</title>
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

        $mechanicN = "SELECT DISTINCT(mechanic) FROM games";
        $mechanic = $conn->query($mechanicN);

        $categoryN = "SELECT DISTINCT(name) FROM category";
        $category = $conn->query($categoryN);
        ?>

        <div class = "row justify-content-around">
            <div class="d-flex flex-row bd-highlight mb-3">
             <a href = "home.html" class = "btn btn-secondary">Home</a>
             <a href = "login.html" class = "btn btn-secondary">Log In</a>
             <a href = "display.php" class = "btn btn-secondary">Favorite</a>
            </div>
            
            <h6 class="display-3 align-self-center text-center">
            Browse
            </h6>
            
        </div>

        <?php
        $m = $_POST["mechanic"];
        $c = $_POST["category"];
        $n = $_POST["player"];
        $a = $_POST["age"];
        $sort = $_POST["sortby"];
        ?>

        <form method = "post" >
        <div class = "container d-flex justify-content-center">
            
            <div class = "container col-sm-3">
                
                <label><b>Filter</b></label>
                <div class = "form-group">
                        <label>Category</label>
                        <select class = "form-control" name = "category">
                            <option value = "*">No Preference</option>
                            <?php 
                            while($row = $category->fetch_assoc()){
                                if (isset($c) && $c==$row["name"]){
                                    echo "<option value = \"". $row["name"]."\" selected>".
                                    $row["name"].
                                    "</option>";
                                }else{
                                    echo "<option value = \"". $row["name"]."\">".
                                    $row["name"].
                                    "</option>";
                                }

                            } ?>
                        </select>
                    </div>
                    <div class = "form-group">
                        <label>Mechanic</label>
                        <select class = "form-control" name = "mechanic">
                            <option value = "*">No Preference</option>
                            <?php 
                            while($row = $mechanic->fetch_assoc()){
                                if (isset($m) && $m==$row["mechanic"]){
                                    echo "<option value = \"". $row["mechanic"]."\" selected>".
                                    $row["mechanic"].
                                    "</option>";
                                }else{
                                    echo "<option value = \"". $row["mechanic"]."\">".
                                    $row["mechanic"].
                                    "</option>";
                                }
                            } ?>
                        </select>
                    </div>
                    <div class = "form-group">
                        <label>Number of Players</label>
                        <select class = "form-control" name = "player">
                            <option value = "*" <?php if (isset($n) && $n=="*") echo "selected";?>>No Preference</option>
                            <option value = "1" <?php if (isset($n) && $n=="1") echo "selected";?>>1</option>
                            <option value = "2" <?php if (isset($n) && $n=="2") echo "selected";?>>2</option>
                            <option value = "3" <?php if (isset($n) && $n=="3") echo "selected";?>>3</option>
                            <option value = "4" <?php if (isset($n) && $n=="4") echo "selected";?>>4</option>
                            <option value = "5" <?php if (isset($n) && $n=="5") echo "selected";?>>5</option>
                            <option value = "6" <?php if (isset($n) && $n=="6") echo "selected";?>>6</option>
                            <option value = "7" <?php if (isset($n) && $n=="7") echo "selected";?>>7</option>
                            <option value = "8" <?php if (isset($n) && $n=="8") echo "selected";?>>8</option>
                            <option value = "9" <?php if (isset($n) && $n=="9") echo "selected";?>>9+</option>
                        </select>
                    </div>
                    <div class = "form-group">
                        <label>Youngest Player</label>
                        <input class = "form-control" type = "number" min = "0" name = "age" value = <?php if (isset($a)){ echo $a;} else {echo "18";}?>>
                    </div>
                    <input type = "submit" name = "search-submit" Value = "Search" class="btn btn-primary">
                    <div class = "form-group">
                        <label><b>Sort By</b></label>
                        <select class = "form-control" name = "sortby" onchange="this.form.submit()">
                            <option value = "1" <?php if (isset($sort) && $sort=="1") echo "selected";?>>Name Ascending</option>
                            <option value = "2" <?php if (isset($sort) && $sort=="2") echo "selected";?>>Name Descending</option>
                            <option value = "3" <?php if (isset($sort) && $sort=="3") echo "selected";?>>Rating Ascending</option>
                            <option value = "4" <?php if (isset($sort) && $sort=="4") echo "selected";?>>Rating Descending</option>
                            <option value = "5" <?php if (isset($sort) && $sort=="5") echo "selected";?>>Play Time Ascending</option>
                            <option value = "6" <?php if (isset($sort) && $sort=="6") echo "selected";?>>Play Time Descending</option>
                        </select>
                    </div>
                    
            </div>


        <?php
        $count = 0;


        $search = "SELECT image_url, games.name, mechanic, category.name AS cat_name, bgg_url, avg_rating, avg_time
        FROM games JOIN category ON games.cat_id = category.ID JOIN player ON games.gameID = player.gameID JOIN information ON games.gameID = information.gameID";
        if($m != "*"){
            $search = $search . " WHERE ";
            $search = $search . "mechanic = '$m'";
            $count += 1;
        }
        if($c != "*"){
            if($count != 0){
                $search = $search . " AND category.name = '$c'";
            }else{
                $search = $search . " WHERE ";
                $search = $search . "category.name = '$c'";
                $count += 1;
            }
        }
        if($n != "9" && $n != "*"){
            if($count != 0){
                $search = $search . " AND min_player <=" . $n. " AND max_player >=" . $n;
            }else{
                $search = $search . " WHERE ";
                $search = $search . "min_player <=" . $n. " AND max_player >=" . $n;
                $count += 1;
            }
        }
        else if ($n == "9"){
            if($count != 0){
                $search = $search . " AND min_player <= 8";
            }else{
                $search = $search . " WHERE ";
                $search = $search . "min_player <= 8";
                $count += 1;
            }
        }

        if($count != 0){
            $search = $search . " AND age <= " . $a;
        }else{
            $search = $search . " WHERE ";
            $search = $search . "age <= " . $a;
            $count += 1;
        }

        if(isset($sort)){
            $search = $search . " ORDER BY ";
            if($sort == "1"){
                $search = $search . "name";
            }else if($sort == "2"){
                $search = $search . "name DESC";
            }else if($sort == "3"){
                $search = $search . "avg_rating";
            }else if($sort == "4"){
                $search = $search . "avg_rating DESC";
            }else if($sort == "5"){
                $search = $search . "avg_time";
            }else if($sort == "6"){
                $search = $search . "avg_time DESC";
            }
        }
        ?>

        
        <div class = "container">
            <style>
                .star {
                    visibility:hidden;
                    font-size:30px;
                    cursor:pointer;
                    color:gold;
                }
                .star:checked {
                   content: "\2605";
                   position: absolute;
                   visibility:visible;
                }
                .star:before:checked {
                   content: "\2606";
                   position: absolute;
                }
            </style>

            <?php
            // if(isset($_POST['favorite'])) {
            //     $name = $_POST['favorite'];
            // }} 
            $search = $search . ";";
        
            $result = $conn->query($search);

            

            echo "<table class = \"table table-striped\"><tr><th>Image</th><th>Game Name</th><th>Rating</th><th>Mechanic</th><th>Category</th><th>Average Play Time</th><th>Favorite?</th></tr>";

            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td> <img style= \"width: 64px\" src=\"". $row["image_url"]. "\"> </td><td> <a href = \"" . $row["bgg_url"] . "\">" . $row["name"]. "</a> </td><td>". $row["avg_rating"] . "</td><td>" . $row["mechanic"]. "</td><td>" . $row["cat_name"] . "</td><td>" . $row["avg_time"] ."</td></tr>";

                //      echo "<tr><td> <img style= \"width: 64px\" src=\"". $row["image_url"]. "\"> </td><td> <a href = \"" . $row["bgg_url"] . "\">" . $row["name"]. "</a> </td><td>". $row["avg_rating"] . "</td><td>" . $row["mechanic"]. "</td><td>" . $row["cat_name"] . "</td><td>" . $row["avg_time"] . "</td><td>". "<input class=\"star\" type=\"checkbox\" name=\"favorite\" value=\"gameID\">" ."</td></tr>";
                }
            
            } 
            echo "</table>";
            ?>
        </div>
        

    </div>
    </form>

        <?php
        $mechanic ->free_result();
        $conn->close();
        ?>



    </body>
</html>