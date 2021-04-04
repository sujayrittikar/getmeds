<?php
        if(isset($_POST['med_id']))
        {
            require 'db.php';

            $med_id = $_POST['med_id'];
            $company = $_POST['company'];
            $medicine_name = $_POST['medicine_name'];
            $mg = $_POST['mg'];
            $amount = $_POST['amount'];
            $price = $_POST['price'];

            $sqlcheck1 = "SELECT `med_id` FROM  `epiz_28304119_pharmaz`.`medicines` WHERE med_id=$med_id;";

            if (strlen(strval($med_id))<8)
            {
                if($con->query($sqlcheck1)==true)
                {

                    $resultcheck1 = $con->query($sqlcheck1);
                    if($resultcheck1->num_rows>0)
                    {
                        $sqlcheck5 = "SELECT `med_name` FROM `epiz_28304119_pharmaz`.`medicines` WHERE med_id=$med_id;";
                        $sqlcheck2 = "SELECT `mg` FROM `epiz_28304119_pharmaz`.`medicines` WHERE med_id=$med_id;";
                        $resultcheck5 = $con->query($sqlcheck5);
                        $resultcheck2 = $con->query($sqlcheck2);
                        $row2 = $resultcheck2->fetch_assoc();
                        $row5 = $resultcheck5->fetch_assoc();
                        if ($row2['mg']==$mg && strcmp($row5['med_name'],$medicine_name)==0)
                        {
                            $sqlcheck3 = "SELECT `available` FROM `epiz_28304119_pharmaz`.`medicines` WHERE med_id=$med_id;";
                            $resultcheck3 = $con->query($sqlcheck3);
                            $row3 = $resultcheck3->fetch_assoc();
                            $available = $row3['available'];
                            $sqlupdate = "UPDATE `epiz_28304119_pharmaz`.`medicines`
                            SET `available` = $available+$amount, `price`=$price WHERE med_id=$med_id;";
                            if($con->query($sqlupdate)==true)
                            {
                                echo '<script>alert("The data has been updated on Database");</script>';
                                echo file_get_contents("admin_page.html");
                                echo "
                                <div class='container'>
                                <h2>For Admins only</h2>
                                 <form action='admin_page.php' method='post' autocomplete='off'>
                                   <div class='form-group'>
                                         <label><b>Medicine ID:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter Medicine ID' name='med_id' id='med_id' maxlength='7' required>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>Company:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter Company of Medicine' name='company' id='company' required>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>Medicine Name:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>mg:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter mg of Medicine' name='mg' id='mg'>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>available:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter amount of Medicine(Packets)' name='amount' id='amount' required>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>Price:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter Price' name='price' id='price' required>
                                   </div>
                                   <button type='submit' class='btn btn-success'>Add Medicine</button>
                                 </form>
                       
                                 <form action='delete.php' method='POST' autocomplete='off'>
                                         <input type='text' class='invisible' name='invisible' id='invisible' value='invisible' hidden>
                                         <button type='submit' class='btn btn-delete'>Delete Medicine</button>
                                 </form>
                              </div>
                                ";
                            }
                            else
                            {
                                echo '<script>alert("Updation request could not be processed, try again!");</script>';
                                echo file_get_contents("admin_page.html");
                                echo "
                                
                                <div class='container'>
                                <h2>For Admins only</h2>
                                 <form action='admin_page.php' method='post' autocomplete='off'>
                                   <div class='form-group'>
                                         <label><b>Medicine ID:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter Medicine ID' name='med_id' id='med_id' maxlength='7' required>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>Company:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter Company of Medicine' name='company' id='company' required>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>Medicine Name:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>mg:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter mg of Medicine' name='mg' id='mg'>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>available:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter amount of Medicine(Packets)' name='amount' id='amount' required>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>Price:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter Price' name='price' id='price' required>
                                   </div>
                                   <button type='submit' class='btn btn-success'>Add Medicine</button>
                                 </form>
                       
                                 <form action='delete.php' method='POST' autocomplete='off'>
                                         <input type='text' class='invisible' name='invisible' id='invisible' value='invisible' hidden>
                                         <button type='submit' class='btn btn-delete'>Delete Medicine</button>
                                 </form>
                              </div>

                                ";
                            }
    
                        }
                        else
                        {
                            $index = 10000000;
                            $k=0;
                            while ($k==0)
                            {
                                $sqlcheck4 = "SELECT * FROM `epiz_28304119_pharmaz`.`medicines` WHERE med_id=$index;";
                                $resultcheck4 = $con->query($sqlcheck4);
                                if ($resultcheck4->num_rows==0)
                                {
                                    $k=1;
                                    break;
                                }
                                $index++;
                            }
                            $sqlnew = "INSERT INTO `epiz_28304119_pharmaz`.`medicines` (`med_id`, `company`, `med_name`, `mg`, `available`, `price`, `time`) 
                            VALUES ('$index', '$company', '$medicine_name', '$mg', '$amount', '$price', current_timestamp());";
                            if($con->query($sqlnew)==true)
                            {
                                $resultnew = $con->query($sqlnew);
                                echo '<script>alert("The medicine has been inserted in Database");</script>';
                                echo file_get_contents("admin_page.html");
                                echo "
                                
                                <div class='container'>
                                <h2>For Admins only</h2>
                                 <form action='admin_page.php' method='post' autocomplete='off'>
                                   <div class='form-group'>
                                         <label><b>Medicine ID:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter Medicine ID' name='med_id' id='med_id' maxlength='7' required>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>Company:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter Company of Medicine' name='company' id='company' required>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>Medicine Name:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>mg:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter mg of Medicine' name='mg' id='mg'>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>available:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter amount of Medicine(Packets)' name='amount' id='amount' required>
                                   </div>
                                   <div class='form-group'>
                                         <label><b>Price:</b></label>
                                         <input type='text' class='form-control w-25' placeholder='Enter Price' name='price' id='price' required>
                                   </div>
                                   <button type='submit' class='btn btn-success'>Add Medicine</button>
                                 </form>
                       
                                 <form action='delete.php' method='POST' autocomplete='off'>
                                         <input type='text' class='invisible' name='invisible' id='invisible' value='invisible' hidden>
                                         <button type='submit' class='btn btn-delete'>Delete Medicine</button>
                                 </form>
                              </div>

                                ";
                            }
                        }
                    }
                    else
                    {
                        $sql = "INSERT INTO `epiz_28304119_pharmaz`.`medicines` (`med_id`, `company`, `med_name`, `mg`, `available`, `price`, `time`) 
                        VALUES ('$med_id', '$company', '$medicine_name', '$mg', '$amount', '$price', current_timestamp());";
                        if ($con->query($sql)==true)
                        {
                            $result = $con->query($sql);
                            echo '<script>alert("The medicine has been inserted in Database");</script>';
                            echo file_get_contents("admin_page.html");
                            echo "
                            
                            <div class='container'>
                            <h2>For Admins only</h2>
                             <form action='admin_page.php' method='post' autocomplete='off'>
                               <div class='form-group'>
                                     <label><b>Medicine ID:</b></label>
                                     <input type='text' class='form-control w-25' placeholder='Enter Medicine ID' name='med_id' id='med_id' maxlength='7' required>
                               </div>
                               <div class='form-group'>
                                     <label><b>Company:</b></label>
                                     <input type='text' class='form-control w-25' placeholder='Enter Company of Medicine' name='company' id='company' required>
                               </div>
                               <div class='form-group'>
                                     <label><b>Medicine Name:</b></label>
                                     <input type='text' class='form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                               </div>
                               <div class='form-group'>
                                     <label><b>mg:</b></label>
                                     <input type='text' class='form-control w-25' placeholder='Enter mg of Medicine' name='mg' id='mg'>
                               </div>
                               <div class='form-group'>
                                     <label><b>available:</b></label>
                                     <input type='text' class='form-control w-25' placeholder='Enter amount of Medicine(Packets)' name='amount' id='amount' required>
                               </div>
                               <div class='form-group'>
                                     <label><b>Price:</b></label>
                                     <input type='text' class='form-control w-25' placeholder='Enter Price' name='price' id='price' required>
                               </div>
                               <button type='submit' class='btn btn-success'>Add Medicine</button>
                             </form>
                   
                             <form action='delete.php' method='POST' autocomplete='off'>
                                     <input type='text' class='invisible' name='invisible' id='invisible' value='invisible' hidden>
                                     <button type='submit' class='btn btn-delete'>Delete Medicine</button>
                             </form>
                          </div>
                            
                            ";
                        }
                        else
                        {
                            echo '<script>alert("There was some problem inserting the medicine, please try again!");</script>';
                            echo file_get_contents("admin_page.html");
                            echo "
                            
                            <div class='container'>
                            <h2>For Admins only</h2>
                             <form action='admin_page.php' method='post' autocomplete='off'>
                               <div class='form-group'>
                                     <label><b>Medicine ID:</b></label>
                                     <input type='text' class='form-control w-25' placeholder='Enter Medicine ID' name='med_id' id='med_id' maxlength='7' required>
                               </div>
                               <div class='form-group'>
                                     <label><b>Company:</b></label>
                                     <input type='text' class='form-control w-25' placeholder='Enter Company of Medicine' name='company' id='company' required>
                               </div>
                               <div class='form-group'>
                                     <label><b>Medicine Name:</b></label>
                                     <input type='text' class='form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                               </div>
                               <div class='form-group'>
                                     <label><b>mg:</b></label>
                                     <input type='text' class='form-control w-25' placeholder='Enter mg of Medicine' name='mg' id='mg'>
                               </div>
                               <div class='form-group'>
                                     <label><b>available:</b></label>
                                     <input type='text' class='form-control w-25' placeholder='Enter amount of Medicine(Packets)' name='amount' id='amount' required>
                               </div>
                               <div class='form-group'>
                                     <label><b>Price:</b></label>
                                     <input type='text' class='form-control w-25' placeholder='Enter Price' name='price' id='price' required>
                               </div>
                               <button type='submit' class='btn btn-success'>Add Medicine</button>
                             </form>
                   
                             <form action='delete.php' method='POST' autocomplete='off'>
                                     <input type='text' class='invisible' name='invisible' id='invisible' value='invisible' hidden>
                                     <button type='submit' class='btn btn-delete'>Delete Medicine</button>
                             </form>
                          </div>
                            
                            ";
                        }
                    }
                }
                else
                {
                    echo '<script>alert("There was some problem inserting the medicine, please try again!");</script>';
                    echo file_get_contents("admin_page.html");
                    echo "
                    
                    <div class='container'>
                    <h2>For Admins only</h2>
                     <form action='admin_page.php' method='post' autocomplete='off'>
                       <div class='form-group'>
                             <label><b>Medicine ID:</b></label>
                             <input type='text' class='form-control w-25' placeholder='Enter Medicine ID' name='med_id' id='med_id' maxlength='7' required>
                       </div>
                       <div class='form-group'>
                             <label><b>Company:</b></label>
                             <input type='text' class='form-control w-25' placeholder='Enter Company of Medicine' name='company' id='company' required>
                       </div>
                       <div class='form-group'>
                             <label><b>Medicine Name:</b></label>
                             <input type='text' class='form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                       </div>
                       <div class='form-group'>
                             <label><b>mg:</b></label>
                             <input type='text' class='form-control w-25' placeholder='Enter mg of Medicine' name='mg' id='mg'>
                       </div>
                       <div class='form-group'>
                             <label><b>available:</b></label>
                             <input type='text' class='form-control w-25' placeholder='Enter amount of Medicine(Packets)' name='amount' id='amount' required>
                       </div>
                       <div class='form-group'>
                             <label><b>Price:</b></label>
                             <input type='text' class='form-control w-25' placeholder='Enter Price' name='price' id='price' required>
                       </div>
                       <button type='submit' class='btn btn-success'>Add Medicine</button>
                     </form>
           
                     <form action='delete.php' method='POST' autocomplete='off'>
                             <input type='text' class='invisible' name='invisible' id='invisible' value='invisible' hidden>
                             <button type='submit' class='btn btn-delete'>Delete Medicine</button>
                     </form>
                  </div>
                    
                    ";
                }

            }
            else
            {
                echo '<script>alert("Medicine ID can be at max 7 digits!, try again")</script>';
                echo file_get_conents("admin_page.html");
                echo "
                
                <div class='container'>
                <h2>For Admins only</h2>
                 <form action='admin_page.php' method='post' autocomplete='off'>
                   <div class='form-group'>
                         <label><b>Medicine ID:</b></label>
                         <input type='text' class='form-control w-25' placeholder='Enter Medicine ID' name='med_id' id='med_id' maxlength='7' required>
                   </div>
                   <div class='form-group'>
                         <label><b>Company:</b></label>
                         <input type='text' class='form-control w-25' placeholder='Enter Company of Medicine' name='company' id='company' required>
                   </div>
                   <div class='form-group'>
                         <label><b>Medicine Name:</b></label>
                         <input type='text' class='form-control w-25' placeholder='Enter Name of Medicine' name='medicine_name' id='medicine_name' required>
                   </div>
                   <div class='form-group'>
                         <label><b>mg:</b></label>
                         <input type='text' class='form-control w-25' placeholder='Enter mg of Medicine' name='mg' id='mg'>
                   </div>
                   <div class='form-group'>
                         <label><b>available:</b></label>
                         <input type='text' class='form-control w-25' placeholder='Enter amount of Medicine(Packets)' name='amount' id='amount' required>
                   </div>
                   <div class='form-group'>
                         <label><b>Price:</b></label>
                         <input type='text' class='form-control w-25' placeholder='Enter Price' name='price' id='price' required>
                   </div>
                   <button type='submit' class='btn btn-success'>Add Medicine</button>
                 </form>
       
                 <form action='delete.php' method='POST' autocomplete='off'>
                         <input type='text' class='invisible' name='invisible' id='invisible' value='invisible' hidden>
                         <button type='submit' class='btn btn-delete'>Delete Medicine</button>
                 </form>
              </div>
                
                ";
            }
            $con->close();
            
        }
?>
