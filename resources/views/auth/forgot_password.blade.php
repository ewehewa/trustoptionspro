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

    <h5 class="text-center mb-4">Reset Your Password</h5>

    <form id="forgotPasswordForm">
      <div class="mb-3">
        <label for="email" class="form-label">Enter your email</label>
        <input type="email" id="email" name="email" class="form-control" required>
      </div>

      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-purple" id="resetBtn">
          <span id="resetBtnText">Send Reset Link</span>
          <span id="resetLoader" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
        </button>
      </div>

      <p class="text-center text-light small">
        Remembered your password? <a href="{{ route('login') }}" class="text-decoration-none">Login here</a>
      </p>
    </form>
  </div>

  <script>
    document.getElementById('forgotPasswordForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const form = e.target;
      const email = document.getElementById('email').value.trim();

      const resetBtn = document.getElementById('resetBtn');
      const resetText = document.getElementById('resetBtnText');
      const resetLoader = document.getElementById('resetLoader');

      if (!email) {
        toastr.error("Email is required.");
        return;
      }

      resetBtn.disabled = true;
      resetText.textContent = 'Sending...';
      resetLoader.classList.remove('d-none');

      try {
        const res = await fetch("{{ route('password.email') }}", {
          method: "POST",
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ email })
        });

        const data = await res.json();

        if (res.ok) {
          toastr.success(data.message || "Password reset link sent to your email.");
          form.reset();
        } else if (res.status === 422 && data.errors) {
          Object.values(data.errors).forEach(errArr => {
            errArr.forEach(err => toastr.error(err));
          });
        } else {
          toastr.error(data.message || "Something went wrong.");
        }
      } catch (err) {
        console.error(err);
        toastr.error("Network error. Please try again.");
      } finally {
        resetBtn.disabled = false;
        resetText.textContent = 'Send Reset Link';
        resetLoader.classList.add('d-none');
      }
    });
  </script>
</x-auth>
