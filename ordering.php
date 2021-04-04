<?php
    if(isset($_POST['Pay']))
    {
        session_start();
       
        require 'db.php';

        $order = $_POST['orders'];
        $price = $_POST['prices'];
        $username = $_SESSION['username'];

        $sql = "SELECT phone FROM `epiz_28304119_pharmaz`.`users` WHERE username='$username';";
        if($con->query($sql)==true)
        {
            $result = $con->query($sql);
            $row = $result->fetch_assoc();
            
            $apiKey = urlencode('NTEyNDViMWU1ZDZlZTdiZmZjOGE1NmE4YWRhYTFjZGM=');
            // Message details
            $numbers = array((int)'91'.$row['phone']);
            $sender = urlencode('TXTLCL');
            $message = rawurlencode("This is your message");
            $numbers = implode(',', $numbers);
            // Prepare data for POST request
            $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
            // Send the POST request with cURL
            $ch = curl_init('https://api.textlocal.in/send/');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            // Process your response here
            // echo $response;
        }
        else
        {
            echo "Some Database Problem!";
        }


        $pay = $_POST['Pay'];
        header("Location: payment.php");
        exit();
    }

    if(isset($_POST['Cancel']))
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $con = mysqli_connect($server, $username, $password);

        if(!$con)
        {
            die("Connection to this database failed due to ".mysqli_connect_error());
        }
        $pay = $_POST['Cancel'];
        header("Location: getmedicine.html");
        exit();
        $con->close();
    }
?>
