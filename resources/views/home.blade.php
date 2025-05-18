@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold">Course</h1>
    <div class="row">
        @foreach ($courses as $course)
            <div class="col-md-4">
                <div class="card p-1 shadow">
                    <img src="{{ asset('img/course.svg') }}" class=" p-2 card-img-top" alt="..." />
                    <div class="card-body">
                        <h3 class="card-title fw-bolder">{{ $course->name }}</h3>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <p class="fw-semibold fs-5 m-0">{{ $course->user->name }}</p>
                                    <p class="fs-6 m-0">{{ $course->name }}</p>
                                </div>
                            </div>
                            <a class="btn btn-primary-custom" href="{{ route('courses.unit', $course->id) }}">Open</a>
                        </div>
                        <p class="card-text mt-3">{{ $course->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <h2 class="mt-5">Articles</h2>
    <div class="row">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($articles as $article)
                {{-- set first article as active --}}
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="col">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-2 justify-content-center flex-column d-flex">
                                        <img src="{{ asset('storage/images/' . $article->path_image_title) }}" class="rounded-start img-fluid" alt="..." />
                                        {{-- <img style="max-width: 400px; max-height: 200px;" src="{{ asset('storage/images/' . $article->path_image_title) }}" class="rounded-start" alt="..." /> --}}
                                    </div>
                                    <div class="col-md-10">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <p class="card-text"><small class="text-body-secondary">{{ $article->created_at->format('d F Y') }}</small></p>
                                                    <h5 class="card-title fw-bold m-0">{{ $article->title }}</h5>
                                                </div>
                                            </div>
                                            <p class="card-text">{{ $article->user->name }}</p>
                                            <div class="card-text">{!! Str::limit($article->content, 100, '...') !!}
                                                <span>
                                                    <a href="{{ route('articles.show', $article->id) }}" class="link-primary">Read More</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

@if ($showModal)
    <div class="modal fade" id="firstLoginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="firstLoginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-bold" id="firstLoginModalLabel">Take a Quick Survey</h5>
                </div>
                <div class="modal-body">
                    <p class="fw-bold">We’d love to hear your thoughts! 🎓</p>
                    <p class="fw-medium">
                        Take a minute to complete a short survey to help us understand your competencies to supports research needs.
                    </p>
                    <iframe src="https://forms.gle/9JzV4Y4ggJ3QWB5Z8" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="590vh"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModalBtn">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="firstLoginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="firstLoginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Hi PGSD students! 👋</p>
                    <p>My name is Ailsa, and I'm conducting a research project on developing AI prompting skills to help future teachers like you design effective lesson plans (RPP).</p>
                    <br>
                    <p>Before the training begins, I’d love your help in completing a short survey about your self-regulated learning and technology skills. It will only take 5–7 minutes, and your honest responses will be really valuable for this research.</p>
                    <br>
                    <p>All responses are confidential and anonymous, and will only be used for academic purposes.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="closeModalBtn">Take the Survey</button>
                </div>
            </div>
        </div>
    </div> --}}
@endif

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        @if ($showModal)
            var modal = $('#firstLoginModal');
            modal.modal('show');

            $('#closeModalBtn, #modalCloseButton').on('click', function () {
                $.ajax({
                    url: '{{ route('modal.close') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        console.log("Modal close state saved.");
                    },
                    error: function () {
                        console.error("Error saving modal close state.");
                    }
                });
            });
        @endif
    });
</script>
@endsection
