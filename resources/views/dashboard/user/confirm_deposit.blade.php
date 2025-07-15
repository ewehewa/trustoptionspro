<x-dashboard>
    <div class="container-fluid px-4">
        <h2 class="page-title">Make Payment</h2>

        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="content-card">
                    <form id="depositForm">
                        <small id="paymentInstruction" style="display: block; margin-bottom: 15px;">
                            You are to make a payment of $0 using your selected payment method.
                        </small>

                        {{-- Wallets Display --}}
                        @if ($wallets->isEmpty())
                            <div class="wallet-box text-center text-light bg-danger bg-opacity-25 p-4 rounded">
                                <p class="mb-0">There is no wallet details yet. Please contact admin.</p>
                            </div>
                        @else
                            @foreach ($wallets as $wallet)
                                <div class="wallet-box mb-4">
                                    <label class="wallet-label">{{ strtoupper($wallet->wallet_name) }} Address:</label>
                                    <div class="wallet-address-group">
                                        <div class="wallet-address" id="walletAddress{{ $wallet->id }}">
                                            {{ $wallet->wallet_address }}
                                        </div>
                                        <button type="button" class="copy-btn" onclick="copyWalletAddress('{{ $wallet->id }}')">Copy</button>
                                    </div>
                                    <div style="margin-top: 8px; font-size: 12px; color: #9ca3af;">
                                        Network Type: {{ strtoupper($wallet->wallet_name) }}
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="proof-upload-box mt-3">
                            <label class="wallet-label">Upload Payment Proof (Image or PDF)</label>
                            <label class="custom-upload">
                                Click to upload file
                                <input type="file" id="proofInput" accept=".jpg,.jpeg,.png,.webp,.pdf" onchange="previewProofImage(event)">
                            </label>
                            <img id="proofPreview" alt="Proof Preview">
                        </div>

                        <button type="submit" class="btn-primary submit-btn" style="width: 100%; margin-top: 25px;">
                            Submit Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .wallet-box {
            background-color: rgba(25, 40, 80, 0.6);
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
        }

        .wallet-label {
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
        }

        .wallet-address-group {
            display: flex;
            align-items: center;
            background-color: #1f2937;
            padding: 10px;
            border-radius: 6px;
            overflow: hidden;
        }

        .wallet-address {
            flex-grow: 1;
            color: #cbd5e1;
            font-family: monospace;
            font-size: 14px;
            word-break: break-word;
        }

        .copy-btn {
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            margin-left: 10px;
            cursor: pointer;
            font-size: 13px;
        }

        .proof-upload-box {
            background-color: rgba(25, 40, 80, 0.6);
            padding: 20px;
            border-radius: 8px;
        }

        .custom-upload {
            background-color: #1f2937;
            padding: 15px;
            border: 2px dashed #475569;
            text-align: center;
            color: #94a3b8;
            border-radius: 8px;
            cursor: pointer;
        }

        .custom-upload:hover {
            border-color: #3b82f6;
        }

        .custom-upload input {
            display: none;
        }

        #proofPreview {
            display: none;
            margin-top: 10px;
            max-height: 150px;
            border-radius: 6px;
        }

        .submit-btn:disabled {
            background-color: #94a3b8 !important;
            cursor: not-allowed;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const amount = localStorage.getItem('paymentAmount');
            const method = localStorage.getItem('paymentMethod');

            if (amount && method) {
                const displayMethod = method.toUpperCase().replace(/-/g, ' ');
                const instruction = `You are to make a payment of $${amount} using ${displayMethod}`;
                document.getElementById('paymentInstruction').textContent = instruction;
            }
        });

        function copyWalletAddress(id) {
            const walletText = document.getElementById(`walletAddress${id}`).innerText;
            navigator.clipboard.writeText(walletText)
                .then(() => toastr.success("Wallet address copied to clipboard"))
                .catch(() => toastr.error("Failed to copy address"));
        }

        function previewProofImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('proofPreview');

            if (file) {
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'application/pdf'];

                if (!allowedTypes.includes(file.type)) {
                    toastr.error("File must be JPG, PNG, WEBP, or PDF");
                    preview.style.display = 'none';
                    event.target.value = '';
                    return;
                }

                if (file.type === 'application/pdf') {
                    preview.style.display = 'none';
                    toastr.info("PDF uploaded. No preview available.");
                } else {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            } else {
                preview.style.display = 'none';
                preview.src = '';
            }
        }

        document.getElementById('depositForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const form = e.target;
            const submitBtn = form.querySelector('.submit-btn');
            const fileInput = document.getElementById('proofInput');
            const file = fileInput.files[0];
            const amount = localStorage.getItem('paymentAmount');
            const paymentMode = localStorage.getItem('paymentMethod');

            if (!file || !amount || !paymentMode) {
                toastr.error("All fields including payment proof must be provided.");
                return;
            }

            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'application/pdf'];

            if (!allowedTypes.includes(file.type)) {
                toastr.error("Invalid file type. Use JPG, PNG, WEBP, or PDF");
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                toastr.error("File size must not exceed 2MB.");
                return;
            }

            const formData = new FormData();
            formData.append('amount', amount);
            formData.append('payment_mode', paymentMode);
            formData.append('payment_proof', file);

            submitBtn.disabled = true;
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Processing...';

            try {
                const res = await fetch("{{ route('deposit') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const contentType = res.headers.get("content-type");

                if (!res.ok) {
                    if (contentType && contentType.includes("application/json")) {
                        const errorData = await res.json();
                        if (res.status === 422 && errorData.errors) {
                            Object.values(errorData.errors).forEach(errs => {
                                errs.forEach(err => toastr.error(err));
                            });
                        } else if (res.status === 401) {
                            toastr.error(errorData.message || "Unauthorized. Please log in again.");
                        } else {
                            toastr.error(errorData.message || `Server error: ${res.status}`);
                        }
                    } else {
                        toastr.error("Oops something went wrong!");
                    }
                    return;
                }

                const data = await res.json();
                toastr.success(data.message || "Deposit submitted successfully.");
                form.reset();
                localStorage.removeItem('paymentAmount');
                localStorage.removeItem('paymentMethod');
                setTimeout(() => {
                    window.location.href = "{{ route('deposit') }}";
                }, 1000);
            } catch (err) {
                console.error("Fetch or JSON parse error:", err);
                toastr.error("Network error or server did not respond. Try again.");
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });
    </script>
</x-dashboard>
