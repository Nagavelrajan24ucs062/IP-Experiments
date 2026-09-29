<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "shopping_db";
$tbl_name = "orders";

// 1. Connect to MySQL database
$conn = mysqli_connect($host, $username, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Insert new record when form submitted
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = mysqli_real_escape_string($conn, trim($_POST['customer_name']));
    $item_name = mysqli_real_escape_string($conn, trim($_POST['item_name']));
    $quantity = (int)$_POST['quantity'];

    $insert_sql = "INSERT INTO $tbl_name (customer_name, item_name, quantity) 
                   VALUES ('$customer_name', '$item_name', $quantity)";

    if (mysqli_query($conn, $insert_sql)) {
        $message = "Order placed and saved successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

// 3. Fetch all saved orders
$select_sql = "SELECT order_id, customer_name, item_name, quantity, order_date FROM $tbl_name ORDER BY order_id DESC";
$result = mysqli_query($conn, $select_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ex 11 - Order Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            padding: 40px;
        }
        .container {
            max-width: 750px;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .success-box {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333333;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .btn-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Online Shopping - Order Details</h2>

    <?php if (!empty($message)): ?>
        <div class="success-box"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <h3>Retrieved Orders from Database:</h3>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['order_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['order_date']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center;'>No orders found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="order.html" class="btn-link">&larr; Place Another Order</a>
</div>

</body>
</html>
<?php
mysqli_close($conn);
?>