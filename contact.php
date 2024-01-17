<?php include("includes/header.php") ?>
   <section id="contact">
    <h2>Contact Us</h2>
    <p class="contact-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id distinctio commodi quos ipsam nam. Odit.</p>
    
    <!-- contact form & address -->
    <div class="contact">
        <div class="contact-form container">
            <form action="#" method="post">
                <div class="input-field">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="input-field">
                    <label for="phone">Phone</label>
                    <input type="phone" name="phone" id="phone">
                </div>
                <div class="input-field">
                    <p>
                        <label for="message">Message</label>
                    </p>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                </div>

                <button type="submit" class="btn">Send Message</button>
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