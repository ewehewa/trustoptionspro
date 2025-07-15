<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Deposit Submitted</title>
</head>
<body>
  <h2>Hello {{ $deposit->user->name }},</h2>
  <p>Your deposit of <strong>${{ number_format($deposit->amount) }}</strong> using <strong>{{ $deposit->payment_mode }}</strong> has been received and is pending approval.</p>

  <p>We'll notify you once it’s reviewed.</p>

  <br>
  <p>Thank you,<br>TrustNetX Team</p>
</body>
</html>
