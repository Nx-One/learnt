@extends('layouts.app')

@section('backButton')
<div class="col-1 d-flex flex-column">
    <a href="{{ route('courses.corridor', ['course_id' => $course->id, 'unit_id' => $unit_id]) }}" class="btn btn-primary-custom"><i class='bx bx-left-arrow-alt mt-1 fs-4' ></i></i></a>
</div>
@endsection

@section('pagename', "Assessment - $course->name")  {{--Replace with course name--}}
@section('content')
<div class="container">
    @if(Auth::user()->isInstructor())
        <div class="row mb-5 justify-content-end">
            <div class="col-3 d-flex">
                <a class="btn btn-outline-primary ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bxs-plus-circle me-2'></i>Add New Assessment</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped-columns">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Link</th>
                        {{-- <th scope="col">Image</th> --}}
                        <th scope="col">Created At</th>
                        <th scope="col" class="px-5">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assessments as $assessment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $assessment->title }}</td>
                        <td>{{ Str::limit($assessment->description, 100, '...') }}</td>
                        <td>{{ $assessment->due_date ? $assessment->due_date : '-' }}</td>
                        <td><a href="{{ $assessment->link }}" target="_blank">{{ $assessment->link }}</a></td>
                        {{-- <td>
                            <img src="{{ asset('storage/images/' . $assessment->image) }}" alt="" class="img-fluid">
                        </td> --}}
                        <td>{{ $assessment->created_at->format('d M Y') }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('assessment.score', $assessment->id) }}" class="btn btn-primary btn-sm">
                                Score
                                {{-- <i class='bx bx-info-circle'></i> --}}
                            </a>
                            <a title="Edit" href="javascript:void(0);" class="btn btn-warning btn-sm edit-user" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $assessment->id }}" data-title="{{ $assessment->title }}" data-description="{{ $assessment->description }}" data-due_date="{{ $assessment->due_date }}" data-link="{{ $assessment->link }}"><i class='bx bxs-edit'></i></a>
                            <form action="{{ route('assessment.destroy', $assessment->id) }}" method="POST" style="display:inline;">
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

        @foreach($assessments as $assessment)
            <a href="{{ route('assessment.show', $assessment->id) }}" style="color: inherit; text-decoration: none;width: 100%; height: 100%;">
                <div class="row mt-3">
                    <div class="col">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-10">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex">
                                                    <h5 class="fw-bold">{{ $assessment->title }}</h5>
                                                </div>
                                            </div>
                                            <p class="mb-0 card-text">
                                                {{ $assessment->description }}
                                            </p>
                                            <p class="fw-bold mt-3 mb-0">
                                                Due Date
                                                <span class="fw-bold text-danger fs-6 fw-lighter">
                                                    {{ date('d M Y', strtotime($assessment->due_date)); }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 ms-auto">
                                    <div class="card-body">
                                        <div class="row">
                                            <p class="mb-0 text-center">
                                                Score
                                            </p>
                                            <h2 class="fw-bold display-6 text-center">
                                                @if($assessment->score == null) -
                                                @elseif($assessment->score->score == "") N/A
                                                @else {{ $assessment->score->score }} @endif
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            {{-- <a href="{{ route('assessment.show', $assessment->id) }}" style="color: inherit; text-decoration: none;width: 100%; height: 100%;">
                <div class="row mt-3">
                    <div class="col">
                        <div class="card">
                            <div class="p-3">
                                <div class="d-flex justify-content-between">
                                    <div class="row" style="height: 200px;">
                                        <img src="{{ asset('img/code2.jpg') }}" alt="" class="img-fluid rounded-start" style="height:200px; object-fit: cover" />
                                    </div>
                                    <div class="d-flex ms-2 flex-column mb-2">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex">
                                                <h2 class="fw-bold mb-0">
                                                {{ $assessment->title }}
                                                </h2>
                                            </div>
                                        </div>
                                        <p class="mb-0 mt-3">
                                            {{ $assessment->description }}
                                        </p>
                                    </div>
                                    <div class="d-flex me-2 flex-column mb-2">
                                        <div class="d-flex justify-content-center">
                                            <div class="d-flex">
                                                <p class="mb-0">
                                                    Score
                                                </p>
                                            </div>
                                        </div>
                                        <h2 class="fw-bold display-6">
                                            @if($assessment->score == null) -
                                            @elseif($assessment->score->score == "") N/A
                                            @else {{ $assessment->score->score }} @endif
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a> --}}
        @endforeach

    @endif
    <div class="row mt-3">
        {{ $assessments->links() }}
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Assessment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="assessmentForm" action="{{ route('assessment.store', ['course_id' => $course->id, 'unit_id' => $unit_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="method"></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">GForm Link<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="link" name="link" required>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
    const form = document.getElementById('assessmentForm');
    const modalLabel = document.getElementById('exampleModalLabel');
    const methodField = document.getElementById('method');

    // Listen for the show.bs.modal event
    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal

        // Extract data attributes from the button
        const id = button.getAttribute('data-id');
        const title = button.getAttribute('data-title');
        const description = button.getAttribute('data-description');
        const due_date = button.getAttribute('data-due_date');
        const link = button.getAttribute('data-link');

        // If id is not null, set the form action to update
        if (id) {
            form.action = "{{ route('assessment.update', '__id__') }}".replace('__id__', id);
            methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            form.querySelector('#title').value = title;
            form.querySelector('#description').value = description;
            form.querySelector('#due_date').value = due_date ? due_date.split('T')[0] : '';
            form.querySelector('#link').value = link;
            modalLabel.textContent = 'Edit Assessment';
        } else {
            // Reset the form for creating a new assessment
            form.action = "{{ route('assessment.store', ['course_id' => $course->id, 'unit_id' => $unit_id]) }}";
            methodField.innerHTML = '<input type="hidden" name="_method" value="POST">';
            form.reset();
        }
    });
</script>
@endsection
