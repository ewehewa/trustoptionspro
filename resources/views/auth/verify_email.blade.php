<x-auth>
  <div class="card signup-card p-4">
    <h5 class="text-center text-secondary mb-4">Verify Your Email</h5>

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

      <p class="text-center text-muted small">
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
