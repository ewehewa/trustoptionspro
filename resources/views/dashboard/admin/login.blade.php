<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin | Login</title>

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
      transition: background-color 0.3s ease;
      opacity: 0.9;
    }
    .btn-purple:hover {
      background-color: #574b90;
      opacity: 1;
      color: white;
    }
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
    <div class="card signup-card p-4">
      <h3 class="text-center mb-4 brand-name">TrustNetX</h3>
      <h5 class="text-center text-secondary mb-4">Admin Control Panel</h5>
      <form id="loginForm">
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="email" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <div class="input-group">
            <input type="password" name="password" id="password" class="form-control" required minlength="6">
            <span class="input-group-text" onclick="togglePassword('password', this)">
              <i class="fas fa-eye"></i>
            </span>
          </div>
        </div>

        <div class="d-flex justify-content-between mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
            <label class="form-check-label" for="rememberMe">Remember Me</label>
          </div>
          <a href="#" class="text-decoration-none small text-primary">Forgot Password?</a>
        </div>

        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-purple" id="loginBtn">
            <span id="loginBtnText">Login</span>
            <span id="loginLoader" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    // Toggle password visibility
    function togglePassword(id, el) {
      const input = document.getElementById(id);
      const icon = el.querySelector('i');
      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }

    // Toastr config
    toastr.options = {
      closeButton: true,
      progressBar: true,
      positionClass: "toast-top-right",
      preventDuplicates: true,
      showDuration: "300",
      hideDuration: "1000",
      timeOut: "5000",
      extendedTimeOut: "1000"
    };

    // Form submit handler
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const form = e.target;
      const formData = new FormData(form);
      const loginBtn = document.getElementById('loginBtn');
      const loginText = document.getElementById('loginBtnText');
      const loginLoader = document.getElementById('loginLoader');

      // Loading state
      loginBtn.classList.add('loading');
      loginBtn.disabled = true;
      loginText.textContent = 'Processing...';
      loginLoader.classList.remove('d-none');

      try {
        const res = await fetch("{{ route('admin.login') }}", {
          method: "POST",
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
          },
          body: formData
        });

        const data = await res.json();

        if (res.ok && data.success) {
          toastr.success(data.message || "Login successful");
          setTimeout(() => {
            window.location.href = data.redirect;
          }, 1500);
        } else if (res.status === 422 && data.errors) {
          Object.values(data.errors).forEach(errArr => {
            if (Array.isArray(errArr)) {
              errArr.forEach(err => toastr.error(err));
            }
          });
        } else if (res.status === 419) {
          toastr.error("Session expired. Please refresh and try again.");
        } else {
          toastr.error(data.message);
        }
      } catch (err) {
        console.error(err);
        toastr.error("Network error. Please try again.");
      } finally {
        loginBtn.classList.remove('loading');
        loginBtn.disabled = false;
        loginText.textContent = 'Login';
        loginLoader.classList.add('d-none');
      }
    });
  </script>
</body>
</html>
