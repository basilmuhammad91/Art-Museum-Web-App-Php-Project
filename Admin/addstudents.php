<?php 
include('header.php');

if(isset($_POST['add_students']))
{
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $class_id = $_POST['class_id'];
    $role = "Student";

    $query = mysqli_query($con, "insert into students (Name, Father_Name, Email, Password, Phone, Address, Image, Class_Id,Role) values('$name', '$fname', '$email','$password','$phone','$address','$img','$class_id','$role')") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewstudents.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }

}

if(isset($_POST['update_students']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];

    if(!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE)
    {
        $query = mysqli_query($con, "update students set Name = '$name', Father_Name = '$fname', Email = '$email', Password = '$password', Phone = '$phone', Address = '$address', Class_Id = '$class_id' where Id = '$id'") or die(mysqli_error($con));
    }
    else
    {
        $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $query = mysqli_query($con, "update students set Name = '$name', Father_Name = '$fname', Email = '$email', Password = '$password', Phone = '$phone', Address = '$address', Image = '$img', Class_Id = '$class_id'  where Id = '$id'") or die(mysqli_error($con));
    }
    if($query)
    {
        echo "<script>window.location.href='viewstudents.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }

}

if(isset($_GET['edit_id']))
{
    $edit_id = $_GET['edit_id'];

    $query = mysqli_query($con, "select * from students where Id = '$edit_id'");

    @$std = mysqli_fetch_array($query);

}
if(isset($_SESSION['Admin_Email']))
{


?>

<main>

<div class="container">

<div class="row">
<div class="col-md-10">
<h3 class="mt-4 mb-4 float-left">Add Students</h3>
</div>
<a href="viewstudents.php" class="btn btn-secondary float-right mt-4 mb-4">View All Students</a>
</div>

<div class="row"><div class="container-fluid">
<div class="row">
    <form action="addstudents.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo @$std['Id']?>">
        <label>Name:</label> <input type="text" name="name" id="std_name" value="<?php echo @$std['Name']?>" class="form-text mt-2">
        <span id="availability"></span>
        <label>Father Name:</label> <input type="text" name="fname" value="<?php echo @$std['Father_Name']?>" class="form-text mt-2">
        <label>Email:</label> <input type="email" name="email" value="<?php echo @$std['Email']?>" class="form-text mt-2">
        <label>Password:</label> <input type="password" name="password" value="<?php echo @$std['Password']?>" class="form-text mt-2">
        <label>Phone:</label> <input type="text" name="phone" value="<?php echo @$std['Phone']?>" class="form-text mt-2">
        <label>Address:</label> <input type="text" name="address" value="<?php echo @$std['Address']?>" class="form-text mt-2">
        <label>Image:</label> <input type="file" name="image" class="form-text mt-2">
        <?php
        if(isset($_GET['edit_id']))
        {
            ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($std['Image'])?>" alt="" width="70" height="70" class="image mt-3 mb-4"><br>
            <?php
        }
        ?>
        <br>
        <label>Class:</label> <select name="class_id" class="ml-3 mb-3">
        <option value="">Select</option>
            <?php
            $query = mysqli_query($con, "select * from classes");
            while($row=mysqli_fetch_array($query))
            {
                ?>
                    <option <?php if($row['Id'] == @$std['Class_Id']) {echo 'selected';} ?> value="<?php echo $row['Id']?>"><?php echo $row['Class_Name']?></option>
                <?php
            }
            ?>
        </select><br>

        <?php
        if(isset($_GET['edit_id']))
        {
            ?>
            <input type="submit" name="update_students" id="add_students" value="Update Students" class="btn btn-secondary mt-2">
            <?php
        }
        else
        {
            ?>
            <input type="submit" name="add_students" id="add_students" value="Add Students" class="btn btn-secondary mt-2">
            <?php
        }
        ?>
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
include('footer.php');
?>


<script>
  
  $(document).ready(function(){
    $('#std_name').blur(function(){
        var std_name = $(this).val();
        $.ajax({
            url: 'check.php',
            method: 'POST',
            data: {std_name:std_name},
            success: function(data)
            {
                if(data != '0')
                {
                    $('#availability').html('<span class="text-danger">Student Name Already Exists</span><br>');
                    $('#add_students').attr('disabled',true);
                }
                else
                {
                    $('#availability').html('');
                    $('#add_students').attr('disabled',false);
                }
            }

        });
    });
  });

</script>