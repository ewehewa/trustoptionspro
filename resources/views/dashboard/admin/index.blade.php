<x-admin>
    <div class="container-fluid py-4">
        <h1 class="dashboard-title text-center text-md-start mb-4">Admin Dashboard</h1>

        <div class="row g-3">
            <!-- Total Users -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="stats-card primary text-center text-md-start">
                    <div class="icon mb-2">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <div class="stats-value">{{ $totalUsers }}</div>
                    <div class="stats-label">Total Users</div>
                </div>
            </div>

            <!-- Total Deposits -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="stats-card success text-center text-md-start">
                    <div class="icon mb-2">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                    <div class="stats-value">${{ number_format($totalDeposits, 2) }}</div>
                    <div class="stats-label">Total Deposits</div>
                </div>
            </div>

            <!-- Total Withdrawals -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="stats-card danger text-center text-md-start">
                    <div class="icon mb-2">
                        <i class="fas fa-arrow-up fa-2x"></i>
                    </div>
                    <div class="stats-value">${{ number_format($totalWithdrawals, 2) }}</div>
                    <div class="stats-label">Total Withdrawals</div>
                </div>
            </div>

            <!-- Pending Deposits -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="stats-card info text-center text-md-start">
                    <div class="icon mb-2">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <div class="stats-value">{{ $pendingDeposits }}</div>
                    <div class="stats-label">Pending Deposits</div>
                </div>
            </div>

            <!-- Pending Withdrawals -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="stats-card info text-center text-md-start">
                    <div class="icon mb-2">
                        <i class="fas fa-hourglass-half fa-2x"></i>
                    </div>
                    <div class="stats-value">{{ $pendingWithdrawals }}</div>
                    <div class="stats-label">Pending Withdrawals</div>
                </div>
            </div>

            <!-- Active Plans -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="stats-card success text-center text-md-start">
                    <div class="icon mb-2">
                        <i class="fas fa-coins fa-2x"></i>
                    </div>
                    <div class="stats-value">{{ $activePlansCount }}</div> {{-- Replace with real data --}}
                    <div class="stats-label">Active Plans</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Optional Inline CSS --}}
    <style>
        .stats-card {
            padding: 1.5rem;
            border-radius: 12px;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease-in-out;
        }

        .stats-card .icon {
            color: #6c757d;
        }

        .stats-card.primary {
            border-left: 4px solid #007bff;
        }

        .stats-card.success {
            border-left: 4px solid #28a745;
        }

        .stats-card.danger {
            border-left: 4px solid #dc3545;
        }

        .stats-card.info {
            border-left: 4px solid #17a2b8;
        }

        .stats-card .stats-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stats-card .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        @media (max-width: 576px) {
            .stats-card .stats-value {
                font-size: 1.25rem;
            }

            .stats-card .icon {
                font-size: 1.5rem;
            }
        }
    </style>
</x-admin>
