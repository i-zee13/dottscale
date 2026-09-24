<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Dark to Light Transitions</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animate.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700|Oswald:200,300,400,500,600,700" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            transition: background-color 1.5s ease;
        }

        section {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3rem;
            transition: background-color 1.5s ease, color 1.5s ease;
            color: white;
        }

        .section-light {
            background-color: #f0f0f0;
            color: #2c3e50;
        }

        .section-dark {
            background-color: #2c3e50;
            color: #f0f0f0;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 60px;
            height: 100vh;
            background-color: transparent;
            transition: background-color 0.5s ease;
        }

        .on-white {
            background-color: white;
        }

        .on-black {
            background-color: black;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="sidebar"></div>

    <!-- Header Section -->
    <header class="header omni-page H_img">
        <div class="logo"> <a href="index.html"><img src="images/allomate-logo-w.svg" alt="Allomate" title="Allomate"></a> </div>
        <div class="header-content">
            <h2>THINK<br>FORWARD<span class="red">.</span></h2>
            <h1>GO DIGITAL<span class="red">.</span></h1>
            <h3>We are a full-service digital Design and Product agency,<br>delivering top-tier solutions for businesses of all sizes.</h3>
        </div>
        <a class="arrow" href="#sec02"><span></span><span></span><span></span> </a>
    </header>

    <!-- Main Content -->
    <div class="main-wrapper">
        <section class="section section-light" id="sec02">
            <h2>We Help - Light Theme</h2>
        </section>

        <section class="section section-dark" id="sec03">
            <h2>Services - Dark Theme</h2>
        </section>

        <section class="section section-light" id="sec04">
            <h2>Our Products - Light Theme</h2>
        </section>

        <section class="section section-dark" id="sec05">
            <h2>Contact Us - Dark Theme</h2>
        </section>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2024 Allomate Solutions. All Rights Reserved.</p>
    </div>

    <script>
        // Function to detect if an element is visible in the viewport
        var _isVisible = function ($el) {
            var top = $(window).scrollTop() + $(window).height() / 2;
            var elTop = $el.offset().top;
            var elBottom = elTop + $el.outerHeight();
            return ((elBottom > top) && (elTop < top));
        };

        // Handle background color changes dynamically based on section visibility
        var _handleBackgroundTransitions = function () {
            $('.section').each(function () {
                var $section = $(this);
                if (_isVisible($section)) {
                    if ($section.hasClass('section-light')) {
                        $('body').css('background-color', '#f0f0f0');
                    } else if ($section.hasClass('section-dark')) {
                        $('body').css('background-color', '#2c3e50');
                    }
                }
            });
        };

        // Call the function on scroll
        $(window).on('scroll', function () {
            _handleBackgroundTransitions();
        });

        // Run the transition function initially when the page loads
        $(document).ready(function() {
            _handleBackgroundTransitions();
        });
    </script>

</body>

</html>
