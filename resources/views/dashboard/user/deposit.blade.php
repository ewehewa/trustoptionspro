<x-dashboard>
    <div class="container-fluid px-4">
        <h2 class="page-title">Fund your Account</h2>

        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="content-card">
                    <form id="depositForm">
                        <div class="form-group">
                            <label class="form-label">Enter Amount(USD)</label>
                            <input type="number" class="form-input" id="depositAmount" placeholder="Enter Amount in USD" min="1" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Choose payment method from the list below</label>
                            <div class="payment-methods" id="paymentMethodsContainer">
                                <div class="payment-method" data-method="usdt-erc20">
                                    <div class="payment-icon">
                                        <img src="https://assets.coingecko.com/coins/images/325/large/Tether-logo.png" alt="USDT">
                                    </div>
                                    <div>
                                        <div style="color: #ffffff; font-weight: 600;">USDT (ERC20)</div>
                                        <div style="color: #9ca3af; font-size: 12px;">Ethereum Network</div>
                                    </div>
                                </div>
                                <div class="payment-method" data-method="usdt-trc20">
                                    <div class="payment-icon">
                                        <img src="https://assets.coingecko.com/coins/images/325/large/Tether-logo.png" alt="USDT">
                                    </div>
                                    <div>
                                        <div style="color: #ffffff; font-weight: 600;">USDT (TRC20)</div>
                                        <div style="color: #9ca3af; font-size: 12px;">Tron Network</div>
                                    </div>
                                </div>
                                <div class="payment-method" data-method="btc">
                                    <div class="payment-icon">
                                        <img src="https://assets.coingecko.com/coins/images/1/large/bitcoin.png" alt="BTC">
                                    </div>
                                    <div>
                                        <div style="color: #ffffff; font-weight: 600;">Bitcoin (BTC)</div>
                                        <div style="color: #9ca3af; font-size: 12px;">Bitcoin Network</div>
                                    </div>
                                </div>
                                <div class="payment-method" data-method="eth">
                                    <div class="payment-icon">
                                        <img src="https://assets.coingecko.com/coins/images/279/large/ethereum.png" alt="ETH">
                                    </div>
                                    <div>
                                        <div style="color: #ffffff; font-weight: 600;">Ethereum (ETH)</div>
                                        <div style="color: #9ca3af; font-size: 12px;">Ethereum Network</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="selectedPaymentMethodInput" name="payment_method">
                        </div>

                        <button type="submit" class="btn-primary" id="submitBtn" style="width: 100%; margin-top: 20px;">
                            <span class="btn-text">Proceed to Payment</span>
                            <span class="btn-loader" style="display: none;">Processing...</span>
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="deposit-summary">
                    <div class="deposit-total">
                        <div class="deposit-total-label">TOTAL DEPOSIT</div>
                        <div class="deposit-total-value fs-5" id="totalDeposit">{{ number_format($totalDeposit, 2) }}</div>
                    </div>

                    <div style="text-align: center; margin-top: 20px;">
                        <a href="{{ route('transactions', ['tab' => 'deposit']) }}" class="link-text">View deposit history
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const depositForm = document.getElementById('depositForm');
        const depositAmountInput = document.getElementById('depositAmount');
        const paymentMethodsContainer = document.getElementById('paymentMethodsContainer');
        const selectedPaymentMethodInput = document.getElementById('selectedPaymentMethodInput');
        const submitBtn = document.getElementById('submitBtn');
        let selectedPaymentMethodElement = null;

        paymentMethodsContainer.addEventListener('click', function(event) {
            let target = event.target;

            while (target && !target.classList.contains('payment-method')) {
                target = target.parentElement;
            }

            if (target && target.classList.contains('payment-method')) {
                if (selectedPaymentMethodElement) {
                    selectedPaymentMethodElement.classList.remove('active');
                }

                target.classList.add('active');
                selectedPaymentMethodElement = target;

                selectedPaymentMethodInput.value = target.dataset.method;
                console.log('Selected payment method:', selectedPaymentMethodInput.value);
            }
        });

        depositForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const amount = depositAmountInput.value;
            const method = selectedPaymentMethodInput.value;

            if (!amount || parseFloat(amount) < 50) {
                toastr.error("You should deposit at least $50");
                return;
            }

            if (!method) {
                toastr.error("Please select a payment method");
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.querySelector('.btn-text').style.display = 'none';
            submitBtn.querySelector('.btn-loader').style.display = 'inline';

            localStorage.setItem('paymentAmount', amount);
            localStorage.setItem('paymentMethod', method);

            setTimeout(() => {
                window.location.href = "{{ route('show.cdeposit') }}";
            }, 1000); // Delay for smoother UX
        });

        const defaultMethod = document.querySelector('.payment-method[data-method="usdt-erc20"]');
        if (defaultMethod) {
            defaultMethod.classList.add('active');
            selectedPaymentMethodElement = defaultMethod;
            selectedPaymentMethodInput.value = defaultMethod.dataset.method;
        }
    });
    </script>
</x-dashboard>
