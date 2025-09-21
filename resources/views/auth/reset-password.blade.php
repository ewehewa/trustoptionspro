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

    /* Input group for password visibility */
    .input-group-text {
      background: #fff;
      border: 1px solid #ccc;
      border-left: none;
      cursor: pointer;
      color: #333;
    }
    .input-group-text:hover {
      color: #a855f7;
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

    <form id="resetForm">
      <input type="hidden" name="token" value="{{ $token }}">
      <input type="hidden" name="email" value="{{ $email }}">

      <div class="mb-3">
        <label class="form-label">New Password</label>
        <div class="input-group">
          <input type="password" name="password" id="password" class="form-control" required minlength="6">
          <span class="input-group-text" onclick="togglePassword('password', this)">
            <i class="fas fa-eye"></i>
          </span>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <div class="input-group">
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required minlength="6">
          <span class="input-group-text" onclick="togglePassword('password_confirmation', this)">
            <i class="fas fa-eye"></i>
          </span>
        </div>
      </div>

      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-purple" id="resetBtn">
          <span id="resetBtnText">Reset Password</span>
          <span id="resetLoader" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
        </button>
      </div>
      <p class="text-center text-muted small">
        <a href="{{ route('login') }}" class="text-decoration-none">Back to Login</a>
      </p>
    </form>
  </div>

  <script>
    function togglePassword(fieldId, el) {
      const input = document.getElementById(fieldId);
      const icon = el.querySelector("i");

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

    document.getElementById('resetForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const form = e.target;
      const formData = new FormData(form);

      const btn = document.getElementById('resetBtn');
      const text = document.getElementById('resetBtnText');
      const loader = document.getElementById('resetLoader');

      btn.disabled = true;
      text.textContent = 'Processing...';
      loader.classList.remove('d-none');

      try {
        const res = await fetch("{{ route('password.update') }}", {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          },
          body: formData
        });

        const data = await res.json();

        if (res.ok) {
          toastr.success(data.message || 'Password reset successfully.');
          setTimeout(() => {
            window.location.href = "{{ route('login') }}";
          }, 1500);
        } else if (res.status === 422) {
          Object.values(data.errors).forEach(errArr => {
            errArr.forEach(err => toastr.error(err));
          });
        } else {
          toastr.error(data.message || 'Something went wrong.');
        }
      } catch (err) {
        toastr.error('Network error. Please try again.');
      } finally {
        btn.disabled = false;
        text.textContent = 'Reset Password';
        loader.classList.add('d-none');
      }
    });
  </script>
</x-auth>
