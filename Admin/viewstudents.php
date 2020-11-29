<?php 
include('header.php');

if(isset($_GET['delete_id']))
{
    $delete_id = $_GET['delete_id'];

    $query = mysqli_query($con, "delete from students where Id = '$delete_id'") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewstudents.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Deleted !');</script>";
    }

}

if(isset($_SESSION['Admin_Email']) || isset($_SESSION['Teacher_Email']))
{

?>

<main>

<div class="container">

<h3 class="mt-4 mb-4 float-left">All Students</h3>
<?php
if(isset($_SESSION['Admin_Email']))
{
?>
<a href="addstudents.php" class="btn btn-secondary float-right mt-4 mb-4">Add New Students</a>
<?php
}
?>
<div class="table-responsive">
<table class="table table-striped mt-4" id="dataTable">
  <thead>
   <tr>
       <th>Id</th>
       <th>Name</th>
       <th>Father Name</th>
       <th>Email</th>
       <th>Password</th>
       <th>Phone</th>
       <th>Address</th>
       <th>Image</th>
       <th>Class</th>
       <?php
       if(isset($_SESSION['Admin_Email']))
       {
        ?>
      <td>Actions</td>
        <?php
       }

       ?>
   </tr>
   </thead>
   <tfoot>
   <tr>
       <th>Id</th>
       <th>Name</th>
       <th>Father Name</th>
       <th>Email</th>
       <th>Password</th>
       <th>Phone</th>
       <th>Address</th>
       <th>Image</th>
       <th>Class</th>
       <?php
       if(isset($_SESSION['Admin_Email']))
       {
        ?>
      <td>Actions</td>
        <?php
       }

       ?>
       
   </tr>
   </tfoot>
<tbody>
   <?php
   $query = mysqli_query($con, 'select * from students');
   while($row=mysqli_fetch_array($query))
   {
?>

    <tr>
       <td><?php echo $row[0] ?></td>
       <td><?php echo $row['Name']?></td>
       <td><?php echo $row['Father_Name']?></td>
       <td><?php echo $row['Email']?></td>
       <td><?php echo $row['Password']?></td>
       <td><?php echo $row['Phone']?></td>
       <td><?php echo $row['Address']?></td>
       <td>
           <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Image']) ?>" alt="Student Image" width="70" height="70" class="rounded-circle">
       </td>
       <td><?php echo $row['Class_Id']?></td>
       <?php
       if(isset($_SESSION['Admin_Email']))
       {
        ?> 
        <td>
            <a href="addstudents.php?edit_id=<?php echo $row[0] ?>" class="btn btn-secondary">Edit</a>
            <a href="viewstudents.php?delete_id=<?php echo $row[0]?>" class="btn btn-secondary">Delete</a>
       </td>
       <?php
       }
       ?>
       
   </tr>

<?php
   }
   ?>
  </tbody>
</table>
</div>
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