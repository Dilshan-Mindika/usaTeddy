<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Inventory App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #333333;
        }
        .content {
            line-height: 1.6;
            color: #555555;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #888888;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 15px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome, {{ $user->name }}!</h1>
        </div>
        <div class="content">
            <p>We are excited to have you on board. Your account has been successfully created.</p>
            <p>Here are your login details:</p>
            <ul>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Password:</strong> {{ $password }}</li>
            </ul>
            <p>You can log in by clicking the button below:</p>
            <a href="{{ route('login') }}" class="btn">Log In</a>
            <p>We recommend changing your password after logging in for security purposes.</p>
        </div>
        <div class="footer">
            <p>If you have any questions, feel free to contact us at support@[yourdomain].com.</p>
            <p>Thank you, <br>The [Your Application Name] Team</p>
        </div>
    </div>
</body>
</html>
