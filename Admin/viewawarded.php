<?php 
include('header.php');

if(isset($_GET['delete_id']))
{
    $delete_id = $_GET['delete_id'];

    $query = mysqli_query($con, "delete from awarded_students where Id = '$delete_id'") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewawarded.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Deleted !');</script>";
    }

}

if(isset($_POST['update']))
{
  $id = $_POST['id'];
  $status = "Pending";
  $query = mysqli_query($con, "update apply_competitions set Status = '$status' where Id = '$id'");
}

if(!isset($_SESSION['Student_Email']))
{
?>
<main>

<div class="container">

<h3 class="mt-4 mb-4 float-left">All Awarded Students </h3>
<!-- <a href="addawardedstudents.php" class="btn btn-secondary float-right mt-4 mb-4">Add New Awarded Student</a> -->
<div class="table-responsive">
<table class="table table-striped mt-4" id="dataTable">
   
   <thead>
     <tr>
         <th>Id</th>
         <th>Name</th>
         <th>Competition</th>
         <th>Remarks</th>
         <th>Actions</th>
     </tr>
   </thead>

   <tfoot>
     <tr>
         <th>Id</th>
         <th>Name</th>
         <th>Competition</th>
         <th>Remarks</th>
         <th>Actions</th>
     </tr>
   </tfoot>
  <tbody>
   <?php
   $query = mysqli_query($con, '
  

   SELECT * FROM apply_competitions 
INNER JOIN 
students
ON
apply_competitions.Student_Id = students.Id
INNER JOIN 
competitions
ON
apply_competitions.Competition_Id = competitions.Id 
WHERE apply_competitions.Status = "selected"

   ');
   while($row=mysqli_fetch_array($query))
   {
?>

    <tr>
       <td><?php echo $row[0] ?></td>
       <td><?php echo $row['Name']?></td>
       <td><?php echo $row['Title']?></td>
       <td><?php echo $row['Remarks'] ?></td>
       <td>
            <!-- <a href="addawardedstudents.php?edit_id=<?php echo $row['Id'] ?>" class="btn btn-secondary">Edit</a>
            <a href="viewawarded.php?delete_id=<?php echo $row['Id']?>" class="btn btn-secondary">Delete</a> -->
            <form action="viewawarded.php" method="post">
              <input type="hidden" name="id" value="<?php echo $row[0]?>">
              <input type="submit" value="Remove" name="update" class="btn btn-secondary">
            </form>
       </td>
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
?>



<?php
include('footer.php');
?>

<!-- 
 -- SELECT awarded_students.Id, students.Name, competitions.Title,awarded_students.Remarks  FROM awarded_students 
   --  INNER JOIN
   --  students
   --  ON
   --  awarded_students.Student_Id = students.Id
   --  INNER JOIN 
   --  competitions
   --  ON
   --  awarded_students.Competition_Id = competitions.Id -->