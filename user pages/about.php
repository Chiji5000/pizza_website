<?php
include  '../backend/db_connection.php';
include 'nav.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
  <style>
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', Arial, sans-serif;
}

/* Body Styling */
body {
    line-height: 1.6;
    background: linear-gradient(to bottom right, #f4f4f4, #e4e4e4);
    color: #333;
    padding: 20px;
    overflow-x: hidden;
}

/* Main Header */
h1, h2 {
    text-align: center;
    margin-bottom: 20px;
    font-family: 'Poppins', Arial, sans-serif;
    color: #333;
    transition: color 0.3s;
}

h2:hover {
    color: #f39c12;
}

/* Section Styling */
section {
    background: #fff;
    margin: 20px auto;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    max-width: 900px;
    transition: transform 0.3s, box-shadow 0.3s;
}

section:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
}

/* Typography */
p, ul, li, blockquote {
    margin: 10px 0;
    font-size: 1rem;
    line-height: 1.8;
    color: #444;
    transition: color 0.3s;
}

p:hover, li:hover, blockquote:hover {
    color: #555;
}

/* Team Section */
#team-images {
    text-align: center;
    padding: 10px;
}

.member {
    display: inline-block;
    margin: 15px;
    text-align: center;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.member:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.member img {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    transition: box-shadow 0.3s, transform 0.3s;
}

.member img:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    transform: rotate(-3deg);
}

.member h3 {
    margin: 10px 0 5px;
    font-size: 1.4em;
    color: #222;
}

.member h3:hover {
    color: #f39c12;
}

.member p {
    font-size: 0.9em;
    color: #666;
    font-style: italic;
}

/* Core Values Section */
#values ul {
    list-style: none;
    padding: 0;
}

#values li {
    margin: 10px 0;
    font-size: 1.1em;
    color: #555;
    position: relative;
    padding-left: 25px;
}

#values li:before {
    content: '✔';
    color: #f39c12;
    font-size: 1.2em;
    position: absolute;
    left: 0;
    top: 3px;
}

/* Awards Section */
#awards ul {
    list-style: none;
    padding: 0;
}

#awards li {
    background: linear-gradient(to right, #ffffff, #f9f9f9);
    margin: 5px 0;
    padding: 15px;
    border-radius: 5px;
    color: #555;
    transition: background 0.3s, transform 0.3s;
}

#awards li:hover {
    background: #fff3e6;
    transform: translateX(5px);
}

/* Quotes Section */
blockquote {
    font-size: 1.2em;
    font-style: italic;
    color: #666;
    border-left: 5px solid #f39c12;
    padding-left: 15px;
    margin: 20px 0;
    position: relative;
}

blockquote:before {
    content: '“';
    font-size: 3em;
    color: #f39c12;
    position: absolute;
    left: -20px;
    top: -20px;
    opacity: 0.3;
}

blockquote:hover {
    color: #555;
    border-color: #e67e22;
}

/* Hover Effects for Links and Elements */
a {
    text-decoration: none;
    color: #f39c12;
    transition: color 0.3s, text-shadow 0.3s;
}

a:hover {
    color: #e67e22;
    text-shadow: 0 0 5px rgba(243, 156, 18, 0.7);
}

/* Simple Glow Effect */
section:hover {
    box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
}

/* Smooth Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

section {
    animation: fadeIn 1s ease-in-out;
}

/* Responsive Design */
@media (max-width: 768px) {
    body {
        padding: 10px;
    }

    section {
        padding: 15px;
    }

    .member {
        display: block;
        margin: 15px auto;
    }

    .member img {
        width: 150px;
        height: 150px;
    }

    h1, h2 {
        font-size: 1.5em;
    }

    blockquote {
        font-size: 1em;
    }
}

/* Subtle Gradient Animations */
body {
    background: linear-gradient(45deg, #f4f4f4, #e4e4e4);
    background-size: 200% 200%;
    animation: gradientMove 6s ease infinite;
}

@keyframes gradientMove {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}  </style>
</head>
<body>
   

    <!-- History Section -->
    <section id="history">
        <h2>Our History</h2>
        <p>Founded in [Year], our journey began with a simple idea: to [Your Goal/Mission]. Over the years, we have grown into a trusted name, achieving milestones such as [Example Milestones].</p>
        <p>From humble beginnings to where we are today, our story is one of passion, perseverance, and progress.</p>
    </section>

    <!-- Team Members Section -->
    <!-- Team Members Section with Images -->
    <section id="team-images">
        <h2>Meet Our Team</h2>
        <div class="member">
            <img src="../image/1.png" alt="John Doe">
            <h3>John Doe</h3>
            <p>CEO - Visionary leader with 10+ years of experience.</p>
        </div>
        <div class="member">
            <img src="../image/2.png" alt="Jane Smith">
            <h3>Jane Smith</h3>
            <p>CTO - Driving technical excellence and innovation.</p>
        </div>
        <div class="member">
            <img src="../image/4.png" alt="Michael Brown">
            <h3>Michael Brown</h3>
            <p>Marketing Head - Expert in audience connection strategies.</p>
        </div>
    </section>
    <!-- Core Values Section -->
    <section id="values">
        <h2>Our Core Values</h2>
        <ul>
            <li><strong>Integrity:</strong> We uphold the highest standards of honesty and fairness.</li>
            <li><strong>Innovation:</strong> Continuously striving to bring fresh ideas to life.</li>
            <li><strong>Excellence:</strong> Delivering top-notch results in everything we do.</li>
            <li><strong>Customer Focus:</strong> Putting our clients' needs at the heart of our work.</li>
        </ul>
    </section>

    <!-- Awards and Achievements Section -->
    <section id="awards">
        <h2>Awards and Achievements</h2>
        <ul>
            <li>Winner of "Best Startup of the Year" - 2023</li>
            <li>Recognized as a "Top Innovator in Technology" - 2022</li>
            <li>Achieved 1 Million Active Users in 2021</li>
        </ul>
    </section>

    <!-- Fans Section -->
    <section id="fans">
        <h2>Our Fans</h2>
        <p>We are grateful for the love and support of our fans worldwide. Your trust inspires us to keep pushing boundaries and delivering excellence.</p>
    </section>

    <!-- Quotes Section -->
    <section id="quotes">
        <h2>Inspirational Quotes</h2>
        <blockquote>
            "Success is not the key to happiness. Happiness is the key to success. If you love what you are doing, you will be successful." - Albert Schweitzer
        </blockquote>
        <blockquote>
            "The best way to predict the future is to create it." - Peter Drucker
        </blockquote>
    </section>
</body>
</html>

<?php
include 'footer.php';
?>