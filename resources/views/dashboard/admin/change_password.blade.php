<x-admin>
  <style>
    .card-box {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      padding: 30px;
      max-width: 500px;
      margin: 30px auto;
    }

    .form-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 6px;
    }

    .form-group {
      position: relative;
      margin-bottom: 20px;
    }

    .form-control {
      padding: 10px 40px 10px 14px; /* right padding increased for eye icon */
      border-radius: 8px;
      border: 1px solid #ddd;
      font-size: 14px;
      width: 100%;
    }

    .toggle-password {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 18px;
      color: #666;
      z-index: 2;
    }

    .btn-submit {
      background-color: #2563eb;
      color: white;
      border: none;
      padding: 10px 20px;
      font-weight: 600;
      border-radius: 8px;
      transition: background-color 0.3s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .btn-submit:hover {
      background-color: #1d4ed8;
    }

    .spinner-border {
      width: 16px;
      height: 16px;
      border-width: 2px;
    }

    @media (max-width: 576px) {
      .card-box {
        padding: 20px;
      }
    }
  </style>

  <div class="container-fluid">
    <div class="card-box">
      <h4 class="mb-4 text-center fw-bold">Change Password</h4>

      <form id="changePasswordForm">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="current_password" class="form-label">Current Password</label>
          <input type="password" class="form-control" id="current_password" name="current_password" required>
          <i class="fas fa-eye toggle-password" onclick="togglePassword(this, 'current_password')"></i>
        </div>

        <div class="form-group">
          <label for="new_password" class="form-label">New Password</label>
          <input type="password" class="form-control" id="new_password" name="new_password" required>
          <i class="fas fa-eye toggle-password" onclick="togglePassword(this, 'new_password')"></i>
        </div>

        <div class="form-group">
          <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
          <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
          <i class="fas fa-eye toggle-password" onclick="togglePassword(this, 'new_password_confirmation')"></i>
        </div>

        <div class="text-center">
          <button type="submit" class="btn-submit" id="submitBtn">
            <span class="btn-text">Update Password</span>
            <span class="btn-loading d-none">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Updating...
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePassword(icon, inputId) {
      const input = document.getElementById(inputId);
      const isPassword = input.type === 'password';
      input.type = isPassword ? 'text' : 'password';
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
    }

    const form = document.getElementById('changePasswordForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      btnText.classList.add('d-none');
      btnLoading.classList.remove('d-none');
      submitBtn.disabled = true;

      const formData = new FormData(form);

      fetch("{{ route('admin.password.update') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            toastr.success(data.message || 'Password updated successfully');
            form.reset();
          } else {
            toastr.error(data.message || 'Something went wrong.');
          }
        })
        .catch(() => {
          toastr.error('An error occurred.');
        })
        .finally(() => {
          btnText.classList.remove('d-none');
          btnLoading.classList.add('d-none');
          submitBtn.disabled = false;
        });
    });
  </script>
</x-admin>
