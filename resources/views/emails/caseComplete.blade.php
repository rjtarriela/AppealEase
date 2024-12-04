<!DOCTYPE html>
<html>

<head>
    <title>Case Update</title>
</head>

<body>
    <h2>Case Completion Update</h2>
    <p>Dear Ma'am/Sir,</p>
    <p>We are pleased to inform you that your case has been successfully completed. Below are the details:</p>
    <ul>
        <li><strong>Case Number:</strong> {{ $data['case_number'] }}</li>
        <li><strong>Case Type:</strong> {{ ucfirst($data['case_type']) }}</li>
        <li><strong>Division:</strong> {{ $data['division'] }}</li>
        <li><strong>Date Completed:</strong> {{ $data['date'] }}</li>
        <li style="margin-top: 15px"><strong>VERDICT:</strong> {{ $data['verdictStatus'] }}</li>
    </ul>
    <p>If you have any questions or require further assistance, feel free to contact us.</p>
    <p>Thank you for your trust in our services.</p>
    <p>Best regards,</p>
    <p>AppealEase</p>
</body>

</html>
