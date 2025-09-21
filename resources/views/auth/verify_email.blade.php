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
    .form-control {
      background: #fff !important;
      border: 1px solid #ccc;
      color: #000 !important;
      border-radius: 8px;
      font-weight: 600;
      letter-spacing: 3px;
      text-align: center;
    }
    .form-control:focus {
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
    .text-muted a {
      color: #a855f7 !important;
      font-weight: 500;
    }
    .text-muted a:hover {
      text-decoration: underline;
    }
  </style>

  <div class="card signup-card p-4">
    <h5 class="text-center mb-4">Verify Your Email</h5>

    <form id="verifyEmailForm">
      <div class="mb-3">
        <label class="form-label">Enter the 6-digit code sent to your email</label>
        <input type="text" name="otp" maxlength="6" class="form-control text-center" required pattern="\d{6}">
      </div>

      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-purple" id="verifyBtn">
          <span id="verifyBtnText">Verify</span>
          <span id="verifyLoader" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
        </button>
      </div>

      <p class="text-center text-light small">
        Didn't receive the code? 
        <a href="#" id="resendOtpBtn" class="text-decoration-none">Resend</a>
      </p>
    </form>
  </div>

  <script>
    // Handle OTP Verification
    document.getElementById('verifyEmailForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const form = e.target;
      const formData = new FormData(form);

      const verifyBtn = document.getElementById('verifyBtn');
      const verifyBtnText = document.getElementById('verifyBtnText');
      const verifyLoader = document.getElementById('verifyLoader');

      verifyBtn.classList.add('btn-purple.loading');
      verifyBtn.disabled = true;
      verifyBtnText.textContent = 'Verifying...';
      verifyLoader.classList.remove('d-none');

      try {
        const res = await fetch("{{ route('verify.email') }}", {
          method: "POST",
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          },
          body: formData
        });

        const data = await res.json();

        if (res.ok) {
          toastr.success(data.message || 'Email verified successfully!');
          setTimeout(() => {
            window.location.href = data.redirect || "{{ route('dashboard') }}";
          }, 1500);
        } else if (res.status === 422) {
          toastr.error(data.message || 'Invalid OTP');
        } else if (res.status === 410) {
          toastr.error('Your code has expired. Please request a new one.');
        } else if (res.status === 419) {
          toastr.error('Session expired. Please try registering again.');
        } else {
          toastr.error(data.message || 'Something went wrong.');
        }
      } catch (err) {
        console.error(err);
        toastr.error("Network error. Please try again.");
      } finally {
        verifyBtn.classList.remove('btn-purple.loading');
        verifyBtn.disabled = false;
        verifyBtnText.textContent = 'Verify';
        verifyLoader.classList.add('d-none');
      }
    });

    // Handle Resend OTP
    document.getElementById('resendOtpBtn').addEventListener('click', async function(e) {
      e.preventDefault();
      const btn = this;
      btn.textContent = 'Sending...';
      btn.classList.add('disabled');

      try {
        const res = await fetch("{{ route('otp.resend') }}", {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          }
        });

        const data = await res.json();

        if (res.ok) {
          toastr.success(data.message);
        } else {
          toastr.error(data.message || 'Could not resend code.');
        }
      } catch (err) {
        toastr.error('Network error.');
      } finally {
        btn.textContent = 'Resend';
        btn.classList.remove('disabled');
      }
    });
  </script>
</x-auth>
