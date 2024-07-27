<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "mos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $user_message = $conn->real_escape_string(trim($_POST['message']));

    // Insert data into the messages table
    $sql = "INSERT INTO messages (user_name, user_email, user_message) VALUES ('$name', '$email', '$user_message')";

    if ($conn->query($sql) === TRUE) {
        $message = "Message sent successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <h1>
            <img src="logo.png" alt="mgroup" class="logo">
            WELCOME TO MGROUP!
        </h1>
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="#table-section">ABOUT</a></li>
                <li><a href="#2">FLOOR PLAN</a></li>
                <li><a href="#3">LOCATION</a></li>
                <li><a href="#4">CONTACT US</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="products" class="products-section">
            <h2>MELAKA OLD STREET</h2>
            <div class="products-grid">
                <div class="product-card">
                    <h2>3 Storey Shop Office</h2>
                    <img src="mos.jpg" alt="1">
                </div>
            </div>
        </section>
    </main>

    <section id="table-section">
        <h2>About</h2>
        <table>
            <tbody>
                <tr>
                    <td>Project Name</td>
                    <td>Melaka Old Street</td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>Kota Laksamana, Melaka</td>
                </tr>
                <tr>
                    <td>Type of Property</td>
                    <td>3 Storey Shop Office</td>
                </tr>
                <tr>
                    <td>Bath / Bed</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Tenure</td>
                    <td>Leasehold</td>
                </tr>
                <tr>
                    <td>Expired on</td>
                    <td>2106</td>
                </tr>
                <tr>
                    <td>Land Size / Built Up</td>
                    <td>22' x 70'</td>
                </tr>
                <tr>
                    <td>Selling / Rental Price</td>
                    <td>RM 1,980,000</td>
                </tr>
                <tr>
                    <td>Condition</td>
                    <td>New</td>
                </tr>
                <tr>
                    <td>Advantages</td>
                    <td>✅Heritage concept design <br>✅Unique historical experience<br>✅A contemporary commercial hub at heart of Melaka<br>✅Avenue corner pathways connected by lighting lines fit for Instagram</td>
                </tr>
            </tbody>
        </table>
    </section>

    <br>
    <br>
    <section class="floorplan" id="2">
        <h2>Floor Plan</h2>
        <div class="products-grid">
            <div class="product-card">
                <img src="floorplan.png" alt="2">
            </div>
        </div>
    </section>

    <br>
    <br>
    <section class="map-section" id="3">
        <h2><b>Location (Online Real Time Address)</b></h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3742.888187809673!2d102.2313222!3d2.2002814999999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1f1b87a9cd181%3A0x87ad4504f6303956!2s7%2C%20Jalan%20KLJ%207%2C%20Melaka!5e1!3m2!1szh-CN!2smy!4v1721979872629!5m2!1szh-CN!2smy"
            width="100%" height="100vh" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
    
    <h2>Nearby</h2>
    <div class="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="aeon.jpg" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="af.jpg" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="admiral.jpg" alt="Image 3">
            </div>
            <div class="carousel-item">
                <img src="ambience_kl.jpg" alt="Image 4">
            </div>
            <div class="carousel-item">
                <img src="bali.jpg" alt="Image 5">
            </div>
            <div class="carousel-item">
                <img src="bs.jpg" alt="Image 6">
            </div>
            <div class="carousel-item">
                <img src="jw.jpg" alt="Image 7">
            </div>
            <div class="carousel-item">
                <img src="klebang.jpg" alt="Image 8">
            </div>
            <div class="carousel-item">
                <img src="mcd.jpg" alt="Image 9">
            </div>
            <div class="carousel-item">
                <img src="medical.jpg" alt="Image 10">
            </div>
            <div class="carousel-item">
                <img src="rh.jpg" alt="Image 11">
            </div>
            <div class="carousel-item">
                <img src="river.jpg" alt="Image 12">
            </div>
            <div class="carousel-item">
                <img src="sentralmedical.jpg" alt="Image 13">
            </div><div class="carousel-item">
                <img src="uniqlo.jpg" alt="Image 14">
            </div>
            

        </div>
        <div class="carousel-indicators">
            <span class="indicator active" data-slide-to="0"></span>
            <span class="indicator" data-slide-to="1"></span>
            <span class="indicator" data-slide-to="2"></span>
            <span class="indicator" data-slide-to="3"></span>
            <span class="indicator" data-slide-to="4"></span>
            <span class="indicator" data-slide-to="5"></span>
            <span class="indicator" data-slide-to="6"></span>
            <span class="indicator" data-slide-to="7"></span>
            <span class="indicator" data-slide-to="8"></span>
            <span class="indicator" data-slide-to="9"></span>
            <span class="indicator" data-slide-to="10"></span>
            <span class="indicator" data-slide-to="11"></span>
            <span class="indicator" data-slide-to="12"></span>
            <span class="indicator" data-slide-to="13"></span>
        </div>
    </div>

    <section class="message">
        <h2>Get In Touch</h2>
        <p>We'd love to hear from you!</p>
        <p>Whether you have questions, suggestions, or just want to say hello,</p>
        <p>feel free to reach out to us using the contact information below.</p>
    </section>

    <br>
    <br>
    <section class="contact-form-container" id="4">
        <h2>Contact Us</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="contact-form" id="contactForm">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">Send Message</button>
        </form>
        <?php if (!empty($message)) echo "<p>$message</p>"; ?>
    </section>

    <button id="goUpButton" class="go-up-button" title="Go to Top">⤴</button>
    <script src="index.js"></script>

    <footer>
        <p>&copy; MGROUP PROPERTY. ALL RIGHTS RESERVED.</p>
    </footer>
</body>
</html>
