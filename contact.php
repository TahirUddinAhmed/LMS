<?php include("includes/header.php") ?>
<?php
 if($_SERVER["REQUEST_METHOD"] == "POST") {
    // grab all the input fields
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // validate the contact form 
    $error = []; // initializing an empty array 
    if(empty($name)) {
        $error['name'] = "Name is required";
    }

    if(empty($email)) {
        $error['email'] = "Email is required";
    } 

    if(empty($phone)) {
        $error['phone'] = "Phone number is required";
    }

    if(empty($message)) {
        $error['message'] = "Message is required";
    }

    if(empty($error)) {
        // insert date into database 
        $sql = "INSERT INTO `contact` (`name`, `email`, `phone`, `message`, `added_on`) VALUES ('$name', '$email', '$phone', '$message', current_timestamp());";
        $result = mysqli_query($conn, $sql);
    
        if(!$result) {
            die("QUERY FAILED: " . mysqli_error($conn));
        } else {
            $success = "Thank you for contacting us";
        }

    }

 }

?>

   <section id="contact">
    <h2>Contact Us</h2>
    <h3 class="contact-text" style="color: green;"><?= $success ?? null ?></h3>
    <p class="contact-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id distinctio commodi quos ipsam nam. Odit.</p>
    
    <!-- contact form & address -->
    <div class="contact">
        <div class="contact-form container">
            <form action="" method="post">
                <div class="input-field">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">
                    <span style="color: #ED4F32;">
                    <?php
                        if(isset($error['name'])) {
                          echo $error['name'];
                        }
                    ?>
                   </span>
                </div>
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                    <span style="color: #ED4F32;">
                    <?php
                        if(isset($error['email'])) {
                          echo $error['email'];
                        } 
                    ?>
                   </span>
                </div>
                <div class="input-field">
                    <label for="phone">Phone</label>
                    <input type="phone" name="phone" id="phone">
                    <span style="color: #ED4F32;">
                    <?php
                        if(isset($error['phone'])) {
                          echo $error['phone'];
                        } 
                    ?>
                   </span>
                </div>
                <div class="input-field">
                    <p>
                        <label for="message">Message</label>
                    </p>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                    <span style="color: #ED4F32;">
                    <?php
                        if(isset($error['message'])) {
                          echo $error['message'];
                        } 
                    ?>
                   </span>
                </div>

                <button type="submit" name="contact" class="btn">Send Message</button>
            </form>
        </div>
        <div class="contact-address container">
          
           <div class="office-address">
             <div class="addr-phone">
                 <i class="fa-solid fa-phone"></i>
                 <p class="addr-name">Phone</p>
                 <a href="tel:">9365910717</a>
                 <a href="tel:">6002592382</a>
             </div>
 
             <div class="addr-email">
                 <i class="fa-solid fa-envelope"></i>
                 <p class="addr-name">Email</p>
 
                 <a href="">01tahirahmed@gmail.com</a>
                 <a href="">01tahirahmed@gmail.com</a>
             </div>
 
             <div class="addr-office">
                 <i class="fa-solid fa-location-dot"></i>
                 <p class="addr-name">Office Address</p>
                 <p>Morigaon, Assam, 782105</p>
             </div>
           </div>

        </div>
    </div>
    <!-- !contact form & address -->

   </section>
 <?php include("includes/footer.php"); ?>