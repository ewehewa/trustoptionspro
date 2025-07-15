<x-dashboard>
    <div class="container-fluid px-4">
        <h1 class="page-title">Withdraw Funds</h1>

        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="content-card">
                    <div style="background: #1a1d29; border: 1px solid #374151; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
                        <div style="color: #9ca3af; font-size: 12px; margin-bottom: 8px;">AVAILABLE BALANCE</div>
                        <div style="color: #ffffff; font-size: 24px; font-weight: 700;">
                            ${{ number_format($user->balance ?? 0, 2) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Withdrawal Amount (USD)</label>
                        <input type="number" class="form-input" id="withdrawAmount" placeholder="Enter amount to withdraw" min="50" step="0.01">
                        <small style="color: #9ca3af; font-size: 12px;">Minimum withdrawal: $50</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Select Withdrawal Method</label>
                        <div class="payment-methods" id="paymentMethodsContainer">
                            <div class="payment-method" data-method="usdt-erc20">
                                <div class="payment-icon">
                                    <img src="https://assets.coingecko.com/coins/images/325/large/Tether-logo.png" alt="USDT">
                                </div>
                                <div><div style="color: #ffffff; font-weight: 600;">USDT (ERC20)</div></div>
                            </div>
                            <div class="payment-method" data-method="usdt-trc20">
                                <div class="payment-icon">
                                    <img src="https://assets.coingecko.com/coins/images/325/large/Tether-logo.png" alt="USDT">
                                </div>
                                <div><div style="color: #ffffff; font-weight: 600;">USDT (TRC20)</div></div>
                            </div>
                            <div class="payment-method" data-method="btc">
                                <div class="payment-icon">
                                    <img src="https://assets.coingecko.com/coins/images/1/large/bitcoin.png" alt="BTC">
                                </div>
                                <div><div style="color: #ffffff; font-weight: 600;">Bitcoin (BTC)</div></div>
                            </div>
                            <div class="payment-method" data-method="bank">
                                <div class="payment-icon"><i class="fas fa-university"></i></div>
                                <div><div style="color: #ffffff; font-weight: 600;">Bank Transfer</div></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="walletAddressGroup">
                        <label class="form-label">Wallet Address</label>
                        <input type="text" class="form-input" id="walletAddress" placeholder="Enter your wallet address">
                    </div>

                    <div class="form-group" id="bankDetailsGroup" style="display: none;">
                        <label class="form-label">Bank Account Details</label>
                        <input type="text" class="form-input" id="bankName" placeholder="Bank Name" style="margin-bottom: 10px;">
                        <input type="text" class="form-input" id="accountNumber" placeholder="Account Number">
                    </div>

                    <button type="button" class="btn-primary" style="width: 100%; margin-top: 20px;" onclick="openOtpModal()">
                        Submit Withdrawal Request
                    </button>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="deposit-summary">
                    <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #374151;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="color: #9ca3af; font-size: 14px;">Processing Fee:</span>
                            <span style="color: #ffffff; font-size: 14px;" id="processingFee">$0.00</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 16px;">
                            <span style="color: #9ca3af; font-size: 14px;">You'll Receive:</span>
                            <span style="color: #10b981; font-size: 16px; font-weight: 600;" id="netAmount">$0.00</span>
                        </div>
                    </div>
                    <div style="text-align: center; margin-top: 20px;">
                        <a href="{{ route('transactions', ['tab' => 'withdrawal']) }}" class="link-text">
                            View withdrawal history
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- OTP MODAL -->
    <div id="otpModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:1000;">
        <div class="bg-white p-4 rounded shadow" style="width: 90%; max-width: 400px;">
            <h5 class="text-center mb-3">Enter OTP to Confirm</h5>
            <input type="number" id="otpInput" class="form-input mb-3" placeholder="Enter OTP" style="width: 100%;">
            <div class="d-flex justify-content-end gap-2">
                <button onclick="closeOtpModal()" class="btn btn-secondary">Cancel</button>
                <button onclick="submitWithdrawal()" class="btn btn-primary" id="confirmOtpBtn">
                    Confirm
                </button>
            </div>
        </div>
    </div>

    <script>
        const withdrawAmountInput = document.getElementById('withdrawAmount');
        const paymentMethodsContainer = document.getElementById('paymentMethodsContainer');
        const processingFeeSpan = document.getElementById('processingFee');
        const netAmountSpan = document.getElementById('netAmount');
        const walletAddressGroup = document.getElementById('walletAddressGroup');
        const bankDetailsGroup = document.getElementById('bankDetailsGroup');
        const minimumWithdrawal = parseFloat(withdrawAmountInput.min);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function updateNetAmount() {
            const withdrawalAmount = parseFloat(withdrawAmountInput.value);
            processingFeeSpan.textContent = '$0.00';
            if (withdrawalAmount >= minimumWithdrawal) {
                netAmountSpan.textContent = `$${withdrawalAmount.toFixed(2)}`;
            } else {
                netAmountSpan.textContent = '$0.00';
            }
        }

        withdrawAmountInput.addEventListener('input', updateNetAmount);
        updateNetAmount();

        let selectedMethod = null;
        paymentMethodsContainer.addEventListener('click', function (e) {
            let target = e.target.closest('.payment-method');
            if (!target) return;
            if (selectedMethod) selectedMethod.classList.remove('active');
            selectedMethod = target;
            selectedMethod.classList.add('active');
            const method = target.dataset.method;
            if (method === 'bank') {
                walletAddressGroup.style.display = 'none';
                bankDetailsGroup.style.display = 'block';
            } else {
                walletAddressGroup.style.display = 'block';
                bankDetailsGroup.style.display = 'none';
            }
        });

        function openOtpModal() {
            const amount = parseFloat(withdrawAmountInput.value);
            if (!amount || amount < 50) return toastr.error("Minimum withdrawal is $50");
            if (!selectedMethod) return toastr.error("Select a withdrawal method");
            const method = selectedMethod.dataset.method;
            const wallet = document.getElementById('walletAddress').value;
            const acct = document.getElementById('accountNumber').value;
            if (method === 'bank' && !acct) return toastr.error("Enter account number");
            if (method !== 'bank' && !wallet) return toastr.error("Enter wallet address");
            document.getElementById('otpModal').style.display = 'flex';
        }

        function closeOtpModal() {
            document.getElementById('otpModal').style.display = 'none';
            document.getElementById('otpInput').value = '';
        }

        function submitWithdrawal() {
            const amount = parseFloat(document.getElementById('withdrawAmount').value);
            const method = selectedMethod.dataset.method;
            const address = method === 'bank' 
                ? document.getElementById('accountNumber').value 
                : document.getElementById('walletAddress').value;
            const otp = document.getElementById('otpInput').value;

            if (!otp) return toastr.error("Please enter OTP");

            const btn = document.getElementById('confirmOtpBtn');
            btn.disabled = true;
            btn.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Processing...`;

            fetch("{{ route('withdraw.submit') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ amount, method, address, otp })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    toastr.success(data.message);
                    closeOtpModal();
                    setTimeout(() => location.reload(), 1000);
                } else {
                    toastr.error(data.message || "Withdrawal failed");
                }
            })
            .catch(() => {
                toastr.error("Something went wrong, try again later");
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = "Confirm";
            });
        }
    </script>
</x-dashboard>
