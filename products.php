<?php
// products.php

session_start(); // Start the session if not already started

// Database connection details (replace with your actual credentials)
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_dbname";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT id, name, price, image FROM products"; // Ensure the table and column names match your database
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AQUA COOL - Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>AQUA COOL</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <h2>Our Products</h2>
        <div class="products">
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<img src='" . $row["image"] . "' alt='" . $row["name"] . "'>";
                    echo "<h3>" . $row["name"] . "</h3>";
                    echo "<p>$" . $row["price"] . "</p>";
                    echo "<a href='add_to_cart.php?id=" . $row["id"] . "'>Add to Cart</a>";
                    echo "</div>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> AQUA COOL. All rights reserved.</p>
        </div>
    </footer>

    <?php $conn->close(); // Close the database connection ?>
</body>
</html>