<?php
    if(isset($_POST['password'])||isset($_POST['logout']))
    {
        session_start();
        require 'db.php';
        if(isset($_POST['logout']))
        {
            header("Location: index.html");
            session_destroy();
            exit();
        }

        if (isset($_POST['password']))
        {   
            $password = $_POST['password'];
            if(strcmp("nustadhur", $password)==0)
            {
                $_SESSION['password'] = $password;
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
                echo '<script>alert("Incorrect Password!");</script>';
                echo file_get_contents("admin.html");
            }
        }
        $con->close();
    }
?>
