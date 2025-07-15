<x-dashboard>
  <div class="container-fluid px-4">

    <h2 class="page-title">My Active Investments</h2>

    @if ($investments->isEmpty())
      <!-- Empty State Card -->
      <div class="content-card">
        <div class="empty-state" style="padding: 60px 20px; text-align: center;">
          <i class="fas fa-chart-pie" style="font-size: 48px; color: #6b7280; margin-bottom: 20px;"></i>
          <p style="font-size: 16px; margin-bottom: 30px;">
            You do not have an investment plan at the moment or no value matches your query.
          </p>
          <a href="{{ route('show.plans') }}">
            <button class="btn-white">Buy a plan</button>
          </a>
        </div>
      </div>
    @else
      <!-- Active Investment Plans -->
      <div id="investmentPlans">
        <div class="investment-plans" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">

          @foreach ($investments as $investment)
            <div class="plan-card" style="background-color: #1f2937; padding: 25px; border-radius: 12px; width: 320px; text-align: center; color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.2);">
              <div class="plan-name" style="font-size: 20px; font-weight: bold; margin-bottom: 10px;">
                {{ $investment->plan->name }}
              </div>
              <div class="plan-return" style="font-size: 18px;">
                {{ $investment->plan->roi }}% ROI
              </div>
              <p style="color: #9ca3af; margin-bottom: 20px; font-size: 14px;">Daily Returns</p>
              <ul class="plan-features" style="list-style: none; padding: 0; font-size: 15px;">
                <li>Invested: ${{ number_format($investment->amount) }}</li>
                <li>Duration: {{ $investment->plan->duration }} days</li>
              </ul>
              <div style="margin-top: 15px; font-size: 13px; color: #9ca3af;">
                Started: {{ $investment->created_at->format('M d, Y') }}
              </div>
            </div>
          @endforeach

        </div>
      </div>
    @endif

  </div>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</x-dashboard>
