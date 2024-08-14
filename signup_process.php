<?php
session_start();

include ("db.php");

//deactivate the automatic error messing
mysqli_report(MYSQLI_REPORT_OFF);

$pagename="sign up results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>".$pagename."</title>"; //display name of the page as window title

echo "<body>";

include ("headfile.html"); //include header layout file 

echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

//Capture the 7 inputs entered in the 7 fields of the form using the $_POST superglobal variable
//Store these details into a set of 7 new local variables
$fname = trim($_POST['r_firstname']);
$lname = trim($_POST['r_lastname']);
$address = trim($_POST['r_address']);
$postcode = trim($_POST['r_postcode']);
$telno = trim($_POST['r_telno']);
$email = trim($_POST['r_email']);
$password1 = trim($_POST['r_password1']);
$password2 = trim($_POST['r_password2']);
	
//Write a SQL query to insert a new user into users table
$SQL = "insert into users
(userType, userFName, userSName, userAddress, userPostCode, userTelNo, userEmail,userPassword)
values
('C','".$fname."','".$lname."','".$address."','".$postcode."', '".$telno."', '".$email."', '".$password1."')";

//Execute the INSERT INTO SQL query
mysqli_query($conn, $SQL);
	
//create a regular expression variable	
$reg = "/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9]+)*(\.[a-z]{2,3})$/";

if(empty($fname)or empty($lname)or empty($address)or empty($postcode)or empty($telno)or empty($email)or
 empty($password1)or empty($password2))
{	
	echo "<p><b>Sign-up Failed!</b></p>";
	echo "<br><p>Your signup form is incomplete and all fields are mandatory";
	echo "<br>Make sure you provide all the required details</p>";
	echo "<br><p>Go back to <a href=signup.php>sign up</a></p>";
	echo "<br><br><br><br>";
}

	elseif ($password1<>$password2) //if not match
	{
		echo "<p><b>Sign-up failed!</b></p>";
		echo "<br><p>2 passwords are not matching";
		echo "<br>Make sure you enter them correctly";
		echo "<br><p>Go back to <a href=signup.php>sign up</a></p>";
		echo "<br><br><br><br>";
	}
	elseif (!preg_match($reg, $email))
	{
		echo "<p><b>Sign-up failed!</b></p>";
		echo "<br><p>Email not valid";
		echo "<br>Make sure you enter a correct email address";
		echo "<br><p>Go back to <a href=signup.php>sign up</a></p>";
		echo "<br><br><br><br>";
	}
	else 
	{
		//write sql query to insert new user into user table and execute sql query
		$SQL = "insert into users
		(userType, userFName, userSName, userAddress, userPostCode,userTelNo,userEmail,userPassword)
		values
		('C','$fname','$lname','$address','$postcode','$telno','$email','$password1')";

		//if sql execution is correct	
		if(mysqli_query($conn, $SQL))
		{
			//display sign up success
			echo "<p><b>Sign-up successful!</b></p>";
			echo "<br><p>Go to Login in Page <a href=login.php>Login</a></p>";
		}
		//if the SQL execution is erroneous, there is a problem
		else
		{
			//display sign up failure
			echo "<p><b>Sign-up failed!</b></p>";	
		
			//echo "<p>SQL Error :".mysqli_errno($conn)."</p>";
		
			//if error detector returns number 1062 i.e. unique constraint on the email is breached 
			//(meaning that the user entered an email which already existed)
			if(mysqli_errno($conn)==1062)
			{
				echo "<br><p>An account with your e-mail address is already registered ";
				echo "<br> you may be already registered or try another email address</p>";
				//echo "<br><p>Go back to: <a href = 'signup.php'>Sign up</a></p>";
			}
			
			//if error detector returns number 1064 i.e. invalid characters such as ' and \ have been entered 
			if(mysqli_errno($conn)==1064)
			{
				echo "<br><p>Invalid charaters used</p> ";
				$invalidchars = "apostrophes like ['] and backslashes like [\]";
				echo "<br>Make sure you avoid the following characters:".$invalidchars. "</p>";		
			}
			echo "<br><p>Go back to: <a href = 'signup.php'>Sign up</a></p>";
			echo "<br><br><br><br>";
		}
	}

include("footfile.html"); //include head layout

echo "</body>";
?>

