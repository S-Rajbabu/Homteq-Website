<?php
if (isset($_SESSION['userid']))
{
echo "<p style='float: right'><i><b>  Account: ".$_SESSION['fname']." ".$_SESSION['sname']." |User Type".$_SESSION['usertype']."</b></i></p>";

//echo "<p style='float: right'><i><b> User type: ".$_SESSION['usertype']." ".$_SESSION['userid']."</b></i></p>";
}
?>