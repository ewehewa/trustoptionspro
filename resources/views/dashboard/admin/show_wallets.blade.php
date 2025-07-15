<x-admin>
  <style>
    .wallets-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }

    .wallet-card {
      background: #ffffff;
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
      transition: transform 0.2s;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .wallet-card:hover {
      transform: translateY(-3px);
    }

    .wallet-header {
      font-size: 16px;
      font-weight: 600;
      color: #111827;
      margin-bottom: 10px;
    }

    .wallet-address {
      font-family: monospace;
      font-size: 13px;
      color: #374151;
      background-color: #f3f4f6;
      padding: 8px 10px;
      border-radius: 8px;
      word-break: break-word;
      margin-bottom: 15px;
    }

    .wallet-actions {
      display: flex;
      justify-content: flex-end;
      gap: 8px;
    }

    .wallet-btn {
      font-size: 12px;
      padding: 6px 12px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      transition: background-color 0.2s ease-in-out;
    }

    .copy-btn {
      background-color: #2563eb;
      color: white;
    }

    .copy-btn:hover {
      background-color: #1d4ed8;
    }

    .delete-btn {
      background-color: #ef4444;
      color: white;
    }

    .delete-btn:hover {
      background-color: #dc2626;
    }

    /* Modal Spinner */
    .spinner-border-sm {
      width: 1rem;
      height: 1rem;
      border-width: 2px;
    }
  </style>

  <div class="container-fluid px-4">
    <h2 class="page-title mb-3">All Wallets</h2>

    <div class="wallets-container">
      @forelse ($wallets as $wallet)
        <div class="wallet-card" id="wallet-card-{{ $wallet->id }}">
          <div class="wallet-header">{{ $wallet->wallet_name }}</div>
          <div class="wallet-address" id="wallet_{{ $wallet->id }}">{{ $wallet->wallet_address }}</div>

          <div class="wallet-actions">
            <button class="wallet-btn copy-btn" onclick="copyToClipboard('wallet_{{ $wallet->id }}')">Copy</button>
            <button class="wallet-btn delete-btn" onclick="openDeleteModal({{ $wallet->id }})">Delete</button>
          </div>
        </div>
      @empty
        <div class="alert alert-info w-100">No wallets have been added yet.</div>
      @endforelse
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this wallet address?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-sm btn-danger" id="confirmDeleteBtn">
            <span class="btn-text">Delete</span>
            <span class="spinner-border spinner-border-sm d-none" id="deleteSpinner" role="status" aria-hidden="true"></span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
    let selectedWalletId = null;

    function copyToClipboard(elementId) {
      const text = document.getElementById(elementId).innerText;
      navigator.clipboard.writeText(text)
        .then(() => toastr.success("Wallet address copied"))
        .catch(() => toastr.error("Failed to copy"));
    }

    function openDeleteModal(walletId) {
      selectedWalletId = walletId;
      const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
      modal.show();
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
      const spinner = document.getElementById('deleteSpinner');
      const btnText = document.querySelector('#confirmDeleteBtn .btn-text');
      const deleteBtn = document.getElementById('confirmDeleteBtn');

      deleteBtn.disabled = true;
      spinner.classList.remove('d-none');
      btnText.classList.add('d-none');

      fetch(`/admin/wallets/${selectedWalletId}`, {
        method: "DELETE",
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        }
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          document.getElementById(`wallet-card-${selectedWalletId}`).remove();
          toastr.success("Wallet deleted");
        } else {
          toastr.error(data.message || "Could not delete wallet");
        }
      })
      .catch(() => toastr.error("Server error. Try again."))
      .finally(() => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
        modal.hide();
        deleteBtn.disabled = false;
        spinner.classList.add('d-none');
        btnText.classList.remove('d-none');
      });
    });
  </script>
</x-admin>
