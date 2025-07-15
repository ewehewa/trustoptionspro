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
      <h4 class="mb-4 text-center fw-bold">Update Wallet Information</h4>

      <form id="walletForm">
        @csrf

        <div class="mb-3">
          <label for="wallet_name" class="form-label">Wallet Name</label>
          <input type="text" class="form-control" id="wallet_name" name="wallet_name" placeholder="e.g. USDT (TRC20)" required>
        </div>

        <div class="mb-3">
          <label for="wallet_address" class="form-label">Wallet Address</label>
          <input type="text" class="form-control" id="wallet_address" name="wallet_address" placeholder="Paste wallet address here" required>
        </div>

        <div class="text-center">
          <button type="submit" class="btn-submit" id="submitBtn">
            <span class="btn-text">Save Wallet</span>
            <span class="btn-loading d-none">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Saving...
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const form = document.getElementById('walletForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');

    form.addEventListener('submit', function(e) {
      e.preventDefault();

      btnText.classList.add('d-none');
      btnLoading.classList.remove('d-none');
      submitBtn.disabled = true;

      const formData = new FormData(form);

      fetch("{{ route('admin.wallet.save') }}", {
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
          toastr.success(data.message || 'Wallet updated successfully!');
          form.reset();
        } else {
          toastr.error(data.message || 'Failed to update wallet.');
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
