<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        footer {
    background-color: #333;
    color: white;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    flex-direction: column;
    gap: 10px;
    padding: 20px 10px;
}

footer .footer-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

footer p {
    font-size: 0.9rem;
    margin: 0;
}

.footer-icons {
    display: flex;
    gap: 15px;
}

.footer-icons a {
    display: inline-block;
    width: 40px;
    height: 40px;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

/* Icon-Specific Styling */
.facebook-icon {
    background-color: #3b5998;
    color: white;
}

/* Icon-Specific Styling */
.facebook-icon {
    background-color: #3b5998;
    color: white;
}

.facebook-icon:hover {
    background-color: #2d4373;
    box-shadow: 0 0 10px 5px rgba(59, 89, 152, 0.7);
}

.twitter-icon {
    background-color: #00acee;
    color: white;
}

.twitter-icon:hover {
    background-color: #0084b4;
    box-shadow: 0 0 10px 5px rgba(0, 172, 238, 0.7);
}

.instagram-icon {
    background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
    color: white;
}

.instagram-icon:hover {
    background: linear-gradient(45deg, #bc1888, #cc2366, #dc2743, #e6683c, #f09433);
    box-shadow: 0 0 10px 5px rgba(188, 24, 136, 0.7);
}
  
    </style>
</head>
<body>
<footer>
    <div class="footer-content">
        <p>&copy; 2024 Pizza Shop | All Rights Reserved</p>
        <div class="footer-icons">
            <a href="#" class="facebook-icon"><i class="fab fa-facebook"></i></a>
            <a href="#" class="twitter-icon"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/pizzapilgrims?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="instagram-icon"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</footer>
</body>
</html>