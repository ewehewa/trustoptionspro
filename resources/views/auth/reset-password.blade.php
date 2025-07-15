<x-auth>
<div class="card signup-card p-4">
  <div class="d-flex justify-content-center py-2">
    <a href="{{ url('/') }}" class="text-decoration-none">
      <img src="{{ asset('assets/img/appicon.png') }}" width="140" height="40">
    </a> 
  </div>
  <h5 class="text-center text-secondary mb-4">Reset Your Password</h5>

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
