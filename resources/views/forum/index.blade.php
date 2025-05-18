@extends('layouts.app')

@section('backButton')
<div class="col-1 d-flex flex-column">
    <a href="{{ route('courses.corridor', ['course_id' => $course->id, 'unit_id' => $unit_id]) }}" class="btn btn-primary-custom"><i class='bx bx-left-arrow-alt mt-1 fs-4' ></i></i></a>
</div>
@endsection

@section('pagename', "Forum - $course->name")  {{--Replace with course name--}}
@section('content')
<div class="container">
    <div class="row mb-5 justify-content-end">
        {{-- <div class="col-10">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div> --}}
        <div class="col-2 d-flex">
            <a class="btn btn-outline-primary ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bxs-plus-circle me-2 fs-5'></i>Add New Thread</a>
        </div>
    </div>

    @foreach ($threads as $thread)
        <a href="{{ route('forum.thread.show', $thread->id) }}" style="color: inherit; text-decoration: none;width: 100%; height: 100%;">
            <div class="row mt-3">
                <div class="col">
                    <div class="card">
                        <div class="p-3">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex">
                                            <p class="fw-bold mb-0">
                                                {{ $thread->user->name }}<span class="mx-2">•</span>
                                            </p>
                                            <p class="mb-0 text-primary-custom">
                                                {{-- {{ $thread->user->roles->first()->name }} --}}
                                                @if($thread->user->roles->first()->name == 'instructor') Instructor @else Student @endif
                                            </p>
                                        </div>
                                    </div>
                                    <p>
                                        {{ $thread->created_at->format('d F Y') }}
                                    </p>
                                </div>

                                <div>
                                    <p class="mr-3 font-weight-500 mb-1">
                                        <i class='bx bx-conversation'></i>
                                        {{-- if thread->post == null then show 0 --}}
                                        @if($thread->post == null) 0 @else {{ $thread->post->count() }} @endif Response(s)
                                    </p>
                                </div>
                            </div>

                            <h5 class="hyphenate text-gray-700 text-md font-weight-600">
                                {{ $thread->title }}
                            </h5>

                            <!--Description-->
                            <p class="text-ellipsis-two-row">
                                {{-- this body parse html to text --}}
                                {!! Str::limit(strip_tags($thread->body), 200, '...') !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach

    <div class="row mt-3">
        {{ $threads->links() }}
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Thread</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('forum.thread.store', ['course_id' => $course->id, 'unit_id' => $unit_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="simple" class="form-label">Body</label>
                        <textarea class="form-control" id="simple" rows="3" name="body"></textarea>
                    </div>
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
