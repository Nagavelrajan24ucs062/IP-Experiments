<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $credit_card = trim($_POST['credit_card'] ?? '');

    $errors = [];

    // 1. Email Regex Pattern
    $email_pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    if (!preg_match($email_pattern, $email)) {
        $errors[] = "Invalid Email format.";
    }

    // 2. Password Regex Pattern (Min 8 chars, 1 uppercase, 1 lowercase, 1 number, 1 special character)
    $password_pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    if (!preg_match($password_pattern, $password)) {
        $errors[] = "Password must be at least 8 characters long and contain uppercase, lowercase, a digit, and a special character.";
    }

    // 3. Phone Regex Pattern (10 digits starting with 6-9)
    $phone_pattern = "/^[6-9]\d{9}$/";
    if (!preg_match($phone_pattern, $phone)) {
        $errors[] = "Phone number must be a 10-digit number starting with 6, 7, 8, or 9.";
    }

    // 4. Credit Card Regex Pattern (16 digits with optional dashes or spaces)
    $card_pattern = "/^(?:\d{4}[- ]?){3}\d{4}$/";
    if (!preg_match($card_pattern, $credit_card)) {
        $errors[] = "Credit Card must be 16 digits (e.g., 1234-5678-9876-5432).";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .result-card {
            background: #ffffff;
            width: 480px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .success-banner {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #c3e6cb;
        }
        .error-banner {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            text-align: left;
            padding: 10px 12px;
            border-bottom: 1px solid #eeeeee;
        }
        th {
            background-color: #f8f9fa;
            width: 40%;
            color: #555555;
        }
        td {
            color: #222222;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="result-card">
    <?php if (empty($errors)): ?>
        <div class="success-banner">
            Server-side Validation Successful!
        </div>
        <h3 style="margin-top: 0; color: #333;">Submitted Details:</h3>
        <table>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($email) ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?= htmlspecialchars($password) ?></td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td><?= htmlspecialchars($phone) ?></td>
            </tr>
            <tr>
                <th>Credit Card</th>
                <td><?= htmlspecialchars($credit_card) ?></td>
            </tr>
        </table>
    <?php else: ?>
        <div class="error-banner">
            <h4 style="margin: 0 0 10px 0;">Validation Failed:</h4>
            <ul style="margin: 0; padding-left: 20px;">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <a href="index.html" class="back-link">&larr; Back to Registration Form</a>
</div>

</body>
</html>
<?php
} else {
    header("Location: index.html");
    exit();
}
?>