@extends('layouts.app')

@section('backButton')
<div class="col-1 d-flex flex-column">
    <a href="{{ route('courses.corridor', ['course_id' => $course->id, 'unit_id' => $unit_id]) }}" class="btn btn-primary-custom"><i class='bx bx-left-arrow-alt mt-1 fs-4' ></i></i></a>
</div>
@endsection

@section('pagename', "Material - $course->name")  {{--Replace with course name--}}
@section('content')
<div class="container">
    @if(Auth::user()->isInstructor())
        <div class="row mb-5 justify-content-end">
            <div class="col-3 d-flex">
                <a class="btn btn-outline-primary ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="new"><i class='bx bxs-plus-circle me-2'></i>Add New Material</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped-columns">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Type</th>
                        <th scope="col">Link</th>
                        <th scope="col">Image</th>
                        <th scope="col">Created At</th>
                        <th scope="col" class="px-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materials as $material)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Str::limit($material->title, 100, '...') }}</td>
                        <td>{{ Str::limit($material->description, 100, '...') }}</td>
                        <td>{{ ucfirst($material->type) }}</td>
                        <td><a href="{{ $material->link }}" target="_blank">{{ $material->link }}</a></td>
                        <td>
                            <img src="{{ asset('storage/images/' . $material->image) }}" alt="" class="img-fluid">
                        </td>
                        <td>{{ $material->created_at->format('d M Y') }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a title="Edit" href="javascript:void(0);" class="btn btn-warning btn-sm edit-user" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $material->id }}" data-title="{{ $material->title }}" data-description="{{ $material->description }}" data-type="{{ $material->type }}" data-link="{{ $material->link }}"><i class='bx bxs-edit'></i></a>
                            <form action="{{ route('material.destroy', $material->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button title="Delete" type="submit" class="btn btn-danger btn-sm"><i class='bx bxs-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else

        @foreach($materials as $material)
            <div class="row mt-3 justify-content-center">
                <div class="col-8">
                    <a href="{{ $material->link }}" style="color: inherit; text-decoration: none;height: 100%;" target="_blank">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{ asset('storage/images/' . $material->image) }}" alt="" class="img-fluid rounded" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="fw-bold">{{ $material->title }}</h5>
                                            <p class1="card-text">{{ Str::limit($material->description, 100, '...') }}</p>
                                            <span class="card-text text-body-secondary fs-6 fw-lighter">
                                                {{ ucfirst($material->type) }} •
                                                {{ $material->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach

    @endif
    <div class="row mt-3">
        {{ $materials->links() }}
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Material</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="materialForm" action="{{ route('material.store', ['course_id' => $course->id, 'unit_id' => $unit_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="method"></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        {{-- <input type="text" class="form-control" id="description" name="description"> --}}
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-select">
                            <option value="" disabled selected>Select type</option>
                            <option value="video">Video</option>
                            <option value="document">Document</option>
                            <option value="slides">Slides</option>
                            <option value="photo">Photo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="link" name="link" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
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

@endsection

@section('scripts')
<script>
    // Get modal and form elements
    const modal = document.getElementById('exampleModal');
    const modalLabel = document.getElementById('exampleModalLabel');
    const form = document.getElementById('materialForm');
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const typeInput = document.getElementById('type');
    const linkInput = document.getElementById('link');
    const saveButton = document.getElementById('saveButton');
    const methodField = document.getElementById('method');

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const materialId = button.getAttribute('data-id');
        const title = button.getAttribute('data-title');
        const description = button.getAttribute('data-description');
        const type = button.getAttribute('data-type');
        const link = button.getAttribute('data-link');

        if(materialId === 'new') {
            form.action = "{{ route('material.store', ['course_id' => $course->id, 'unit_id' => $unit_id]) }}";
            methodField.innerHTML = '<input type="hidden" name="_method" value="POST">';
            titleInput.value = '';
            descriptionInput.value = '';
            typeInput.value = '';
            modalLabel.textContent = 'Add New Material';
            linkInput.value = '';
        } else {
            // form.action = `/material/update/${materialId}`;
            form.action = "{{ route('material.update', '__id__') }}".replace('__id__', materialId);
            methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            titleInput.value = title;
            descriptionInput.value = description;
            typeInput.value = type;
            linkInput.value = link;
            modalLabel.textContent = 'Edit Material';
        }
    });
</script>
@endsection
