<style>
  @media(max-width:768px) {
    /* .footer-menu {
      align-items: center;
      justify-content: center;
    } */

    .contact-details {
      flex: none;
    }

    /* .footer-section {
      align-items: center;
    } */
  }
</style>
<footer>
  <div class="footer-container">
    <!-- Logo and Description -->
    <div class="footer-section">
      <div class="footer-logo">
        <a href="index.php"> <img
            src="assets/images/shutku-logo.png"
            alt="Logo"
            class="logo-img" /></a>

      </div>
      <p class="footer-description">
        At Shutku, we believe every baby deserves the best start in life. That’s why we bring you safe, gentle, and thoughtfully crafted baby products designed to make parenting easier and childhood happier.
      </p>

      <!-- Newsletter Subscription -->
      <!-- <div class="newsletter">
        <h3 class="footer-heading">Stay Updated</h3>
        <form class="newsletter-form">
          <input
            type="email"
            placeholder="Your email address"
            class="newsletter-input"
            required />
          <button type="submit" class="newsletter-button">
            Subscribe
          </button>
        </form>
      </div> -->

      <div class="social-icons">
        <a href="#" class="social-link" aria-label="Facebook">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" class="social-link" aria-label="Twitter">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="social-link" aria-label="Instagram">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="#" class="social-link" aria-label="LinkedIn">
          <i class="fab fa-linkedin-in"></i>
        </a>
      </div>
    </div>

    <!-- Quick Links Menu -->
    <div class="footer-section">
      <h3 class="footer-heading">Quick Links</h3>
      <nav class="footer-menu">
        <a href="index.php" class="footer-link">Home</a>
        <a href="#about-shutku" class="footer-link">About Us</a>
        <a href="#products-shutku" class="footer-link">Products</a>
        <!-- <a href="#" class="footer-link">Services</a> -->
        <a href="#contact-shutku" class="footer-link">Contact</a>
        <!-- <a href="privacy-policy.php" class="footer-link">Privacy Policy</a> -->
      </nav>
    </div>

    <div class="footer-section">
      <h3 class="footer-heading">Legal</h3>
      <nav class="footer-menu">
        <a href="terms-and-conditions.php" class="footer-link">Terms & Conditions</a>
        <a href="shipping-policy.php" class="footer-link">Shipping Policy</a>
        <a href="cancellation-refund.php" class="footer-link">Cancellation & Refund</a>
        
        <a href="privacy-policy.php" class="footer-link">Privacy Policy</a>
      </nav>
    </div>

    

    <!-- Contact Information -->
    <div class="footer-section">
      <h3 class="footer-heading">Contact Us</h3>
      <div class="contact-info">
        <div class="contact-item">
          <i class="fas fa-map-marker-alt contact-icon"></i>
          <div class="contact-details">
            Shutku Smart Techno Pvt Ltd Shop <br>
            no-30 Basement sector 39 ,<br>
            near cyber park , HSVP market <br>
            Gurugram Haryana 122003
          </div>
        </div>
        <div class="contact-item">
          <i class="fas fa-phone contact-icon"></i>
          <div class="contact-details">+91 9310187037</div>
        </div>
        <div class="contact-item">
          <i class="fas fa-envelope contact-icon"></i>
          <div class="contact-details">info@shutku.com</div>
        </div>
        <div class="contact-item">
          <i class="fas fa-clock contact-icon"></i>
          <div class="contact-details">Mon-Fri: 9AM-6PM</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Bottom -->
  <div class="footer-bottom">

    <p>&copy; 2025 Shutku. All rights reserved.</p>
    <!-- <a href="privacy-policy.php">Privacy Policy</a> -->
    <div class="footer-links">
      <p>
        Designed and Developed By
        <a href="">Maisha Infotech SoftLabs LLP</a>
      </p>
    </div>
  </div>
</footer>
</div>

<!-- JS
============================================ -->

<!-- jQuery JS -->
<script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
<!-- Migrate JS -->
<script src="assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- Plugins JS -->
<script src="assets/js/plugins.js"></script>
<!-- Main JS -->
<script src="assets/js/main.js"></script>
<script>
  const menuToggle = document.getElementById("menuToggle");
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlay");
  const closesidebar = document.getElementById("closeSidebar")

  menuToggle.addEventListener("click", () => {
    sidebar.classList.add("active");
    overlay.classList.add("active");
    document.body.style.overflow = "hidden";
  });

  overlay.addEventListener("click", () => {
    sidebar.classList.remove("active");
    overlay.classList.remove("active");
    document.body.style.overflow = "";
  });
  closesidebar.addEventListener("click", () => {
    sidebar.classList.remove("active");
    overlay.classList.remove("active");
    document.body.style.overflow = "";
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>

  
  document.addEventListener("DOMContentLoaded", function() {
    const cards = document.querySelectorAll(".card");

    cards.forEach((card) => {
      card.addEventListener("mouseenter", function() {
        this.style.zIndex = "10";
      });

      card.addEventListener("mouseleave", function() {
        this.style.zIndex = "2";
      });
    });

    // Add subtle animation to decorative leaves
    const leaves = document.querySelectorAll(".leaf-decoration");
    leaves.forEach((leaf) => {
      leaf.addEventListener("mouseenter", function() {
        this.style.transform = this.classList.contains("leaf-1") ?
          "rotate(25deg) scale(1.1)" :
          "rotate(-25deg) scale(1.1)";
      });

      leaf.addEventListener("mouseleave", function() {
        this.style.transform = this.classList.contains("leaf-1") ?
          "rotate(15deg) scale(1)" :
          "rotate(-15deg) scale(1)";
      });
    });
  });
</script>
<script>
  const faqs = document.querySelectorAll(".faq-card");

  faqs.forEach((faq) => {
    faq.addEventListener("click", () => {
      faq.classList.toggle("active");
    });
  });
</script>
<script>
const swiper = new Swiper(".auto-slider", {
  slidesPerView: 3,     
  spaceBetween: 20,
  loop: true,            
  speed: 3000,           
  autoplay: {
    delay: 0,            
    disableOnInteraction: false,
  },
  freeMode: true,        
  freeModeMomentum: false,
  breakpoints: {
    0: {                  
      slidesPerView: 1,   
      spaceBetween: 14,
    },
    480: {               
      slidesPerView: 2,
      spaceBetween: 20,
    },
    992: {               
      slidesPerView: 3,
      spaceBetween: 20,
    }
  }
});


</script>

</body>

</html>