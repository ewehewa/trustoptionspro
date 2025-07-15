<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ $subjectLine ?? 'Message from Admin' }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" style="padding: 20px 0;">
        <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
          
          <!-- Logo -->
          <tr style="background-color: #2563eb;">
            <td align="center" style="padding: 20px;">
              <img src="https://yourdomain.com/logo.png" alt="Logo" style="max-width: 150px;">
            </td>
          </tr>

          <!-- Email Body -->
          <tr>
            <td style="padding: 30px;">
              <h2 style="color: #333333; margin-top: 0;">Hello,</h2>
              <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                {!! nl2br(e($messageBody)) !!}
              </p>
              <p style="margin-top: 40px; color: #555;">
                Regards,<br><strong>The Admin Team</strong>
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td align="center" style="padding: 15px; background-color: #f0f0f0; font-size: 13px; color: #888;">
              &copy; {{ date('Y') }} TrustNetX. All rights reserved.
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
