<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Creation Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #1e90ff;
            margin: 0;
            padding: 0;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
        }

        li {
            font-size: 16px;
            margin: 5px 0;
        }

        .footer {
            font-size: 14px;
            text-align: center;
            margin-top: 30px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>Hello, {{ $litigantData['name'] }}!</h1>
        <p>Your account has been successfully created on our platform.</p>
        <p><strong>Account Details:</strong></p>
        <ul>
            <li>Email: {{ $litigantData['email'] }}</li>
            <li>Contact Number: {{ $litigantData['contact_number'] }}</li>
            <li>Attorney's Number: {{ $litigantData['atty_number'] }}</li>
            <li>Date of Registration: {{ $litigantData['date'] }}</li>
        </ul>

        <p><strong>Set your password by clicking the "Forgot your password?" button in the AppealEase Web App.</strong>
        </p>

        <p>If you didn't create this account, please ignore this email or contact us for further assistance.</p>

        <div class="footer">
            <p>&copy; 2024 AppealEase. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
