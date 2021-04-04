<?php 
// SELECT * FROM medicines WHERE med_name like '%metxl%' 
// <table class="table table-bordered table-hover" style="border-width: 5px;">
//     <thead>
//       <tr>
//         <th>Medicine ID</th>
//         <th>Medicine name</th>
//         <th>mg</th>
//         <th>Price</th>
//       </tr>
//     </thead>
//     <tbody style="font-size: 15px;">
//       <tr>
//         <td><b>101</b></td>
//         <td><b>Crocine</b></td>
//         <td><b>1mg</b></td>
//         <td><b>5 rs</b></td>
//       </tr>
//     </tbody>
//   </table>

    if(isset($_POST['medicine']))
    {
        require 'db.php';

        $medicine = $_POST['medicine'];
        $sql = "SELECT * FROM `epiz_28304119_pharmaz`.`medicines` WHERE med_name like '%$medicine%';";

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
                    $s = $s."<td><b><input type='text' name='$c'size='30'/></b></td>";
                    $s = $s."</tr>";
                    $c++;
                }
                echo file_get_contents("getmedicine.html");
                echo 
                "
                <form action='order.php' method='post'>
                <table class='table table-bordered table-hover' style='border-width: 5px;'>
                <thead>
                <tr>
                    <th>Medicine ID</th>
                    <th>Medicine name</th>
                    <th>mg</th>
                    <th>Price</th>
                    <th>Available</th>
                    <th>Order</th>
                </tr>
                </thead>
                <tbody style='font-size: 15px;''>"
                .$s
                ."</tbody>
                </table>
                <input type='text' name='order' id='order' value='$c' hidden>
                <button type='submit' class='btn btn-primary' style='margin-left: 600px;margin-bottom: 10px;'>Order</button>
                </form>
                ";
            }
            else
            {
                echo file_get_contents("getmedicine.html");
                echo 
                "<table class='table table-bordered table-hover' style='border-width: 5px;'>
                <thead>
                <tr>
                    <th>Medicine ID</th>
                    <th>Medicine name</th>
                    <th>mg</th>
                    <th>Price</th>
                    <th>Available</th>
                    <th>Order</th>
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
            echo file_get_contents("getmedicine.html");
            echo 
            "<table class='table table-bordered table-hover' style='border-width: 5px;'>
            <thead>
            <tr>
                <th>Medicine ID</th>
                <th>Medicine name</th>
                <th>mg</th>
                <th>Price</th>
                <th>Available</th>
                <th>Order</th>
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
        $con->close();
    }
?>
