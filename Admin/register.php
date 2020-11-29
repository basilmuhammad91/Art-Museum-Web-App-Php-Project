<?php
// register.php

// IT WILL CONNEC DATABASE
include('database_connection.php');

// TEACHER REGISTER WORK 
if(isset($_POST['createAccount']))
{
    $name = $_POST['inputName'];
    $email = $_POST['inputEmailAddress'];
    $password = $_POST['inputPassword'];
    $phone = $_POST['inputPhone'];
    $address = $_POST['inputAddress'];
    $joiningDate = $_POST['inputJoiningDate'];

    $image = addslashes(file_get_contents($_FILES['teacherImage']['tmp_name']));

    
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Page Title - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqBootstrapValidation/1.3.6/jqBootstrapValidation.js"></script>

  

        <style>
            body{
                background-image: url(img/bg.jpg);
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>

        </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header" style="background-color: #5A6268"><h3 class="text-center font-weight-light my-4"><img src="img/logo.png"></h3></div>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="register.php" id="register_form">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputFirstName">Full Name</label><input class="form-control py-4" id="inputName" name="inputName" type="text" placeholder="Enter your name"/><small id="n_error" class="form-text text-muted"></small></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputLastName">Phone Number</label><input class="form-control py-4" id="inputPhone" name="inputPhone" type="text" placeholder="Enter phone number" /><small id="ph_error" class="form-text text-muted"></small></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" id="inputEmailAddress" name="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" /><small id="e_error" class="form-text text-muted"></small></div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" name="inputPassword" type="password" placeholder="Enter password" /><small id="p1_error" class="form-text text-muted"></small></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Confirm Password</label><input class="form-control py-4" id="inputConfirmPassword" name="inputConfirmPassword" type="password" placeholder="Confirm password" /><small id="p2_error" class="form-text text-muted"></small></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="small mb-1" for="inputAddress">Address</label><input class="form-control py-4" id="inputAddress" name="inputAddress" type="email" aria-describedby="emailHelp" placeholder="Enter complete address" /><small id="a_error" class="form-text text-muted"></small></div>
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputJoiningDate">Joining Date</label><input class="form-control py-4" id="joiningDate" name="joiningDate" type="date" /><small id="joining_date_error" class="form-text text-muted"></small></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Teacher Image</label><br><input class="form-control-file" id="teacherImage" type="file" name="teacherImage" /><small id="image_error" class="form-text text-muted"></small></div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0" style="background-color: #212529">
                                                <input type="submit" id="createAccount" name="createAccount" class="btn btn-primary btn-block" style="background-color: #212529; border: solid #212529" value="Create Account"></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <br><br>
            <div id="layoutAuthentication_footer">
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
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
<script>
    $(document).ready(function(){

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

