<?php
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