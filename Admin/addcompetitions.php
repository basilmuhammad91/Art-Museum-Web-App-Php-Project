<?php 
include('header.php');

if(isset($_POST['add_competitions']))
{
    $title = $_POST['title'];
    $description = $_POST['description'];
    $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $status = $_POST['status'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $conditions = $_POST['conditions'];
    $award_details = $_POST['award_details'];

    $query = mysqli_query($con, "insert into competitions (Title, Description, Image, Status, Start_Date, End_Date, Conditions, Award_Details) values('$title','$description','$img','$status','$start_date','$end_date','$conditions', '$award_details')") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewcompetitions.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }

}

if(isset($_POST['update_competitions']))
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $conditions = $_POST['conditions'];
    $award_details = $_POST['award_details'];

    if(!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE)
    {
        $query = mysqli_query($con, "update competitions set Title = '$title', Description = '$description', Status = '$status', Start_Date = '$start_date', End_Date = '$end_date', Conditions = '$conditions', Award_Details = '$award_details' where Id = '$id'") or die(mysqli_error($con));
    }
    else
    {
        $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $query = mysqli_query($con, "update competitions set Title = '$title', Description = '$description', Image = '$img', Status = '$status', Start_Date = '$start_date', End_Date = '$end_date', Conditions = '$conditions' where Id = '$id'") or die(mysqli_error($con));
    }
    if($query)
    {
        echo "<script>window.location.href='viewcompetitions.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }

}

if(isset($_GET['edit_id']))
{
    $edit_id = $_GET['edit_id'];

    $query = mysqli_query($con, "select * from competitions where Id = '$edit_id'");

    @$std = mysqli_fetch_array($query);

}
if(!isset($_SESSION['Student_Email']))
{
?>
<main>

<div class="container">

<div class="row">
<div class="col-md-10">
<h3 class="mt-4 mb-4 float-left">Add Competition</h3>
</div>
<a href="viewcompetitions.php" class="btn btn-secondary float-right mt-4 mb-4">View All Competitions</a>
</div>

<div class="row"><div class="container-fluid">
<form action="addcompetitions.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo @$std['Id']?>">
    Title: <input type="text" name="title" id="title" value="<?php echo @$std['Title']?>" class="form-text mt-2">
    <span id="availability"></span>
    Description: <input type="text" name="description" value="<?php echo @$std['Description']?>" class="form-text mt-2">
    Image: <input type="file" name="image" class="form-text mt-2">
    <?php
    if(isset($_GET['edit_id']))
    {
        ?>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($std['Image'])?>" alt="" width="70" height="70" class="image mt-3 mb-4"><br>
        <?php
    }
    ?>
    Status: <br>
    <select name="status" class="mb-3">
        <option value="">Select</option>
        <option <?php if(@$std['Status'] == "Upcoming") {echo "selected";}?> value="Upcoming">Upcoming</option>
        <option <?php if(@$std['Status'] == "Ongoing") {echo "selected";}?> value="Ongoing">Ongoing</option>
        <option <?php if(@$std['Status'] == "None") {echo "selected";}?> value="None">None</option>
    </select>
<br>
    Start Date: <input type="date" name="start_date" value="<?php echo @$std['Start_Date']?>" class="form-text mt-2">
    End Date: <input type="date" name="end_date" value="<?php echo @$std['End_Date']?>" class="form-text mt-2">

    Conditions: <input type="text" name="conditions" value="<?php echo @$std['Conditions']?>" class="form-text mt-2">
    Award Details: <input type="text" name="award_details" value="<?php echo @$std['Award_Details']?>" class="form-text mt-2">
    
    <?php
    if(isset($_GET['edit_id']))
    {
        ?>
        <input type="submit" name="update_competitions" id="add_competitions" value="Update Competition" class="btn btn-secondary mt-2">
        <?php
    }
    else
    {
        ?>
        <input type="submit" name="add_competitions" id="add_competitions" value="Add Competition" class="btn btn-secondary mt-2">
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
    $('#title').blur(function(){
        var title = $(this).val();
        $.ajax({
            url: 'check.php',
            method: 'POST',
            data: {title:title},
            success: function(data)
            {
                if(data != '0')
                {
                    $('#availability').html('<span class="text-danger">This Competition Already Exists</span><br>');
                    $('#add_competitions').attr('disabled',true);
                }
                else
                {
                    $('#availability').html('');
                    $('#add_competitions').attr('disabled',false);
                }
            }

        });
    });
  });

</script>