<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Deposit Approved</title>
</head>
<body>
  <h2>Hi {{ $deposit->user->name }},</h2>

  <p>Your deposit of <strong>${{ number_format($deposit->amount, 2) }}</strong> has been approved successfully.</p>

  <p>Payment Method: {{ $deposit->payment_mode }}</p>

  <p>Thank you for investing with us.</p>

  <p>Regards,<br>TrustNetX</p>
</body>
</html>
