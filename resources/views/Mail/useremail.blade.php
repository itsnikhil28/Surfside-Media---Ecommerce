<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surfside Media - Query Received</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #1a1a1a;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .logo {
            max-width: 250px;
            margin: 10px auto;
            display: block;
        }

        .content {
            padding: 20px;
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }

        .content p {
            margin: 10px 0;
        }

        .highlight-box {
            background-color: #f1f1f1;
            padding: 12px;
            border-left: 5px solid #ff6600;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #555;
            background-color: #1a1a1a;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            color: white;
        }

        .footer a {
            color: #ff6600;
            text-decoration: none;
            font-weight: bold;
        }

        .shop-btn {
            display: inline-block;
            background-color: #ff6600;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <!-- Header with Brand Logo -->
        <div class="header">
            <img src="https://i.postimg.cc/NGkynpMG/logo.png" alt="Surfside Media Logo" class="logo">
            We’ve Received Your Query!
        </div>

        <!-- Content Section -->
        <div class="content">
            <p>Dear {{ $name }},</p>
            <p>Thanks for reaching out to <strong>Surfside Media</strong>! We’ve received your query and our team will
                get back to you as soon as possible.</p>

            <p><strong>Your Query Details:</strong></p>
            <div class="highlight-box">
                <p><strong>Email:</strong> {{ $email }}</p>
                <p><strong>Phone:</strong> {{ $phone }}</p>
                @isset($usermessage)
                <p><strong>Message:</strong> {{ $usermessage }}</p>
                @endisset
            </div>

            <p>While you wait, why not check out our latest clothing collections?</p>
            <a href="http://localhost:8000/shop" class="shop-btn">Shop Now</a>

            <p>If you have any urgent concerns, feel free to <a href="mailto:support@surfside.com">contact us</a>.</p>

            <p>Best regards,</p>
            <p><strong>Surfside Media Team</strong></p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            &copy; 2024 Surfside Media. All rights reserved.
            <br> Need help? <a href="mailto:support@surfside.com">Contact Us</a>
        </div>
    </div>

</body>

</html>