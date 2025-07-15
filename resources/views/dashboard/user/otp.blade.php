<x-dashboard>
  <div class="container-fluid px-4">
            <h1 class="page-title">Withdraw Funds</h1>

            <div class="row">
                <div class="col-lg-8 col-12">
                    <!-- Withdrawal Form -->
                    <div class="content-card">
                        <form id="withdrawForm">
                            <!-- Available Balance -->
                            <div style="background: #1a1d29; border: 1px solid #374151; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
                                <div style="color: #9ca3af; font-size: 12px; margin-bottom: 8px;">AVAILABLE BALANCE</div>
                                <div style="color: #ffffff; font-size: 24px; font-weight: 700;">$0.00</div>
                            </div>

                            <!-- Withdrawal Amount -->
                            <div class="form-group">
                                <label class="form-label">Withdrawal Amount (USD)</label>
                                <input type="number" class="form-input" id="withdrawAmount" placeholder="Enter amount to withdraw" min="50" step="0.01">
                                <small style="color: #9ca3af; font-size: 12px;">Minimum withdrawal: $50</small>
                            </div>

                            <!-- Wallet Address / Bank Details -->
                            <div class="form-group" id="walletAddressGroup">
                                <label class="form-label">Wallet Address</label>
                                <input type="text" class="form-input" id="walletAddress" placeholder="Enter your wallet address">
                            </div>

                            <div class="form-group" id="bankDetailsGroup" style="display: none;">
                                <label class="form-label">Bank Account Details</label>
                                <input type="text" class="form-input" id="bankName" placeholder="Bank Name" style="margin-bottom: 10px;">
                                <input type="text" class="form-input" id="accountNumber" placeholder="Account Number" style="margin-bottom: 10px;">
                                <input type="text" class="form-input" id="routingNumber" placeholder="Routing Number">
                            </div>

                            <!-- Two-Factor Authentication -->
                            <div class="form-group">
                                <label class="form-label">OTP Code</label>
                                <input type="text" class="form-input" id="twoFactorCode" placeholder="Enter 6-digit code">
                                <small style="color: #9ca3af; font-size: 12px;">Enter the code from your authenticator app</small>
                            </div>

                            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 20px;">
                                Submit Withdrawal Request
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <!-- Withdrawal Summary -->
                    <div class="deposit-summary">
                        <div class="deposit-total">
                            <div class="deposit-total-label">WITHDRAWAL AMOUNT</div>
                            <div class="deposit-total-value" id="totalWithdraw">$0.00</div>
                        </div>
                        
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
                            <a href="{{ route('transactions') }}" class="link-text">View withdrawal history</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-dashboard>