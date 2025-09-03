<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "root";      // Replace with your MySQL password
$dbname = "orders_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=orders_db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";  // Optional: You can remove this line in production
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();  // Exit if the connection fails
}

// Process the form when it's submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $price = 0;

    // Set price based on product
    switch ($product) {
        case "Tomato":
            $price = 2.50;
            break;
        case "Potato":
            $price = 1.80;
            break;
        case "Onion":
            $price = 1.20;
            break;
        default:
            $price = 0;
            break;
    }

    // Calculate total price
    $totalPrice = $price * $quantity;

    // Insert order into database using prepared statements to prevent SQL injection
    $sql = "INSERT INTO orders (name, email, phone, product, quantity, price, totalPrice) 
            VALUES (:name, :email, :phone, :product, :quantity, :price, :totalPrice)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':product', $product);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':totalPrice', $totalPrice);

    // Execute the query and check if the order is inserted
    if ($stmt->execute()) {
        // Successfully inserted the order, display confirmation
        echo "<h1>Order Placed Successfully!</h1>";
        echo "<p>Thank you, $name. Your order has been placed successfully.</p>";
        echo "<p><strong>Product:</strong> $product</p>";
        echo "<p><strong>Quantity:</strong> $quantity</p>";
        echo "<p><strong>Total Price:</strong> $" . number_format($totalPrice, 2) . "</p>";
    } else {
        echo "Error: Unable to place the order. Please try again.";
    }
}
?>
