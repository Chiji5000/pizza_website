
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/all.css" />
    <link rel="stylesheet" href="../css/fontawesome.min.css" />
    <link rel="stylesheet" href="../css/css/bootstrap-grid.min.css">
    <link href="../css/css/bootstrap.min.css" rel="stylesheet">
    <style>/* Navbar */
        nav {
            background-color: #ff5733;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.8rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-brand img {
            height: 35px;
            width: 35px;
            object-fit: cover;
            border-radius: 50%;
        }

        .nav-brand h1 {
            color: white;
            font-size: 1.2rem;
            margin: 0;
        }

        .nav-links {
            display: flex;
            gap: 12px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            font-size: 0.9rem;
            border-radius: 4px;
        }

        .nav-links a:hover {
            background-color: #c74128;
        }

        .nav-links a.active {
            background-color: #c70039;
        }

        /* Toggle Button */
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .menu-toggle span {
            height: 3px;
            width: 20px;
            background-color: white;
            margin: 4px 0;
        }

        /* Mobile Menu */
        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                background-color: #ff5733;
                position: absolute;
                top: 100%;
                right: 0;
                width: 100%;
                text-align: center;
                z-index: 999;
            }

            .nav-links.active {
                display: flex;
            }
        }</style>
</head>
<body>
   <header>        <nav>
            <div class="nav-brand">
                <img src="logo.pizza.png" alt="Pizza Shop Logo">
                <h1>Pizza Shop</h1>
            </div>
            <div class="menu-toggle" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="nav-links">
                <a href="home.php" class="active">Home</a>
                <a href="about.php">About Us</a>
                <a href="contact.php">Contact Us</a>
                <a href="menu.php">Menu</a>
                <a href="../authentication/logout.php">Logout</a>
            </div>
        </nav></header> 
</body>
</html>