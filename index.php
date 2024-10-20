<?php
include('admin/config/dbcon.php');

// Fetch services from the database
$sql = "SELECT service, description FROM service_list";
$result = $conn->query($sql);

$services = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
} 

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bhairab Bike Service</title>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background: rgba(0, 0, 0, 0.85);
            padding: 10px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }
        .navbar .logo-container {
            display: flex;
            align-items: center;
        }
        .navbar .logo-img {
            height: 40px;
            width: 40px;
        }
        .navbar .logotitle {
            color: #ff5733;
            font-size: 24px;
            margin: 0 10px;
            font-weight: 400;
            font-family: Comic Sans MS ;
        }
        .navbar .nav-links {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }
        .navbar .nav-links li {
            margin-left: 20px;
        }
        .navbar .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            padding: 5px 10px;
            transition: background 0.3s, color 0.3s;
        }
        .navbar .nav-links a:hover {
            background: #ff5733;
            color: #fff;
            border-radius: 5px;
        }
        .split-screen {
            display: flex;
            height: 100vh;
        }
        .left-side {
            background: url('images/ThanitApril_58.jpg') no-repeat center center;
            background-size: cover;
            flex: 2;
            position: relative;
            height: 100vh;
        }
        .right-side {
            background: #000;
            color: #fff;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 20px;
        }
        .right-side .hero-title {
            font-size: 48px;
            margin-bottom: 20px;
            font-weight: 400;
        }
        .right-side .hero-motto {
            font-size: 24px;
            margin-bottom: 30px;
            font-weight: 300;
        }
        .right-side .check-status-btn {
            padding: 10px 20px;
            background-color: #ff5733;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
        }
        .services-section {
            display: none; /* Initially hidden */
            background-color: rgba(255, 255, 255, 0.9);
            padding: 50px 20px;
            text-align: center;
        }
        .services-section h2 {
            font-size: 36px;
            margin-bottom: 40px;
            color: #ff5733;
            
        }
        .services-section .service-display {
            max-width: 600px;
            margin: 0 auto;
            background-color: #000;
            
            
        }
        .services-section h3 {
            font-size: 24px;
            margin-bottom: 20px;
        color: #f2f2f2;
        }

       
        .about-section {
            padding: 50px 20px;
            text-align: center;
            background-color: #f2f2f2; /* Light grey background */
            color: #333; /* Dark grey text color */
        }
        .about-section .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
        }
        .about-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
            font-weight: bold;
            color: #ff5733;
        }
        .about-section p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            text-align: left;
            flex: 0 0 100%; /* Take full width on small screens */
        }
        .about-section .about-image {
            max-width: 100%;
            height: auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Subtle shadow for the image */
            flex: 1 1 50%;
            margin-top: 20px;
        }
        .footer {
        background: #000;
        color: #fff;
        padding: 20px 0;
        text-align: center;
    }
    .footer .footer-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .footer .footer-links {
        list-style: none;
        margin: 10px 0 0;
        padding: 0;
        text-align: center;
    }
    .footer .footer-links p {
        color: #ff5733;
        text-decoration: none;
        font-size: 14px;
        margin: 5px 0;
    }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .about-section .about-image {
                flex: 0 0 100%; /* Take full width on smaller screens */
                margin-left: 0;
                margin-top: 30px;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo-container">
            <img src="images/bscms logo.png" alt="Bhairab Bike Service Logo" class="logo-img">
            <h1 class="logotitle">BBSC</h1>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="admin/login.php">AdminPanel</a></li>
        </ul>
    </nav>

    <!-- Split Screen Section -->
    <div class="split-screen">
        <div class="left-side"></div>
        <div class="right-side">
            <h1 class="hero-title">Bhairab Bike Service Center</h1>
            <p class="hero-motto">Welcome! We will take care of your bike</p>
            <a href="user/user_login.php" class="check-status-btn">Login to send service request</a>
        </div>
    </div>

    <!-- Services Section -->
    <div class="services-section" id="services-section">
        <h2>Our Services</h2>
        <div class="service-display">
            <h3 id="service-title"></h3>
            <p id="service-description"></p>
        </div>
    </div>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <h2>About Us</h2>
            <p>Bhairab Bike Service Center is committed to providing exceptional service and maintenance for motorcycles. Our team of dedicated professionals ensures that every bike receives the highest level of care and attention. We strive to exceed customer expectations through quality service, reliability, and customer satisfaction.</p>
            <img src="images/thumb.jpg" alt="About Us Image" class="about-image">
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
    <div class="footer-container">
        <p>&copy; 2024 Bhairab Bike Service Center</p>
        <div class="footer-links">
            <ul>
            <p><strong>Address:</strong> Bhairab Bike Service Center, Buddha Chowk, Damauli</p>
            <p><strong>Phone:</strong> +065 560221</p>
            <p><strong>Email:</strong> info@bhairabbikeservice.com</p>
            </ul>
        </div>
    </footer>   

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const services = <?php echo json_encode($services); ?>;
            let currentIndex = 0;

            function displayService() {
                const serviceTitle = document.getElementById('service-title');
                const serviceDescription = document.getElementById('service-description');

                serviceTitle.textContent = services[currentIndex].service;
                serviceDescription.textContent = services[currentIndex].description;

                currentIndex = (currentIndex + 1) % services.length;
            }

            if (services.length > 0) {
                displayService();
                setInterval(displayService, 2000); // Change service every 2 seconds
            }

            // Show the services section when scrolled
            const servicesSection = document.getElementById('services-section');
            window.addEventListener('scroll', () => {
                const scrollPosition = window.scrollY + window.innerHeight;
                const servicesPosition = servicesSection.offsetTop;
                
                if (scrollPosition >= servicesPosition) {
                    servicesSection.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>
