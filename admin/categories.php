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

//  Edit category 
if(isset($_POST['editCat'])) {
    $catID = $_POST['cat-id'];
    $catName = $_POST['categoryName'];

    // update query 
    $update = "UPDATE `course_categories` SET `name` = '$catName' WHERE `category_id` = $catID;";
    $updateResult = mysqli_query($conn, $update);

    if(!$updateResult) {
        die("Update QUERY FAILED" . mysqli_error($conn)); 
    } else {
        header("Location: categories.php");
    }
}

//  Delete category
if(isset($_GET['delete'])) {
    $catID = $_GET['delete'];

    // query to delete category
    $delete = "DELETE FROM course_categories WHERE category_id = $catID";
    $result = mysqli_query($conn, $delete);

    if(!$result) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        // refresh the page
        header("Location: categories.php");
    }
}

//  query to retrieve all categories item
$query = "SELECT * FROM course_categories ORDER BY `category_id` DESC";
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

        if(isset($_GET['edit'])) {
            $theID = $_GET['edit'];

            $query = "SELECT * FROM course_categories WHERE category_id = $theID";
            $get_result = mysqli_query($conn, $query);

            if(!$get_result) {
                die("QUERY FAILED" . mysqli_error($conn));
            }

            while($row=mysqli_fetch_assoc($get_result)) {
                $name = $row['name'];
            }

    ?>
            <div class="border p-2 mt-2" style="width: 26rem;">
                <form action="" method="POST">
                        <input type="hidden" name="cat-id" value="<?= $theID ?>">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="CategoryName">Name</label>
                            <input type="text" name="categoryName" value="<?= $name ?>" id="categoryName" class="form-control" placeholder="Type category..." />
                            <span class="text-danger"><?= $catErr ?? null ?></span>
                        </div>
                        
                        <button type="submit" name="editCat" class="btn btn-primary btn-block">Save Changes</button>
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

                            // no of course
                            $courseQ = "SELECT * FROM courses WHERE category_id = $cat_id";
                            $getCourse_res = mysqli_query($conn, $courseQ);
                            $getNumCource = mysqli_num_rows($getCourse_res);
                            
                ?>
                    <tr>
                        <td><?= $sno ?></td>
                        <td><strong><?= $name ?></strong></td>
                        <td><?= $getNumCource ?></td>
                        <td>
                            <!-- edit -->
                            <a href="?edit=<?= $cat_id ?>" class="btn btn-sm btn-success"><i class="fa-solid fa-pen"></i> Edit</a>
                            <!-- delete -->
                            <a href="?delete=<?= $cat_id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delele this category?')"><i class="fa-solid fa-xmark"></i> Delete</a>
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