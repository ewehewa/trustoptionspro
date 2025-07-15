<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Investment Successful</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px;">
  <div style="max-width: 600px; margin: auto; background: #fff; padding: 30px; border-radius: 10px;">
    <h2 style="color: #333;">Investment Confirmed</h2>
    <p>Hello {{ $investment->user->name }},</p>

    <p>Thank you for investing with us. Here are the details of your investment:</p>

    <ul>
      <li><strong>Plan:</strong> {{ $investment->plan->name }}</li>
      <li><strong>Amount:</strong> ${{ number_format($investment->amount, 2) }}</li>
      <li><strong>Duration:</strong> {{ $investment->plan->duration }} days</li>
    </ul>

    <p>You will start receiving your returns based on the plan's schedule.</p>

    <p>Regards,<br><strong>{{ config('app.name') }}</strong></p>
  </div>
</body>
</html>
