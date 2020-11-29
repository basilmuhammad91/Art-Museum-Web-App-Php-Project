<?php
// Login.php

// IT WILL CONNEC DATABASE
include('database_connection.php');

session_start();

if(isset($_POST['logout']))
{
    unset($_SESSION['Id']);
    unset($_SESSION['Name']);
    unset($_SESSION['Admin_Email']);
    unset($_SESSION['Admin_Password']);
    unset($_SESSION['Teacher_Email']);
    unset($_SESSION['Teacher_Password']);
    unset($_SESSION['Student_Email']);
    unset($_SESSION['Student_Password']);
}

if(isset($_SESSION['Admin_Email']) || isset($_SESSION['Teacher_Email']) || isset($_SESSION['Student_Email']))
{
    header("location: index.php");
}

if(isset($_POST['login']))
{
    $email = $_POST['inputEmailAddress'];
    $password = $_POST['inputPassword'];

    $query = mysqli_query($con, "
        select id, name, email, password, role from admins where email = '$email' and password = '$password'
        union all
        select id, name, email, password, role from teachers where email = '$email' and password = '$password'
        union all
        select id, name, email, password, role from students where email = '$email' and password = '$password'
        ");

    $count = mysqli_num_rows($query);
    $row = mysqli_fetch_array($query);
    
    $role = $row['role'];

    if($count >= 1)
    {
        if ($role == 'Admin') 
        {
            $_SESSION['Id'] = $row[0];
            $_SESSION['Name'] = $row[1];
            $_SESSION['Admin_Email'] = $email;
            $_SESSION['Admin_Password'] = $password;

            echo "<script>window.location.href='index.php';</script>";
        }
        else if ($role == 'Student') 
        {
            $_SESSION['Id'] = $row[0];
            $_SESSION['Name'] = $row[1];
            $_SESSION['Student_Email'] = $email;
            $_SESSION['Student_Password'] = $password;

            echo "<script>window.location.href='index.php';</script>";
        }
        else if($role == 'Teacher')
        {
            $_SESSION['Id'] = $row[0];
            $_SESSION['Name'] = $row[1];
            $_SESSION['Teacher_Email'] = $email;
            $_SESSION['Teacher_Password'] = $password;

            echo "<script>window.location.href='index.php';</script>";
        }

    }

    else
    {
        echo "<span class='text-danger border-danger'>Email or Password Incorrect</span>";
    }

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
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header" style="background-color: #5A6268"><h3 class="text-center font-weight-light my-4"><img src="img/logo.png"></h3></div>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="font-weight: 800;"><b>LOGIN</b></h3></div>
                                    <div class="card-body">
                                        <form method="post" action="login.php">
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" id="inputEmailAddress" type="email" name="inputEmailAddress" placeholder="Enter email address" /></div>
                                            <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" name="inputPassword" type="password" placeholder="Enter password" /></div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox"><input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" /><label class="custom-control-label" for="rememberPasswordCheck">Remember password</label></div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><a class="small" href="password.html">Forgot Password?</a><input type="submit" name="login" value="Login" class="btn btn-secondary"></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
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
