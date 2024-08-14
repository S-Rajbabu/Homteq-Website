<?php
session_start();

include ("db.php");

$pagename="Login results"; //Create and populate a variable called $pagename

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>".$pagename."</title>"; //display name of the page as window title

echo "<body>";

include ("headfile.html"); //include header layout file 

echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

$email = trim($_POST['r_email']);
$password = trim($_POST['r_password']);

//echo "<p><b>Email entered :-$email</b></p>";
//echo "<p><b>Password entered :-$password</b></p>";

if(empty($email)or empty($password)){
	echo "<p><b>Login Failed!</b></p>";
	echo "<br><p>Login form is incomplete";
	echo "<br>Make sure you provide all the required details</p>";
	echo "<br><p>Go back to <a href=login.php>Login</a></p>";
	echo "<br><br><br><br>";
}else{
	$SQL = "SELECT * FROM Users WHERE userEmail= '".$email."'"; 
	//run SQL query for connected DB or exit and display error message
	$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

	//$arrayu = mysqli_fetch_array($exeSQL);
	$nbrecs = mysqli_num_rows($exeSQL);
	//if the number of records is 0 (i.e. email retrieved from the DB does not match $email login email in form
	if($nbrecs == 0)
	{
		echo "<p><b>Login failed!</b>"; //display login error
		echo "<br>Email not recognised</p>";
		echo "<br><p> Go back to <a href=login.php>login</a></p>";
	}
	//else
	else	
	{
		$arrayuser = mysqli_fetch_array($exeSQL); 
		//if password retrieved from the database (in arrayu) does not match $password
		if($arrayuser['userPassword'] <>  $password)
		{
			echo "<p><b>Login failed!</b>"; //display login error
			echo "<br>Password not valid</p>";
			echo "<br><p> Go back to <a href=login.php>login</a></p>";
		}
		//else
		else	
		{
			//display login success message and store user id, user type, name into 4 session variables i.e.
			//create $_SESSION['userid'], $_SESSION['usertype'], $_SESSION['fname'], $_SESSION['sname'],
			//Greet the user by displaying their name using $_SESSION['fname'] and $_SESSION['sname']
			//Welcome them as a customer by using $_SESSION['usertype '] 
		echo "<p><b>Login success!</b></p>";
		echo $_SESSION['userid'] = $arrayuser['userId']; 
		echo $_SESSION['usertype']= $arrayuser['userType'];
		echo $_SESSION['fname']= $arrayuser['userFName'];
		echo $_SESSION['sname']= $arrayuser['userSName'];
		echo "<p>Welcome: ". $_SESSION['fname']." ".$_SESSION['sname']."</p>"; 
		
		
		if ($_SESSION['usertype']=='A') //if user type is A, they are an admin
		{

			echo "<p>User Type".$_SESSION['usertype']=': Administrator'."</p>";
			echo "<br><p>Continue shopping for <a href=index.php>Home Tech</a>";
		}
		
		if ($_SESSION['usertype']=='C') //if user type is C, they are a customer
		{
			//echo $_SESSION['usertype']='Customer';
			echo "<p>User Type".$_SESSION['usertype']=': Customer'."</p>";
			
			echo "<br><p>Continue shopping for <a href=index.php>Home Tech</a>";
			echo "<br>View your <a href=basket.php>Smart Basket</a></p>";
		}

		
		
		
		}
	}
}

include("footfile.html"); //include head layout

echo "</body>";
?>

