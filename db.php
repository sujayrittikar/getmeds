<?php
  
        $server = "sql203.epizy.com";
        $username = "epiz_28304119";
        $password = "Czm9dWaof8XYpH";
        $con = mysqli_connect($server, $username, $password);
        if(!$con)
        {
            die("Connection to this database failed due to ".mysqli_connect_error());
        }
  
?>
