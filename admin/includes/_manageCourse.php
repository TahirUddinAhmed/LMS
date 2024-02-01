<?php
//  query to retrieve all course data 
$query = "SELECT * FROM courses";
$result = mysqli_query($conn, $query);

 if(!$result) {
    die("Query failed" . mysqli_error($conn));
 }

// delete course 
if(isset($_GET['delete'])) {
    $c_id = $_GET['delete'];

    // query 
    $d_query = "DELETE FROM courses WHERE course_id = $c_id";
    $d_result = mysqli_query($conn, $d_query);

    if(!$d_result) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        header("Location: courses.php");
    }
}
?>
<h2>Manage course</h2>
<hr>

<?php
 if(isset($_GET['added'])) {
?>
<div class="alert alert-primary alert-dismissible fade show" role="alert">
<i class="fa-solid fa-circle-check ms-2"></i> One Course is successfully Created
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
 }
?>

<?php
 if(isset($_GET['lessonAdded'])) {
?>
<div class="alert alert-primary alert-dismissible fade show" role="alert">
<i class="fa-solid fa-circle-check ms-2"></i> Lesson added successfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
 }
?>


<div class="container-fluid">
    <div class="text-end mb-2">
        <a href="?source=lesson" class="btn btn-sm btn-success"><i class="fa-solid fa-plus me-2"></i> Add Lessons</a>
    </div>
<div class="card mb-4">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>SNO</th>
                        <th>Thumbnail</th>
                        <th>Title & Category</th>
                        <th>Lessons</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SNO</th>
                        <th>Thumbnail</th>
                        <th>Title & Category</th>
                        <th>Lessons</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    if(mysqli_num_rows($result) > 0) {
                        $sno = 1;
                        while($row=mysqli_fetch_assoc($result)) {
                            $courseID = $row['course_id'];
                            $courseTitle = $row['title'];
                            $courseThumbnail = $row['course_thumbnail'];
                            $cat_id = $row['category_id'];
                            $status = $row['Status'];
                            $added_on = $row['created_at'];

                            // category name 
                            $get_CatName = mysqli_query($conn, "SELECT * FROM course_categories WHERE category_id = $cat_id");

                            if(!$get_CatName) {
                                die("QUERY FAILED" . mysqli_error($conn));
                            }

                            while($row=mysqli_fetch_assoc($get_CatName)) {
                                $cat_name = $row['name'];
                            }
                    ?>

                            <tr>
                                <td><?= $sno ?></td>
                                <td>
                                    <img src="../assets/thumbnail/<?= $courseThumbnail ?>" class="img-fluid" width="100" alt="">
                                </td>
                                <td>
                                    <strong><?= $courseTitle ?></strong>
                                    <p><?= $cat_name ?></p>
                                </td>
                                <td>
                                    0
                                </td>
                                <td class="mb-2">
                                 <?php
                                    if($status == 'public') {
                                ?>
                                    <span class="bg-success p-1 rounded-pill text-white"><?= $status ?></span>
                                <?php
                                    } else {
                                ?>
                                        <span class="bg-danger p-1 rounded-pill text-white"><?= $status ?></span>

                                <?php
                                    }
                                 ?>
                                </td>
                                <td>
                                    <!-- edit -->
                                    <a href="" class="btn btn-sm btn-outline-success">Edit</a>
                                    <!-- delete -->
                                    <a href="?delete=<?= $courseID ?>" class="btn btn-sm btn-danger">Delete</a>
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