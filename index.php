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
    <style>
    /* General Reset for elements */
    body, h1, h2, h3, p, ul, li {
        margin: 0 auto;
        padding: 0;
    }


    body {
        font-family: 'Roboto', sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f4f4f4;
        text-align: center; 
    }

    /* Link Styling */
    li.li-button {
        background: none;
        border: none;
        color: inherit;
        font: inherit;
        cursor: pointer;
        outline: none;
        text-decoration: none;
        padding: 10px 20px;
        transform: translateY(0px);
    }

    .link:hover {
        background-color: #ddd;
        border-radius: 5px;
        transform: scale(1.05); /* Scale up the link slightly on hover */
        transition: background-color 0.3s, transform 0.3s; /* Added transform transition */
    }

    .link
    {
        color: white;
        text-decoration:none;
        transform: scale(0.95); /* Scale down the link slightly on active */
    }

    .li-button:hover
    {
        padding: 10px 20px;
        background-color: #ddd;
        border-radius: 5px;
    }



    /* Header Styling */
    header {
        background-color: #222;
        color: #fff;
        text-align: center;
        position: relative;
        padding: 15px;
        height: auto;
        width: 100%; /* Full-width header */

    }

    header h1 {
        display: flex;
        align-items: center;
        justify-content: left;
        font-size: 36px;
        color: white;
        font-weight: bold;
        transform: translateY(25%);
    }

    header .logo {
        width: 150px;
        height: auto;
        margin-right: 15px;
    }

    /* Modal Styling */
    .modal {
        display: none; 
        position: fixed;
        z-index: 1; 
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%;
        overflow: auto; 
        background-color: rgb(0,0,0); 
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; 
        padding: 20px;
        border: 1px solid #888;
        width: 80%; 
        max-width: 500px; 
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Navigation Styling */
    nav {
        display: flex;
        justify-content: right; 
        transform: translateY(-80%);
    }

    nav ul {
        list-style: none; /* Remove default list styling */
        display: flex; /* Arrange list items in a row */
        padding: 0;
        margin: 0;
    }

    nav ul li {
        margin: 0 5px; /* Add space between the buttons */
    }

    nav ul li button.nav-button {
        background: none;
        border: none;
        color: inherit;
        font: inherit;
        cursor: pointer;
        outline: none;
        text-decoration: none;
        padding: 10px 20px;
        transition: background-color 0.3s;
    }

    nav ul li button.nav-button:hover {
        background-color: #ddd;
        border-radius: 5px;
    }

    /* Main Styling */
    main {
        padding: 30px;
        text-align: center;
    }

    h1 {
        color: white;
    }

    h2 {
        color: #333;
        font-size: 28px;
        margin-bottom: 20px;
    }

    /* Form Styling */
    form {
        max-width: 600px;
        margin: 20px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: left; 
    }

    form label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    form input, form textarea, form button {
        width: calc(100% - 22px);
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    form button {
        background-color: #222;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: #444;
    }

    /* Table Section Styling */
    #table-section {
        text-align: center;
        padding: 30px;
        background: #fff;
        margin: 20px auto;
        max-width: 1000px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left; /* Ensure table text is left-aligned */
    }

    th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #fafafa;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    /* Map Section Styling */
    .map-section {
        position: relative;
        width: 100%;
        height: 100vh; 
        margin: 0 auto;
        padding: 0;
    }

    .map-section iframe {
        width: 100%;
        height: 80%;
        border: 0;
        box-sizing: border-box; 
    }

    /* Go Up Button Styling */
    .go-up-button {
        position: fixed;
        bottom: 20px; /* Distance from the bottom of the page */
        right: 20px; /* Distance from the right of the page */
        background-color: #222;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        opacity: 0; /* Start as invisible */
        transition: opacity 0.3s ease;
        z-index: 1000;
    }

    .go-up-button:hover {
        background-color: #444;
    }

    .go-up-button.show {
        opacity: 1; /* Make visible */
    }

    /* Carousel Styling */
    .carousel {
        position: relative;
        width: 100%;
        max-width: 1000px;
        margin: 0 auto; /* Center the carousel without extra margins */
        overflow: hidden;
        padding: 0; /* Ensure no padding on the carousel */
    }

    .carousel-inner {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .carousel-item {
        min-width: 100%;
        padding: 0; /* Ensure no padding on carousel items */
    }

    .carousel-item img {
        max-height: 60%;
        max-width: 60%;
        margin: 0 auto; 
    }

    .carousel-indicators {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        padding: 0;
        margin-bottom: 150px;
    }

    .indicator {
        width: 10px;
        height: 10px;
        margin: 0 5px;
        background-color: #ccc;
        border-radius: 50%;
        cursor: pointer;
    }

    .indicator.active {
        background-color: #333;
    }



    /* Footer Styling */
    footer {
        background-color: #222;
        color: #fff;
        text-align: center;
        padding: 15px 20px;
        position: relative;
        width: 100%;
        bottom: 0;
    }

    .infor{
        background-color: white;
        text-align: center;
        padding: 15px 20px;
        position: relative;
        width: 100%;
        bottom: 0;
    }

    .tb-infor {
        width: 500px;
        border-collapse: collapse; 
        color: black;
        margin: 0 auto; 
        background-color: white;
        text-align: center; 
    }

    .tb-infor td, .tb-infor th {
        padding: 10px; 
        border: none; 
        vertical-align: middle; 
        text-align: center; 
    }

    .tb-infor img {
        margin-right: 0; /* No margin needed if centering everything */
        max-width: 80px; /* Limits the width of the image */
        height: auto; 
        vertical-align: right; 
    }

    /* Media Queries */
   /* Media Queries for Mobile Devices */
    @media (max-width: 768px) {
        /* Header Adjustments */
        header {
            padding: 10px;
        }

        header h1 {
            font-size: 28px;
            justify-content: center; /* Center align on mobile */
            transform: none;
        }

        header .logo {
            width: 120px;
        }

        /* Navigation Adjustments */
        nav {
            transform: none;
            justify-content: center;
        }

        nav ul {
            flex-direction: column; /* Stack navigation links vertically */
        }

        nav ul li {
            margin: 5px 0; /* Adjust spacing between stacked items */
        }

        nav ul li button.nav-button {
            padding: 10px 15px;
            width: 100%; /* Full width buttons for better touch targets */
        }

        /* Main Adjustments */
        main {
            padding: 20px;
        }

        h1 {
            font-size: 24px; /* Adjust font size for mobile */
        }

        h2 {
            font-size: 20px; /* Adjust font size for mobile */
        }

        /* Form Adjustments */
        form {
            padding: 15px;
        }

        form input, form textarea, form button {
            width: calc(100% - 20px); /* Adjust width for mobile */
            padding: 10px;
        }

        /* Table Section Adjustments */
        #table-section {
            padding: 20px;
            max-width: 100%;
        }

        table {
            font-size: 14px; /* Smaller font for table on mobile */
        }

        /* Map Section Adjustments */
        .map-section {
            height: 50vh; /* Adjust height for mobile view */
        }

        /* Carousel Adjustments */
        .carousel-item img {
            max-height: 40%; /* Adjust image size for mobile */
            max-width: 80%;
        }

        /* Footer Adjustments */
        footer {
            padding: 10px 15px;
        }

        /* Go Up Button Adjustments */
        .go-up-button {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }
    }

</style>
</head>
<body>
    <header>
        <h1>
            <img src="MG Logo(White).png" alt="mgroup" class="logo">
            WELCOME TO MGROUP !
        </h1>
        <nav>
            <ul>
                <li class="li-button"><a href="index.php" class="link">HOME</a></li>
                <li><button class="nav-button" data-target="about">ABOUT</button></li>
                <li><button class="nav-button" data-target="floor-plan">FLOOR PLAN</button></li>
                <li class="li-button"><a href="location.html" class="link" data-target="location">LOCATION</a></li>
                <li><button class="nav-button" data-target="contact">CONTACT US</button></li>
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

    <section class="infor">
    <h2>For more information on MGROUP, please contact us at:</h2>
        <table class="tb-infor">
            <tbody>
                <tr>
                    <td><img src="kong.png" alt="Kong"></td>
                    <td>010-228-2675 (KONG)</td>
                    <td><a href="mailto:leeching2565@gmail.com">leeching2565@gmail.com</a></td>
                </tr>
                <tr>
                    <td><img src="lydia.jpg" alt="Lydia"></td>
                    <td>011-2175-0925 (LYDIA)</td>
                    <td><a href="mailto:lydiasyazana9@gmail.com">lydiasyazana9@gmail.com</a></td>
                </tr>
                <tr>
                    <td><img src="atul.jpg" alt="Atul"></td>
                    <td>018-987-8300 (ATUL)</td> 
                    <td><a href="mailto:atul@gmail.com">qurratulanisya210@gmail.com</a></td>
                </tr>
            </tbody>
        </table>
    </section>



    <footer>
        <p>&copy; MGROUP PROPERTY. ALL RIGHTS RESERVED.</p>
    </footer>


    <!-- Modal Popup Structure -->
    <div id="modalPopup" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="popupText"></p>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const navButtons = document.querySelectorAll(".nav-button");
        const modal = document.getElementById("modalPopup");
        const popupText = document.getElementById("popupText");
        const closeModal = document.querySelector(".close");

        navButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const target = button.getAttribute("data-target");
                    if (target === 'location') {
                        // Skip the popup logic for the 'location' button
                        return;
                    }

                    switch (target) {
                        case 'home':
                            popupText.textContent = "Welcome to the Home Section!";
                            break;
                        case 'about':
                            popupText.innerHTML = `
                                <h2>About Melaka Old Street</h2>
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
                            `;
                            break;
                        case 'floor-plan':
                            popupText.innerHTML = `
                                <h2>Floor Plan</h2>
                                <img src="floorplan.png" alt="Floor Plan" style="width: 100%; height: auto;">
                            `;
                            break;
                        case 'contact':
                            popupText.innerHTML = `
                                <h2>Contact us for more information!</h2>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="contact-form" id="contactForm">
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" name="name" required>

                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" required>

                                    <label for="message">Message:</label>
                                    <textarea id="message" name="message" rows="4" required></textarea>

                                    <button type="submit">Send Message</button>
                                </form>
                            `;
                            break;
                    }
                    modal.style.display = "block";
                });
            });

            closeModal.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            }
        });

    </script>

</body>
</html>
