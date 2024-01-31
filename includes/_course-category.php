<?php
 // query to retrieve all course categories
 $query = "SELECT * FROM course_categories";
 $result = mysqli_query($conn, $query);

 if(!$result) {
    die("category retrieve failed: " . mysqli_error($conn));
 } 



?>
<div class="course-categories">
    <h3>Course Category</h3>

    <?php
        if(mysqli_num_rows($result)) {
            while($row=mysqli_fetch_assoc($result)) {
                $cat_id = $row['category_id'];
                $cat_name = $row['name'];
    ?>
    <ul>
        <li> <a href="?category=<?= $cat_id ?>"><?= $cat_name ?></a> </li>

    </ul>
    <?php
            }
        }
    ?>
    
</div>