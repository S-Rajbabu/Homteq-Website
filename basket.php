<?php
//Adding session
session_start();

include ("db.php");

$pagename="Smart basket"; //Create and populate a variable called $pagename

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>".$pagename."</title>"; //display name of the page as window title

echo "<body>";

include ("headfile.html"); //include header layout file 

include ("detectlogin.php");

echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

//if the value of the product id to be deleted (which was posted through the hidden field) is set
if(isset($_POST['del_prodid']))
{
	//capture the posted product id and assign it to a local variable $delprodid
	$delprodid = $_POST['del_prodid'];
	//unset the cell of the session for this posted product id variable
	unset ($_SESSION['basket'][$delprodid]);
	//display a "1 item removed from the basket" message
	echo "<p><b>1 item removed from the basket</b></p>";
}


//if the posted ID of the new product is set i.e. if the user is adding a new product into the basket
if(isset($_POST['h_prodid']))
{
	//capture the ID of selected product using the POST method and the $_POST superglobal variable
	//and store it in a new local variable called $newprodid
	$newprodid=$_POST['h_prodid'];
	
	//capture the required quantity of selected product using the POST method and $_POST superglobal variable 
	//and store it in a new local variable called $reququantity
	$reququantity = $_POST['p_quantity'];
	
	//--------------------
	//display the value of the product id, for debugging purposes
	//echo "<p>ID of selected product: ".$newprodid;
	//echo "<p>Quantity of selected product: ".$reququantity;
	//--------------------

	//create a new cell in the basket session array.Index this cell with the new product id.Inside the cell store the required product quantity 
	$_SESSION['basket'][$newprodid]=$reququantity;
	echo "<p><b>1 item added to the basket</b></p>";
}

//else
//{
	//echo "<p><b>Basket unchanged</b></p>";	
//}


$total = 0;	//Create a variable $total and initialize it to zero

//Create a HTML table with a header to display the content of the shopping basket 
echo "<p><table id = 'baskettable'>";
echo "<tr>";
echo "<th>Product Name</th>";
echo "<th>Price</th>";
echo "<th>Quantity</th>";
echo "<th>Sub-Total</th>";
echo "<th>Remove Product</th>";
echo "</tr>";

//if the session array $_SESSION['basket'] is set
if(isset($_SESSION['basket']))
{
	//loop through the basket session array for each data item inside the session using a foreach loop 
	//to split the session array between the index and the content of the cell
	//for each iteration of the loop
	//store the id in a local variable $index & store the required quantity into a local variable $value
	
	foreach($_SESSION['basket'] as $index => $value)
	{
		//SQL query to retrieve from Product table details of selected product for which id matches $index
		//execute query and create array of records $arrayp
		$SQL="select prodId, prodName,prodPrice  from product where prodId=".$index;
		
		//run SQL query for connected DB or exit and display error message
		$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
		$arrayp=mysqli_fetch_array($exeSQL);
		
		//create a new HTML table row
		echo "<tr>";
		echo "<td>".$arrayp['prodName']."</td>";
		echo "<td> &pound".$arrayp['prodPrice']."</td>";
		
		//display selected quantity of product retrieved from the cell of session array and now in $value
		echo "<td style ='text-align:center'>".$value."</td>";


		//calculate subtotal, store it in a local variable $subtotal and display it
		$subtotal = $arrayp['prodPrice'] * $value;	
		echo "<td> &pound".number_format($subtotal,2)."</td>";
		
		echo "<form action = basket.php method =post>";
		echo "<td>";
		echo "<input type = submit value ='Remove' id = 'submitbtn' >";
		echo "</td>";
		echo "<input type = hidden name = del_prodid value=".$arrayp['prodId'].">";
		echo "</form>";
		echo "</tr>";
	
		//increase total by adding the subtotal to the current total
		$total = $total + $subtotal;
	}
}
else{
	//Display empty basket message
	echo "<p><b>Empty Basket</b></p>";
	}
	
	
	

//Total
echo "<tr>";
echo "<td colspan =4><b>Total </b></td>";
echo "<td><b> &pound".number_format($total,2)."</b></td>";
echo "</tr>";
echo "</table>";

//Anchor
echo "<br><p><a href = 'clearbasket.php'>CLEAR BASKET</a></p>";


//echo "<br><p>New homteq customers: <a href = 'signup.php'>Sign up</a></p>";
//echo "<br><p>Returning homteq customers: <a href = 'login.php'>Login</a></p><br>";

if (isset($_SESSION['userid'])) 
	{
	echo "<br><p>To finalise your order: <a href=checkout.php>CHECKOUT</a></p>";
	}
else
	{
	echo "<br><p>New homteq customers: <a href='signup.php'>Sign up</a></p>";
	echo "<p>Returning homteq customers: <a href='login.php'>Login</a></p>";
	}

include("footfile.html"); //include head layout

echo "</body>";
?>

