<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        // grab the input field
        $title = mysqli_real_escape_string($conn, $_POST['courseTitle']);
        $courseCategory = mysqli_real_escape_string($conn, $_POST['courseCategory']);
        $courseDesc = mysqli_real_escape_string($conn, $_POST['desc']);
        $courseStatus = mysqli_real_escape_string($conn, $_POST['status']);

        // image 
        // support extension
        $allowed_ext = array('png', 'jpg', 'jpeg');

        $courseThumbnail = $_FILES['courseThumbnail']['name'];
        $img_temp = $_FILES['courseThumbnail']['tmp_name'];
        $image_size = $_FILES['courseThumbnail']['size'];
        $target_dir = "../assets/thumbnail/$courseThumbnail";

        $image_ext = explode('.', $courseThumbnail);
        $image_ext = strtolower(end($image_ext));


        // validate the form 
        if(empty($title) || empty($courseCategory) || empty($courseDesc) || empty($courseStatus)) {
            $formErr = "All fields are required!";
        } else {
            
            if(in_array($image_ext, $allowed_ext)){
                if($image_size <= 5000000){
                    // image upload
                    move_uploaded_file($img_temp, $target_dir);

                    $addCourse = "INSERT INTO `courses` (`title`, `course_thumbnail`, `description`, `category_id`, `Status`, `created_at`) VALUES ('$title', '$courseThumbnail', '$courseDesc', '$courseCategory', '$courseStatus', current_timestamp());";
                    $addResult = mysqli_query($conn, $addCourse);

                    if(!$addResult) {
                        die("Add Query failed: " . mysqli_error($conn));
                    } else {
                        header("Location: courses.php?added");
                    }
                    
                }else {
                    $imgErr = '<p class="text-danger">Image size is too large, image size should be less than 500KB.</p>';
                }
            }else{
                $imgErr = '<p class="text-danger">Only .png, .jpg, .jpen and .gif allowed</p>';
            } 

        }
    }

 // get categories
 $catQuery = "SELECT * FROM course_categories";
 $get_category = mysqli_query($conn, $catQuery);

 if(!$get_category) {
    die("QUERY FAILED" . mysqli_error($conn));
 }
?>
<h2>Add Course</h2>
<hr>
<div class="container">
    <div class="add-course w-50 m-auto border p-3">
        <span class="text-danger mb-2 mt-2"><?= $formErr ?? null ?></span>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-2">
                <label for="CourseTitle">Course Title</label>
                <input type="text" name="courseTitle" class="form-control" placeholder="Type the course title here...">
            </div>
            <div class="mb-2">
                <label for="courseCategory">Course Category</label>
                <select name="courseCategory" id="" class="form-control">
                <option value="">Choose Category</option>
                <?php 
                    if(mysqli_num_rows($get_category) > 0) {
                        while($row=mysqli_fetch_assoc($get_category)) {
                            $cat_id = $row['category_id'];
                            $cat_name = $row['name'];
                    ?>
                        <option value="<?= $cat_id ?>"><?= $cat_name ?></option>
                    <?php
                        }
                    }
                ?>
                
                    
                  
                </select>
            </div>

            <div class="mb-2">
                <label for="courseThumbnail">Course Thumbnail</label>
                <input type="file" name="courseThumbnail" class="form-control">
                <span class="text-muted ms-2">Only .png, .jpg, .jpeg are allowed</span>
                <span class="text-danger"><?= $imgErr ?? null ?></span>
            </div>


            <div class="mb-2">
                <label for="desc">Description</label>
                <textarea name="desc" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <div class="mb-4">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="">Choose</option>
                    <option value="private">Private</option>
                    <option value="public">Public</option>
                </select>
            </div>

            <input type="submit" value="Add Course" class="mt-2 p-2" style="width: 100%;">
        </form>
    </div>
</div>