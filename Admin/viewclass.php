<?php 
include('header.php');

if(isset($_GET['delete_id']))
{
    $delete_id = $_GET['delete_id'];

    $query = mysqli_query($con, "delete from classes where Id = '$delete_id'") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewclass.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Deleted !');</script>";
    }

}
if(!isset($_SESSION['Student_Email']))
{
?>
<main>

<div class="container">

<h3 class="mt-4 mb-4 float-left">All Classes</h3>
<a href="addclass.php" class="btn btn-secondary float-right mt-4 mb-4">Add New Class</a>

<div class="card-body">
<div class="table-responsive">
<table class="table table-striped mt-4 table-bordered" id="dataTable">
  <thead>
   <tr>
       <th>Id</th>
       <th>Class Name</th>
       <th>Teacher</th>
       <th>Actions</th>
   </tr>
  </thead>
  <tfoot>
   <tr>
       <th>Id</th>
       <th>Class Name</th>
       <th>Teacher</th>
       <th>Actions</th>
   </tr>
  </tfoot>

<tbody>
   <?php
   $query = mysqli_query($con, '
        select * from classes 
        INNER JOIN
        teachers
        ON
        classes.Teacher_Id = teachers.Id
   ');
   while($row=mysqli_fetch_array($query))
   {
?>

    <tr>
       <td><?php echo $row[0] ?></td>
       <td><?php echo $row['Class_Name']?></td>
       <td><?php echo $row['Name'] ?></td>
       <td>
            <a href="addclass.php?edit_id=<?php echo $row[0] ?>" class="btn btn-secondary">Edit</a>
            <a href="viewclass.php?delete_id=<?php echo $row[0]?>" class="btn btn-secondary">Delete</a>
       </td>
   </tr>

<?php
   }
   ?>
</tbody>
</table>
</div>
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
?>



<?php
include('footer.php');
?>