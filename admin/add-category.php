<?php 
include "header.php"; 
include "config.php"; 
//session_start();
if($_SESSION['user_role']=='0')
{
   header("Location: {$hostname}/admin/post.php");
}

if(isset($_POST['save']))
{
  $category_name=mysqli_real_escape_string($conn,$_POST['cat']);

   $sql="INSERT INTO category (category_name) VALUES('".$category_name."')";
    if(mysqli_query($conn,$sql))
    {
      header("Location: {$hostname}/admin/category.php");
    }
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
