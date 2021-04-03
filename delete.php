<?php
    if(isset($_POST['invisible']))
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $con = mysqli_connect($server, $username, $password);
        if(!$con)
        {
            die("Connection to this database failed due to".mysqli_connect_error());
        }

        $invisible = $_POST['invisible'];
        echo file_get_contents('admin_page.html');
        echo "

        <div class='container'>
            <h3> Enter the Medicine name to search and delete: <h3>
            <form action = 'delete.php' method='post' autocomplete='off'>
                <div class='form-group'>
                <label><b>Medicine Name:</b></label>
                <input type='text' class-'form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                </div>
                <button type='submit' class='btn btn-search' style='background-color: green; color: white; margin-top:20px'>Search</button>
            </form>
        </div>
        
        ";
    }

    if(isset($_POST['medicine_name']))
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $con = mysqli_connect($server, $username, $password);
        if(!$con)
        {
            die("Connection to this database failed due to".mysqli_connect_error());
        }
        $medicine = $_POST['medicine_name'];
        $sql = "SELECT * FROM `pharmaz`.`medicines` WHERE med_name like '%$medicine%';";

        if($con->query($sql)==true)
        {
            $result = $con->query($sql);
            if($result->num_rows>0)
            {
                $s = "";
                $c = 0;
                while($row=$result->fetch_assoc())
                {
                    $s = $s."<tr>";
                    $s = $s."<td><b>".strval($row["med_id"])."</b></td>";
                    $s = $s."<td><b>".strval($row["med_name"])."</b></td>";
                    $s = $s."<td><b>".strval($row["mg"])."</b></td>";
                    $s = $s."<td><b>".strval($row["price"])."</b></td>";
                    $temp_price = $row["price"];
                    $d = 10000 + $c;
                    $s = $s."<input type='text' name='$d' id='$d' value='$temp_price' hidden>";
                    $s = $s."<td><b>".strval($row["available"])."</b></td>";
                    $s = $s."</tr>";
                    $c++;
                }
                echo file_get_contents("admin_page.html");
                echo "

        <div class='container'>
            <h3> Enter the Medicine name to search and delete: <h3>
            <form action = 'delete.php' method='post' autocomplete='off'>
                <div class='form-group'>
                <label><b>Medicine Name:</b></label>
                <input type='text' class-'form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                </div>
                <button type='submit' class='btn btn-search' style='background-color: green; color: white; margin-top:20px'>Search</button>
            </form>
        </div>
        
        ";
                echo 
                "
                <form action='delete.php' method='post' style='display: flex;   flex-flow: row wrap; align-items: center;'>
                <table class='table table-bordered table-hover' style='border-width: 5px;'>
                <thead>
                <tr>
                    <th>Medicine ID</th>
                    <th>Medicine name</th>
                    <th>mg</th>
                    <th>Price</th>
                    <th>Available</th>
                </tr>
                </thead>
                <tbody style='font-size: 15px;''>"
                .$s
                ."</tbody>
                </table>
                <div>
                <label style='display: flex; flex-flow: column wrap; align-items: center;'><b>Select Medicine ID from above</b></label>
                <input type='text' name='medicine_id' id='medicine_id' placeholder='Enter the Medicine ID to delete' style='width:300px; margin-left:50px' required>
                </div>
                <div>
                <label style='margin-top: 20px; display: flex; flex-flow: column wrap; align-items: center;'><b>Select Quantity to delete</b></label>
                <input type='text' name='quantity' id='quantity' placeholder='Enter the Quantity to delete' style='width:300px; margin-left:50px' required>
                </div>
                <br><br>
                <button type='submit' class='btn-primary' style='margin-bottom: 10px; display: flex; flex-flow: row wrap; align-items: center;'>Delete</button>
                </form>
                ";
            }
            else
            {
                echo file_get_contents("admin_page.html");
                echo "

        <div class='container'>
            <h3> Enter the Medicine name to search and delete: <h3>
            <form action = 'delete.php' method='post' autocomplete='off'>
                <div class='form-group'>
                <label><b>Medicine Name:</b></label>
                <input type='text' class-'form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                </div>
                <button type='submit' class='btn btn-search' style='background-color: green; color: white; margin-top:20px'>Search</button>
            </form>
        </div>
        
        ";
                echo 
                "<table class='table table-bordered table-hover' style='border-width: 5px;'>
                <thead>
                <tr>
                    <th>Medicine ID</th>
                    <th>Medicine name</th>
                    <th>mg</th>
                    <th>Price</th>
                    <th>Available</th>
                </tr>
                </thead>
                <tbody style='font-size: 15px;''>
                <tr>
                    <td><b>Not Found</b></td>
                    <td><b>Not Found</b></td>
                    <td><b>Not Found</b></td>
                    <td><b>Not Found</b></td>
                    <td><b>Not Found</b></td>
                </tr>
                </tbody>
                </table>";
            }
        }
        else
        {
            echo file_get_contents("admin_page.html");
            echo "

        <div class='container'>
            <h3> Enter the Medicine name to search and delete: <h3>
            <form action = 'delete.php' method='post' autocomplete='off'>
                <div class='form-group'>
                <label><b>Medicine Name:</b></label>
                <input type='text' class-'form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                </div>
                <button type='submit' class='btn btn-search' style='background-color: green; color: white; margin-top:20px'>Search</button>
            </form>
        </div>
        
        ";
            echo 
            "<table class='table table-bordered table-hover' style='border-width: 5px;'>
            <thead>
            <tr>
                <th>Medicine ID</th>
                <th>Medicine name</th>
                <th>mg</th>
                <th>Price</th>
                <th>Available</th>
            </tr>
            </thead>
            <tbody style='font-size: 15px;''>
            <tr>
                <td><b>Not Found</b></td>
                <td><b>Not Found</b></td>
                <td><b>Not Found</b></td>
                <td><b>Not Found</b></td>
                <td><b>Not Found</b></td>
            </tr>
            </tbody>
            </table>";
        }
    }

    if(isset($_POST['medicine_id']))
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $con = mysqli_connect($server, $username, $password);
        if(!$con)
        {
            die("Connection to this database failed due to".mysqli_connect_error());
        }
        $medicine_id = $_POST['medicine_id'];
        $quantity = $_POST['quantity'];
        $sqltest = "SELECT `available` FROM `pharmaz`.`medicines` WHERE med_id=$medicine_id;";
        $resultcheck = $con->query($sqltest);
        $rowtest = $resultcheck->fetch_assoc();
        $available = $rowtest['available'];
        if($resultcheck->num_rows>0)
        {    
            if($available>=$quantity)
            {
                $sqlupdate = "UPDATE `pharmaz`.`medicines`
                SET `available` = $available-$quantity WHERE med_id=$medicine_id;";
                if($con->query($sqlupdate)==true)
                {
                    echo '<script>alert("The items have been deleted!");</script>';
                    echo file_get_contents("admin_page.html");
                    echo "
        
                <div class='container'>
                    <h3> Enter the Medicine name to search and delete: <h3>
                    <form action = 'delete.php' method='post' autocomplete='off'>
                        <div class='form-group'>
                        <label><b>Medicine Name:</b></label>
                        <input type='text' class-'form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                        </div>
                        <button type='submit' class='btn btn-search' style='background-color: green; color: white; margin-top:20px'>Search</button>
                    </form>
                </div>
                
                ";
                }
                else
                {
                    echo '<script>alert("There was some problem deleting items, try again?");</script>';
                    echo file_get_contents("admin_page.html");
                    echo "
        
                <div class='container'>
                    <h3> Enter the Medicine name to search and delete: <h3>
                    <form action = 'delete.php' method='post' autocomplete='off'>
                        <div class='form-group'>
                        <label><b>Medicine Name:</b></label>
                        <input type='text' class-'form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                        </div>
                        <button type='submit' class='btn btn-search' style='background-color: green; color: white; margin-top:20px'>Search</button>
                    </form>
                </div>
                
                ";
                }
            }
            else
            {
                echo '<script>alert("You have entered perhaps too much quantity?");</script>';
                echo file_get_contents("admin_page.html");
                echo "
    
            <div class='container'>
                <h3> Enter the Medicine name to search and delete: <h3>
                <form action = 'delete.php' method='post' autocomplete='off'>
                    <div class='form-group'>
                    <label><b>Medicine Name:</b></label>
                    <input type='text' class-'form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                    </div>
                    <button type='submit' class='btn btn-search' style='background-color: green; color: white; margin-top:20px'>Search</button>
                </form>
            </div>
            
            ";
            }
        }
        else
        {
            echo '<script>alert("No Medicine by that Medicine ID found, try again!");</script>';
            echo file_get_contents("admin_page.html");
            echo "

        <div class='container'>
            <h3> Enter the Medicine name to search and delete: <h3>
            <form action = 'delete.php' method='post' autocomplete='off'>
                <div class='form-group'>
                <label><b>Medicine Name:</b></label>
                <input type='text' class-'form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                </div>
                <button type='submit' class='btn btn-search' style='background-color: green; color: white; margin-top:20px'>Search</button>
            </form>
        </div>
        
        ";
        }
    }
?>