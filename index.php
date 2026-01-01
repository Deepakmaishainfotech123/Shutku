<?php include('include/header.php') ?>

<style>
    .product-categories {
        padding: 80px 0;
        background: #fefefe;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .store-row .btn:hover{
        color: #2e7d32 !important;
    }

    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-header h2 {
        font-size: 36px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .section-header p {
        font-size: 18px;
        color: #666;
        max-width: 600px;
        margin: 0 auto;
    }

    
    .category-card {
        border-radius: 14px;
        overflow: hidden;
        text-align: center;
    }

    .category-card:hover {
        transform: translateY(-6px);
       
    }

    .category-image img {
        width: 100%;
      border-radius: 10px;
        object-fit: cover;
    }

    .category-content {
        padding: 16px;
    }

    .category-content h3 {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 6px;
    }

    .category-content p {
        font-size: 14px;
        color: #666;
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .section-header h2 {
            font-size: 28px;
        }

        .section-header p {
            font-size: 16px;
        }

        
    }

    @media (max-width: 480px) {
        .section-header h2 {
            font-size: 24px;
        }

       

        .category-content {
            padding: 12px;
        }

        .category-content h3 {
            font-size: 16px;
        }

        .category-content p {
            font-size: 13px;
        }
    }
</style>
<style>
    .contact-container {
        max-width: 1200px;
        width: 100%;
    }

    .contact-section {
        display: flex;
        flex-wrap: wrap;
        background: white;
        border-radius: 24px;
        box-shadow: 0 25px 50px rgba(15, 23, 42, 0.15);
        overflow: hidden;
        margin: 20px 0;
        transition: transform 0.3s ease;
    }

    .contact-section:hover {
        transform: translateY(-5px);
    }

    .form-container {
        flex: 1;
        min-width: 300px;
        padding: 60px 50px;
        background: white;
    }

    .cta-container {
        flex: 1;
        min-width: 300px;
        padding: 60px 50px;
        background: #0f172a;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
        border-radius: 24px;
    }

    .cta-container::before {
        content: "";
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: radial-gradient(circle,
                rgba(74, 173, 77, 0.1) 0%,
                transparent 70%);
        z-index: 0;
    }


    .form-container h2 {
        font-size: 2.8rem;
        color: #4caf50;
        margin-bottom: 15px;
        position: relative;
        display: inline-block;
        font-weight: 700;
        position: relative;
    }

    .form-container h2::after {
        content: "";
        display: block;
        width: 60px;
        height: 4px;
        background: #8add73;
        margin: 10px auto 0;
        border-radius: 2px;
    }

    .cta-container h2 {
        background: linear-gradient(135deg, #ffffff 0%, #4aad4d 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        position: relative;
        z-index: 1;
        font-weight: 800;
    }

    .subtitle {
        font-size: 1.2rem;
        color: black;

        max-width: 700px;
        margin: 25px auto 25px auto;
        line-height: 1.8;
    }

    .cta-container .subtitle {
        color: rgba(255, 255, 255, 0.9);
        position: relative;
        z-index: 1;
        font-size: 17px;
    }

    .form-group {
        margin-bottom: 28px;
        position: relative;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: #475569;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    label i {
        color: #4aad4d;
        width: 18px;
    }

    input,
    textarea {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    input:focus,
    textarea:focus {
        outline: none;
        border-color: #4aad4d;
        box-shadow: 0 0 0 4px rgba(74, 173, 77, 0.15);
        background: white;
        transform: translateY(-2px);
    }

    textarea {
        min-height: 150px;
        resize: vertical;
    }

    .contact-send-message {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        background: linear-gradient(135deg, #4aad4d 0%, #3a8d3d 100%);
        color: white;
        padding: 18px 36px;
        border: none;
        border-radius: 12px;
        font-size: 17px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        width: 100%;
        box-shadow: 0 4px 15px rgba(74, 173, 77, 0.3);
    }

    .contact-send-message:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(74, 173, 77, 0.4);
    }

    .badge-container {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(74, 173, 77, 0.15);
        color: #4aad4d;
        padding: 10px 18px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 0;
    }

    .cta-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .app-buttons {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        position: relative;
        z-index: 1;
    }

    .app-btn {
        /* flex: 1; */
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 14px;
        padding: 16px 20px;
        width: 223px;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .app-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }

    .app-btn i {
        font-size: 32px;
    }

    .app-btn-text {
        display: flex;
        flex-direction: column;
    }

    .app-btn-text span:first-child {
        font-size: 12px;
        opacity: 0.9;
    }

    .app-btn-text span:last-child {
        font-size: 18px;
        font-weight: 700;
    }

    .feature-list {
        list-style: none;
        /* margin: 30px 0; */
        position: relative;
        z-index: 1;
    }

    .feature-list li {
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
    }

    .feature-list i {
        background: rgba(74, 173, 77, 0.2);
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        flex-shrink: 0;
        color: #4aad4d;
        font-size: 13px;
    }

    .contact-info {
        /* margin-top: 35px; */
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        padding-top: 25px;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        position: relative;
        z-index: 1;
    }

    .contact-info p {
        display: flex;
        align-items: center;
        font-size: 15px;
        color: rgba(255, 255, 255, 0.9);
    }

    .contact-info i {
        margin-right: 12px;
        width: 18px;
        color: #4aad4d;
    }

    .success-message {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 16px 20px;
        border-radius: 12px;
        margin-top: 25px;
        display: none;
        align-items: center;
        gap: 12px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .contact-section {
            flex-direction: column;
        }

        .form-container,
        .cta-container {
            padding: 40px 30px;
        }

        .app-buttons {
            flex-direction: column;
        }

        .contact-info {
            flex-direction: column;
            gap: 15px;
        }

        

        h2 {
            font-size: 28px;
        }
    }
    @media(max-width:435px){
        .badge-container .badge{
                font-size: 11px;
        }
    }

     @media(max-width:385px){
        .badge-container .badge{
                padding:10px;
        }
    }

    .cta-heading {
        font-size: 32px;
        margin-bottom: 20px;
        line-height: 1.3;
        position: relative;
        z-index: 1;
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        z-index: 2;
    }

    .input-with-icon input {
        padding-left: 50px;
    }


   
</style>
<style>
    .why-choose-us {
        background: linear-gradient(135deg, #f8fdf8 0%, #f0f9f0 100%);
    }

    .section-why-choose {
        padding: 80px 20px;
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        overflow: hidden;
    }

    .section-header {
        display: flex;
        align-items: center;
        flex-direction: column;
        text-align: center;
        margin-bottom: 60px;
        position: relative;
        z-index: 2;
    }

    .section-header h2 {
        font-size: 2.8rem;
        color: #4caf50;
        margin-bottom: 15px;
        position: relative;
        display: inline-block;
        font-weight: 700;
    }

    .section-header h2:after {
        content: "";
        position: absolute;
        width: 80px;
        height: 4px;
        background: linear-gradient(to right, #7bc47b, #a8d8a8);
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .section-header p {
        font-size: 1.2rem;
        color: black;
        max-width: 700px;
        margin: 25px auto 0;
        line-height: 1.8;
    }

    .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
        position: relative;
        z-index: 2;
    }

    .card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 16px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 8px 25px rgba(123, 196, 123, 0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(123, 196, 123, 0.2);
        backdrop-filter: blur(5px);
        cursor: pointer;
    }

    .card:before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.4),
                transparent);
        transition: left 0.7s ease;
    }

    .card:hover:before {
        left: 100%;
    }

    .card:hover {
        transform: translateY(-15px) scale(1.03);
        box-shadow: 0 20px 40px rgba(123, 196, 123, 0.2);
        border-color: rgba(123, 196, 123, 0.4);
    }

    .card-icon {
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, #7bc47b, #a8d8a8);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        color: white;
        font-size: 2.5rem;
        transition: all 0.4s ease;
        position: relative;
        box-shadow: 0 8px 20px rgba(123, 196, 123, 0.3);
    }

    .card:hover .card-icon {
        transform: scale(1.15) rotate(5deg);
        background: linear-gradient(135deg, #6ab06a, #97cd97);
        box-shadow: 0 12px 25px rgba(123, 196, 123, 0.4);
    }

    .card-icon:after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 2px dashed rgba(255, 255, 255, 0.6);
        animation: rotate 20s linear infinite;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .card:hover .card-icon:after {
        opacity: 1;
    }

    .card h3 {
        font-size: 1.6rem;
        color: #4caf50;
        margin-bottom: 20px;
        font-weight: 600;
        transition: color 0.3s ease;
        position: relative;
    }

    .card:hover h3 {
        color: #4caf50;
    }

    .card h3:after {
        content: "";
        position: absolute;
        width: 0;
        height: 2px;
        background: linear-gradient(to right, #7bc47b, #a8d8a8);
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        transition: width 0.4s ease;
    }

    .card:hover h3:after {
        width: 60px;
    }

    .card p {
        color: black;
        font-size: 1.05rem;
        line-height: 1.7;
        transition: color 0.3s ease;
    }

    .card:hover p {
        color: black;
    }

    /* Decorative elements */
    .leaf-decoration {
        position: absolute;
        opacity: 0.08;
        font-size: 150px;
        color: #7bc47b;
        z-index: 1;
        transition: transform 5s ease;
    }

    .leaf-1 {
        top: 10%;
        left: 5%;
        transform: rotate(15deg);
    }

    .leaf-2 {
        bottom: 10%;
        right: 5%;
        transform: rotate(-15deg);
    }

    .bubble {
        position: absolute;
        border-radius: 50%;
        background: rgba(123, 196, 123, 0.05);
        z-index: 1;
    }

    .bubble-1 {
        width: 120px;
        height: 120px;
        top: 15%;
        right: 10%;
    }

    .bubble-2 {
        width: 80px;
        height: 80px;
        bottom: 20%;
        left: 8%;
    }

    .card .highlight {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: radial-gradient(circle at center,
                rgba(123, 196, 123, 0.1) 0%,
                transparent 70%);
        opacity: 0;
        transition: opacity 0.4s ease;
        pointer-events: none;
    }

    .card:hover .highlight {
        opacity: 1;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @media (max-width: 768px) {
        .cards-container {
            grid-template-columns: 1fr;
        }

        .section-header h2 {
            font-size: 2.2rem;
        }

        .leaf-decoration {
            display: none;
        }

        .card {
            padding: 30px 20px;
        }
    }

    /* Pulse animation for attention */
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(123, 196, 123, 0.4);
        }

        70% {
            box-shadow: 0 0 0 15px rgba(123, 196, 123, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(123, 196, 123, 0);
        }
    }

    .card:nth-child(1) {
        animation: pulse 3s infinite 1s;
    }

    .card:nth-child(3) {
        animation: pulse 3s infinite 2s;
    }

    .card:nth-child(5) {
        animation: pulse 3s infinite 3s;
    }
</style>
<style>
    .faq-section {
        padding: 80px 7px;
        background: #fdfdfd;
    }

    .faq-title {
        text-align: center;
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 50px;
        position: relative;
    }

    .faq-title::after {
        content: "";
        display: block;
        width: 60px;
        height: 4px;
        background: #8add73;
        margin: 10px auto 0;
        border-radius: 2px;
    }

    .faq-card {
        background: #fff;
        border-radius: 12px;
        margin-bottom: 15px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .faq-card:hover {
        transform: translateY(-3px);
    }

    .faq-question {
        padding: 20px;
        font-weight: 600;
        font-size: 18px;
        color: #333;
        position: relative;
    }

    .faq-question::after {
        content: "+";
        position: absolute;
        right: 20px;
        font-size: 22px;
        transition: transform 0.3s ease;
    }

    .faq-card.active .faq-question::after {
        transform: rotate(45deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        padding: 0 20px;
        font-size: 15px;
        color: #666;
        line-height: 1.6;
        transition: max-height 0.4s ease, padding 0.4s ease;
    }

    .faq-card.active .faq-answer {
        max-height: 200px;
        padding: 15px 20px;
    }
</style>
<style>
    .about-section {
        padding: 55px 0;
    }

    .features-container {
        display: flex;
        justify-content: center;
        padding-top: 48px;
    }

    .features-anim {
        width: 100%;
        overflow: hidden;
        padding: 48px 0 0 0 0;
        display: none;
    }

    .features-box {
        display: inline-flex;
        gap: clamp(20px, 5vw, 60px);
        animation: featureRun 10s linear infinite;
        will-change: transform;
    }

    .feature {
        font-size: clamp(14px, 2.5vw, 20px);
        font-weight: 600;
        display: flex;
        gap: 6px;
        align-items: center;
        white-space: nowrap;
    }


    @keyframes featureRun {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }



    @media (max-width: 480px) {
        .features-anim {
            padding-top: 10px;
        }

        .feature i {
            font-size: 14px;
        }
    }

    @media(max-width:768px) {
        .features-container {
            display: none;
        }

        .features-anim {
            display: flex;
            padding-top: 22px;
        }
    }
</style>

<!-- Hero Section Start -->
<section class="banner">
    <div class="banner-container">

        <!-- Left Content -->
        <div class="banner-content">
            <h1>

                A new mom needs <span>clarity and safety</span>, - we deliver both,
                <span>at speed.</span>
            </h1>
            <p>We deliver all your baby and toddler essentials in just minutes.</p>

            <!-- Buttons -->
            <div class="order-btns">

                <!-- Row 1 -->
                <div class="download-row">
                    <p>Download Now <i class="fa-solid fa-arrow-right"></i></p>
                </div>

                <!-- Row 2 -->
                <div class="store-row">
                    <a href="#" class="btn"><i class="fa-brands fa-apple"></i> App Store</a>
                    <a href="#" class="btn"><i class="fa-brands fa-google-play"></i> Google Play Store</a>
                </div>

            </div>

        </div>

        <!-- Right Image -->
        <div class="banner-img">
            <img src="assets/images/Shutkumockup2.png" alt="">
        </div>

    </div>
</section>


<div class="features-anim">
    <div class="features-box">
        <div class="feature"><i class="fa-solid fa-bolt"></i> Fast Delivery</div>
        <div class="feature"><i class="fa-solid fa-shield-heart"></i> Safe & Secure</div>
        <div class="feature"><i class="fa-solid fa-certificate"></i> 100% Genuine</div>
    </div>
</div>

<div class="features-container">
    <div class="features">
        <div class="feature">
            <i class="fa-solid fa-bolt"></i> Fast Delivery
        </div>
        <div class="feature">
            <i class="fa-solid fa-shield-heart"></i> Safe & Secure
        </div>
        <div class="feature">
            <i class="fa-solid fa-certificate"></i> 100% Genuine
        </div>
    </div>
</div>


<!-- about section -->
<section class="about-section" id="about-shutku">
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="about-container">
        <div class="content-wrapper">
            <div class="text-content">
                <div class="about-badge">About Us</div>
                <h2 class="about-heading">
                    Trusted by Thousands of <span>Happy Parents</span>
                </h2>
                <p class="about-description">
                    We know how precious your little one is. That's why our app
                    brings together safe, trusted, and high-quality baby products —
                    all in one place. From diapers and baby care essentials to toys
                    and accessories, we make parenting easier with reliable shopping
                    at your fingertips.
                </p>

                <ul class="features-list">
                    <li>100% safety tested products for your baby</li>
                    <li>Expert-curated selection of baby essentials</li>
                    <li>Fast delivery right to your doorstep</li>
                    <li>24/7 parenting support and advice</li>
                    <li>Exclusive deals for our community members</li>
                    <li>Easy returns and hassle-free shopping</li>
                </ul>

                <a href="#" class="cta-button">Explore Our Products</a>
            </div>

            <div class="image-container">
                <img
                    src="assets/images/about-shutku.png"
                    alt="Happy parents with baby using our products" />
            </div>
        </div>
    </div>
</section>


<!-- product categories -->
<section class="product-categories">
    <div class="container">
        <div class="section-header">
            <h2>Baby & Kids Essentials You’ll Love</h2>
            <p>
                Everything your little one needs for daily care—soft clothes, gentle skincare, fun toys, and all the essentials to keep them happy.
            </p>
        </div>

        <!-- Swiper Slider -->
        <div class="swiper auto-slider">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide category-card skeleten-card">
                    <div class="category-image">
                        <img src="assets/images/Baby & kids clothing 1.png" alt="Baby & Kids Clothing">
                    </div>
                    <div class="category-content">
                        <h3>Baby & Kids Clothing</h3>
                        <p>Onesies, Bibs, Caps, and more</p>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide category-card">
                    <div class="category-image">
                        <img src="assets/images/Toys for kids.png" alt="Toys For Kids">
                    </div>
                    <div class="category-content">
                        <h3>Toys For Kids</h3>
                        <p>Soft Toys, Rattles, Learning Games</p>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide category-card">
                    <div class="category-image">
                        <img src="assets/images/Day to Day Care.png" alt="Day To Day Care">
                    </div>
                    <div class="category-content">
                        <h3>Day To Day Care</h3>
                        <p>Lotions, Powders, Oils, and more</p>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="swiper-slide category-card">
                    <div class="category-image">
                        <img src="assets/images/baby gifts.png" alt="Gifts">
                    </div>
                    <div class="category-content">
                        <h3>Gifts</h3>
                        <p>Perfect presents for special occasions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- why choose us -->
<section class="why-choose-us">
    <div class="section-why-choose">
        <i class="fas fa-leaf leaf-decoration leaf-1"></i>
        <i class="fas fa-seedling leaf-decoration leaf-2"></i>
        <div class="bubble bubble-1"></div>
        <div class="bubble bubble-2"></div>

        <div class="section-header">
            <div class="about-badge">Why Choose us</div>
            <h2>Our Promise to You</h2>
            <p>
                We understand that your baby deserves the very best. That's why
                we're committed to providing products that meet the highest
                standards of safety, quality, and comfort.
            </p>
        </div>

        <div class="cards-container">
            <div class="card">
                <div class="highlight"></div>
                <div class="card-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Safety Certified</h3>
                <p>
                    All our products undergo rigorous safety testing and meet
                    international standards to ensure your baby's wellbeing.
                </p>
            </div>

            <div class="card">
                <div class="highlight"></div>
                <div class="card-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3>Eco-Friendly Materials</h3>
                <p>
                    We use sustainable, non-toxic materials that are gentle on your
                    baby's skin and kind to our planet.
                </p>
            </div>

            <div class="card">
                <div class="highlight"></div>
                <div class="card-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h3>Premium Quality</h3>
                <p>
                    From soft fabrics to durable construction, we never compromise
                    on quality to ensure long-lasting products.
                </p>
            </div>

            <div class="card">
                <div class="highlight"></div>
                <div class="card-icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h3>Fast & Free Shipping</h3>
                <p>
                    Enjoy quick delivery with our free shipping on orders over $50.
                    Because waiting isn't fun for anyone.
                </p>
            </div>

            <div class="card">
                <div class="highlight"></div>
                <div class="card-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3>Expert Support</h3>
                <p>
                    Our baby product specialists are here to help you make the best
                    choices for your little one.
                </p>
            </div>

            <div class="card">
                <div class="highlight"></div>
                <div class="card-icon">
                    <i class="fas fa-undo-alt"></i>
                </div>
                <h3>Easy Returns</h3>
                <p>
                    Not satisfied? Our hassle-free return policy ensures you get
                    exactly what your baby needs.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- FAQ section -->
<section class="faq-section">
    <div class="container">
        <div class="section-header">
            <div class="about-badge">Help Center</div>
            <h2>Frequently Asked Questions</h2>
            <p>
                Find answers to the most common questions about our products,
                shipping, returns, and safety. We’re here to make your little
                one’s daily care smooth and worry-free.
            </p>
        </div>

        <div class="faq-card">
            <div class="faq-question">What kind of baby products do you offer?</div>
            <div class="faq-answer">
                We offer a wide range of baby essentials including diapers, baby wipes, skincare products, feeding bottles, toys, clothes, and more.
            </div>
        </div>


        <div class="faq-card">
            <div class="faq-question"> Are the products safe for newborns?</div>
            <div class="faq-answer">
                Yes, all products are carefully selected, baby-safe, and dermatologist-tested to ensure maximum safety for newborns and toddlers.

            </div>
        </div>


        <div class="faq-card">
            <div class="faq-question">Do you provide home delivery?</div>
            <div class="faq-answer">
                Absolutely! We provide fast and reliable doorstep delivery so parents never run out of baby essentials.
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question"> Can I return or exchange a product?</div>
            <div class="faq-answer">
                Yes, we have a simple return and exchange policy. If you face any issues with a product, you can return or exchange it hassle-free.

            </div>
        </div>
    </div>
</section>


<!-- conatct us section -->
<div class="container" id="contact-shutku">
    <div class="contact-section">
        <!-- Left Side - Contact Form -->
        <div class="form-container">
            <div class="about-badge">Contact us</div>
            <h2>Get In Touch With Us</h2>
            <p class="subtitle">
                Have questions or need support? We're here to help. Send us a
                message and we'll respond within 24 hours.
            </p>

            <form id="contactForm">
                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> Full Name</label>
                    <input
                        type="text"
                        id="name"
                        placeholder="Enter your full name"
                        required />
                </div>

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                    <input
                        type="email"
                        id="email"
                        placeholder="your.email@example.com"
                        required />
                </div>

                <div class="form-group">
                    <label for="subject"><i class="fas fa-tag"></i> Subject</label>
                    <div class="input-with-icon">
                        <i class="fas fa-heading"></i>
                        <input
                            type="text"
                            id="subject"
                            placeholder="Enter your subject"
                            required />
                    </div>
                </div>

                <div class="form-group">
                    <label for="message"><i class="fas fa-comment"></i> Your Message</label>
                    <textarea
                        id="message"
                        placeholder="How can we help you? Please provide details..."
                        required></textarea>
                </div>

                <button type="submit" class="contact-send-message" id="">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>

                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i> Thank you! Your message has
                    been sent successfully.
                </div>
            </form>
        </div>

        <!-- Right Side - CTA Section -->
        <div class="cta-container">
            <div class="badge-container">
                <div class="badge cta-badge">
                    <i class="fas fa-bolt"></i> Fastest Delivery
                </div>
                <div class="badge cta-badge">
                    <i class="fas fa-gift"></i> Exclusive Deals
                </div>
                <div class="badge cta-badge">
                    <i class="fas fa-star"></i> Premium Quality
                </div>
            </div>

            <h2 class="cta-heading">
                Your Little One’s Favorites, Just a Tap Away
            </h2>
            <p class="subtitle">
                Get everything your little one needs—baby care, clothing, toys, and daily essentials—delivered fast, right from our app. Convenience for you, smiles for them!.
            </p>

            <ul class="feature-list">
                <li>
                    <i class="fas fa-shipping-fast"></i>
                    <span>Fastest delivery in your area with real-time tracking</span>
                </li>
                <li>
                    <i class="fas fa-percent"></i>
                    <span>Exclusive app-only deals and special discounts</span>
                </li>
                <li>
                    <i class="fas fa-mobile-alt"></i>
                    <span>Easy ordering with saved preferences and quick reorder</span>
                </li>
                <li>
                    <i class="fas fa-shield-alt"></i>
                    <span>Secure payment and complete data protection</span>
                </li>
            </ul>

            <div class="app-buttons">
                <a href="#" class="app-btn">
                    <i class="fab fa-apple"></i>
                    <div class="app-btn-text">
                        <!-- <span>Download on the</span> -->
                        <span style="white-space: nowrap;">App Store</span>
                    </div>
                </a>
                <a href="#" class="app-btn">
                    <i class="fab fa-google-play"></i>
                    <div class="app-btn-text">
                        <!-- <span>Get it on</span> -->
                        <span style="white-space: nowrap;">Google Play Store</span>
                    </div>
                </a>
            </div>

            <div class="contact-info">
                <p><i class="fas fa-phone"></i> +91 9310187037</p>
                <p><i class="fas fa-envelope"></i> contact@shutku.com</p>
                <p><i class="fas fa-clock"></i> 24/7 Customer Support</p>
            </div>
        </div>
    </div>
</div>
<script>
    // Simple counter animation trigger
    document.addEventListener("DOMContentLoaded", function() {
        const counters = document.querySelectorAll(".counter");

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = "countUp 2s ease-out forwards";
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5,
            }
        );

        counters.forEach((counter) => {
            observer.observe(counter);
        });
    });
</script>
<script>
    document
        .getElementById("contactForm")
        .addEventListener("submit", function(e) {
            e.preventDefault();

            // Show success message
            document.getElementById("successMessage").style.display = "flex";

            // Reset the form after 4 seconds
            setTimeout(function() {
                document.getElementById("contactForm").reset();
                document.getElementById("successMessage").style.display = "none";
            }, 4000);
        });

    // Add subtle animation to form inputs on focus
    const inputs = document.querySelectorAll("input, textarea");
    inputs.forEach((input) => {
        input.addEventListener("focus", function() {
            this.parentElement.style.transform = "translateY(-2px)";
        });

        input.addEventListener("blur", function() {
            this.parentElement.style.transform = "translateY(0)";
        });
    });
</script>



<?php include('include/footer.php') ?>