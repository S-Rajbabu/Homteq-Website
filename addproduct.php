<?php
$pagename="ADMIN: add a new product"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>".$pagename."</title>"; //display name of the page as window title

echo "<body>";

include ("headfile.html"); //include header layout file 

echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

//user detail


echo "<form method=post action=addproduct_process.php>";
echo "<table id='baskettable'>";
//echo "<table syle='border: 0px'>";

echo "<tr>";
echo "<td style='border:0px'>Product Name</td>";
echo "<td style='border:0px'><input type=text name=r_productname size=35</td>";
echo "</tr>";

echo "<tr>";
echo "<td style='border:0px'>Small Picture Name</td>";
echo "<td style='border:0px'><input type=text name=r_lastname size=35</td>";
echo "</tr>";

echo "<tr>";
echo "<td style='border:0px'>Large Picture Name</td>";
echo "<td style='border:0px'><input type=text name=r_address size= 35</td>";
echo "</tr>";

echo "<tr>";
echo "<td style='border:0px'>Short Description</td>";
echo "<td style='border:0px'><input type=text name=r_postcode size= 35</td>";
echo "</tr>";

echo "<tr>";
echo "<td style='border:0px'>Long Description</td>";
echo "<td style='border:0px'><input type=text name=r_telno size= 35</td>";
echo "</tr>";

echo "<tr>";
echo "<td style='border:0px'>Price</td>";
echo "<td style='border:0px'><input type=text name=r_email size= 35</td>";
echo "</tr>";

echo "<tr>";
echo "<td style='border:0px'>Initial Stock Quantity</td>";
echo "<td style='border:0px'><input type=password name=r_password1 maxlength=10 size= 35</td>";
echo "</tr>";


echo "<tr>";
echo "<td style='border: 0px'><input type=submit value='Add Product' name='submitbtn' id='submitbtn'></td>";
echo "<td style='border: 0px'><input type=reset value='Clear Form' name='submitbtn' id='submitbtn'></td>";
echo "</tr>";

echo"</table>";
echo"</form>";

		
include("footfile.html"); //include head layout

echo "</body>";
?>

