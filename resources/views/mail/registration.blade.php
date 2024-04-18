<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ env('APP_NAME') }}!</title>
</head>
<body>
    <h1>Welcome to {{ env('APP_NAME') }}, {{ $userData['username'] }}!</h1>
    
    <p>Thank you for registering with us. Your account details are as follows:</p>
    
    <p><strong>Name:</strong> {{ $userData['username'] }}</p>
    <p><strong>Email:</strong> {{ $userData['email'] }}</p>
    <p><strong>Password:</strong> {{ $userData['password'] }}</p>

    <p>You can now log in to your account and choose a plan to get started with {{ env('APP_NAME') }} services. We offer various membership plans tailored to your needs.</p>

    <p>To make your membership process easier, you can also make payments online via eSewa.</p>

    <p>If you have any questions or need assistance, feel free to contact us. We're here to help!</p>

    <p>Best regards,<br>
    {{ env('APP_NAME') }} Team</p>
</body>
</html>
