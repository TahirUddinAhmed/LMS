<?php
 // 
 if(isset($_GET['cid'])) {
    $course_id = $_GET['cid'];
 }

 // count lesson number 
 $countLesson = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM lessons WHERE course_id = $course_id")); 

 if($countLesson <= 0) {
    header("Location: courses.php?emptyLesson");
    exit();
 }

//  query to retrieve all lesson for that specific course 
 $query = "SELECT * FROM lessons WHERE course_id = $course_id";
 $result = mysqli_query($conn, $query);

 if(!$result) {
    die("QUERY FAILED" . mysqli_error($conn));
 }

//  get the course name 
$courseQuery = "SELECT * FROM courses WHERE course_id = $course_id";
$courseRes = mysqli_query($conn, $courseQuery);

if(!$courseRes) {
    die("Course QUERY FAILED: " . mysqli_error($conn));
}

while($data=mysqli_fetch_assoc($courseRes)) {
    $courseName = $data['title'];
}


?>
<h2>Manage Lessons</h2>
<p>Course Name: <strong><?= $courseName ?? null ?></strong></p>
<hr>

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
                        <th>Video</th>
                        <th>Lesson Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SNO</th>
                        <th>Video</th>
                        <th>Lesson Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php
                  $sno = 1;
                    while($row=mysqli_fetch_assoc($result)) {
                        $lesson_id = $row['lesson_id'];
                        $lesson_title = $row['title'];
                        $video = $row['content'];
                        $status = $row['status'];
                ?>
                    <tr>
                        <td><?= $sno ?></td>
                        <td>
                            <div class="embed-responsive embed-responsive-1by1">
                                <iframe class="embed-responsive-item" src="../assets/course-video/<?= $video ?>"></iframe>
                            </div>
                        </td>
                        <td>
                            <p><strong><?= $lesson_title ?></strong></p>
                        </td>
                        <td>
                            <?= $status ?>
                        </td>
                        <td>
                            <a href="" class="btn btn-sm btn-danger">delete</a>
                            <a href="" class="btn btn-sm btn-success">edit</a>
                        </td>
                        
                    </tr>
                <?php
                 $sno++;
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>