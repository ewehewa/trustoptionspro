<x-admin>
  <style>
    .card-box {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      padding: 25px;
      margin-bottom: 30px;
    }

    .user-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 10px;
    }

    .user-table thead {
      background: none;
      font-weight: 600;
      color: #333;
      border-bottom: 1px solid #eee;
    }

    .user-table th, .user-table td {
      padding: 16px 20px;
      background-color: #fff;
    }

    .user-table tbody tr {
      box-shadow: 0 1px 5px rgba(0, 0, 0, 0.04);
      border-radius: 8px;
      transition: transform 0.2s ease;
    }

    .user-table tbody tr:hover {
      transform: scale(1.005);
    }

    .user-table td:first-child,
    .user-table th:first-child {
      border-top-left-radius: 10px;
      border-bottom-left-radius: 10px;
    }

    .user-table td:last-child,
    .user-table th:last-child {
      border-top-right-radius: 10px;
      border-bottom-right-radius: 10px;
    }

    .btn-view {
      background-color: #6c63ff;
      color: white;
    }

    .btn-view:hover {
      background-color: #5848d7;
    }

    .btn-delete {
      background-color: #e63946;
      color: white;
    }

    .btn-delete:hover {
      background-color: #c12736;
    }

    .pagination {
      display: flex;
      justify-content: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .pagination .page-link {
      color: #333;
      padding: 8px 14px;
      border-radius: 8px;
      border: 1px solid #ddd;
      background-color: #fff;
      transition: 0.3s;
    }

    .pagination .page-item.active .page-link {
      background-color: #6c63ff;
      border-color: #6c63ff;
      color: white;
    }

    .pagination .page-link:hover {
      background-color: #f1f1f1;
      text-decoration: none;
    }

    @media (max-width: 768px) {
      .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
      }

      .user-table thead {
        display: none;
      }

      .user-table tbody tr {
        display: block;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
      }

      .user-table td {
        display: flex;
        justify-content: space-between;
        padding: 12px 15px;
        font-size: 14px;
        border-bottom: 1px solid #f0f0f0;
      }

      .user-table td:last-child {
        border-bottom: none;
      }

      .user-table td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #666;
      }
    }
  </style>

  <div class="container-fluid">
    <div class="card-box">
      <h4 class="mb-4">All Registered Users</h4>

      @if($users->count())
        <div class="table-responsive">
          <table class="user-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Registered Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $index => $user)
              <tr>
                <td data-label="#"> {{ $users->firstItem() + $index }} </td>
                <td data-label="Full Name">{{ $user->name }}</td>
                <td data-label="Email">{{ $user->email }}</td>
                <td data-label="Registered">{{ $user->created_at->format('d M Y') }}</td>
                <td data-label="Actions">
                  <div class="action-buttons d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-view">
                      <i class="fas fa-eye me-1"></i> View
                    </a>

                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="delete-form">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-sm btn-delete" onclick="confirmDelete(this)">
                        <i class="fas fa-trash me-1"></i> Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="mt-4">
          {{ $users->links('pagination::bootstrap-5') }}
        </div>
      @else
        <p class="text-muted text-center">No users found.</p>
      @endif
    </div>
  </div>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmDelete(button) {
      const form = button.closest('form');

      Swal.fire({
        title: 'Are you sure?',
        text: "This user will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e63946',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    }
  </script>
</x-admin>
