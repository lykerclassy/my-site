<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - EduLearn</title>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<script>
document.getElementById("contactForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Stop page refresh

    let formData = new FormData(this);
    let responseMessage = document.getElementById("responseMessage");

    fetch("send_message.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "success") {
            responseMessage.textContent = "Message sent successfully!";
            responseMessage.style.color = "green";
            document.getElementById("contactForm").reset(); // Clear form
        } else {
            responseMessage.textContent = "Failed to send message. Try again.";
            responseMessage.style.color = "red";
        }
        responseMessage.style.display = "block";
    })
    .catch(error => {
        responseMessage.textContent = "Error occurred.";
        responseMessage.style.color = "red";
        responseMessage.style.display = "block";
    });
});
</script>

<body>
    <nav class="navbar">
        <div class="logo">EduLearn</div>
        <div class="nav-links">
            <a href="dashboard.php"><i class="fa fa-home"></i> Home</a>
            <a href="downloads.php"><i class="fa fa-download"></i> Downloads</a>
            <a href="contact.php"><i class="fa fa-envelope"></i> Contact Us</a>
            <a href="logout.php" class="logout-btn"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>

    <div class="container">
        <h2>Contact Us</h2>
        <div class="contact-info">
            <p><i class="fa fa-phone"></i> Phone: 0115566605</p>
            <p><i class="fa fa-envelope"></i> Email: <a href="mailto:kanewalker483@gmail.com">kanewalker483@gmail.com</a></p>
        </div>

        <h3>Send us a message</h3>
        <form id="contactForm">
    <input type="text" id="name" name="name" placeholder="Your Name" required>
    <input type="email" id="email" name="email" placeholder="Your Email" required>
    <textarea id="message" name="message" placeholder="Your Message" required></textarea>
    <button type="submit">Send Message</button>
</form>

<p id="responseMessage" style="display: none;"></p>

    </div>

    <footer class="footer">
        &copy; 2025 EduLearn. All Rights Reserved.
    </footer>
</body>
</html>
