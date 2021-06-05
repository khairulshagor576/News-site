<?php include "header.php"; 
      include "config.php";
$limit=3;
if(!empty($_GET['page']))
{
    $page=$_GET['page'];
}else{
    $page=1;
}
$offset=($page-1)*$limit;      
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                <?php
                 if($_SESSION['user_role']=='1')
                 {
                   //admin shows all post 
                  $sql="SELECT * FROM post
                  LEFT JOIN category ON post.category=category.category_id
                  LEFT JOIN user ON post.author=user.user_id 
                  ORDER BY post.post_id DESC 
                  LIMIT {$offset},{$limit}";
                 }elseif($_SESSION['user_role']=='0')
                 {
                  //normal user show only his post 
                  $sql="SELECT * FROM post
                  LEFT JOIN category ON post.category=category.category_id
                  LEFT JOIN user ON post.author=user.user_id
                  WHERE post.author={$_SESSION['user_id']}
                  ORDER BY post.post_id DESC 
                  LIMIT {$offset},{$limit}";
                 }
                 
                  $result=mysqli_query($conn,$sql) or die("Query Failed.!!");
                  if(mysqli_num_rows($result)>0)
                  {
                ?> 
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Category</th>
                          <th>Image</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <!-- <img src="upload/khairul.jpg"> -->
                      <tbody>
                        <?php 
                         while ($row=mysqli_fetch_assoc($result))
                         {
                        ?>
                          <tr>
                              <td class='id'><?php echo $row['post_id'];?></td>
                              <td><?php echo $row['title'];?></td>
                              <td><?php echo $row['description'];?></td>
                              <td><?php echo $row['category_name'];?></td>
                              <td><img src="upload/<?php echo $row['post_img'];?>" alt="post image" height="100" width="100"></td>
                              <td><?php echo $row['post_date'];?></td>
                              <td><?php echo $row['username'];?></td>
                              <td class='edit'><a href='update-post.php?eid=<?php echo $row["post_id"]; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row["post_id"]; ?>&catid=<?php echo $row["category"]; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
                  <?php } 
                  $page_sql="SELECT * FROM post";
                  $output=mysqli_query($conn,$page_sql) or die("Query Failed.");
                  if(mysqli_num_rows($output)>0){
                  $total_records = mysqli_num_rows($output);
                  $total_pages=ceil($total_records/$limit);
                  echo "<ul class='pagination admin-pagination'>";
                  for ($i=1; $i <=$total_pages; $i++) 
                  { 
                    if($i==$page)
                    {
                      $active = "active";
                    }else
                    { 
                      $active = "";
                    } 
                     echo "<li class='".$active."'><a href='post.php?page={$i}'>{$i}</a></li>"; 
                  }
                     echo "</ul>";
                    }
                   ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
