<x-dashboard>
  <div class="container-fluid px-4">

    <!-- Top Header with My Trades link -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="page-title" style="color: #ffffff;">Available Expert Traders</h2>
      <a href="{{ route('user.copied.traders') }}" 
         class="btn btn-outline-success btn-sm fw-semibold px-3 py-2 rounded-pill">
        <i class="fas fa-chart-line me-2"></i> My Trades
      </a>
    </div>

    <div class="trader-list row g-4 justify-content-center">

      @forelse ($traders as $trader)
        @php
          $isCopied = $trader->copiedByUsers->contains(auth()->id());
        @endphp

        <div class="col-12 col-md-6">
          <div class="trader-card d-flex flex-column flex-md-row align-items-center p-4 rounded-3 shadow-sm" 
               style="background: #1f2937; color: #fff; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.2);">

            <!-- Trader Picture -->
            <div class="trader-img me-md-4 mb-3 mb-md-0 text-center">
              <img src="{{ $trader->picture }}" 
                   alt="{{ $trader->name }}" 
                   style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #10b981; box-shadow: 0px 0px 10px rgba(16,185,129,0.4);">
            </div>

            <!-- Trader Details -->
            <div class="flex-grow-1 text-center text-md-start">
              <!-- Name with Trophy & Verified inline -->
              <h4 class="fw-bold mb-2">
                {{ $trader->name }}
                <i class="fas fa-check-circle text-primary ms-1" style="font-size: 0.9rem;"></i>
                {{-- <i class="fas fa-trophy text-warning ms-2" style="font-size: 0.9rem;"></i> --}}
              </h4>

              <!-- Stats -->
              <div class="row g-2 small">
                <div class="col-6"><i class="fas fa-chart-line text-success me-1"></i> Avg Return: <strong>{{ $trader->average_return }}%</strong></div>
                <div class="col-6"><i class="fas fa-percent text-info me-1"></i> Profit Share: <strong>{{ $trader->profit_share }}%</strong></div>
                <div class="col-6"><i class="fas fa-bullseye text-warning me-1"></i> Win Rate: <strong>{{ $trader->win_rate }}%</strong></div>
                <div class="col-6"><i class="fas fa-users text-light me-1"></i> Followers: <strong>{{ $trader->followers }}</strong></div>
                <div class="col-12"><i class="fas fa-dollar-sign text-success me-1"></i> Total Profit: <strong>${{ number_format($trader->total_profit, 2) }}</strong></div>
              </div>

              <!-- Copy Button -->
              <form action="{{ route('copy.trader') }}" method="POST" class="copy-trader-form mt-3">
                @csrf
                <input type="hidden" name="trader_id" value="{{ $trader->id }}">
                @if ($isCopied)
                  <button type="button" 
                          class="btn btn-secondary fw-semibold px-4 py-2 rounded-pill" disabled>
                    <i class="fas fa-check me-2"></i> Copied
                  </button>
                @else
                  <button type="submit" 
                          class="btn btn-success fw-semibold px-4 py-2 rounded-pill copy-btn">
                    <i class="fas fa-copy me-2"></i> Copy Trader
                  </button>
                @endif
              </form>
            </div>

          </div>
        </div>
      @empty
        <!-- Empty State -->
        <div class="text-center mt-5">
          <i class="fas fa-user-tie fa-3x mb-3 text-secondary"></i>
          <p class="text-darkie mb-0" style="font-size: 16px;">No traders are available at the moment.</p>
        </div>
      @endforelse

    </div>
  </div>

  <style>
    .text-darkie {
      color: #6b7280;
    }
  </style>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

  <!-- ✅ Toastr CSS & JS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- JS to handle Copy button -->
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("form.copy-trader-form").forEach((form) => {
      let button = form.querySelector(".copy-btn");
      if (!button) return; // skip if already copied

      form.addEventListener("submit", function (e) {
        e.preventDefault();

        button.disabled = true;
        button.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Copying...`;

        fetch(form.action, {
          method: "POST",
          body: new FormData(form),
          headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
          }
        })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            button.innerHTML = `<i class="fas fa-check me-2"></i> Copied`;
            button.classList.remove("btn-success");
            button.classList.add("btn-secondary");
            toastr.success(data.message || "Successfully copied trader.");
          } else {
            button.disabled = false;
            button.innerHTML = `<i class="fas fa-copy me-2"></i> Copy Trader`;
            toastr.error(data.message || "Something went wrong.");
          }
        })
        .catch((err) => {
          console.error(err);
          button.disabled = false;
          button.innerHTML = `<i class="fas fa-copy me-2"></i> Copy Trader`;
          toastr.error("An unexpected error occurred.");
        });
      });
    });
  });
  </script>
</x-dashboard>
