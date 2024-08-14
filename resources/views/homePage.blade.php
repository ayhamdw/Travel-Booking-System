<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="{{ asset('images/icons/favicon.ico') }}">
    <title>About Us</title>
    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- GoogleFonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700&family=Cairo:wght@400;600;700&family=Tajawal:wght@300;400;500;700&display=swap"
        rel="stylesheet"
    />
    <!-- OurStyles -->
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
</head>
<body>
<!-- To top -->
<span class="up">⬆</span>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary py-4">
    <div class="container">
        <a data-aos="fade-right" class="navbar-brand">GlobeTrek</a>

        <a href="{{ route('login') }}" class="navbar-brand button ms-3">Login</a>

        <button
            data-aos="fade-left"
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul data-aos="fade-left" class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#prog">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#whous">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contactus">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Hero -->
<section class="hero block">
    <div class="container" data-aos="zoom-in">
        <h1>Your Journey Begins Here</h1>
        <p>Explore the best travel deals on flights, hotels, and car rentals</p>
        <a href="sign_up.php"> <button class="btn">Click Here to Register</button></a>
    </div>
</section>
<!-- Numbers -->
<section class="numbers block">
    <div class="container">
        <h3 id="whous" data-aos="fade-right" class="section-heading">About Us</h3>
        <div class="row">
            <div class="col col1">
                <p>
                    GlobeTrek is your go-to online platform for booking flights, hotels, and car rentals. We provide a seamless and affordable travel experience with a wide selection of options to suit every need and budget.
                </p>
                <div class="image"><img src="{{ asset('/images/plan.jpg') }}" alt="Plan Image" /></div>
            </div>
            <div class="circles col-md">
                <div
                    data-aos="fade-up"
                    data-aos-anchor-placement="top-bottom"
                    data-aos-delay="50"
                    class="circle"
                >
                    25 Years
                </div>
                <div
                    data-aos="fade-up"
                    data-aos-anchor-placement="center-bottom"
                    data-aos-delay="150"
                    class="circle"
                >
                    500+ Dest
                </div>
                <div
                    data-aos="fade-up"
                    data-aos-anchor-placement="top-bottom"
                    data-aos-delay="200"
                    class="circle"
                >
                    1M+ Bookings
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Goals -->
<section id="prog" class="our-goals block">
    <div class="container">
        <div class="goals row gap-5">
            <div class="goal col-md">
                <header>
                    <img src="{{ asset('images/small-plane.png') }}" alt="Flight Image" />
                    <h4 class="goal__heading">Flight Bookings</h4>
                </header>
                <div class="goal__content">
                    Find and book flights to over 500 destinations worldwide.
                </div>
            </div>
            <div class="goal col-md">
                <header>
                    <img src="{{ asset('images/hoteljpg.jpg') }}" alt="Hotel Image" />
                    <h4 class="goal__heading">Hotel Reservation</h4>
                </header>
                <div class="goal__content">
                    Choose from thousands of hotels for every type of traveler.
                </div>
            </div>
            <div class="goal col-md">
                <header>
                    <img src="{{ asset('images/car-rental-concept.png') }}" alt="Car Rental Image" />
                    <h4 class="goal__heading">Car Rentals</h4>
                </header>
                <div class="goal__content">
                    Rent a car at your destination with flexible options.
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact us -->
<section class="contact block">
    <div class="container">
        <h3 data-aos="fade-right" id="contactus" class="section-heading">
            Contact Us
        </h3>
        <div class="row">
            <div class="contact__form col-sm">
                <form action="">
                    <div class="input-group-lg mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" />
                    </div>
                    <div class="input-group-lg mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            aria-describedby="emailHelp"
                        />
                    </div>
                    <div class="input-group-lg">
                        <label for="textarea" class="form-label">Message</label>
                        <textarea
                            class="form-control"
                            placeholder="Write your message here"
                            id="textarea"
                        ></textarea>
                    </div>
                    <button type="submit" class="btn">Send</button>
                </form>
            </div>
            <div class="contact__content col-md">
                <img src="{{ asset('images/aboutUs.jpg') }}" alt="About Us Image" />
            </div>
        </div>
    </div>
</section>
<footer class="footer">
    <div class="container">
        <div class="footer__content">
            <p class="copy-right">
                All rights reserved <span class="logo">GlobeTrek</span> &copy;
            </p>
        </div>
    </div>
</footer>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
