<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Email Verification Code</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4;">

  <div style="max-width: 600px; margin: 30px auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);">
    
    <h2 style="color: #333333; font-weight: 600; margin-bottom: 20px;">Hi there,</h2>

    <p style="font-size: 16px; color: #555555; margin-bottom: 20px;">
      Thank you for signing up with TrustNetX! Please use the code below to verify your email address:
    </p>

    <div style="text-align: center; margin: 30px 0;">
      <span style="display: inline-block; background-color: #2563eb; color: #ffffff; font-size: 28px; font-weight: bold; padding: 12px 24px; border-radius: 6px; letter-spacing: 4px;">
        {{ $otp }}
      </span>
    </div>

    <p style="font-size: 16px; color: #555555; margin-bottom: 30px;">
      Enter this code in the app to complete your registration.
    </p>

    <p style="font-size: 14px; color: #999999; text-align: center;">
      If you didn't sign up for this account, you can safely ignore this email.
    </p>
  </div>

</body>
</html>
