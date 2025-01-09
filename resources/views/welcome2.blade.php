<!DOCTYPE html>
<!--[if lt IE 9 ]><html class="no-js oldie" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>

    <!--- basic page needs
   ================================================== -->
    <meta charset="utf-8">
    <title>AppealEase</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
   ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
   ================================================== -->
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/vendor.css">
    <link rel="stylesheet" href="/css/main.css">

    <!-- script
   ================================================== -->
    <script src="js/modernizr.js"></script>
    <script src="js/pace.min.js"></script>

    <!-- favicons
 ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body id="top">

    <!-- header
   ================================================== -->
    <header id="header" class="row">

        <div class="header-logo">
            <a class="smoothscroll" href="#home">AppealEase</a>
        </div>

        <nav id="header-nav-wrap">
            <ul class="header-main-nav">
                <li class="current"><a class="smoothscroll" href="#home" title="home">Home</a></li>
                <li><a class="smoothscroll" href="#about" title="about">About</a></li>

                <li><a class="smoothscroll" href="#download" title="register">Register</a></li>
                <li><a class="smoothscroll" href="#footer" title="contact">Contact</a></li>
            </ul>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" title="dashboard" class="button button-primary cta">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" title="log-in" class="button button-primary cta">
                        Log in
                    </a>
                @endauth
            @endif
        </nav>

        <a class="header-menu-toggle" href="#"><span>Menu</span></a>

    </header> <!-- /header -->


    <!-- home
   ================================================== -->
    <section id="home" data-parallax="scroll" data-image-src="images/hero-bg.jpg" data-natural-width=3000
        data-natural-height=2000>

        <div class="overlay"></div>
        <div class="home-content">

            <div class="row contents">
                <div class="home-content-left">

                    <h3 data-aos="fade-up">Welcome to AppealEase</h3>

                    <h1 data-aos="fade-up">
                        File with ease and<br>
                        track case progress<br>
                        seamlessly.
                    </h1>

                    <div class="buttons" data-aos="fade-up">
                        <a href="#about" class="smoothscroll button stroke">
                            <span class="" aria-hidden="true"></span>
                            Get Started
                        </a>

                    </div>

                </div>

                <div class="home-image-right">

                </div>
            </div>

        </div> <!-- end home-content -->


        <!-- end home-social-list -->

        <div class="home-scrolldown">
            <a href="#about" class="scroll-icon smoothscroll">
                <span>Scroll Down</span>
                <i class="icon-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

    </section> <!-- end home -->


    <!-- about
    ================================================== -->
    <section id="about">

        <div class="row about-intro">

            <div class="col-four">
                <h1 class="intro-header" data-aos="fade-up">About Our Website</h1>
            </div>
            <div class="col-eight">
                <p class="lead" data-aos="fade-up">
                    AppealEase is a cutting-edge online filing and case monitoring system tailored to modernize
                    processes for the Court of Appeals. With efficiency, accuracy, and security at its core, we ensure
                    that managing your legal documents has never been easier. This platform is designed for
                    <u>litigants/lawyers</u>, <u>justices</u>, and <u>clerks of court</u>, streamlining their legal
                    workflows.
                </p>
            </div>

        </div>

        <div class="row about-features">

            <div class="features-list block-1-3 block-m-1-2 block-mob-full group">

                <div class="bgrid feature" data-aos="fade-up">

                    <span class="icon"><i class="icon-file-add"></i></span>

                    <div class="service-content">

                        <h3>Online Filing System</h3>

                        <p>Effortlessly submit your legal documents through our secure online platform. No more waiting
                            in line or navigating complex procedures—just upload, submit, and track your case.
                        </p>

                    </div>

                </div> <!-- /bgrid -->

                <div class="bgrid feature" data-aos="fade-up">

                    <span class="icon"><i class="icon-clock"></i></span>

                    <div class="service-content">
                        <h3>Real-Time Case Monitoring</h3>

                        <p>Stay informed every step of the way. AppealEase provides real-time updates on your case's
                            status, from submission to resolution, so you can monitor progress without the hassle.
                        </p>


                    </div>

                </div> <!-- /bgrid -->

                <div class="bgrid feature" data-aos="fade-up">

                    <span class="icon"><i class="icon-padlock"></i></span>

                    <div class="service-content">
                        <h3>Secure & Confidential</h3>

                        <p>Your privacy is our top priority. AppealEase employs the latest encryption technologies to
                            protect your sensitive data, ensuring all information remains secure and confidential.
                        </p>

                    </div>

                </div> <!-- /bgrid -->

                <div class="bgrid feature" data-aos="fade-up">

                    <span class="icon"><i class="icon-users"></i></span>

                    <div class="service-content">

                        <h3>User-Friendly Interface</h3>

                        <p>Designed with simplicity in mind, our platform is intuitive and easy to use, so you can focus
                            on what matters most—your case. No technical skills required!
                        </p>

                    </div>

                </div> <!-- /bgrid -->

                <div class="bgrid feature" data-aos="fade-up">

                    <span class="icon"><i class="icon-shuffle"></i></span>

                    <div class="service-content">
                        <h3>Case Randomization</h3>

                        <p>To ensure fairness and impartiality, cases are randomly assigned to justices, eliminating any
                            biases in the decision-making process.
                        </p>


                    </div>

                </div> <!-- /bgrid -->

                <div class="bgrid feature" data-aos="fade-up">

                    <span class="icon"><i class="icon-mail"></i></span>

                    <div class="service-content">
                        <h3>Notification for Litigants/Lawyers</h3>

                        <p>The litigants and their lawyers will be notified of the justices' decisions on cases. This
                            ensures confidentiality while keeping the relevant parties informed of the case's outcome.
                        </p>

                    </div>

                </div> <!-- /bgrid -->




            </div> <!-- end features-list -->

        </div> <!-- end about-features -->




    </section> <!-- end about -->


    <!-- pricing
    ================================================== -->


    <!-- Testimonials Section
    ================================================== -->
    <section id="download">
        <div class="row about-how" data-aos="fade-up">

            <h1 class="intro-header" data-aos="fade-up">How to Create a Litigant/Lawyer Account?</h1>

            <p class="lead aos-init aos-animate" data-aos="fade-up">To create a Litigant or Lawyer account, simply
                follow the registration process designed to verify your identity and grant you access to case updates
                and legal documents. You'll need to provide basic information, such as your name, contact details, and
                other documents. After completing the registration, you'll receive a confirmation email with further
                instructions to activate your account.</p>


            <div class="buttons aos-init aos-animate" data-aos="fade-up">
                <a href="{{ route('howToRegister') }}" class="button stroke">

                    <span class="" aria-hidden="true"></span>
                    Click here for step-by-step Instructions
                </a>

            </div>

        </div> <!-- end about-how -->



    </section> <!-- end testimonials -->


    <!-- download
    ================================================== -->
    <section id="footer">

        <footer>

            <div class="footer-main">
                <div class="row">



                    <div class="footer-contact">

                        <h4>Contact</h4>



                        <p>
                            appealease.systemad@gmail.com<br>
                            <br>

                        </p>

                    </div> <!-- end footer-contact -->





                </div> <!-- /row -->
            </div> <!-- end footer-main -->
            <div class="footer-bottom">

                <div class="row">

                    <div class="col-twelve">
                        <div class="copyright">
                            <span>All rights reserved 2025.</span>

                        </div>

                        <div id="go-top" style="display: block;">
                            <a class="smoothscroll" title="Back to Top" href="#top"><i
                                    class="icon-arrow-up"></i></a>
                        </div>
                    </div>

                </div> <!-- end footer-bottom -->

            </div>



        </footer>
    </section> <!-- end download -->


    <!-- footer
    ================================================== -->


    <div id="preloader">
        <div id="loader"></div>
    </div>

    <!-- Java Script
    ================================================== -->
    <script src="/js/jquery-2.1.3.min.js"></script>
    <script src="/js/plugins.js"></script>
    <script src="/js/main.js"></script>

</body>

</html>
