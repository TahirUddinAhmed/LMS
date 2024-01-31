<?php include("includes/admin_header.php"); ?>
<?php
//  Add categories
 if(isset($_POST['addCat'])) {
    $catName = mysqli_real_escape_string($conn, $_POST['categoryName']);

    if(empty($catName)) {
        $catErr = "Category name is required!";
    } else {
        // query to insert data into database
        $query = "INSERT INTO course_categories (`name`, `added_on`) VALUES ('$catName', current_timestamp());";
        $result = mysqli_query($conn, $query);

        if(!$result) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {
            header("location: categories.php");
        }
    }


 }

//  query to retrieve all categories item
$query = "SELECT * FROM course_categories";
$result = mysqli_query($conn, $query);

if(!$result) {
    die('QUERY FAILED' . mysqli_error($conn));
}
?>
<div class="container-fluid px-4">
    <h2 class="mt-4">Categories</h2> 
    <hr>
    <a href="?add" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add new</a> 

    <?php
        if(isset($_GET['add'])) {
    ?>
<div class="border p-2 mt-2" style="width: 26rem;">
        <form action="" method="POST">
               
                <div class="form-outline mb-4">
                    <label class="form-label" for="CategoryName">Name</label>
                    <input type="text" name="categoryName" id="categoryName" class="form-control" placeholder="Type category..." />
                    <span class="text-danger"><?= $catErr ?? null ?></span>
                </div>
                
                <button type="submit" name="addCat" class="btn btn-primary btn-block">Add Category</button>
        </form>


    </div>
    <?php
        }
    ?>
    

    <div class="card mb-4 mt-4">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>SNO</th>
                        <th>Category Name</th>
                        <th>No. of Courses</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SNO</th>
                        <th>Category Name</th>
                        <th>No. of Courses</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php
                    if(mysqli_num_rows($result) > 0) {
                        $sno = 1;
                        while($data=mysqli_fetch_assoc($result)) {
                            $cat_id = $data['category_id'];
                            $name = $data['name'];
                ?>
                    <tr>
                        <td><?= $sno ?></td>
                        <td><strong><?= $name ?></strong></td>
                        <td>0</td>
                        <td>
                            <!-- edit -->
                            <a href="" class="btn btn-sm btn-success">Edit</a>
                            <!-- delete -->
                            <a href="" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php
                   $sno++;
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("includes/admin_footer.php"); ?>