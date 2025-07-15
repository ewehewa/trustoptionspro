<x-admin>
  <style>
    .card-box {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      padding: 30px;
      max-width: 600px;
      margin: 30px auto;
    }

    .form-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 6px;
    }

    .form-control {
      padding: 10px 14px;
      border-radius: 8px;
      border: 1px solid #ddd;
      font-size: 14px;
      margin-bottom: 15px;
      width: 100%;
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
      <h4 class="mb-4 text-center fw-bold">Send Mail to User</h4>

      <form id="sendMailForm">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">Recipient Email</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ $user->email ?? '' }}" required>
        </div>

        <div class="mb-3">
          <label for="subject" class="form-label">Subject</label>
          <input type="text" class="form-control" id="subject" name="subject" required>
        </div>

        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>

        <div class="text-center">
          <button type="submit" class="btn-submit" id="submitBtn">
            <span class="btn-text">Send Mail</span>
            <span class="btn-loading d-none">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Sending...
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const form = document.getElementById('sendMailForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');

    form.addEventListener('submit', function(e) {
      e.preventDefault();

      btnText.classList.add('d-none');
      btnLoading.classList.remove('d-none');
      submitBtn.disabled = true;

      const formData = new FormData(form);

      fetch("{{ route('admin.mail.send') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        },
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          toastr.success(data.message || 'Mail sent successfully!');
          form.reset();
        } else {
          toastr.error(data.message || 'Failed to send mail.');
        }
      })
      .catch(() => {
        toastr.error('Network error.');
      })
      .finally(() => {
        btnText.classList.remove('d-none');
        btnLoading.classList.add('d-none');
        submitBtn.disabled = false;
      });
    });
  </script>
</x-admin>
