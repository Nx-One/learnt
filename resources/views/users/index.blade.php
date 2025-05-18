@extends('layouts.app')

@section('backButton')
<div class="col-1 d-flex flex-column">
    <a href="{{ route('home') }}" class="btn btn-primary-custom"><i class='bx bx-left-arrow-alt mt-1 fs-4' ></i></i></a>
</div>
@endsection

@section('pagename', 'Master Users')  {{--Replace with course name--}}

@section('content')
<div class="container">
    <div class="row mb-5 justify-content-end">
        <div class="col-3 d-flex">
            <!-- Add New User Button -->
            <a class="btn btn-outline-primary ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="new"><i class='bx bxs-plus-circle me-2'></i>Add New User</a>
        </div>
        <div class="col-2 d-flex">
            <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class='bx bx-upload'></i> Upload User
            </button>
            {{-- Upload Excel User --}}
            {{-- <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control" accept=".xlsx, .xls, .csv" required>
                <button type="submit" class="btn btn-primary mt-2">Upload</button>
            </form> --}}
        </div>
    </div>

    <table class="table table-striped-columns">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NISN</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->nisn }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                {{-- join roles with span badge --}}
                <td>
                    <span class="badge bg-primary">{{ $user->roles->first()->name }}</span>
                </td>
                <td>
                    <!-- Edit Button -->
                    <a href="javascript:void(0);" class="btn btn-warning btn-sm edit-user" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-role="{{ $user->roles->first()->id }}" data-nisn="{{ $user->nisn }}"><i class='bx bxs-edit'></i></a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class='bx bxs-trash'></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row mt-3">
        {{ $users->links() }}
    </div>
</div>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="userForm" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="method"></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nisn" name="nisn" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role<span class="text-danger">*</span></label>
                        <select name="role_id" id="role_id" class="form-select" required>
                            <option value="" disabled selected>Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveButton">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="uploadModalLabel">Upload User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload Excel File<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls, .csv" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Get modal and form elements
    const modal = document.getElementById('exampleModal');
    const userForm = document.getElementById('userForm');
    const saveButton = document.getElementById('saveButton');
    const methodField = document.getElementById('method');

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const userId = button.getAttribute('data-id');
        const userName = button.getAttribute('data-name');
        const userEmail = button.getAttribute('data-email');
        const userRole = button.getAttribute('data-role');
        const userNisn = button.getAttribute('data-nisn');

        if (userId === "new") {
            // It's a new user, reset form fields and set action to create
            userForm.setAttribute('action', '{{ route("users.store") }}');
            methodField.innerHTML = '<input type="hidden" name="_method" value="POST">';

            saveButton.textContent = 'Save changes';
            userForm.reset(); // Clear form fields
        } else {
            // It's an edit, populate form with existing user data and set action to edit
            userForm.setAttribute('action', `/users/${userId}`);
            methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            saveButton.textContent = 'Update User';
            document.getElementById('name').value = userName;
            document.getElementById('email').value = userEmail;
            document.getElementById('role_id').value = userRole;
            document.getElementById('nisn').value = userNisn;
        }
    });
</script>
@endsection
