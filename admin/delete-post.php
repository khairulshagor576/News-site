<?php

include "config.php";

$id=$_GET['id'];
$category_id=$_GET['catid'];

$sql="DELETE FROM post WHERE post_id={$id};";
$sql .="UPDATE category SET post =post-1 WHERE category_id={$category_id}";

if(mysqli_multi_query($conn,$sql))
{
  header("Location: {$hostname}/admin/post.php");
}else{
    echo "Data not deleted!!.";
}







?>