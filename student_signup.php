	<?php
	include('admin/database_connection.php');

	if(isset($_POST['add_students']))
{
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $class_id = $_POST['class_id'];

    $query = mysqli_query($con, "insert into students (Name, Father_Name, Email, Password, Phone, Address, Image, Class_Id) values('$name', '$fname', '$email','$password','$phone','$address','$img','$class_id')") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewstudents.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }

}


	?>

	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="codepixer">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Art Museum</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">					
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/main.css">
		</head>
		<body>

			  <header id="header" id="home">
			  	<div class="container header-top">
			  		<div class="row">
				  		<div class="col-6 top-head-left">
				  			<ul>
				  				<li><a href="#">Visit Us</a></li>
				  				<li><a href="#">Buy Ticket</a></li>
				  			</ul>
				  		</div>
				  		<div class="col-6 top-head-right">
				  			<ul>
		  						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-behance"></i></a></li>
				  			</ul>
				  		</div>			  			
			  		</div>
			  	</div>
			  	<hr>
			    <div class="container">
			    	<div class="row align-items-center justify-content-between d-flex">
				      <div id="logo">
				        <a href="index.html"><img src="img/logo.png" alt="" title="" /></a>
				      </div>
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
				          <li class="menu-active"><a href="index.html">Home</a></li>
				          <li><a href="about.html">About</a></li>
				          <li><a href="gallery.html">Gallery</a></li>
				          <li><a href="event.html">Events</a></li>
				          <li><a href="ticket.html">Ticket</a></li>
				          <li><a href="blog-home.html">Blog</a></li>
				          <li><a href="contact.html">Contact</a></li>
				          <li class="menu-has-children"><a href="">Pages</a>
				            <ul>
				              <li><a href="blog-single.html">Blog Single</a></li>
				              <li><a href="category.html">Category</a></li>
				              <li><a href="elements.html">Elements</a></li>
				            </ul>
				          </li>			          
				        </ul>
				      </nav><!-- #nav-menu-container -->		    		
			    	</div>
			    </div>
			  </header><!-- #header -->


			<!-- start banner Area -->
			<section class="banner-area relative" id="home">
				<div class="overlay overlay-bg"></div>	
				<div class="container">
				<div class="row fullscreen d-flex align-items-center justify-content-center">
						<div class="banner-content col-lg-8">
							<div class="row text-center">

							<div class="col-md-6">
							<form action="student_signup.php" class="text-white text-center mt-5" style="margin-top:100px; padding-top:150px">
								
							<label style="color:white; font-size: 20px; font-family: monospace" for="">Name: </label> 
							<input style="background: none" type="text" class="text-white form-control mt-2">
							<label style="color:white; font-size: 20px; font-family: monospace" for="">Father Name: </label> 
							<input style="background: none" type="text" name="fname" value="<?php echo @$std['Father_Name']?>" class="text-white form-control mt-2">
							<label style="color:white; font-size: 20px; font-family: monospace" for="">Email: </label> 
							<input style="background: none" type="email" name="email" value="<?php echo @$std['Email']?>" class="text-white form-control mt-2">
							<label style="color:white; font-size: 20px; font-family: monospace" for="">Password: </label> 
							<input style="background: none" type="password" name="password" value="<?php echo @$std['Password']?>" class="text-white form-control mt-2">
							<label style="color:white; font-size: 20px; font-family: monospace" for="">Phone: </label>> 
							<input style="background: none" type="text" name="phone" value="<?php echo @$std['Phone']?>" class="text-white form-control mt-2">
							</div>
							<div class="col-md-6" style="margin-top:200px;">
						    <label style="color:white; font-size: 20px; font-family: monospace" for="">Address: </label> 
							<input style="background: none" type="text" name="address" value="<?php echo @$std['Address']?>" class="text-white form-control mt-2">
							<label style="color:white; font-size: 20px; font-family: monospace" for="">Image: </label> 
							<input type="file" name="image" class="form-text mt-2 text-center offset-2">
    <?php
    if(isset($_GET['edit_id']))
    {
        ?>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($std['Image'])?>" alt="" width="70" height="70" class="image mt-3 mb-4 offset-2"><br>
        <?php
    }
    ?>
    <br>
    <label style="color:white; font-size: 20px; font-family: monospace" for="">Class: </label>
    <select name="class_id" class="ml-3 mb-3 offset-2">
    <option value="">Select</option>
        <?php
        $query = mysqli_query($con, "select * from classes");
        while($row=mysqli_fetch_array($query))
        {
            ?>
                <option <?php if($row['Id'] == @$std['Class_Id']) {echo 'selected';} ?> value="<?php echo $row['Id']?>"><?php echo $row['Class_Name']?></option>
            <?php
        }
        ?>
    </select><br>

    <?php
    if(isset($_GET['edit_id']))
    {
        ?>
        <input type="submit" name="update_students" value="Update Students" class="primary-btn text-uppercase mt-2">
        <?php
    }
    else
    {
        ?>
        <input type="submit" name="add_students" value="Add Students" class="primary-btn text-uppercase mt-2">
        <?php
    }
    ?>



							</form>
						
							</div>
							</div>
						</div>											
					</div>
				</div>					
			</section>
			<!-- End banner Area -->	

			
			

			<!-- start footer Area -->		
			<footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-5 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>About Us</h6>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.
								</p>
								<p class="footer-text">
									<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								</p>
							</div>
						</div>
						<div class="col-lg-5  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Newsletter</h6>
								<p>Stay update with our latest</p>
								<div class="" id="mc_embed_signup">
									<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
										<input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">
			                            	<button class="click-btn btn btn-default"><span class="lnr lnr-arrow-right"></span></button>
			                            	<div style="position: absolute; left: -5000px;">
												<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
											</div>

										<div class="info"></div>
									</form>
								</div>
							</div>
						</div>						
						<div class="col-lg-2 col-md-6 col-sm-6 social-widget">
							<div class="single-footer-widget">
								<h6>Follow Us</h6>
								<p>Let us be social</p>
								<div class="footer-social d-flex align-items-center">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-dribbble"></i></a>
									<a href="#"><i class="fa fa-behance"></i></a>
								</div>
							</div>
						</div>							
					</div>
				</div>
			</footer>	
			<!-- End footer Area -->		

			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>			
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>	
			<script src="js/owl.carousel.min.js"></script>	
			<script src="js/imagesloaded.pkgd.min.js"></script>
			<script src="js/justified.min.js"></script>					
			<script src="js/jquery.sticky.js"></script>
			<script src="js/jquery.nice-select.min.js"></script>			
			<script src="js/parallax.min.js"></script>		
			<script src="js/mail-script.js"></script>	
			<script src="js/main.js"></script>	
		</body>
	</html>



