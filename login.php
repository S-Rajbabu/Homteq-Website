<?php
session_start();

$pagename="Login"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>".$pagename."</title>"; //display name of the page as window title

echo "<body>";

include ("headfile.html"); //include header layout file 

echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

//user detail
echo "<center>";
echo "<form method=post action=login_process.php>";
//echo "<table syle='border: 0px'
echo "<table id='baskettable'>";

echo "<tr>";
echo "<td style='border:0px'>Email Address</td>";
echo "<td style='border:0px'><input type=text name=r_email size= 35</td>";
echo "</tr>";

echo "<tr>";
echo "<td style='border:0px'>Password</td>";
echo "<td style='border:0px'><input type=password name=r_password maxlength=10 size= 35</td>";
echo "</tr>";

echo "<tr>";
echo "<td style='border: 0px'><input type=reset value='Clear Form' name='submitbtn' id='submitbtn'></td>";
echo "<td style='border: 0px'><input type=submit value='Log In' name='submitbtn' id='submitbtn'></td>";
echo "</tr>";
	
echo"</table>";
echo"</form>";
echo "</center>";	

include("footfile.html"); //include head layout

echo "</body>";
?>

