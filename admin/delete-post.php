<?php

include "config.php";

$id=$_GET['id'];
$category_id=$_GET['catid'];

//image remove from upload folder:

$image_sql="SELECT * FROM post WHERE post_id={$id}";
$rmv_sql=mysqli_query($conn,$image_sql) or die("Image remove query failed!!.");
$row_image=mysqli_fetch_assoc($rmv_sql);

unlink("upload/".$row_image['post_img']);

// echo "<pre>";
// print_r($row_image);
// die;

//delete post 
$sql="DELETE FROM post WHERE post_id={$id};";
//delete post number from category table:
$sql .="UPDATE category SET post =post-1 WHERE category_id={$category_id}";

if(mysqli_multi_query($conn,$sql))
{
  header("Location: {$hostname}/admin/post.php");
}else{
    echo "Data not deleted!!.";
}







?>