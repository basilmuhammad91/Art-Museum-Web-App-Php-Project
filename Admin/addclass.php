<?php 
include('header.php');

if(isset($_POST['add_class']))
{
    $name = $_POST['name'];
    $teacher_id = $_POST['teacher_id'];

    $query = mysqli_query($con, "insert into classes (Class_Name, Teacher_Id) values ('$name','$teacher_id')") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewclass.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }

}

if(isset($_POST['update_class']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $teacher_id = $_POST['teacher_id'];

    $query = mysqli_query($con, "update classes Class set Class_Name = '$name', teacher_id = '$teacher_id' where Id = '$id'") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewclass.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }

}

if(isset($_GET['edit_id']))
{
    $edit_id = $_GET['edit_id'];

    $query = mysqli_query($con, "select * from classes where Id = '$edit_id'");

    @$std = mysqli_fetch_array($query);

}

if(!isset($_SESSION['Student_Email']))
{
?>
<main>

<div class="container">

<div class="row">
<div class="col-md-10">
<h3 class="mt-4 mb-4 float-left">Add Class</h3>
</div>
<a href="viewclass.php" class="btn btn-secondary float-right mt-4 mb-4">View All Classes</a>
</div>

<div class="row"><div class="container-fluid">
<form action="addclass.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo @$std['Id']?>">
    Name: <input type="text" name="name" id="name" value="<?php echo @$std['Class_Name']?>" class="form-text mt-2 mb-3">
    <span id="availability"></span>
    Teacher: <select name="teacher_id" class="ml-3 mb-3">
    <option value="">Select</option>
        <?php
        $query = mysqli_query($con, "select * from teachers");
        while($row=mysqli_fetch_array($query))
        {
            ?>
                <option <?php if($row['Id'] == @$std['Teacher_Id']) {echo 'selected';} ?> value="<?php echo $row['Id']?>"><?php echo $row['Name']?></option>
            <?php
        }
        ?>
    </select><br>
    
    <?php
    if(isset($_GET['edit_id']))
    {
        ?>
        <input type="submit" name="update_class" id="add_class" value="Update Class" class="btn btn-secondary mt-2">
        <?php
    }
    else
    {
        ?>
        <input type="submit" name="add_class" id="add_class" value="Add Class" class="btn btn-secondary mt-2">
        <?php
    }
    ?>
</form>
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
    $('#name').blur(function(){
        var name = $(this).val();
        $.ajax({
            url: 'check.php',
            method: 'POST',
            data: {name:name},
            success: function(data)
            {
                if(data != '0')
                {
                    $('#availability').html('<span class="text-danger">Class Name Already Exists</span><br>');
                    $('#add_class').attr('disabled',true);
                }
                else
                {
                    $('#availability').html('');
                    $('#add_class').attr('disabled',false);
                }
            }

        });
    });
  });

</script>