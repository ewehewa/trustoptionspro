<x-dashboard>
  <div class="container-fluid px-4">
    <h3 class="page-title">My Copied Traders</h3>

    <div class="content-card">
      <div class="table-responsive">
        <table class="data-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Trader</th>
              <th>Copied Since</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse (Auth::user()->copiedTraders->sortByDesc('created_at') as $index => $copy)
              <tr id="copy-row-{{ $copy->trader_id }}">
                <td>{{ $index + 1 }}</td>
                <td>{{ $copy->trader->name ?? 'N/A' }}</td>
                <td>{{ $copy->created_at->format('Y-m-d H:i:s') }}</td>
                <td>
                  <button 
                    class="uncopy-btn btn btn-danger btn-sm" 
                    data-id="{{ $copy->trader_id }}">
                    Stop Copying
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center">No copied traders found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".uncopy-btn").forEach(button => {
        button.addEventListener("click", function () {
          let traderId = this.dataset.id;
          let row = document.getElementById("copy-row-" + traderId);
          let originalHtml = this.innerHTML;

          this.disabled = true;
          this.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Removing...`;

          fetch(`/user/copy-trader/${traderId}`, {
            method: "DELETE",
            headers: {
              "X-Requested-With": "XMLHttpRequest",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            }
          })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.message,
                showConfirmButton: false,
                timer: 2000
              });

              row.style.transition = "opacity 0.5s ease";
              row.style.opacity = "0";
              setTimeout(() => row.remove(), 500);
            } else {
              this.disabled = false;
              this.innerHTML = originalHtml;

              Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: data.message || "Failed to uncopy.",
                showConfirmButton: false,
                timer: 2000
              });
            }
          })
          .catch(err => {
            console.error(err);
            this.disabled = false;
            this.innerHTML = originalHtml;

            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'error',
              title: "Something went wrong!",
              showConfirmButton: false,
              timer: 2000
            });
          });
        });
      });
    });
  </script>

  <!-- Styles (reuse transaction styles for consistency) -->
  <style>
    .status-badge {
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
    }

    .btn-sm {
      padding: 4px 10px;
      font-size: 12px;
      border-radius: 4px;
    }

    .table-responsive {
      overflow-x: auto;
    }
  </style>
</x-dashboard>
