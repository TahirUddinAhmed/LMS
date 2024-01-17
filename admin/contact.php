<?php
 include("includes/admin_header.php");
?>
<?php
  // retrieve all the data 
  $sql = "SELECT * FROM contact";
  $result = mysqli_query($conn, $sql);
  
  if(!$result) {
    die("QUERY FAILED BECAUSE: " . mysqli_error($conn));
  }

  $no_of_data = mysqli_num_rows($result);

  // delete contact 
  if(isset($_GET['delete'])) {
    $the_id = $_GET['delete'];

    // delete query 
    $sql = "DELETE FROM contact WHERE `contact`.`contact_id` = $the_id";
    $delete_result = mysqli_query($conn, $sql);

    if(!$delete_result) {
        die("QUERY FAILED: " . mysqli_error($conn));
    } else {
        header("location: contact.php");
    }

  }


?>

<div class="container-fluid mt-3">
    <h3>Contact Us</h3>
    <hr>

    <div class="card mb-4">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                  <?php
                    if($no_of_data > 0) {
                        while($data=mysqli_fetch_assoc($result)) {
                            $id = $data['contact_id'];
                            $name = $data['name'];
                            $email = $data['email'];
                            $phone = $data['phone'];
                            $message = $data['message'];
                    ?>
                       <tr>
                          <td><?= $name ?></td>
                          <td>
                            <p>
                                <?= $email ?>
                            </p>
                            <p>
                                <?= $phone ?>
                            </p>
                          </td>
                          <td><?= $message ?></td>
                          <td>
                            <!-- // reply button -->
                            <a href="mailto:<?= $email ?>" class="btn btn-sm btn-primary">Reply</a>
                            <!-- delete button -->
                            <a href="?delete=<?= $id ?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Delete</a>
                          </td>
                       </tr>
                    <?php
                        }
                    }
                  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("includes/admin_footer.php"); ?>