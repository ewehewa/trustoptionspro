<x-auth>
<div class="card signup-card p-4">
  <div class="d-flex justify-content-center py-2">
    <a href="{{ url('/') }}" class="text-decoration-none">
      <img src="{{ asset('assets/img/appicon.png') }}" width="140" height="40">
    </a> 
  </div>
  <h5 class="text-center text-secondary mb-4">Welcome back</h5>

  <form id="loginForm">
    <div class="mb-3">
      <label class="form-label">Email or Username</label>
      <input type="text" name="login" class="form-control" required >
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <div class="input-group">
        <input type="password" name="password" id="password" class="form-control" required  minlength="6">
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
    <p class="text-center text-muted small">
      Don't have an account? <a href="{{ route('show.register') }}" class="text-decoration-none">Register here</a>
    </p>
  </form>
</div>

<script>
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
        // User is unverified
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
