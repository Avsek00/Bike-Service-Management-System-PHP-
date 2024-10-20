<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Bhairab Bike Service</title>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; /* Light grey background */
            color: #333; /* Dark grey text color */
        }
        .navbar {
            background: #333; /* Dark background for navbar */
            color: #fff; /* White text color for navbar */
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
            height: 30px;
            width: 30px;
            margin-right: 10px;
        }
        .navbar .logotitle {
            font: fantasy;
            font-size: 24px;
            font-weight: bold;

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
            background: #ff5733; /* Orange hover background */
            border-radius: 5px;
        }
        .about-section {
            padding: 100px 20px;
            text-align: center;
            min-height: 100vh;
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
            <li><a href="admin/login.php">Admin Panel</a></li>
        </ul>
    </nav>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <h2>About Us</h2>
            <p>Bhairab Bike Service Center is committed to providing exceptional service and maintenance for motorcycles. Our team of dedicated professionals ensures that every bike receives the highest level of care and attention. We strive to exceed customer expectations through quality service, reliability, and customer satisfaction.</p>
            <img src="images/thumb.jpg" alt="About Us Image" class="about-image">
        </div>
    </section>

    <!-- Footer
    <footer class="footer">
        <div class="footer-container">
            <p>&copy; 2024 Bhairab Bike Service Center</p>
            <ul class="footer-links">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">FAQs</a></li>
            </ul>
        </div>
    </footer> -->

</body>
</html>
