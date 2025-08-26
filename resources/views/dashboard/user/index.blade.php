<x-dashboard>
  <div class="container-fluid px-4">

    <!-- Welcome Section - Mobile Only -->
    <div class="row d-md-none mb-4">
      <div class="col-12">
        <h1 class="welcome-title">Welcome, {{ $user->username }}!</h1>
      </div>
    </div>

    <!-- Main Dashboard Row -->
    <div class="row">
      <!-- Left Side - Portfolio & Charts -->
      <div class="col-lg-6 col-12 mb-4">
        <!-- Portfolio -->
        <div class="portfolio-section mb-4">
          <div class="portfolio-label">MY BALANCE</div>
          <div class="portfolio-value">${{ number_format($user->balance, 2) }}</div>

          <!-- Live Stock Ticker -->
          <div class="tradingview-widget-container mb-3">
            <div class="tradingview-widget-container__widget"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
              {
                "symbols": [
                  { "proName": "NASDAQ:AAPL", "title": "Apple" },
                  { "proName": "NASDAQ:GOOGL", "title": "Google" },
                  { "proName": "NASDAQ:MSFT", "title": "Microsoft" },
                  { "proName": "NASDAQ:AMZN", "title": "Amazon" },
                  { "proName": "NASDAQ:TSLA", "title": "Tesla" },
                  { "proName": "NYSE:BRK.B", "title": "Berkshire" },
                  { "proName": "NASDAQ:NVDA", "title": "NVIDIA" }
                ],
                "showSymbolLogo": true,
                "colorTheme": "dark",
                "isTransparent": true,
                "displayMode": "regular",
                "locale": "en"
              }
            </script>
          </div>

          <!-- Live Crypto Chart -->
          <div class="tradingview-widget-container">
            <div class="tradingview-widget-container__widget"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
              {
                "symbol": "BINANCE:BTCUSDT",
                "width": "100%",
                "height": "364",
                "locale": "en",
                "dateRange": "12M",
                "colorTheme": "dark",
                "isTransparent": true,
                "autosize": true
              }
            </script>
          </div>
        </div>
      </div>

      <!-- Right Side - Stats & Auto Trading -->
      <div class="col-lg-6 col-12">
        <div class="row mb-4">
          <div class="col-6 mb-3">
            <div class="stat-card">
              <div class="stat-content">
                <div class="stat-label">TOTAL DEPOSIT</div>
                <div class="stat-value">${{ number_format($user->deposits->sum('amount'), 2) }}</div>
              </div>
              <div class="stat-icon bg-cyan">
                <i class="fas fa-dollar-sign"></i>
              </div>
            </div>
          </div>
          <div class="col-6 mb-3">
            <div class="stat-card">
              <div class="stat-content">
                <div class="stat-label">TOTAL PROFIT</div>
                <div class="stat-value">${{ number_format($user->profits->sum('amount'), 2) }}</div>
              </div>
              <div class="stat-icon bg-green">
                <i class="fas fa-chart-line"></i>
              </div>
            </div>
          </div>
          <div class="col-6 mb-3">
            <div class="stat-card">
              <div class="stat-content">
                <div class="stat-label">BONUS</div>
                <div class="stat-value">${{ number_format($totalBonus, 2) }}</div>
              </div>
              <div class="stat-icon bg-orange">
                <i class="fas fa-gift"></i>
              </div>
            </div>
          </div>
          <div class="col-6 mb-3">
            <div class="stat-card">
              <div class="stat-content">
                <div class="stat-label">WITHDRAWALS</div>
                <div class="stat-value">${{ number_format($user->withdrawals->sum('amount'), 2) }}</div>
              </div>
              <div class="stat-icon bg-red">
                <i class="fas fa-arrow-down"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Auto Trading Section -->
        <div class="auto-trading-section mobile-margin-bottom">
          <h3 class="auto-trading-title">Auto Trading</h3>
          <p class="auto-trading-description">
            Earn profits by securely investing in stocks, crypto, REITs, ETFs and Bonds with our world-class auto-trading software.
          </p>
          <div class="auto-trading-content">
            {{-- <p class="no-plan-text">You do not have an active plan at the moment.</p> --}}
            <a href="{{ route('show.investment') }}" class="text-decoration-none">
                <button class="btn btn-invest">Invest in a plan</button>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Transactions -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="transactions-section">
          <h3 class="section-title">Recent Transactions</h3>

          <!-- Tabs -->
          <div class="transaction-tabs mb-4">
            <button class="tab-btn active" data-tab="deposit">Deposit</button>
            <button class="tab-btn" data-tab="withdrawal">Withdrawal</button>
          </div>

          <!-- Transaction Table -->
          <div class="transaction-table">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Amount</th>
                  <th>Mode</th>
                  <th>Status</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody id="depositTable">
                @foreach($user->deposits->take(5) as $deposit)
                  <tr>
                    <td>${{ number_format($deposit->amount, 2) }}</td>
                    <td>{{ strtoupper($deposit->payment_mode) }}</td>
                    <td>
                      <span class="status-badge {{ strtolower($deposit->status ?? 'pending') }}">
                        {{ ucfirst($deposit->status ?? 'pending') }}
                      </span>
                    </td>
                    <td>{{ $deposit->created_at->format('Y-m-d H:i') }}</td>
                  </tr>
                @endforeach
              </tbody>
              <tbody id="withdrawalTable" style="display: none;">
                @foreach($user->withdrawals->take(5) as $withdrawal)
                  <tr>
                    <td>${{ number_format($withdrawal->amount, 2) }}</td>
                    <td>{{ strtoupper($withdrawal->receiving_mode) }}</td>
                    <td>
                      <span class="status-badge {{ strtolower($withdrawal->status ?? 'pending') }}">
                        {{ ucfirst($withdrawal->status ?? 'pending') }}
                      </span>
                    </td>
                    <td>{{ $withdrawal->created_at->format('Y-m-d H:i') }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="view-all-link">
            <a href="{{ route('transactions') }}" class="link-text">View all transactions</a>
          </div>
        </div>
      </div>
    </div>

  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const tabButtons = document.querySelectorAll('.tab-btn');
      const depositTable = document.getElementById('depositTable');
      const withdrawalTable = document.getElementById('withdrawalTable');

      tabButtons.forEach(button => {
        button.addEventListener('click', function () {
          tabButtons.forEach(btn => btn.classList.remove('active'));
          this.classList.add('active');

          if (this.dataset.tab === 'deposit') {
            depositTable.style.display = '';
            withdrawalTable.style.display = 'none';
          } else {
            depositTable.style.display = 'none';
            withdrawalTable.style.display = '';
          }
        });
      });
    });
  </script>

  <style>
    .status-badge {
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
    }

    .status-badge.pending {
      background-color: rgba(245, 158, 11, 0.2);
      color: #f59e0b;
    }

    .status-badge.completed {
      background-color: rgba(16, 185, 129, 0.2);
      color: #10b981;
    }

    .status-badge.failed {
      background-color: rgba(239, 68, 68, 0.2);
      color: #ef4444;
    }

    @media (max-width: 767.98px) {
      .mobile-margin-bottom {
        margin-bottom: 2rem;
      }
    }
  </style>
</x-dashboard>
