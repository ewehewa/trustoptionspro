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

    .form-control {
      padding: 10px 14px;
      border-radius: 8px;
      border: 1px solid #ddd;
      font-size: 14px;
      margin-bottom: 15px;
    }

    .btn-submit {
      background-color: #2563eb;
      color: white;
      border: none;
      padding: 10px 20px;
      font-weight: 600;
      border-radius: 8px;
      transition: background-color 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-top: 10px;
    }

    .btn-submit:hover {
      background-color: #1d4ed8;
    }

    .btn-submit.loading {
      background-color: #1e40af !important;
      cursor: not-allowed;
    }

    .spinner-border {
      width: 16px;
      height: 16px;
      border-width: 2px;
    }

    .hidden {
      display: none !important;
    }

    @media (max-width: 576px) {
      .card-box {
        padding: 20px;
      }
    }
  </style>

  <div class="container-fluid">
    <div class="card-box">
      <h4 class="mb-4 text-center fw-bold">Add New Investment Plan</h4>

      <form id="investmentForm">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Plan Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="roi" class="form-label">ROI (%)</label>
          <input type="number" name="roi" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="min_amount" class="form-label">Minimum Amount ($)</label>
          <input type="number" name="min_amount" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="max_amount" class="form-label">Maximum Amount ($)</label>
          <input type="number" name="max_amount" step="0.01" class="form-control" required>
        </div>

        <div class="mb-4">
          <label for="duration" class="form-label">Duration (in days)</label>
          <input type="number" name="duration" class="form-control" required>
        </div>

        <div class="text-center d-flex justify-content-center">
          <button type="submit" class="btn-submit" id="submitBtn">
            <span class="spinner-border spinner-border-sm hidden" id="submitSpinner" role="status" aria-hidden="true"></span>
            <span id="submitText">Create Plan</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const form = document.getElementById('investmentForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');

    form.addEventListener('submit', async function (e) {
      e.preventDefault();

      submitBtn.disabled = true;
      submitBtn.classList.add('loading');
      submitText.textContent = "Processing...";
      submitSpinner.classList.remove('hidden');

      const formData = new FormData(form);

      try {
        const response = await fetch("{{ route('admin.plans.add') }}", {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
          },
          body: formData
        });

        const result = await response.json();

        if (result.success) {
          toastr.success(result.message || 'Plan created successfully');
          form.reset();
        } else {
          let errorText = result.message || 'Something went wrong.';
          if (result.errors) {
            errorText = Object.values(result.errors).flat().join('<br>');
          }
          toastr.error(errorText);
        }
      } catch (error) {
        toastr.error('A server error occurred. Please try again.');
      } finally {
        submitBtn.disabled = false;
        submitBtn.classList.remove('loading');
        submitText.textContent = "Create Plan";
        submitSpinner.classList.add('hidden');
      }
    });
  </script>
</x-admin>
