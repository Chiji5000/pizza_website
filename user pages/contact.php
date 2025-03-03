<?php
include '../backend/db_connection.php';
include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Pizza Shop</title>
    <link rel="stylesheet" type="text/css" href="../css/all.css" />
    <link rel="stylesheet" href="../css/fontawesome.min.css" />
    <link rel="stylesheet" href="../css/css/bootstrap-grid.min.css">
    <link href="../css/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .contact-container {
            padding: 50px 15px;
            text-align: center;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 30px;
        }

        .contact-container h1 {
            font-size: 2.8rem;
            color: #333;
            margin-bottom: 20px;
        }

        .contact-container p {
            font-size: 1.2rem;
            color: #555;
        }

        .contact-info {
            margin: 40px 0;
        }

        .contact-info h3 {
            font-size: 1.5rem;
            color: #555;
            margin-bottom: 10px;
        }

        .contact-info p {
            font-size: 1.1rem;
            color: #666;
        }

        .contact-info i {
            color: #ff5733;
            margin-right: 8px;
        }

        .contact-form h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
          
        }

        .btn-primary {
            background-color: #ff5733;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #e94c26;
        }

        .contact-map {
            margin-top: 40px;
            text-align: center;
        }

        .contact-map iframe {
            width: 100%;
            height: 400px;
            border: 0;
            border-radius: 8px;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .contact-info .col-md-4 {
                margin-bottom: 20px;
            }

            .contact-container {
                padding: 30px 10px;
            }

            .contact-form h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

    <!-- Contact Section -->
    <div class="container contact-container">
        <h1>Contact Us</h1>
        <p>If you have any questions, feel free to reach out to us:</p>
        
        <div class="row contact-info">
            <div class="col-md-4">
                <h3>Email Us</h3>
                <p><i class="fas fa-envelope"></i> support@pizzashop.com</p>
            </div>
            <div class="col-md-4">
                <h3>Call Us</h3>
                <p><i class="fas fa-phone-alt"></i> +234 890-123-4567</p>
            </div>
            <div class="col-md-4">
                <h3>Visit Us</h3>
                <p><i class="fas fa-map-marker-alt"></i> 123 Pizza Street, Food City, 12345</p>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form">
            <h2>Send Us a Message</h2>
            <form action="contact_submit.php" method="post">
                <div class="form-row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Your Name" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control" placeholder="Your Email" name="email" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <textarea class="form-control" placeholder="Your Message" name="message" rows="4" required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Send Message</button>
            </form>
        </div>

        <!-- Map -->
        <div class="contact-map">
            <h2>Find Us On the Map</h2>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31709.123456789!2d6.24375932739133!3d5.563417624062511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104361fe40e6b645%3A0x5df9aa40dd2de7ff!2sDelta%20Mall!5e0!3m2!1sen!2sng!4v1700000000000" 
                allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>

</body>
</html>

<?php
include 'footer.php';
?>