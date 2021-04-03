<?php
    if(isset($_POST['username'])||isset($_POST['logout']))
    {
        session_start();
        if(isset($_POST['logout']))
        {
            header("Location: index.html");
            session_destroy();
            exit();
        }

        if(isset($_POST['username']))
        {        
            $server = "localhost";
            $username = "root";
            $password = "";
            $con = mysqli_connect($server, $username, $password);

            if(!$con)
            {
                die("Connection to this database failed due to ".mysqli_connect_error());
            }

            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "SELECT `password` FROM `pharmaz`.`users` WHERE username='$username';";

            if($con->query($sql)==true)
            {
                $result = $con->query($sql);
                $row = $result->fetch_assoc();
                $entered_pass = $row["password"];
                if (strcmp($entered_pass, $password)==0)
                {
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    echo file_get_contents("getmedicine.html");    
                }
                else
                {
                    if ($result->num_rows==0)
                    {
                        echo '<script>alert("User ID does not exist, Sign Up?");</script>';
                        echo file_get_contents("signup.html");
                    }
                    else
                    {
                        echo '<script>alert("Password is wrong try again? :(");</script>';
                        echo file_get_contents("login.html");
                    }
                }
            }
            $con->close();
        }
    }
?>