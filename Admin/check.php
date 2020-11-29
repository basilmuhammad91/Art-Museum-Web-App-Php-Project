<?php

// check_teacher_email.php

// IT WILL CONNEC DATABASE
include('database_connection.php');

if(isset($_POST['email']))
{
	$email = $_POST['email'];

	$query = mysqli_query($con, "select * from teachers where email = '$email'");

	echo mysqli_num_rows($query);
}

if(isset($_POST['name']))
{
	$name = $_POST['name'];

	$query = mysqli_query($con, "select * from classes where class_name = '$name'");

	echo mysqli_num_rows($query);
}

if(isset($_POST['std_name']))
{
	$name = $_POST['std_name'];

	$query = mysqli_query($con, "select * from students where name = '$name'");

	echo mysqli_num_rows($query);
}

if(isset($_POST['title']))
{
	$title = $_POST['title'];

	$query = mysqli_query($con, "select * from competitions where title = '$title'");

	echo mysqli_num_rows($query);
}

?>