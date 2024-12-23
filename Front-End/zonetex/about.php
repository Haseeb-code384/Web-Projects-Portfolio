<?php 
$titlepage = "ZoneTex- About Us";
$scriptpage = "assets/js/about.js";
include "header.php";
include "includes/navbar.php";
?>
<section class="page-highlight reveal">
  <img loading="lazy" src="./assets/images/about/about-highlight.jpeg" alt="">
  <div class="highlight-content">
    <h1>About Us</h1>
    <h4>Home / <span>About Us</span></h4>
  </div>
</section>
<section class="who-we-are ">
  <div class="image-cont-wwa reveal">
    <img loading="lazy" src="./assets/images/about/about-waa1.jpeg" alt="Who we Are">
    <img loading="lazy" src="./assets/images/about/about-waa2.jpeg" alt="Who we Are">

  </div>
  <div class="content-waa reveal">
    <h4>Who We are</h4>
    <h2>Your Source for Premium Fabrics Worldwide</h2>
    <p>Zone Tex is a leading textile export company based in Pakistan, specializing in providing high-quality fabrics and textile products to clients worldwide. Since our founding in 2009, we have built a reputation for excellence by delivering top-tier fabrics for both apparel and home textiles, including greige and PFD fabrics, as well as air-jet weaving and knitting solutions.<br><br>
    With a deep understanding of the global textile market, we partner with renowned suppliers and clients to ensure competitive pricing, timely delivery, and superior quality. At Zone Tex, our mission is to not only meet but exceed the expectations of our customers by offering innovative and reliable textile solutions that drive success in an ever-evolving industry.</p>
    <div class="btns-waa">
      <a href="about-us.php" class="btn-service">Our Services</a>
      <a href="contact-us.php" class="btn-contact">Contact Us</a>
    </div>
  </div>
</section>

<section class="mission-vision reveal">
  <div class="mv-content">
    <div class="mv-content-btns">
      <h4 onclick="openMvTab(event, 'Vision')" id="default-tab">Our Vision</h4>
      <h4 onclick="openMvTab(event, 'Mission')">Our Mission</h4>
    </div>
    <div class="mv-tabcontent" id= "Vision">
      <p>At Zone Textile, our vision is to become a global leader in textile innovation, known for delivering sustainable and high-quality fabrics that empower various industries and enhance everyday life. We aim to set new standards in the textile manufacturing sector by focusing on eco-friendly practices, advanced technologies, and unparalleled craftsmanship. Our goal is not only to meet the current demands of the industry but to anticipate future needs, all while contributing to a greener, more responsible world.</p>
    </div>
    <div class="mv-tabcontent" id= "Mission">
      <p>Our mission is to produce premium textile products that seamlessly blend cutting-edge technology with the rich heritage of traditional craftsmanship. We are dedicated to maintaining the highest standards of quality, durability, and sustainability in everything we do. By continuously innovating in fabric design and manufacturing processes, we offer custom solutions that cater to the diverse and evolving needs of our global clientele.
        <br><br>Sustainability is at the core of our operations. We are committed to eco-friendly practices and ethically sourced materials, ensuring that our work not only serves the textile industry but also benefits the communities and environments we impact. At Zone Textile, we believe that responsible manufacturing is key to building a better future for all.</p>
    </div>
  </div>
  <div class="mv-image">
    <img loading="lazy" src="./assets/images/about/about-mv.jpeg" alt="Our Mission and Vision">
  </div>
</section>


<?php
include("footer.php");
?>