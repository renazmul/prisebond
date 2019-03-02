<?php
// Connect to the database
$con=mysqli_connect('localhost', 'root', 'S@l098','prisebond');
//select Database
//mysql_select_db('prisebond');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//Query the Database
$sql="SELECT u.name AS Name, count(b.bdsl) AS Total FROM pbbond b, pbusers u where u.id=b.usid  group by Name,b.usid;";

($result=mysqli_query($con,$sql))

echo "<table border='1'>
<tr>
<th>Name</th>
<th>Total</th>
</tr>" 
While ($gp = mysql_fetch_assoc($result))
{
   echo"<tr>";
   echo"<td>" . $gp['Name']  . "</td>" ; 
   echo"<td>" . $gp['Total'] . "</td>" ;
   echo "</tr>";
}
   echo"</table>";   
   //Free Result Set
 //mysqli_free_result($result);
 mysqli_close($con);
 // or die(mysql_error());
//$rsprofl=mysql_fetch_assoc($profl_query);
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<style>
h6{
	display: block;
    font-size: 1.67em;
    margin-top: 2.33em;
    margin-bottom: 2.33em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
	text-align: left
  } 
</style>
</head>
<body>
<h6>

</h6>
<p><a href="welcome.php" class="btn btn-danger" style="float:left">Back your Profile</a></p>
</body>
</html>

	
	
