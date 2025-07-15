<x-dashboard>
  <div class="container-fluid px-4">
    <div id="investmentPlans">
      <h3 style="color: #ffffff; margin: 40px 0 20px;">Investment Plans</h3>

      <div class="investment-plans" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">

        @forelse($plans as $plan)
          <div class="plan-card" style="background-color: #1f2937; padding: 25px; border-radius: 12px; width: 340px; text-align: center; color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.2);">
            <div class="plan-name" style="font-size: 20px; font-weight: bold; margin-bottom: 10px;">{{ $plan->name }}</div>
            <div class="plan-return" style="font-size: 18px;">{{ $plan->roi }}%</div>
            <p style="color: #9ca3af; margin-bottom: 20px; font-size: 14px;">Daily Returns</p>
            <ul class="plan-features" style="list-style: none; padding: 0; font-size: 15px;">
              <li>Minimum: ${{ number_format($plan->min_amount) }}</li>
              <li>Maximum: ${{ number_format($plan->max_amount) }}</li>
              <li>Duration: {{ $plan->duration }} days</li>
            </ul>

            <form class="invest-form mt-3" data-plan-id="{{ $plan->id }}">
              @csrf
              <input type="number" class="form-control mb-3" name="amount" placeholder="Enter amount to invest" min="{{ $plan->min_amount }}" max="{{ $plan->max_amount }}" required />
              <button type="submit" class="btn btn-primary w-100 invest-btn">
                <span class="btn-text">Invest Now</span>
                <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
              </button>
            </form>
          </div>
        @empty
          <div class="text-center mt-5">
            <i class="fas fa-folder-open fa-3x mb-3 text-secondary"></i>
            <p class="text-darkie mb-0" style="font-size: 16px;">No investment plans available at the moment.</p>
          </div>
        @endforelse

      </div>
    </div>
  </div>

  <style>
    .text-darkie {
      color: #6b7280;
    }
    .form-control {
      background-color: #111827;
      color: #fff;
      border: 1px solid #374151;
      border-radius: 6px;
      padding: 10px;
      width: 100%;
      text-align: center;
      font-size: 15px;
    }

    .form-control::placeholder {
      color: #6b7280;
      text-align: center;
    }

    .btn-primary {
      background-color: #4f46e5;
      border: none;
      color: #fff;
      font-weight: 600;
      padding: 10px;
      border-radius: 6px;
      font-size: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-primary:hover {
      background-color: #4338ca;
    }

    .spinner-border {
      width: 1rem;
      height: 1rem;
      border-width: 2px;
    }

    .hidden {
      display: none !important;
    }

    @media (max-width: 768px) {
      .plan-card {
        width: 100% !important;
      }
    }
  </style>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

  <script>
    document.querySelectorAll('.invest-form').forEach(form => {
      form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const planId = this.dataset.planId;
        const amount = this.querySelector('input[name="amount"]').value;
        const button = this.querySelector('.invest-btn');
        const spinner = this.querySelector('.spinner-border');
        const btnText = this.querySelector('.btn-text');

        if (!amount || isNaN(amount) || amount <= 0) {
          toastr.error('Please enter a valid amount.');
          return;
        }

        // Start Loading
        button.disabled = true;
        btnText.textContent = "Processing...";
        spinner.classList.remove('hidden');

        try {
          const response = await fetch("{{ route('user.invest') }}", {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
              'Accept': 'application/json',
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({ plan_id: planId, amount: amount })
          });

          const result = await response.json();

          if (result.success) {
            toastr.success(result.message || 'Investment successful!');
            this.reset();
          } else {
            let errorMsg = result.message || 'Something went wrong.';
            if (result.errors) {
              errorMsg = Object.values(result.errors).flat().join('<br>');
            }
            toastr.error(errorMsg);
          }
        } catch (error) {
          toastr.error('Server error occurred. Please try again.');
        } finally {
          // Reset Button
          button.disabled = false;
          btnText.textContent = "Invest Now";
          spinner.classList.add('hidden');
        }
      });
    });
  </script>
</x-dashboard>
