<?php
    if(isset($_POST['0']))
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $con = mysqli_connect($server, $username, $password);
        if(!$con)
        {
            die("Connection to this database failed due to ".mysqli_connect_error());
        }
        $total_items = $_POST['order'];
        $total_items = (int)$total_items;
        $temp = $total_items-1;
        $total_orders = 0;
        $total_price = 0;
        while($temp>-1)
        {
            $total_orders += (int)$_POST[strval($temp)];
            $total_price += (int)$_POST[strval(10000+$temp)]*(int)$_POST[strval($temp)];
            $temp--;
        }
        echo file_get_contents("order.html");
        echo " <form action='ordering.php' method='post'>
        <div class='container' style='text-align: center;font-size: 25px;'>
            <input type='text' name='orders' value='$total_orders' hidden/>
            <input type='text' name='prices' value='$total_price' hidden/>
            <input type='submit' name='Pay' id='Pay' value='Pay'>
            <input type='submit' name='Cancel' id='Cancel' value='Cancel'>
        </div>
        </form>";
        echo "<div class='container' style='text-align: center;font-size: 25px;'>
            <h2> Your Total Items are: $total_orders</h2>
                <h2> Your Total Cost is: $total_price</h2>
                </div>";
        
                $con->close();
    }
?>