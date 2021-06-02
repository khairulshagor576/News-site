<?php 

include "config.php";

$id=$_GET['id'];
$sql="DELETE FROM category WHERE category_id={$id}";

if(mysqli_query($conn,$sql))
{
  header("Location: {$hostname}/admin/category.php");
}else{
  echo "<p style='color:red;'>Con't Delete Data</p>";	
}

mysqli_close($conn);
?>