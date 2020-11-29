<?php 
include('header.php');

if(isset($_POST['add_awarded_students']))
{
    $student_id = $_POST['student_id'];
    $competition_id = $_POST['competition_id'];

    $query = mysqli_query($con, "insert into awarded_students (Student_Id, Competition_Id) values('$student_id','$competition_id')") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewawarded.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }

}

if(isset($_POST['update_awarded_students']))
{
    $id = $_POST['id'];
    $student_id = $_POST['student_id'];
    $competition_id = $_POST['competition_id'];

    $query = mysqli_query($con, "update awarded_students set Student_Id = '$student_id', Competition_Id = '$competition_id' where Id = '$id'") or die(mysqli_error($con));
    
    if($query)
    {
        echo "<script>window.location.href='viewawarded.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }

}

if(isset($_GET['edit_id']))
{
    $edit_id = $_GET['edit_id'];

    $query = mysqli_query($con, "select * from awarded_students where Id = '$edit_id'");

    @$std = mysqli_fetch_array($query);

}

?>

<main>

<div class="container">

<div class="row">
<div class="col-md-10">
<h3 class="mt-4 mb-4 float-left">Add Awarded Students</h3>
</div>
<a href="viewawarded.php" class="btn btn-secondary float-right mt-4 mb-4">View All Students</a>
</div>

<div class="row"><div class="container-fluid">
<form action="addawardedstudents.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo @$std['Id']?>">
    Student Name: <br>
    <select name="student_id" id="" class="mt-3 mb-3">
        <option value="">Select</option>
        <?php 
        $query = mysqli_query($con, "select * from students");
        while($row=mysqli_fetch_array($query))
        {
            ?>
        <option <?php if($row['Id'] == @$std['Student_Id']){echo "selected";}?>  value="<?php echo $row['Id']?>"><?php echo $row['Name']?></option>
            <?php
        }
        ?>
    </select>
<br>
    Competition Title: <br>
    <select name="competition_id" id="" class="mt-3">
        <option value="">Select</option>
        <?php 
        $query = mysqli_query($con, "select * from competitions");
        while($row=mysqli_fetch_array($query))
        {
            ?>
        <option <?php if($row['Id'] == @$std['Competition_Id']){echo "selected";}?> value="<?php echo $row['Id']?>"><?php echo $row['Title']?></option>
            <?php
        }
        ?>
    </select>
    <br>
    <?php
    if(isset($_GET['edit_id']))
    {
        ?>
        <input type="submit" name="update_awarded_students" value="Update Awarded Student" class="btn btn-secondary mt-4">
        <?php
    }
    else
    {
        ?>
        <input type="submit" name="add_awarded_students" value="Add Awarded Student" class="btn btn-secondary mt-4">
        <?php
    }
    ?>
</form>
</div></div>

</div>
</main>

<?php
include('footer.php');
?>