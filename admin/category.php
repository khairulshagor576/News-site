<?php 
include "header.php";
include "config.php";
//session_start();
if($_SESSION['user_role']=='0')
{
   header("Location: {$hostname}/admin/post.php");
}

//$page=$_GET['page'];
$limit=3;
if(isset($_GET['page']))
{
  $page=$_GET['page'];
}else
{
  $page=1;
}
$offset=($page-1)*$limit; 

$sql="SELECT * FROM category LIMIT {$offset},{$limit}";
$result=mysqli_query($conn,$sql);
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <?php 
                if(mysqli_num_rows($result)>0){
                ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                    <?php 
                    while ($row=mysqli_fetch_assoc($result)) 
                    {
                    ?> 
                        <tr>
                            <td class='id'><?php echo $row['category_id'];?></td>
                            <td><?php echo $row['category_name'];?></td>
                            <td><?php echo $row['post'];?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $row["category_id"];?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $row["category_id"];?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                    <?php } ?>    
                    </tbody>
                </table>
            <?php }

            $page_sql="SELECT * FROM category";
            $output=mysqli_query($conn,$page_sql);
            if(mysqli_num_rows($output)>0)
            { 

            $total_records=mysqli_num_rows($output); 
            $total_pages=ceil($total_records/$limit);
            echo "<ul class='pagination admin-pagination'>";
            for ($i=1; $i <=$total_pages; $i++) 
            { 
               echo "<li><a href='category.php?page=".$i."'>".$i."</a></li>";      
            }    
            echo "</ul>";
            } 
            ?>    
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
