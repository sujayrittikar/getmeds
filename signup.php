<?php 
    if(isset($_POST['username']))
    {
        require 'db.php';

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $pcode = $_POST['pcode'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $house = $_POST['house'];
        $area = $_POST['area'];
        $state = $_POST['stt'];
        $city = $_POST['city'];
        $pincode = $_POST['pincode'];
        $country = "India";
        $req = $_POST['req'];

        if(strlen($password)>11)
        { 
          echo '<script>
          alert("The password length is more than 11!");
          </script>';  
          echo file_get_contents('signup.html');
        }

        else
        {
          $sqltest = "SELECT `username` FROM `epiz_28304119_pharmaz`.`users` WHERE username='$username'";
          if($con->query($sqltest)==true)
          {
            $resulttest = $con->query($sqltest);
            if ($resulttest->num_rows>0)
            {
                echo '<script>alert("The username already exists, login maybe?");</script>';
                echo file_get_contents("signup.html");
            }
            else
            {
              $sql = "INSERT INTO `epiz_28304119_pharmaz`.`users` (`username`, `password`, `firstname`, `lastname`, `phone_code`, `phone`, `email`, `house`, `area`, `city`, `pin_code`, `state`, `country`, `req`, `time`) VALUES 
              ('$username', '$password', '$firstname', '$lastname', '$pcode', '$phone', '$email', '$house', '$area', '$city', '$pincode', '$state', '$country', '$req', current_timestamp());";
              if ($con->query($sql)==true)
              { 
                  echo '<script>alert("Your account has been created, login to access.");</script>';
                  echo file_get_contents("login.html");
              }
              else
              {
                  echo '<script">alert("Some problems in executing your request :(! Try again maybe? :)");</script>';
                  echo file_get_contents("signup.html");
              }
            }
          }
          else
          {
            echo '<script>alert("Some problems in executing your request :(! Try again maybe? :)");</script>';
            echo file_get_contents("signup.html");
          }
          
        }
    }

    ?>
