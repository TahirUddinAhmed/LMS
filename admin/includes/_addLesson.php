<?php

// grab the course list 
$courseQuery = "SELECT * FROM courses";
$getCourse = mysqli_query($conn, $courseQuery);

if(!$getCourse) {
   die('QUERY FAILED' . mysqli_error($conn)); 
}

if(mysqli_num_rows($getCourse) <= 0) {
    header("Location: courses.php?source=add");
    exit();
}

 if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lesson_title = mysqli_real_escape_string($conn, $_POST['lessonTitle']);
    $CourseId = mysqli_real_escape_string($conn, $_POST['course']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // video upload
    $video_name = $_FILES['video']['name'];
    $temp_name = $_FILES['video']['tmp_name'];
    $video_size = $_FILES['video']['size'];
    $error = $_FILES['video']['error'];
    $videoFileType = strtolower(pathinfo($video_name,PATHINFO_EXTENSION));

    // allowed extension
    $allowed_ext = array('mp4', 'webm', 'avi', 'mov');

    if(empty($lesson_title) || empty($CourseId) || empty($status)) {
        $formErr = "All fields are required!";
    } else {
        if($error == 0) {
            if(in_array($videoFileType, $allowed_ext)) {
                $newVideName = uniqid("lesson-", true) . '.' . $videoFileType;
                $targetDirectory = "../assets/course-video/$newVideName";
    
                move_uploaded_file($temp_name, $targetDirectory);
    
                // query to insert data into database 
                $query = "INSERT INTO `lessons` (`course_id`, `title`, `content`, `status`, `created_at`) VALUES ('$CourseId', '$lesson_title', '$newVideName', '$status', current_timestamp());";
                $result = mysqli_query($conn, $query);
    
                if(!$result) {
                    die("QUERY FAILED" . mysqli_error($conn));
                } else {
                    // redirect -> course manage page 
                    header("Location: courses.php?lessonAdded");
                }
                
            } else {
                $videoErr = "Only .mp4, .webm, .avi and .mov are allowed";
            }
        } else {
            $videoErr = "Choose a video file";
        }
    }

    
    
    
    
 }

 
?>
<h2>Add Lesson</h2>
<hr>

<div class="container">
    <div class="add-course w-50 m-auto border p-3">
        <span class="text-danger mb-2 mt-2"><?= $formErr ?? null ?></span>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-2">
                <label for="CourseTitle">Lecture Title</label>
                <input type="text" name="lessonTitle" class="form-control" placeholder="Type the course title here...">
            </div>
            <div class="mb-2">
                <label for="courseCategory">Select Course</label>
                <select name="course" id="" class="form-control">
                <option value="">Choose Course</option>
                <?php
                    while($row=mysqli_fetch_assoc($getCourse)) {
                        $courseID = $row['course_id'];
                        $courseTitle = $row['title'];
                ?>
                    <option value="<?= $courseID ?>"><?= $courseTitle ?></option>
                <?php
                    }
                ?>
                </select>
            </div>

            <div class="mb-2">
                <label for="courseThumbnail">Video</label>
                <input type="file" name="video" class="form-control">
                <!-- <span class="text-muted ms-2">Only .png, .jpg, .jpeg are allowed</span> -->
                <span class="text-danger"><?= $videoErr ?? null ?></span>
            </div>

            <div class="mb-4">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="">Choose</option>
                    <option value="private">Private</option>
                    <option value="public">Public</option>
                </select>
            </div>

            <input type="submit" value="Add Lession" class="mt-2 p-2" style="width: 100%;">
        </form>
    </div>
</div>