<x-auth>
  <style>
    body {
      background: #0b0b2a; /* Dark navy background */
      color: #fff;
    }

    .signup-card {
      background: #111133;
      border-radius: 16px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
      color: #fff;
    }

    h5 {
      background: linear-gradient(90deg, #a855f7, #ec4899, #f97316);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: 600;
    }

    .form-label {
      color: #cfcfe0;
      font-weight: 500;
    }

    /* White input fields */
    .form-control,
    .form-select {
      background: #fff !important;
      border: 1px solid #ccc;
      color: #000 !important;
      border-radius: 8px;
    }
    .form-control:focus,
    .form-select:focus {
      background: #fff !important;
      color: #000 !important;
      border-color: #a855f7;
      box-shadow: 0 0 0 0.25rem rgba(168, 85, 247, 0.25);
    }

    .input-group-text {
      background: #1a1a3a;
      border: 1px solid #2d2d4d;
      cursor: pointer;
      color: #bbb;
    }

    /* Gradient button */
    .btn-purple {
      background: linear-gradient(90deg, #6366f1, #a855f7, #ec4899, #f97316);
      border: none;
      color: #fff;
      font-weight: 600;
      border-radius: 8px;
      transition: 0.3s;
    }
    .btn-purple:hover {
      opacity: 0.9;
      transform: translateY(-2px);
    }

    /* Links */
    .text-muted a,
    .text-primary {
      color: #a855f7 !important;
      font-weight: 500;
    }
    .text-muted a:hover,
    .text-primary:hover {
      text-decoration: underline;
    }
  </style>

  <div class="card signup-card p-4">
    <div class="d-flex justify-content-center py-2">
      <a href="{{ url('/') }}" class="text-decoration-none">
        <img src="{{ asset('assets1/img/logo.png') }}" width="60" height="60">
      </a> 
    </div>
    <h5 class="text-center mb-4">Welcome back</h5>

    <form id="loginForm">
      <div class="mb-3">
        <label class="form-label">Email or Username</label>
        <input type="text" name="login" class="form-control" required>
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
          <input class="form-check-input" type="checkbox" id="rememberMe">
          <label class="form-check-label" for="rememberMe">Remember Me</label>
        </div>
        <a href="{{ route('password.request') }}" class="text-decoration-none small text-primary">Forgot Password?</a>
      </div>

      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-purple" id="loginBtn">
          <span id="loginBtnText">Login</span>
          <span id="loginLoader" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
        </button>
      </div>

      <p class="text-center text-light small">
        Don't have an account? <a href="{{ route('show.register') }}" class="text-decoration-none">Register here</a>
      </p>
    </form>
  </div>

  <script>
    function togglePassword(fieldId, el) {
      const field = document.getElementById(fieldId);
      const icon = el.querySelector('i');
      if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }

    document.getElementById('loginForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const form = e.target;
      const formData = new FormData(form);

      const loginBtn = document.getElementById('loginBtn');
      const loginText = document.getElementById('loginBtnText');
      const loginLoader = document.getElementById('loginLoader');

      loginBtn.classList.add('btn-purple.loading');
      loginBtn.disabled = true;
      loginText.textContent = 'Processing...';
      loginLoader.classList.remove('d-none');

      try {
        const res = await fetch("{{ route('login') }}", {
          method: "POST",
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
          },
          body: formData
        });

        const data = await res.json();

        if (res.ok) {
          toastr.success(data.message || "Login successful");
          setTimeout(() => {
            window.location.href = "{{ route('dashboard') }}";
          }, 1500);
        } else if (res.status === 422) {
          Object.values(data.errors).forEach(errArr => {
            if (Array.isArray(errArr)) {
              errArr.forEach(err => toastr.error(err));
            }
          });
        } else if (res.status === 403 && data.redirect) {
          toastr.warning(data.message || "Please verify your email.");
          setTimeout(() => {
            window.location.href = data.redirect;
          }, 1500);
        } else if (res.status === 419) {
          toastr.error("Your session has expired. Please refresh the page and try again.");
        } else {
          toastr.error(data.message || "Invalid login credentials.");
        }
      } catch (err) {
        console.error(err);
        toastr.error("Network error. Please try again.");
      } finally {
        loginBtn.classList.remove('btn-purple.loading');
        loginBtn.disabled = false;
        loginText.textContent = 'Login';
        loginLoader.classList.add('d-none');
      }
    });
  </script>
</x-auth>
