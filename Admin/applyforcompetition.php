<?php
include('header.php');

if(isset($_POST['submit']))
{
	$Student_Id = $_POST['Student_Id'];
	$Competition_Id = $_POST['Competition_Id'];
	$Quotations_Details = $_POST['Quotations_Details'];
	$Stories = $_POST['Stories'];
	$Poems = $_POST['Poems'];
	$img_file = addslashes(file_get_contents($_FILES['file']['tmp_name']));
	$Painting_Price = $_POST['Painting_Price'];
	$Document = addslashes(file_get_contents($_FILES['Document']['tmp_name']));
	$Remarks = 'Pending';
	$Status = 'Pending';

	$query = mysqli_query($con, "insert into apply_competitions (Student_Id, Quotations_Details, Stories, Poems, Image, Painting_Price, Competition_Id, Document, Remarks, Status) values ('$Student_Id','$Quotations_Details','$Stories','$Poems','$img_file','$Painting_Price','$Competition_Id','$Document','$Remarks','$Status')");

	if($query)
	{
		echo "Data Inserted";
	}
	else
	{
		echo "Not Inserted";
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

	<style>
		.register{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    margin-top: 3%;
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #f8f9fa;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #0062cc;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}
	</style>

</head>
<body>
	<?php
if(isset($_SESSION['Student_Email']))
{
?>
<div class="container">
		<?php
		$query = mysqli_query($con, "select * from competitions");
		$Student_Id = $_SESSION['Id'];
		while($row=mysqli_fetch_array($query))
		{
			$com_id = $row[0];
			$checkQuery = mysqli_query($con,"select * from apply_competitions where Student_Id = '$Student_Id' and Competition_Id = '$com_id'");
			$count = mysqli_num_rows($checkQuery);
			?>
			<div class="container register">
	                <div class="row">
	                    <div class="col-md-3 register-left">
	                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
	                        <h3><?php echo $row[1]?> Competition</h3>
	                        <p><?php echo $row['Conditions'] ?></p>
	                        <div class="alert alert-success blink">
	                        	<h5><b><?php echo $row['Start_Date']?> - <?php echo $row['End_Date']?></b></h5>
	                        </div>
	                    </div>
	                    <div class="col-md-9 register-right">
	                        <div class="tab-content" id="myTabContent">
	                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><br>
	                                <h3 class="register-heading">Apply for a Competition</h3>
	                                
	                                <form method="post" enctype="multipart/form-data">
	                                	<div class="row register-form">
	                                	    <div class="col-md-6">
		                                        <div class="form-group">
		                                            <input type="hidden" name="Student_Id" value="<?php echo $_SESSION['Id'] ?>">
		                                            <input type="hidden" name="Competition_Id" value="<?php echo $row[0] ?>">
		                                            <textarea class="form-control" id=""rows="1" placeholder="Quotations Details *" name="Quotations_Details"></textarea>
		                                        </div>
		                                        <div class="form-group">
		                                            <textarea class="form-control" id=""rows="1" placeholder="Stories *" name="Stories"></textarea>
		                                        </div>
		                                        <div class="form-group">
		                                        	<label><b>Your Document *</b></label>
		                                            <input type="file" class="" name="Document" accept="application/pdf">
		                                        </div>
		                                        <span class="text-danger">Document must contain your stories, poems, painting designs and pricing details.</span>
		                                    </div>
		                                    <div class="col-md-6">
		                                    	<div class="form-group">
		                                            <!-- <input type="password" class="form-control" placeholder="Password *" value="" /> -->
		                                            <textarea class="form-control" name="Poems" id=""rows="1" placeholder="Poems *"></textarea>
		                                        </div>
		                                        <div class="form-group">
		                                            <input type="number" class="form-control" placeholder="Painting Price *" name="Painting_Price" value="" />
		                                        </div>
		                                        <div class="form-group">
		                                        	<label for="Painting Design"><b>Painting Design *</b></label>
		                                            <input type="file" name="file" id="profile-img" accept="Image/*">
													<img class="img-fluid mt-3" src="" id="profile-img-tag" width="200px" />
		                                        </div>
		                                        <?php
		                                        if($count>0)
		                                        {
		                                        	?>
		                                        	<div class="alert alert-danger" role="alert">
														You have been applied for this competition.
													</div>
													<input type="submit" name="submit" class="btnRegister" disabled="" value="Apply" style="opacity: 10" />
		                                        	<?php
		                                        }
		                                        else
		                                        {
		                                        	?>
		                                        	<input type="submit" name="submit" class="btnRegister" value="Apply"/>
		                                        	<?php
		                                        }
		                                        ?>
		                                        
		                                    </div>
		                                </div>
	                            	</form>
	                            </div>
	                        </div>
	                    </div>
	                </div>

		</div>
			<?php
		}
		?>
		
	</div>
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
	
</body>
</html>

<script type="text/javascript">

	function blink(selector){
$(selector).fadeOut('slow', function(){
    $(this).fadeIn('slow', function(){
        blink(this);
    });
});
}

blink('.blink');

	function readURL(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function (e) {

                $('#profile-img-tag').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);

        }

    }

    $("#profile-img").change(function(){

        readURL(this);

    });
</script>