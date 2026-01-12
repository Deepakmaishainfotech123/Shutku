<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Shutku - Baby Prodcuct</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Favicon -->
  <link
    rel="shortcut icon"
    type="image/x-icon"
    href="assets/images/shutku-logo.png" />

  <!-- CSS
	============================================ -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

  <!-- Icon Font CSS -->
  <!-- <link rel="stylesheet" href="assets/css/icon-font.min.css" /> -->

  <!-- Plugins CSS -->
  <link rel="stylesheet" href="assets/css/plugins.css" />

  <!-- Helper CSS -->
  <link rel="stylesheet" href="assets/css/helper.css" />

  <!-- Main Style CSS -->
  <link rel="stylesheet" href="assets/css/style.css" />

  <!-- Modernizer JS -->
  <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


  <style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Nunito:wght@400;600&display=swap');

    body {
      font-family: 'Nunito', sans-serif;
      color: #333;
    }

    h1,
    h2,
    h3 {
      font-family: 'Fredoka', sans-serif;
    }

    @media (max-width: 576px) {

      .top-header-container,
      .header-container {
        flex-direction: row !important;
        align-items: center !important;
        gap: 10px !important;
      }
    }
  </style>

  <style>
    :root {
      --primary-color: #3b9b08;
      --primary-dark: #2e7a06;
      --primary-light: #e8f5e2;
      --text-dark: #333;
      --text-light: #666;
      --white: #fff;
    }

    a:hover {
      color: #3b9b08;
    }

    /* ---------- TOP HEADER ---------- */

    .top-header {
      background: linear-gradient(135deg, #96e781 0%, #7ad161 100%);
      color: #1a1a1a;
      font-size: 14px;
      padding: 8px 0;
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);

    }

    .top-header-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
    }

    .location-email {
      display: flex;
      gap: 25px;
    }

    .location,
    .email {
      display: flex;
      gap: 8px;
      align-items: center;
      padding: 4px 12px;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 20px;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .location:hover,
    .email:hover {
      background: rgba(255, 255, 255, 0.25);
      transform: translateY(-1px);
    }

    .location i,
    .email i {
      color: #2d5016;
      font-size: 13px;
      transition: transform 0.3s ease;
    }

    .location:hover i,
    .email:hover i {
      transform: scale(1.1);
    }

    .location span,
    .email span {
      font-weight: 500;
      letter-spacing: 0.3px;
    }

    .promo-text {
      display: flex;
      align-items: center;
      gap: 10px;
      background: rgba(26, 26, 26, 0.9);
      color: white;
      padding: 6px 15px;
      border-radius: 25px;
      font-weight: 500;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(26, 26, 26, 0.4);
      }

      70% {
        box-shadow: 0 0 0 6px rgba(26, 26, 26, 0);
      }

      100% {
        box-shadow: 0 0 0 0 rgba(26, 26, 26, 0);
      }
    }

    .download-link {
      color: #96e781;
      font-weight: 600;
      text-decoration: none;
      padding: 4px 12px;
      background: rgba(150, 231, 129, 0.15);
      border-radius: 15px;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .download-link:hover {
      background: rgba(150, 231, 129, 0.3);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(150, 231, 129, 0.3);
    }

    .download-link::after {
      content: "↗";
      font-size: 12px;
      transition: transform 0.3s ease;
    }

    .download-link:hover::after {
      transform: translate(2px, -2px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .top-header-container {
        justify-content: center;
        text-align: center;
      }

      .location-email {
        gap: 15px;
      }

      .promo-text {
        flex-direction: column;
        gap: 8px;
        text-align: center;
      }
    }

    @media (max-width: 480px) {
      .location-email {
        flex-direction: column;
        gap: 8px;
        width: 100%;
      }

      .location,
      .email {
        justify-content: center;
      }

      .top-header {
        padding: 12px 0;
      }
    }

    /* ---------- MAIN HEADER ---------- */
    .main-header {
      background-color: var(--white);
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .header-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .logo-container .logo {
      width: 70px;
      height: 70px;
      object-fit: contain;
    }

    /* ---------- NAV MENU ---------- */
    .nav-menu {
      display: flex;
      gap: 30px;
      list-style: none;
    }

    .nav-menu li {
      font-size: 15px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .nav-menu a {
      text-decoration: none;
      color: var(--text-dark);
      /* font-weight: 500; */
      position: relative;
      padding: 5px 0;
      transition: color 0.3s;
    }

    /* Underline hover effect */
    .nav-menu a::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background-color: var(--primary-color);
      transition: width 0.3s ease;
    }

    .nav-menu a:hover {
      color: var(--primary-color);
    }

    .nav-menu a:hover::after {
      width: 100%;
    }

    /* ---------- MOBILE MENU ---------- */
    .menu-toggle {
      display: none;
      flex-direction: column;
      gap: 4px;
      cursor: pointer;
    }

    .menu-toggle span {
      width: 25px;
      height: 3px;
      background-color: var(--primary-color);
      transition: 0.3s;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: -300px;
      width: 280px;
      height: 100vh;
      background-color: var(--white);
      padding: 20px;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
      transition: 0.4s ease;
      z-index: 1000;
      display: flex;
      flex-direction: column;
    }

    .sidebar-nav a {
      position: relative;
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 15px;
      text-decoration: none;
      color: var(--text-dark);
      font-size: 18px;
      border-radius: 8px;
      transition: color 0.3s ease;
      overflow: hidden;
    }

    /* Animated underline */
    .sidebar-nav a::after {
      content: "";
      position: absolute;
      bottom: 6px;
      /* little above bottom padding */
      left: 15px;
      width: 0;
      height: 2px;
      background: var(--primary-color);
      transition: width 0.3s ease;
      border-radius: 4px;
    }

    .sidebar-nav a:hover {
      color: var(--primary-color);
    }

    .sidebar-nav a:hover::after {
      width: calc(100% - 30px);
      /* full width minus left/right padding */
    }


    .sidebar.active {
      left: 0;
    }

    /* Logo + Close button */
    .logo-container-sidemenu {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .logo-side-menu {
      max-width: 40px;
    }

    .close-btn {
      background: none;
      border: none;
      font-size: 28px;
      cursor: pointer;
      color: var(--text-dark);
      transition: 0.3s;
    }

    .close-btn:hover {
      color: var(--primary-color);
    }

    /* Sidebar Navigation */
    .sidebar-nav {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar-nav li {
      margin: 10px 0;
    }

    .sidebar-nav a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 15px;
      text-decoration: none;
      color: var(--text-dark);
      font-size: 18px;
      border-radius: 8px;
      transition: 0.3s;
    }

    .sidebar-nav a:hover {
      background-color: rgba(0, 0, 0, 0.05);
      color: var(--primary-color);
    }

    /* Overlay */
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      visibility: hidden;
      opacity: 0;
      transition: 0.3s;
      z-index: 900;
    }

    .overlay.active {
      visibility: visible;
      opacity: 1;
    }


    /* ---------- RESPONSIVE ---------- */
    @media (max-width: 992px) {
      .nav-menu {
        display: none;
      }

      .menu-toggle {
        display: flex;
      }

      .promo-text {
        display: none;
      }
    }

    @media (max-width: 576px) {

      .top-header-container,
      .header-container {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
    }
  </style>
  <style>
    footer {
      background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
      color: #f8f9fa;
      padding: 4rem 0 1.5rem;
      margin-top: auto;

    }

    footer::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, #4caf50, transparent);
    }

    .footer-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem 2rem;
      display: grid;
      grid-template-columns:1fr 1fr 1fr 1fr;
      gap: 3rem;
      position: relative;
      z-index: 1;
    }

    .footer-section {
      display: flex;
      flex-direction: column;
      /* align-items: center; */
    }

    .footer-logo {
      display: flex;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .logo-img {
      height: 80px;
      width: auto;

      transition: all 0.3s ease;
    }

    .footer-description {
      line-height: 1.7;
      opacity: 0.85;
      margin-bottom: 1.5rem;
      font-size: 0.95rem;
      font-weight: 300;
      max-width: 320px;
    }

    .footer-heading {
      color: #4caf50;
      font-size: 1.3rem;
      margin-bottom: 1.8rem;
      position: relative;
      padding-bottom: 0.8rem;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    .footer-heading::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      width: 50px;
      height: 3px;
      background: linear-gradient(90deg, #4caf50, transparent);
      border-radius: 3px;
    }

    .footer-menu {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .footer-link {
      color: #e0e0e0;
      text-decoration: none;
      transition: all 0.3s ease;
      position: relative;
      padding: 0.3rem 0;
      display: inline-flex;
      align-items: center;
      font-size: 15px;
      font-weight: 400;
      letter-spacing: 0.3px;
    }

    .footer-links a {
      color: #4caf50 !important;
      font-weight: 500 !important;
      letter-spacing: 1px !important;
    }

    .footer-link::before {
      content: "▸";
      color: #4caf50;
      margin-right: 10px;
      font-size: 12px;
      /* opacity: 0; */
      transform: translateX(-10px);
      transition: all 0.3s ease;
    }

    .footer-link:hover {
      color: #4caf50;
      transform: translateX(8px);
    }

    .footer-link:hover::before {
      opacity: 1;
      transform: translateX(0);
    }

    .contact-info {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .contact-item {
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      transition: transform 0.3s ease;
    }

    .contact-item:hover {
      transform: translateX(5px);
    }

    .contact-icon {
      color: #4caf50;
      width: 22px;
      text-align: center;
      margin-top: 3px;
      font-size: 1.2rem;
      flex-shrink: 0;
    }

    .contact-details {
      flex: 1;
      line-height: 1.6;
      font-weight: 300;
    }

    .social-icons {
      display: flex;
      gap: 1rem;
      margin-top: 1.5rem;
    }

    .social-link {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 44px;
      height: 44px;
      background: rgba(150, 231, 129, 0.1);
      border-radius: 12px;
      color: #f0f0f0;
      text-decoration: none;
      transition: all 0.4s ease;
      font-size: 1.2rem;
      position: relative;
      overflow: hidden;
    }

    .social-link::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg,
          transparent,
          rgba(150, 231, 129, 0.2),
          transparent);
      transition: left 0.6s ease;
    }

    .social-link:hover {
      background: #4caf50;
      color: white !important;
      transform: translateY(-5px) scale(1.05);
      box-shadow: 0 10px 20px rgba(150, 231, 129, 0.3);
    }

    .social-link:hover::before {
      left: 100%;
    }

    .footer-bottom {
      max-width: 1200px;
      margin: 1px auto 0;
      padding: 2rem 2rem 0;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      display: flex;
      justify-content: space-between;
      /* align-items: center; */
      font-size: 0.9rem;
      opacity: 0.8;
      position: relative;
    }

    .footer-bottom::before {
      content: "";
      position: absolute;
      top: -1px;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 2px;
      background: #4caf50;
      border-radius: 2px;
    }

    .footer-links {
      display: flex;
      gap: 1.5rem;
    }

    .footer-links a {
      color: #e0e0e0;
      text-decoration: none;
      font-size: 0.85rem;
      transition: color 0.3s ease;
      font-weight: 300;
    }

    .footer-links a:hover {
      color: #4caf50;
    }

    .newsletter-form {
      display: flex;
      flex-wrap:wrap;
      gap:10px;
      margin-top: 1.5rem;
      max-width: 320px;
    }

    .newsletter-input {
      flex: 1;
      padding: 0.8rem 1rem;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 8px;
      color: #f0f0f0;

      font-size: 0.9rem;
      transition: all 0.3s ease;
    }

    .newsletter-input:focus {
      outline: none;
      border-color: #4caf50;
      background: rgba(255, 255, 255, 0.08);
    }

    .newsletter-button {
      padding: 0.8rem 1.5rem;
      background: #4caf50;
      color: #0a0a0a;
      border: none;
      border-radius:8px;

      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .newsletter-button:hover {
      background: #4caf50;
      transform: translateY(-1px);
    }

    /* Animation for footer entrance */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .footer-section {
      animation: fadeInUp 0.6s ease forwards;
    }

    .footer-section:nth-child(2) {
      animation-delay: 0.1s;
    }

    .footer-section:nth-child(3) {
      animation-delay: 0.2s;
    }

    /* Responsive Design */
    @media (max-width: 968px) {
      .footer-container {
        grid-template-columns: 1fr 1fr;
        gap: 2.5rem;
      }

      .footer-section:first-child {
        /* grid-column: 1 / -1; */
      }
    }

    @media (max-width: 768px) {
      footer {
        padding: 3rem 0 1.5rem;
      }

      .footer-container {
        grid-template-columns: 1fr;
        gap: 2.5rem;
        /* text-align: center; */
      }

      /* .footer-logo {
        justify-content: center;
      } */

      /* .footer-description {
        margin: 0 auto 1.5rem;
      } */

      /* .social-icons {
        justify-content: center;
      } */

      /* .footer-heading::after {
        left: 50%;
        transform: translateX(-50%);
      } */

      .footer-bottom {
        flex-direction: column;
        gap: 1rem;
        /* text-align: center; */
      }

      .footer-links {
        order: -1;
      }

      /* .newsletter-form {
        margin: 1.5rem auto 0;
      } */
    }

    @media (max-width: 480px) {
      .footer-links {
        flex-direction: column;
        gap: 0.8rem;
      }

      .footer-container {
        padding: 10px 1.5rem;
      }

      .footer-bottom {
        padding: 1.5rem 1.5rem 0;
      }
    }
  </style>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

    .slick-dots {
      display: none;
    }
  </style>
  <style>
    .eshutku-badges {
      /* display: flex; */
      flex-wrap: wrap;
      gap: 15px;
      justify-content: center;
      margin-top: 20px;
    }

    .eshutku-badge {
      display: inline-block;
      padding: 10px 18px;
      border-radius: 50px;
      font-size: 0.95rem;
      font-weight: 600;
      color: #004a00;
      background-color: #cdffcd;
      /* Dark green */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s, box-shadow 0.3s;
      cursor: default;
    }

    .eshutku-badge:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    @media (max-width: 600px) {
      .eshutku-badge {
        font-size: 0.9rem;
        padding: 8px 15px;
      }
    }

    @media only screen and (min-width: 1200px) and (max-width: 1599px) {
      .hero-content-2 h1 {
        font-size: 60px;
        font-weight: 600;
        line-height: 66px;
        margin-bottom: 26px;
      }
    }
  </style>
  <style>
    .about-section {
      padding: 80px 0;
      background: linear-gradient(135deg,
          white 0%,
          white 50%,
          #eff0ea 100%);
    }

    .about-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
      /* position: relative; */
      z-index: 2;
    }

    .content-wrapper {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      gap: 40px;
    }

    .text-content {
      flex: 1;
      min-width: 300px;
      max-width: 550px;
    }

    .about-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(155, 230, 122, 0.15);
      color: #2a7a1c;
      padding: 10px 25px;
      border-radius: 50px;
      font-size: 0.9rem;
      font-weight: 600;
      letter-spacing: 1.5px;
      margin-bottom: 20px;
      text-transform: uppercase;
      border: 1px solid rgba(155, 230, 122, 0.3);
      animation: float 3s ease-in-out infinite;
    }

    .about-badge::before {
      content: "✦";
      font-size: 12px;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-5px);
      }
    }

    .about-heading {
      font-size: 2.5rem;
      color: #333;
      margin-bottom: 20px;
      font-weight: 700;
      line-height: 1.2;
    }

    .about-heading span {
      color: #4caf50;
    }

    .about-description {
      font-size: 1.1rem;
      line-height: 1.7;
      color: black;
      margin-bottom: 30px;
      font-weight: 400;
    }

    .features-list {
      list-style: none;
      margin: 25px 0;
    }

    .features-list li {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
      font-size: 1rem;
      color: black;
    }

    .features-list li::before {
      content: "✓";
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 24px;
      height: 24px;
      background-color: #9be67a;
      color: white;
      border-radius: 50%;
      margin-right: 10px;
      font-size: 0.8rem;
      flex-shrink: 0;
    }

    .image-container {
      flex: 1;
      min-width: 300px;
      max-width: 500px;
      border-radius: 20px;
      overflow: hidden;
      /* box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08); */
      transition: transform 0.3s ease;
    }

    .image-container:hover {
      transform: translateY(-5px);
    }

    .image-container img {
      width: 100%;
      height: auto;
      display: block;
      transition: transform 0.5s ease;
    }

    .image-container:hover img {
      transform: scale(1.03);
    }

    .stats-container {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      margin-top: 50px;
      flex-wrap: wrap;
    }

    .stat-item {
      text-align: center;
      padding: 25px 20px;
      background: rgba(255, 255, 255, 0.7);
      border-radius: 15px;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(155, 230, 122, 0.2);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      flex: 1;
      min-width: 180px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    .stat-item::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg,
          transparent,
          rgba(155, 230, 122, 0.1),
          transparent);
      transition: left 0.6s ease;
    }

    .stat-item:hover::before {
      left: 100%;
    }

    .stat-item:hover {
      transform: translateY(-5px);
      border-color: rgba(155, 230, 122, 0.3);
      box-shadow: 0 15px 30px rgba(155, 230, 122, 0.1);
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: 800;
      color: #9be67a;
      display: block;
      margin-bottom: 10px;
    }

    .stat-label {
      font-size: 1.1rem;
      color: #333;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .stat-subtext {
      font-size: 0.9rem;
      color: #777;
      font-weight: 400;
    }

    .cta-button {
      display: inline-block;
      background: #9be67a;
      color: black;
      padding: 14px 32px;
      border-radius: 50px;
      font-weight: 600;
      text-decoration: none;
      margin-top: 10px;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(155, 230, 122, 0.3);
      border: none;
      cursor: pointer;
      font-size: 1rem;
    }

    .cta-button:hover {
      background: #8cd46a;
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(155, 230, 122, 0.4);
      color:black !important;
    }

    .floating-shapes {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 1;
    }

    .shape {
      position: absolute;
      background: rgba(155, 230, 122, 0.05);
      border-radius: 50%;
      animation: floatShape 20s infinite linear;
    }

    .shape:nth-child(1) {
      width: 100px;
      height: 100px;
      top: 10%;
      left: 5%;
      animation-delay: 0s;
    }

    .shape:nth-child(2) {
      width: 150px;
      height: 150px;
      top: 60%;
      right: 10%;
      animation-delay: -5s;
    }

    .shape:nth-child(3) {
      width: 80px;
      height: 80px;
      bottom: 20%;
      left: 15%;
      animation-delay: -10s;
    }

    @keyframes floatShape {
      0% {
        transform: translateY(0) rotate(0deg);
      }

      50% {
        transform: translateY(-20px) rotate(180deg);
      }

      100% {
        transform: translateY(0) rotate(360deg);
      }
    }

    .counter {
      animation: countUp 2s ease-out forwards;
      opacity: 0;
      transform: translateY(30px);
    }

    @keyframes countUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 768px) {
      .about-section {
        padding: 60px 0;
      }

      .about-heading {
        font-size: 2rem;
      }

      .content-wrapper {
        flex-direction: column;
      }

      .text-content,
      .image-container {
        max-width: 100%;
      }

      .stats-container {
        gap: 15px;
      }

      .stat-item {
        min-width: calc(50% - 15px);
        padding: 20px 15px;
      }

      .stat-number {
        font-size: 2rem;
      }
    }

    @media (max-width: 480px) {
      .about-heading {
        font-size: 1.8rem;
      }

      .about-description {
        font-size: 1rem;
      }

      .stat-item {
        min-width: 100%;
      }

      .about-badge {
        padding: 8px 20px;
        font-size: 0.8rem;
      }
    }
  </style>
  <style>
    .banner {
      width: 100%;
      /* padding: 60px 0; */
      display: flex;
      justify-content: center;
      background-size: cover;
      position: relative;
      background-color: #f9fbf7;
    }

    .banner-container {
      width: 100%;
      max-width: 1200px;
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 40px;
    }

    .banner-content {
      flex: 1;
      max-width: 600px;
    }

    .banner-content h1 {
      font-size: 38px;
      font-weight: 800;
      line-height: 1.3;
      margin-bottom: 18px;
    }

    .banner-content span {
      color: #4caf50;
    }

    .banner-content p {
      font-size: 18px;
      margin-bottom: 25px;
      color: #444;
    }

    .features {
      display: flex;
      gap: 20px;
      margin-bottom: 25px;
      flex-wrap: wrap;
    }

    .feature {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 15px !important;
      font-weight: 600;
      color: #333;
      background: #f8f9fa;
      padding: 9px 14px;
      border-radius: 12px;
      border: 1px solid #e9ecef;

    }

    .feature i {
      color: #4caf50;
      font-size: 18px;
    }

  
    .order-btns {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 12px;
  margin-top: 10px;
}


