<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Auth | TrustNex</title>
  <!-- CSS Links -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  
  <style>
    body {
      background: #f5f9ff;
      font-family: 'Segoe UI', sans-serif;
    }
    .signup-card {
      max-width: 500px;
      margin: 50px auto;
      border: none;
      box-shadow: 0 0 25px rgba(0,0,0,0.1);
      border-radius: 15px;
    }
    .brand-name {
      font-weight: bold;
      color: #4d2db7;
    }
    .form-control:focus, .form-select:focus {
      border-color: #6c63ff;
      box-shadow: 0 0 0 0.25rem rgba(108, 99, 255, 0.25);
    }
    .btn-purple {
      background-color: #6c63ff;
      color: #fff;
    }
    .btn-purple:hover {
      background-color: #574b90;
    }

    .btn-purple {
      background-color: #6c63ff;
      color: #fff;
      transition: background-color 0.3s ease;
      opacity: 0.9;
    }

    .btn-purple:hover {
      background-color: #574b90;
      opacity: 1;
      color: white;
    }

    /* Active (loading) state - full purple */
    .btn-purple.loading {
      background-color: #4d2db7 !important;
      color: white;
      opacity: 1;
    }

    .input-group-text {
      background-color: #f0f0f0;
      cursor: pointer;
    }
    select.form-select {
      background-color: #fff;
      border-radius: 10px;
      padding: 0.6rem;
    }
  </style>
</head>
<body>

  <div class="container py-5">
    {{ $slot }}
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  
  <script>
    // Initialize Toastr with default options
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000"
    };
  </script>
  
  <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>