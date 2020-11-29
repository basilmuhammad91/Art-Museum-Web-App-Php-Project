<?php 
include('header.php');

if(isset($_GET['delete_id']))
{
    $delete_id = $_GET['delete_id'];

    $query = mysqli_query($con, "delete from teachers where Id = '$delete_id'") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewteachers.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Deleted !');</script>";
    }

}

?>


<?php
if(isset($_SESSION['Admin_Email']))
{

?>
<main>

<div class="container">

<h3 class="mt-4 mb-4 float-left">All Teachers</h3>

<?php
if(isset($_SESSION['Admin_Email']))
{
    ?>
    <a href="addteachers.php" class="btn btn-secondary float-right mt-4 mb-4">Add New Teacher</a>  
    <?php  
}
?>

 <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Joining Date</th>
                                                <th>Classes</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Joining Date</th>
                                                <th>Classes</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                          <?php
                                           $query = mysqli_query($con, '

                                            select teachers.Id, teachers.Name, teachers.Email, teachers.Password, teachers.Phone, teachers.Address, teachers.Image, teachers.Joining_Date, GROUP_CONCAT(classes.Class_Name) as classes 
                                            FROM 
                                            teachers 
                                            LEFT JOIN 
                                            classes 
                                            ON 
                                            teachers.Id = classes.Teacher_Id 
                                            GROUP BY teachers.Id

                                            ');
                                           while($row=mysqli_fetch_array($query))
                                           {
                                        ?>
                                            <tr>
                                                 <td><?php echo $row['Id'] ?></td>
                                                 <td><?php echo $row['Name']?></td>
                                                 <td><?php echo $row['Email']?></td>
                                                 <td><?php echo $row['Password']?></td>
                                                 <td><?php echo $row['Phone']?></td>
                                                 <td><?php echo $row['Address']?></td>
                                                 <td><?php echo $row['Joining_Date']?></td>
                                                 <td>
                                                   
                                                   <?php

                                                   $classes = explode(",", $row['classes']);
                                                   foreach($classes as $class)
                                                   {
                                                      echo $class.'<br>';
                                                   }

                                                   ?>

                                                 </td>
                                                 <td>
                                                     <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Image']) ?>" alt="Teacher Image" width="70" height="70">
                                                 </td>
                                                 
                                                 <td>
                                                      <a href="addteachers.php?edit_id=<?php echo $row['Id'] ?>" class="btn btn-secondary">Edit</a>
                                                      <a href="viewteachers.php?delete_id=<?php echo $row['Id']?>" class="btn btn-secondary">Delete</a>
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

include('footer.php');
?>


<script>
  
</script>