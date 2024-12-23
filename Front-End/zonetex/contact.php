<?php 
$titlepage = "ZoneTex- Contact Us";
$scriptpage = "assets/js/contact.js";
include "header.php";
include "includes/navbar.php";
?>
<section class="page-highlight reveal">
  <img loading="lazy" src="./assets/images/contact/contact-highlight.jpg" alt="">
  <div class="highlight-content">
    <h1>Contact Us</h1>
    <h4>Home / <span>Contact Us</span></h4>
  </div>
</section>


<section class="contact-form-box">
  <div class="form-content reveal">
    <h2>Get a Quote</h2>
    <p>Ready to start your project? Let us know your requirements, and we will provide a tailored quote just for you. </p>
  </div>
  <form action="" class="form-contact reveal">
    <label for="name" class="form-name">Name
      <input type="text" name="username" id="name" placeholder="Your Name">
    </label>
    <label for="email" class="form-email">Email
      <input type="email" name="email" id="email" placeholder="Your Email">
    </label>
    <label for="phone" class="form-phone">Phone
      <input type="tel" name="phone" id="phone" placeholder="Your Phone">
    </label>
    <label for="company" class="form-company">Company
      <input type="text" name="company" id="company" placeholder="Your Company Name">
    </label>
    <label for="subject" class="form-subject">Subject
      <input type="text" name="subject" id="subject" placeholder="Subject Here">
    </label>
    <label for="message" class="form-message">Message
      <textarea name="message" id="message" placeholder="Your Message Here" rows="6"></textarea>
    </label>
    <input type="submit" value="Send" class="submit-btn">
  </form>
</section>

<section class="contact-map">
  <div class="map-cont reveal">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d813.5373368365488!2d73.06243303467906!3d31.38409943718022!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39225d087a8b2255%3A0x8415cce97940b5d6!2sZone%20Tex!5e1!3m2!1sen!2s!4v1731609121068!5m2!1sen!2s"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
  <div class="contact-cont reveal">
    <div class="get-content">
      <h4>Contact Us</h4>
      <h2>Get In Touch</h2>
      <p>Reach out to us directly with any questions or requests. We’re just a call or email away and look forward to connecting with you!</p>
    </div>
    <ul class="detail-contact">
      <li><a href=""><i class="bi bi-telephone"></i>+92 345 2626888</a></li>
      <li><a href=""><i class="bi bi-telephone"></i>+92 300 6674057</a></li>
      <li><a href=""><i class="bi bi-envelope"></i>info@zone-tex.com</a></li>
      <li><a href=""><i class="bi bi-envelope"></i>mehmud@zone-tex.com</a></li>
      <li><a href=""><i class="bi bi-geo-alt"></i>FD-2, Madni Masjid,Sanora Colony, Faisalabad</a></li>
    </ul>
  </div>
</section>




<?php
include("footer.php");
?>