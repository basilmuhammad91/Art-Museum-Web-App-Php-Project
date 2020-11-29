<?php 
include('header.php');

if(isset($_GET['delete_id']))
{
    $delete_id = $_GET['delete_id'];

    $query = mysqli_query($con, "delete from apply_competitions where Id = '$delete_id'") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewrequests.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Deleted !');</script>";
    }

}

if(isset($_POST['update_requests']))
{
    
    $id = $_POST['Id'];
    $remarks = $_POST['remarks'];
    $status = $_POST['status'];
    
    $query = mysqli_query($con, "update apply_competitions set Remarks = '$remarks', Status = '$status' where Id = '$id'") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewrequests.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Deleted !');</script>";
    }

}

?>

<main>

<div class="container">

<h3 class="mt-4 mb-4 float-left">All Teachers</h3>
<div class="table-responsive">
<table class="table table-striped mt-4" id="dataTable">
  <thead>
     <tr>
         <th>Id</th>
         <th>Student Name</th>
         <th>Quotation Details</th>
         <th>Stories</th>
         <th>Poems</th>
         <th>Painting Designs</th>
         <th>Painting Price</th>
         <th>Compedition Title</th>
         <th>Remarks</th>
         <th>Status</th>
         <th>Actions</th>
     </tr>
   </thead>
   <tfoot>
     <tr>
         <th>Id</th>
         <th>Student Name</th>
         <th>Quotation Details</th>
         <th>Stories</th>
         <th>Poems</th>
         <th>Painting Designs</th>
         <th>Painting Price</th>
         <th>Compedition Title</th>
         <th>Remarks</th>
         <th>Status</th>
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
   ');
   while($row=mysqli_fetch_array($query))
   {
?>

    <tr>
       <td><?php echo $row[0] ?></td>
       <td><?php echo $row['Name']?></td>
       <td><?php echo $row['Quotations_Details']?></td>
       <td><?php echo $row['Stories']?></td>
       <td><?php echo $row['Poems']?></td>
       <td>
           <img src="data:image/jpeg;base64,<?php echo base64_encode($row[5]) ?>" alt="Teacher Image" width="70" height="70">
       </td>
       <td><?php echo $row['Painting_Price']?></td>
       <td><?php echo $row['Title']?></td>
       <form action="viewrequests.php" method="post">
       <input type="hidden" name="Id" value="<?php echo $row[0]?>">
       <td>
       <select name="remarks" id="">
       <option <?php if($row['Remarks'] == "Pending"){echo "selected";}?>  value="Pending">Pending</option>
       <option <?php if($row['Remarks'] == "Best"){echo "selected";}?>   value="Best">Best</option>
       <option <?php if($row['Remarks'] == "Better"){echo "selected";}?>   value="Better">Better</option>
       <option <?php if($row['Remarks'] == "Good"){echo "selected";}?>   value="Good">Good</option>
       <option <?php if($row['Remarks'] == "Moderate"){echo "selected";}?>   value="Moderate">Moderate</option>
       <option <?php if($row['Remarks'] == "Normal"){echo "selected";}?>   value="Normal">Normal</option>
       </select>
       </td>
       <td>
       <select name="status" id="">
       <option <?php if($row[10] == "Pending"){echo "selected";}?> value="Pending">Pending</option>
       <option <?php if($row[10] == "Selected"){echo "selected";}?> value="Selected">Selected</option>
       <option <?php if($row[10] == "Not Selected"){echo "selected";}?> value="Not Selected">Not Selected</option>
       </select>
       </td>
       <td>
            <input type="submit" name="update_requests" value="Update" class="btn btn-secondary">
            <a href="viewrequests.php?delete_id=<?php echo $row[0]?>" class="btn btn-secondary">Delete</a>
       </td>
       </form>
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