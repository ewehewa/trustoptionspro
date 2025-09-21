<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Welcome to Trust Options Pro</title>
  <style>
    body {
      background-color: #f4f4f4;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 40px auto;
      background: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .header {
      background-color: #4d2db7;
      padding: 30px;
      text-align: center;
      color: #ffffff;
    }
    .header h1 {
      margin: 0;
      font-size: 26px;
    }
    .content {
      padding: 30px;
      color: #444444;
    }
    .content h2 {
      color: #333333;
      font-size: 20px;
      margin-bottom: 15px;
    }
    .content p {
      line-height: 1.7;
      font-size: 16px;
    }
    .cta-button {
      margin: 30px 0;
      text-align: center;
    }
    .cta-button a {
      background-color: #6c63ff;
      color: #ffffff;
      padding: 12px 24px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      display: inline-block;
    }
    .footer {
      text-align: center;
      background: #f0f0f0;
      padding: 20px;
      font-size: 13px;
      color: #777777;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      <h1>Welcome to Trust Options Pro</h1>
    </div>

    <div class="content">
      <h2>Hi {{ $user->name ?? 'Valued User' }},</h2>
      <p>We're excited to have you on board! 🎉</p>
      <p>
        Trust Options Pro is your gateway to reliable investment opportunities and secure financial growth. 
        Our platform is designed with transparency, user security, and performance at its core.
      </p>

      <div class="cta-button">
        <a href="{{ $loginUrl }}">Log In to Your Account</a>
      </div>

      <p>If you ever need help, our support team is just a message away.</p>
      <p>Thank you for choosing Trust Options Pro.<br><br>Warm regards,<br>The Trust Options Pro Team</p>
    </div>

    <div class="footer">
      &copy; {{ date('Y') }} Trust Options Pro. All rights reserved.
    </div>
  </div>

</body>
</html>
