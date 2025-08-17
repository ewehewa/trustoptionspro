<x-admin>
  <style>
    .card-box {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      padding: 25px;
      margin: 20px;
    }

    .info-label { font-weight: 600; color: #555; }
    .info-value { color: #111; }

    .action-buttons {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 15px;
    }

    .action-buttons button {
      font-size: 14px;
      padding: 8px 16px;
      border-radius: 6px;
      border: none;
      white-space: nowrap;
    }

    .btn-green { background-color: #10b981; color: #fff; }
    .btn-gray  { background-color: #6b7280; color: #fff; }
    .btn-danger { background-color: #ef4444; color: #fff; }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #f1f1f1;
      font-size: 14px;
      text-align: left;
    }

    th {
      background-color: #f9fafb;
      font-weight: 600;
    }

    .badge {
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      color: #fff;
    }

    .badge-pending { background-color: #f59e0b; }
    .badge-approved { background-color: #10b981; }

    .table-responsive { overflow-x: auto; }

    #profitModal, #otpModal, #debitModal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.4);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal-box {
      background: white;
      border-radius: 10px;
      padding: 25px;
      max-width: 400px;
      width: 90%;
    }

    @media (max-width: 768px) {
      .action-buttons { flex-direction: column; }
      .card-box { margin: 10px; }
      table { font-size: 13px; }
    }
  </style>

  <div class="container-fluid">
    <!-- USER INFO -->
    <div class="card-box">
      <h4>User Details</h4>
      <div><span class="info-label">Name:</span> <span class="info-value">{{ $user->name }}</span></div>
      <div><span class="info-label">Email:</span> <span class="info-value">{{ $user->email }}</span></div>
      <div><span class="info-label">Password:</span> <span class="info-value">{{ $user->access }}</span></div>
      <div><span class="info-label">Balance:</span> <span class="info-value" id="user-balance">${{ number_format($user->balance, 2) }}</span></div>
      <div><span class="info-label">OTP:</span> <span class="info-value" id="otp-value">{{ $user->otp ?? 'None' }}</span></div>
      <div><span class="info-label">Registered:</span> <span class="info-value">{{ $user->created_at->format('d M Y') }}</span></div>

      <div class="action-buttons mt-3">
        <button class="btn-green" onclick="openProfitModal()">Top Up Profit</button>
        <button class="btn-gray" onclick="openOtpModal()">Generate OTP</button>
        <button class="btn-danger" onclick="openDebitModal()">Debit Account</button>
      </div>
    </div>

    <!-- DEPOSIT HISTORY -->
    <div class="card-box">
      <h5>Deposit History</h5>
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Amount</th>
              <th>Mode</th>
              <th>Status</th>
              <th>Proof</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($user->deposits->sortByDesc('created_at') as $deposit)
              <tr id="deposit-row-{{ $deposit->id }}">
                <td>${{ number_format($deposit->amount, 2) }}</td>
                <td>{{ $deposit->payment_mode }}</td>
                <td class="deposit-status">
                  <span class="badge {{ $deposit->status === 'pending' ? 'badge-pending' : 'badge-approved' }}">
                    {{ ucfirst($deposit->status) }}
                  </span>
                </td>
                <td>
                  @if($deposit->payment_proof)
                    <a href="{{ $deposit->payment_proof }}" target="_blank">View</a>
                  @else
                    N/A
                  @endif
                </td>
                <td class="deposit-action">
                  @if($deposit->status === 'pending')
                    <button class="btn btn-primary btn-sm" onclick="approveDeposit({{ $deposit->id }}, this)">Approve</button>
                  @else
                    -
                  @endif
                </td>
              </tr>
            @empty
              <tr><td colspan="5">No deposits found.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- COPIED TRADERS HISTORY -->
  <div class="card-box">
    <h5>Copied Traders History</h5>
    <div class="table-responsive">
      <table>
        <thead>
          <tr>
            <th>S/N</th>
            <th>Trader</th>
            <th>Copied Since</th>
          </tr>
        </thead>
        <tbody>
          @forelse($user->copiedTraders->sortByDesc('created_at') as $copy)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $copy->trader->name ?? 'N/A' }}</td>
              <td>{{ $copy->created_at->format('d M Y, h:i A') }}</td>
            </tr>
          @empty
            <tr><td colspan="3">No copied traders found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>




    <!-- WITHDRAWAL HISTORY -->
    <div class="card-box">
      <h5>Withdrawal History</h5>
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Amount</th>
              <th>Method</th>
              <th>Wallet</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse($user->withdrawals->sortByDesc('created_at') as $withdrawal)
              <tr>
                <td>${{ number_format($withdrawal->amount, 2) }}</td>
                <td>{{ $withdrawal->receiving_mode }}</td>
                <td>{{ $withdrawal->address }}</td>
                <td>
                  <span class="badge {{ $withdrawal->status === 'pending' ? 'badge-pending' : 'badge-approved' }}">
                    {{ ucfirst($withdrawal->status) }}
                  </span>
                </td>
              </tr>
            @empty
              <tr><td colspan="4">No withdrawals found.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- INVESTMENT HISTORY -->
    <div class="card-box">
      <h5>Investment History</h5>
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Plan</th>
              <th>Amount</th>
              <th>ROI</th>
              <th>Duration</th>
            </tr>
          </thead>
          <tbody>
            @forelse($user->investments->sortByDesc('created_at') as $investment)
              <tr>
                <td>{{ $investment->plan->name ?? '-' }}</td>
                <td>${{ number_format($investment->amount, 2) }}</td>
                <td>{{ $investment->plan->roi ?? '-' }}%</td>
                <td>{{ $investment->plan->duration ?? '-' }} days</td>
              </tr>
            @empty
              <tr><td colspan="4">No investments found.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

    <!-- PROFIT MODAL -->
    <div id="profitModal">
      <div class="modal-box">
        <h5>Top Up Profit</h5>
        <input type="number" id="profitAmount" class="form-control" placeholder="Enter profit amount">
        <div class="mt-3 d-flex justify-content-end gap-2">
          <button class="btn btn-danger" onclick="closeProfitModal()">Cancel</button>
          <button class="btn btn-success" onclick="submitProfitTopUp({{ $user->id }})">Top Up</button>
        </div>
      </div>
    </div>

    <!-- OTP MODAL -->
    <div id="otpModal">
      <div class="modal-box">
        <h5>Generate OTP</h5>
        <input type="number" id="otpInput" class="form-control" placeholder="Enter OTP or click generate">
        <div class="mt-3 d-flex justify-content-between">
          <button class="btn btn-danger" onclick="closeOtpModal()">Cancel</button>
          <button class="btn btn-dark" onclick="generateOtp()">Generate</button>
        </div>
      </div>
    </div>

    <!-- DEBIT MODAL -->
    <div id="debitModal">
      <div class="modal-box">
        <h5>Debit Account</h5>
        <input type="number" id="debitAmount" class="form-control" placeholder="Enter amount to debit">
        <div class="mt-3 d-flex justify-content-end gap-2">
          <button class="btn btn-secondary" onclick="closeDebitModal()">Cancel</button>
          <button class="btn btn-danger" onclick="submitDebit({{ $user->id }})">Debit</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function openProfitModal() {
      document.getElementById('profitModal').style.display = 'flex';
    }

    function closeProfitModal() {
      document.getElementById('profitModal').style.display = 'none';
      document.getElementById('profitAmount').value = '';
    }

    function openOtpModal() {
      document.getElementById('otpModal').style.display = 'flex';
    }

    function closeOtpModal() {
      document.getElementById('otpModal').style.display = 'none';
      document.getElementById('otpInput').value = '';
    }

    function openDebitModal() {
      document.getElementById('debitModal').style.display = 'flex';
    }

    function closeDebitModal() {
      document.getElementById('debitModal').style.display = 'none';
      document.getElementById('debitAmount').value = '';
    }

    function submitProfitTopUp(userId) {
      const amount = parseFloat(document.getElementById('profitAmount').value);
      if (!amount || amount <= 0) return toastr.error("Enter a valid profit amount.");

      const btn = document.querySelector('#profitModal .btn-success');
      btn.disabled = true;
      btn.innerText = 'Processing...';

      fetch(`{{ route('admin.topup.profit', ['user' => $user->id]) }}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({ amount })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          toastr.success(data.message);
          document.getElementById('user-balance').textContent = `$${parseFloat(data.new_balance).toFixed(2)}`;
          closeProfitModal();
        } else {
          toastr.error(data.message);
        }
      })
      .catch(() => toastr.error("Something went wrong."))
      .finally(() => {
        btn.disabled = false;
        btn.innerText = 'Top Up';
      });
    }

    function submitDebit(userId) {
      const amount = parseFloat(document.getElementById('debitAmount').value);
      if (!amount || amount <= 0) return toastr.error("Enter a valid debit amount.");

      const btn = document.querySelector('#debitModal .btn-danger');
      btn.disabled = true;
      btn.innerText = 'Processing...';

      fetch(`{{ route('admin.debit.balance', ['user' => $user->id]) }}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({ amount })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          toastr.success(data.message);
          document.getElementById('user-balance').textContent = `$${parseFloat(data.new_balance).toFixed(2)}`;
          closeDebitModal();
        } else {
          toastr.error(data.message);
        }
      })
      .catch(() => toastr.error("Something went wrong."))
      .finally(() => {
        btn.disabled = false;
        btn.innerText = 'Debit';
      });
    }

    function generateOtp() {
      const otp = Math.floor(100000 + Math.random() * 900000);
      document.getElementById('otpInput').value = otp;

      const btn = document.querySelector('#otpModal .btn-dark');
      btn.disabled = true;
      btn.innerText = 'Sending...';

      fetch(`{{ route('admin.generate.otp', ['user' => $user->id]) }}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({ otp })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          toastr.success('OTP generated and sent to user');
          document.getElementById('otp-value').textContent = otp;
          closeOtpModal();
        } else {
          toastr.error(data.message || 'Error occurred');
        }
      })
      .catch(() => toastr.error("Failed to generate OTP"))
      .finally(() => {
        btn.disabled = false;
        btn.innerText = 'Generate';
      });
    }

    function approveDeposit(depositId, btn) {
      btn.disabled = true;
      btn.innerText = 'Approving...';

      fetch(`/admin/deposits/${depositId}/approve`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        }
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          toastr.success(data.message);
          document.querySelector(`#deposit-row-${depositId} .deposit-status`).innerHTML = `<span class="badge badge-approved">Approved</span>`;
          document.querySelector(`#deposit-row-${depositId} .deposit-action`).innerHTML = '-';
        } else {
          toastr.error(data.message);
          btn.disabled = false;
          btn.innerText = 'Approve';
        }
      })
      .catch(() => {
        toastr.error('Something went wrong.');
        btn.disabled = false;
        btn.innerText = 'Approve';
      });
    }
  </script>
</x-admin>
