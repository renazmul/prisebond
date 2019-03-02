<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: loggin.php");
  exit;
}
?>

<?php
// Connect to the database
mysql_connect('localhost', 'root', 'S@l098');
//select Database
mysql_select_db('prisebond');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//Query the Database
$sql="SELECT name,mobile,email FROM pbusers";
$records=mysql_query($sql); // or die(mysql_error());
//$rsprofl=mysql_fetch_assoc($profl_query);
?>

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
$sql="SELECT usid AS Name FROM pbbond order by usid;";
if
($result=mysqli_query($con,$sql))
{
	//Return the Number of rows in result set
 $rowcount=mysqli_num_rows($result);
   //Free Result Set
 mysqli_free_result($result);
}
mysqli_close($con);
 // or die(mysql_error());
//$rsprofl=mysql_fetch_assoc($profl_query);
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
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
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Welcome to our site.</h1>
    </div>
    <p><a href="logout.php" class="btn btn-danger" style="float:right">Sign Out of Your Account</a></p>
	<p><a href="profl.php" class="btn btn-danger" style="float:left">Your Profile</a></p>
</body>
<body>
<br>
<head>
<h6> User Profile Details : </h6>
</head>
<table style="float:char_from_name" width="600" border="1" cellpadding="1" cellspacin="1" >
<tr>
<th>  Name </th>
<th>  Mobile </th>
<th>  Email </th>
<tr>
<?php
while($pb=mysql_fetch_assoc($records))
{
	echo "<tr>";
	echo "<td>".$pb['name']."</td>";
	echo "<td>".$pb['mobile']."</td>";
	echo "<td>".$pb['email']."</td>";
	echo "</tr>";
}
?>
</table>
<br>
<h6>
<?php
 Printf("Total Number of Prise Bond : %d \n",$rowcount);
?>
<br>
<h6>
<?php
  Printf("Total Amount BDT :  %d \n",$rowcount*100);
?>
</h6>
</html>
