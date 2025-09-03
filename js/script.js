// Function to update the price based on the selected product and quantity
function updatePrice() {
    const product = document.getElementById("product").value;
    const quantity = document.getElementById("quantity").value;
    let pricePerUnit = 0;

    // Set price based on selected product
    if (product === "tomato") {
        pricePerUnit = 2.50;
    } else if (product === "potato") {
        pricePerUnit = 1.80;
    } else if (product === "onion") {
        pricePerUnit = 1.20;
    }

    // Update the displayed price
    const totalPrice = pricePerUnit * quantity;
    document.getElementById("price").innerText = totalPrice.toFixed(2);
}

// Function to handle form submission and display the order summary
function placeOrder(event) {
    event.preventDefault(); // Prevent form submission

    // Get form values
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const product = document.getElementById("product").options[document.getElementById("product").selectedIndex].text;
    const quantity = document.getElementById("quantity").value;
    const price = document.getElementById("price").innerText;

    // Display the order summary
    document.getElementById("summaryName").innerText = name;
    document.getElementById("summaryEmail").innerText = email;
    document.getElementById("summaryPhone").innerText = phone;
    document.getElementById("summaryProduct").innerText = product;
    document.getElementById("summaryQuantity").innerText = quantity;
    document.getElementById("summaryPrice").innerText = price;

    // Hide the form and show the order summary
    document.getElementById("orderForm").style.display = "none";
    document.getElementById("orderSummary").style.display = "block";
}