.download-row p {
  margin: 0;
  font-size: 20px;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 8px;
  color: #222;
}

.store-row {
  display: flex;
  align-items: center;
  gap: 14px;
  flex-wrap: wrap;
}


.store-row .btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 12px 20px;
  border: 2px solid #4caf50;
  background: transparent;
  color: #4caf50;
  font-size: 16px;
  font-weight: 600;
  border-radius: 10px;
  text-decoration: none;
  transition: 0.3s ease;
}

.store-row .btn:hover {
  /* background: #4caf50; */
  color: #fff;
}


  
    .banner-img img {
      width: 100%;
      max-width: 480px;
      height: auto;
      position: relative;
      top: 16px;
    }
    .banner:hover img{
      transform: none;
    }
   
    
        


    @media (max-width: 992px) {
      .banner-container {
        flex-direction: column;
        text-align: center;
      }

      .order-btns {
        align-items: center;
        justify-content: center;
      }

      .banner-img img {
        max-width: 360px;
      }
    }

    @media (max-width: 480px) {
      .banner-content h1 {
        font-size: 28px;
      }

      .banner-content p {
        font-size: 15px;
      }

      .order-btns .btn {
        padding: 10px 16px;
        font-size: 14px;
      }
    }
  </style>
</head>

<body>
  <div class="main-wrapper">
    <!-- ================== TOP HEADER ================== -->

    <div class="top-header">
      <div class="top-header-container">
        <div class="location-email">
          <div class="location">
            <i class="fas fa-map-marker-alt"></i>
            <span>Gurugram Haryana 122003</span>
          </div>
          <div class="email">
            <i class="fas fa-envelope"></i>
            <span>info@shutku.com</span>
          </div>
        </div>
        <div class="promo-text">
          <span>Baby Essentials, Fast & Free →</span>
          <a href="#" class="download-link">Download Now</a>
        </div>
      </div>
    </div>

    <!-- ================== MAIN HEADER ================== -->
    <header class="main-header">
      <div class="header-container">
        <!-- Logo -->
        <div class="logo-container">
          <a href="index.php"> <img src="assets/images/shutku-logo.png" alt="Logo" class="logo" /></a>
        </div>

        <!-- Desktop Menu -->
        <nav>
          <ul class="nav-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="#about-shutku">About Us</a></li>
            <li><a href="#products-shutku">Products</a></li>
            <li><a href="#contact-shutku">Contact</a></li>
          </ul>
        </nav>

        <!-- Mobile Menu Toggle -->
        <div class="menu-toggle" id="menuToggle">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </header>

    <!-- ================== SIDEBAR MENU ================== -->
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <!-- Logo + Close Button -->
      <div class="logo-container-sidemenu">
        <a href="index.php"> <img src="assets/images/shutku-logo.png" alt="Logo" class="logo-side-menu" /></a>
        <button class="close-btn" id="closeSidebar">&times;</button>
      </div>

      <!-- Navigation -->
      <ul class="sidebar-nav">
        <li><a href="index.php"><i class="fas fa-home"></i><span>Home</span></a></li>
        <li><a href="#about-shutku"><i class="fas fa-info-circle"></i><span>About Us</span></a></li>
        <li><a href="#products-shutku"><i class="fas fa-box"></i><span>Products</span></a></li>
        <li><a href="#contact-shutku"><i class="fas fa-phone"></i><span>Contact</span></a></li>
      </ul>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>