<?php 
include('header.php');



if(isset($_POST['add_teachers']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $joining_date = $_POST['joining_date'];
    $role = "Teacher";

    $query = mysqli_query($con, "insert into teachers (Name, Email, Password, Phone, Address, Image, Joining_Date, Role) values('$name','$email','$password','$phone','$address','$img','$joining_date','$role')") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewteachers.php';</script>";
        // echo "hello";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }

}

if(isset($_POST['update_teachers']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $joining_date = $_POST['joining_date'];

    if(!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE)
    {
        $query = mysqli_query($con, "update teachers set Name = '$name', Email = '$email', Password = '$password', Phone = '$phone', Address = '$address', joining_date = '$joining_date' where Id = '$id'") or die(mysqli_error($con));
    }
    else
    {
        $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $query = mysqli_query($con, "update teachers set Name = '$name', Email = '$email', Password = '$password', Phone = '$phone', Address = '$address', Image = '$img', joining_date = '$joining_date' where Id = '$id'") or die(mysqli_error($con));
    }
    if($query)
    {
        echo "<script>window.location.href='viewteachers.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }

}

if(isset($_GET['edit_id']))
{
    $edit_id = $_GET['edit_id'];

    $query = mysqli_query($con, "select * from teachers where Id = '$edit_id'");

    @$std = mysqli_fetch_array($query);

}

if(isset($_SESSION['Admin_Email']))
{
    ?>
    <main>

<div class="container">

<div class="row">
<div class="col-md-10">
<h3 class="mt-4 mb-4 float-left">Add Teachers</h3>
</div>
<a href="viewteachers.php" class="btn btn-secondary float-right mt-4 mb-4">View All Teacher</a>
</div>

<div class="row"><div class="container-fluid">
<!-- <form action="addteachers.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo @$std['Id']?>">
    Name: <input type="text" name="name" value="<?php echo @$std['Name']?>" class="form-text mt-2">
    Email: <input type="email" name="email" id="email" value="<?php echo @$std['Email']?>" class="form-text mt-2">
    <span id="availability" ></span>
    Password: <input type="password" name="password" value="<?php echo @$std['Password']?>" class="form-text mt-2">
    Phone: <input type="text" name="phone" value="<?php echo @$std['Phone']?>" class="form-text mt-2">
    Address: <input type="text" name="address" value="<?php echo @$std['Address']?>" class="form-text mt-2">
    Image: <input type="file" name="image" class="form-text mt-2">
    <?php
    if(isset($_GET['edit_id']))
    {
        ?>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($std['Image'])?>" alt="" width="70" height="70" class="image mt-3 mb-4"><br>
        <?php
    }
    ?>
    Joining Date: <input type="date" name="joining_date" value="<?php echo @$std['Joining_Date']?>" class="form-text mt-2">
    <?php
    if(isset($_GET['edit_id']))
    {
        ?>
        <input type="submit" name="update_teachers" value="Update Teachers" class="btn btn-secondary mt-2">
        <?php
    }
    else
    {
        ?>
        <input type="submit" name="add_teachers" id="add_teachers" value="Add Teachers" class="btn btn-secondary mt-2">
        <?php
    }
    ?>
</form> -->
<div class="col-md-6">
                                        <form method="post" action="addteachers.php" id="register_form" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="hidden" name="id" value="<?php echo @$std['Id']?>">
                                                    <div class="form-group"><label class="small mb-1" for="inputFirstName">Full Name</label><input class="form-control py-4" id="inputName" name="name" type="text" placeholder="Enter your name" value="<?php echo @$std['Name']?>"/><small id="n_error" class="form-text text-muted"></small></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputLastName">Phone Number</label><input class="form-control py-4" id="inputPhone" name="phone" type="text" placeholder="Enter phone number" value="<?php echo @$std['Phone']?>" /><small id="ph_error" class="form-text text-muted"></small></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" value="<?php echo @$std['Email']?>" /><small id="e_error" class="form-text text-muted"></small><span id="availability"></span></div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Enter password" value="<?php echo @$std['Password']?>" /><small id="p1_error" class="form-text text-muted"></small></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Confirm Password</label><input class="form-control py-4" id="inputConfirmPassword" name="inputConfirmPassword" type="password" placeholder="Confirm password" value="<?php echo @$std['Password']?>" /><small id="p2_error" class="form-text text-muted"></small></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="small mb-1" for="inputAddress">Address</label><input class="form-control py-4" id="inputAddress" name="address" type="text" aria-describedby="emailHelp" placeholder="Enter complete address" value="<?php echo @$std['Address']?>" /><small id="a_error" class="form-text text-muted"></small></div>
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputJoiningDate">Joining Date</label><input class="form-control py-4" id="joiningDate" name="joining_date" type="date" value="<?php echo @$std['Joining_Date']?>" /><small id="joining_date_error" class="form-text text-muted"></small></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Teacher Image</label><br><input class="form-control-file" id="teacherImage" type="file" name="image" /><small id="image_error" class="form-text text-muted"></small></div>
                                                </div><br>
                                                
                                            </div>
                                            <div class="form-group mt-4 mb-0" style="background-color: #212529">
                                                <?php
                                                if(isset($_GET['edit_id']))
                                                {
                                                    ?>
                                                    <input type="submit" id="createAccount" name="update_teachers" class="btn btn-primary btn-block" style="background-color: #212529; border: solid #212529" value="Update Account">
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <input type="submit" id="createAccount" name="add_teachers" class="btn btn-primary btn-block" style="background-color: #212529; border: solid #212529" value="Create Account">
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            </div>
                                                </div>
                                        </form>
                                    </div>
</div></div>

</div>
</main>

<?php
}
else
{
    ?>
    <div id="layoutError">
            <div id="layoutError_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center mt-4">
                                    <h1 class="display-1">401</h1>
                                    <p class="lead">Unauthorized</p>
                                    <p>Access to this resource is denied.</p>
                                    <a href="index.php"><i class="fas fa-arrow-left mr-1"></i>Return to Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutError_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2019</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    <?php
}
?>



<?php
include('footer.php');
?>


<script>
  
  $(document).ready(function(){
    $('#inputEmailAddress').blur(function(){
        var email = $(this).val();
        $.ajax({
            url: 'check.php',
            method: 'POST',
            data: {email:email},
            success: function(data)
            {
                if(data != '0')
                {
                    $('#availability').html('<span class="text-danger">Email Already Exists</span><br>');
                    $('#createAccount').attr('disabled',true);
                }
                else
                {
                    $('#availability').html('');
                    $('#createAccount').attr('disabled',false);
                }
            }

        });
    });


                        var name = $("#inputName");
                        var phone = $("#inputPhone");
                        var email = $("#inputEmailAddress");
                        var password = $("#inputPassword");
                        var confirmPassword = $("#inputConfirmPassword");
                        var address = $("#inputAddress");
                        var joiningDate = $("#joiningDate");
                        var image = $("#teacherImage");       

                // PHONE VALIDATION

                $(name).blur(function(){
                  if(name.val() == '')
                        {
                            name.addClass("border-danger");
                            $("#n_error").html("<span class='text-danger'>Please Enter Your Name</span>");
                            $("#createAccount").attr("disabled",true);
                        }
                        else
                        {
                            name.removeClass("border-danger");
                            $("#n_error").html("");
                            $("#createAccount").attr("disabled",false);
                        }  
                });


                // PHONE VALIDATION

                $(phone).blur(function(){
                  if(phone.val() == '')
                        {
                            phone.addClass("border-danger");
                            $("#ph_error").html("<span class='text-danger'>Please Enter Your Phone</span>");
                            $("#createAccount").attr("disabled",true);
                        }
                        else
                        {
                            phone.removeClass("border-danger");
                            $("#ph_error").html("");
                            $("#createAccount").attr("disabled",false);
                        }  
                });

                 // EMAIL VALIDATION
                $(email).blur(function(){
                  if(email.val() == '')
                        {
                            email.addClass("border-danger");
                            $("#e_error").html("<span class='text-danger'>Please Enter Your Email</span>");
                            $("#createAccount").attr("disabled",true);
                        }
                        else
                        {
                            email.removeClass("border-danger");
                            $("#e_error").html("");
                            $("#createAccount").attr("disabled",false);
                        }  
                });

                // PASSWORD VALIDATION
                $(password).blur(function(){
                  if(password.val() == '')
                        {
                            password.addClass("border-danger");
                            $("#p1_error").html("<span class='text-danger'>Please Enter Your Password</span>");
                            $("#createAccount").attr("disabled",true);
                        }
                        else
                        {
                            password.removeClass("border-danger");
                            $("#p1_error").html("");
                            $("#createAccount").attr("disabled",false);
                        }  
                });

               

                // PASSWORD NOT MATCH VALIDATION
                $(confirmPassword).blur(function(){
                  if(confirmPassword.val() == '')
                        {
                            confirmPassword.addClass("border-danger");
                            $("#p2_error").html("<span class='text-danger'>Please Re-Enter Your Password</span>");
                            $("#createAccount").attr("disabled",true);

                        }
                        else if(password.val() !== confirmPassword.val())
                        {
                            confirmPassword.addClass("border-danger");
                            $("#p2_error").html("<span class='text-danger'>Password not metched</span>");
                            $("#createAccount").attr("disabled",true);  
                        }  
                        else
                        {
                            confirmPassword.removeClass("border-danger");
                            $("#p2_error").html("");
                            $("#createAccount").attr("disabled",false);
                        }
                });

                // ADDRESS VALIDATION

                $(address).blur(function(){
                  if(address.val() == '')
                        {
                            address.addClass("border-danger");
                            $("#a_error").html("<span class='text-danger'>Please Enter Your Address</span>");
                            $("#createAccount").attr("disabled",true);

                        }
                        else if(address.val().length < 10)
                        {
                            address.addClass("border-danger");
                            $("#a_error").html("<span class='text-danger'>Please enter your correct address</span>");
                            $("#createAccount").attr("disabled",true);  
                        }  
                        else
                        {
                            address.removeClass("border-danger");
                            $("#a_error").html("");
                            $("#createAccount").attr("disabled",false);
                        }
                });

                // // JOINING DATE VALIDATION
                $(joiningDate).blur(function(){
                  if(joiningDate.val().length == '')
                        {
                            joiningDate.addClass("border-danger");
                            $("#joining_date_error").html("<span class='text-danger'>Select Joining Date</span>");
                            $("#createAccount").attr("disabled",true);
                        }
                        else
                        {
                            joiningDate.removeClass("border-danger");
                            $("#joining_date_error").html("");
                            $("#createAccount").attr("disabled",false);
                        }  
                });

                // // TEACHER IMAGE VALIDATION

                $(image).blur(function(){
                  if(image.val().length == '')
                        {
                            image.addClass("border-danger");
                            $("#image_error").html("<span class='text-danger'>Select Teacher Image</span>");
                            $("#createAccount").attr("disabled",true);
                        }
                        else
                        {
                            image.removeClass("border-danger");
                            $("#image_error").html('');
                            $("#createAccount").attr("disabled",false);
                        }  
                });


  });

</script>