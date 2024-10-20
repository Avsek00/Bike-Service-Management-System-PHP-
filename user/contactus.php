<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

// Check if the email session variable is set
// if (isset($_SESSION['user_email'])) {
//     $email = $_SESSION['user_email'];
// } else {
//     $email = ""; // Default to an empty string if session email is not set
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Bhairab Bike Service Center</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .content-wrapper {
            padding: 20px;
        }

        .content-header {
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .content-header .breadcrumb {
            padding: 0;
            background: none;
            margin: 0;
        }

        .contact-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .contact-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-header h1 {
            margin: 0;
            font-size: 32px;
            color: #333;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
        }

        .contact-form label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .contact-form input,
        .contact-form textarea {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        .contact-form button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #0056b3;
        }

        .contact-details {
            text-align: center;
            margin-top: 20px;
        }

        .contact-details p {
            margin: 5px 0;
        }

        .map-container {
            text-align: center;
            margin-top: 20px;
        }

        .map-container iframe {
            width: 100%;
            height: 400px;
            border: 0;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0">Contact Us</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Contact Us</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <?php
        if (isset($_SESSION['message'])) {
            $message_type = $_SESSION['message_type'] == 'success' ? 'alert-success' : 'alert-danger';
            echo "<div class='alert $message_type'>{$_SESSION['message']}</div>";
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>

        <div class="contact-container">
            <div class="contact-header">
                <h1>Contact Bhairab Bike Service Center</h1>
                <p>We'd love to hear from you. Please fill out the form below and we will get in touch with you shortly.</p>
            </div>

            <form class="contact-form" action="send_contact.php" method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php
                if(isset($_SESSION['auth'])) {
                    echo $_SESSION['auth_user']['user_email']; 
                } else {
                    echo "not logged in";
                }
                ?>">

                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required>

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Send Message</button>
            </form>

            <div class="contact-details">
                <p><strong>Address:</strong> Bhairab Bike Service Center, Buddha Chowk, Damauli</p>
                <p><strong>Phone:</strong> +065 560221</p>
                <p><strong>Email:</strong> info@bhairabbikeservice.com</p>
            </div>

            <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1245.796310941507!2d84.26777537213971!3d27.974184607355692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2snp!4v1718343427068!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include('includes/footer.php');
?>
