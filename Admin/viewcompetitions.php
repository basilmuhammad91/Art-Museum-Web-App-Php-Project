<?php 
include('header.php');

if(isset($_GET['delete_id']))
{
    $delete_id = $_GET['delete_id'];

    $query = mysqli_query($con, "delete from competitions where Id = '$delete_id'") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewcompetitions.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Deleted !');</script>";
    }

}

?>

<main>

<div class="container">

<h3 class="mt-4 mb-4 float-left">All Competitions</h3>
<?php
if(!isset($_SESSION['Student_Email']))
{
?>
<a href="addcompetitions.php" class="btn btn-secondary float-right mt-4 mb-4">Add New Competition</a>
<?php
}
?>

<div class="table-responsive">
<table class="table table-striped mt-4" id="dataTable">
   <thead>
     <tr>
         <th>Id</th>
         <th>Title</th>
         <th>Description</th>
         <th>Image</th>
         <th>Status</th>
         <th>Start Date</th>
         <th>End Date</th>
         <th>Conditions</th>
         <th>Award Details</th>
         <?php
         if(!isset($_SESSION['Student_Email']))
         {
          ?>
            <th>Actions</th>
          <?php
         }
         ?>
     </tr>
   </thead>
   <tfoot>
     <tr>
         <th>Id</th>
         <th>Title</th>
         <th>Description</th>
         <th>Image</th>
         <th>Status</th>
         <th>Start Date</th>
         <th>End Date</th>
         <th>Conditions</th>
         <th>Award Details</th>
         <?php
         if(!isset($_SESSION['Student_Email']))
         {
          ?>
            <th>Actions</th>
          <?php
         }
         ?>
         
     </tr>
   </tfoot>

<tbody>
   <?php
   $query = mysqli_query($con, 'select * from competitions');
   while($row=mysqli_fetch_array($query))
   {
?>

    <tr>
       <td><?php echo $row['Id'] ?></td>
       <td><?php echo $row['Title']?></td>
       <td><?php echo $row['Description']?></td>
       <td>
           <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Image']) ?>" alt="Competition Image" width="70" height="70">
       </td>
       <td><?php echo $row['Status']?></td>
       <td><?php echo $row['Start_Date']?></td>
       <td><?php echo $row['End_Date']?></td>
       <td><?php echo $row['Conditions'] ?></td>
       <td><?php echo $row['Award_Details'] ?></td>
       <?php
       if(!isset($_SESSION['Student_Email']))
       {
        ?>
          <td>
            <div class="row">
            <div class="col-md-6">
            <a href="addcompetitions.php?edit_id=<?php echo $row['Id'] ?>" class="btn btn-secondary">Edit</a>
            <br>
            <!-- </div>
            <br>
            <div class="col-md-6"> -->
            <a href="viewcompetitions.php?delete_id=<?php echo $row['Id']?>" class="btn btn-secondary mt-2">Delete</a>
            </div>
            </div>
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
include('footer.php');
?>