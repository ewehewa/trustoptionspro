<x-admin>
  <style>
    .card-box {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      padding: 30px;
      max-width: 700px;
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

    .btn-view {
      background-color: #10b981;
      color: white;
      border: none;
      padding: 8px 16px;
      font-weight: 600;
      border-radius: 8px;
      transition: background-color 0.3s ease;
      font-size: 14px;
      float: right;
      margin-top: -10px;
    }

    .btn-view:hover {
      background-color: #059669;
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
      <!-- Header with View All Traders button -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Add New Trader</h4>
        <button class="btn-view" onclick="window.location='{{ route('admin.traders.index') }}'">
          View All Traders
        </button>
      </div>

      <form id="traderForm" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Trader Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Trader full name" required>
        </div>

        <div class="mb-3">
          <label for="picture" class="form-label">Trader Picture</label>
          <input type="file" class="form-control" id="picture" name="picture" accept="image/*" required>
        </div>

        <div class="mb-3">
          <label for="average_return" class="form-label">Average Return (%)</label>
          <input type="number" step="0.01" class="form-control" id="average_return" name="average_return" required>
        </div>

        <div class="mb-3">
          <label for="followers" class="form-label">Followers</label>
          <input type="number" class="form-control" id="followers" name="followers" value="0">
        </div>

        <div class="mb-3">
          <label for="profit_share" class="form-label">Profit Share (%)</label>
          <input type="number" step="0.01" class="form-control" id="profit_share" name="profit_share" required>
        </div>

        <div class="mb-3">
          <label for="win_rate" class="form-label">Win Rate (%)</label>
          <input type="number" step="0.01" class="form-control" id="win_rate" name="win_rate" required>
        </div>

        <div class="mb-3">
          <label for="total_profit" class="form-label">Total Profit</label>
          <input type="number" step="0.01" class="form-control" id="total_profit" name="total_profit" required>
        </div>

        <div class="text-center">
          <button type="submit" class="btn-submit" id="submitBtn">
            <span class="btn-text">Save Trader</span>
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
  const form = document.getElementById('traderForm');
  const submitBtn = document.getElementById('submitBtn');
  const btnText = submitBtn.querySelector('.btn-text');
  const btnLoading = submitBtn.querySelector('.btn-loading');

  form.addEventListener('submit', function(e) {
    e.preventDefault();

    btnText.classList.add('d-none');
    btnLoading.classList.remove('d-none');
    submitBtn.disabled = true;

    const formData = new FormData(form);

    fetch("{{ route('admin.traders.store') }}", {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content'),
        'Accept': 'application/json'
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        toastr.success(data.message || 'Trader added successfully!');
        
        // Navigate to traders index
        window.location.href = "{{ route('admin.traders.index') }}";
      } else {
        toastr.error(data.message || 'Failed to add trader.');
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
