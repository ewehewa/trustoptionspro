<x-dashboard>
  <div class="container-fluid px-4">
    <h1 class="page-title">My Profile</h1>

    <div class="row">
      <div class="col-lg-8 col-12 mx-auto">
        <!-- Update Profile -->
        <div class="content-card mb-4">
          <h3>Update Profile</h3>
          <form id="profileForm">
            @csrf
            <div class="form-group mb-3">
              <label class="form-label">Full Name</label>
              <input type="text" class="form-input" id="name" value="{{ auth()->user()->name }}">
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-input" id="email" value="{{ auth()->user()->email }}">
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Phone Number</label>
              <input type="tel" class="form-input" id="phone" value="{{ auth()->user()->phone }}">
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Country</label>
              <select class="form-select" id="country">
                <option value="US" {{ auth()->user()->country == 'US' ? 'selected' : '' }}>United States</option>
                <option value="CA" {{ auth()->user()->country == 'CA' ? 'selected' : '' }}>Canada</option>
                <option value="UK" {{ auth()->user()->country == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                <option value="AU" {{ auth()->user()->country == 'AU' ? 'selected' : '' }}>Australia</option>
                <option value="DE" {{ auth()->user()->country == 'DE' ? 'selected' : '' }}>Germany</option>
              </select>
            </div>

            <button type="submit" class="btn-primary mt-2">Update Profile</button>
          </form>
        </div>

        <!-- Change Password -->
        <div class="content-card">
          <h3>Change Password</h3>
          <form id="passwordForm">
            @csrf
            <div class="form-group">
              <label class="form-label">Current Password</label>
              <input type="password" class="form-input" id="currentPassword" placeholder="Enter current password">
            </div>

            <div class="form-group">
              <label class="form-label">New Password</label>
              <input type="password" class="form-input" id="newPassword" placeholder="Enter new password">
            </div>

            <div class="form-group">
              <label class="form-label">Confirm New Password</label>
              <input type="password" class="form-input" id="confirmPassword" placeholder="Confirm new password">
            </div>

            <button type="submit" class="btn-primary mt-3">Change Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
  const profileForm = document.getElementById('profileForm');
  const profileBtn = profileForm.querySelector('button[type="submit"]');

  const passwordForm = document.getElementById('passwordForm');
  const passwordBtn = passwordForm.querySelector('button[type="submit"]');

  function setButtonLoading(button, isLoading) {
    if (isLoading) {
      button.disabled = true;
      button.innerHTML = `<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>Processing...`;
    } else {
      if (button === profileBtn) {
        button.innerHTML = 'Update Profile';
      } else {
        button.innerHTML = 'Change Password';
      }
      button.disabled = false;
    }
  }

  profileForm.addEventListener('submit', async function (e) {
    e.preventDefault();
    setButtonLoading(profileBtn, true);

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const country = document.getElementById('country').value;

    try {
      const response = await fetch("{{ route('user.update.profile') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ name, email, phone, country })
      });

      const data = await response.json();
      if (data.success) {
        toastr.success(data.message || 'Profile updated successfully.');
      } else {
        toastr.error(data.message || 'Failed to update profile.');
      }
    } catch (err) {
      toastr.error('Something went wrong.');
    } finally {
      setButtonLoading(profileBtn, false);
    }
  });

  passwordForm.addEventListener('submit', async function (e) {
    e.preventDefault();
    setButtonLoading(passwordBtn, true);

    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (newPassword !== confirmPassword) {
      toastr.error('Passwords do not match.');
      setButtonLoading(passwordBtn, false);
      return;
    }

    try {
      const response = await fetch("{{ route('user.update.password') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
          currentPassword,
          newPassword,
          newPassword_confirmation: confirmPassword
        })
      });

      const data = await response.json();
      if (data.success) {
        toastr.success(data.message || 'Password updated successfully.');
        passwordForm.reset();
      } else if (data.errors) {
        const msg = Object.values(data.errors).flat().join('<br>');
        toastr.error(msg);
      } else {
        toastr.error(data.message || 'Failed to update password.');
      }
    } catch (err) {
      toastr.error('Something went wrong.');
    } finally {
      setButtonLoading(passwordBtn, false);
    }
  });
</script>

</x-dashboard>
