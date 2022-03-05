<?php

function index_footer()
{
  echo ('<!-- Footer -->
  <footer class="footer-container">
    <!-- Gread -->
    <div class="footer-box gread-box">
      <span class="section-box">
        <p class="gread">Gread</p>
      </span>
      <div class="footer-links-box">
        <a href="./about.php">About</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
        <a href="#">Dashboard</a>
      </div>
    </div>
    <!-- Others -->
    <div class="footer-box others-box">
      <span class="section-box">
        <p class="others">Others</p>
      </span>
      <div class="footer-links-box">
        <a href="#">Blog</a>
        <a href="#">Help</a>
        <a href="#">Terms</a>
        <a href="#">Privacy</a>
      </div>
    </div>
    <!-- Newsletter -->
    <div class="footer-box newsletter-box">
      <span class="section-box">
        <p class="newsletter">Newsletter</p>
      </span>
      <!-- Email -->
      <div class="email-box">
        <form class="newsletter-form">
          <label for="email" style="display: none;">Email</label>
          <input class="email-input" id="email" type="email" name="newsletter_email" placeholder="Get notified...">
          <button class="email-btn" type="submit" name="join" aria-label="Join newsletter">
            <svg class="email-icon" width="41" height="33" arial-hidden="true" viewBox="0 0 41 33" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.5205 9.68376C16.9619 9.23693 16.1469 9.32749 15.7001 9.88602C15.2533 10.4446 15.3438 11.2596 15.9024 11.7064L17.5205 9.68376ZM23.3959 16.0426L24.2049 17.0539C24.5121 16.8082 24.691 16.4361 24.691 16.0426C24.691 15.6492 24.5121 15.2771 24.2049 15.0313L23.3959 16.0426ZM15.9024 20.3789C15.3438 20.8257 15.2533 21.6407 15.7001 22.1992C16.1469 22.7578 16.9619 22.8483 17.5205 22.4015L15.9024 20.3789ZM15.9024 11.7064L22.5868 17.0539L24.2049 15.0313L17.5205 9.68376L15.9024 11.7064ZM22.5868 15.0313L15.9024 20.3789L17.5205 22.4015L24.2049 17.0539L22.5868 15.0313Z" fill="white" />
            </svg>
          </button>
        </form>
      </div>
    </div>
    <!-- Copy -->
    <div class="copy-box">
      <p>&copy; 2022 Roweme. All rights reserved.</p>
    </div>
  </footer>');
}
