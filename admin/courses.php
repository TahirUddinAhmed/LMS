<?php include("includes/admin_header.php"); ?>

<div class="container-fluid px-4">
    <?php
        if(isset($_GET['source'])) {
            $source = $_GET['source'];
        } else {
            $source = "";
        }

        switch($source) {
            case 'add': 
                include("includes/_addCourse.php");
                break;
            default: 
                include("includes/_manageCourse.php");
        }
    ?>
</div>
<?php include("includes/admin_footer.php"); ?>