<?php 
session_start();
if($_SESSION['user_role']=='0')
{
   header("Location: {$hostname}/admin/post.php");
}
include "config.php";

$id=$_GET['id'];
$sql="DELETE FROM user WHERE user_id={$id}";

if(mysqli_query($conn,$sql))
{
  header("Location: {$hostname}/admin/users.php");
}else{
  echo "<p style='color:red;'>Con't Delete Data</p>";	
}

mysqli_close($conn);
?>