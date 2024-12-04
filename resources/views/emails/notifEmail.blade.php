<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Assignment Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }

        .email-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .email-content {
            margin-bottom: 20px;
        }

        .email-footer {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            Case Assignment
        </div>
        <div class="email-content">
            <p>Dear <strong>Ma'am/Sir</strong>,</p>
            <p>We are pleased to inform you that the case <strong>{{ $data['case_number'] }}</strong> has been
                successfully assigned. Please find the details
                below:</p>
            <ul>
                <li><strong>Case Number:</strong> {{ $data['case_number'] }}</li>
                <li><strong>Case Type:</strong> {{ $data['case_type'] }}</li>
                <li><strong>Assigned Division:</strong> {{ $data['division'] }}</li>
                <li><strong>Submitted On:</strong> {{ $data['date'] }}</li>
            </ul>
            <p>If you have any questions or need further assistance, please do not hesitate to reach out.</p>
            <p>Thank you for your attention to this matter.</p>
        </div>
        <div class="email-footer">
            Best regards,
            <br>
            AppealEase
        </div>
    </div>
</body>

</html>
