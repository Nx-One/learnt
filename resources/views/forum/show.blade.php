@extends('layouts.app')

@section('backButton')
<div class="col-1 d-flex flex-column">
    <a href="{{ route('forum.thread.index', ['course_id' => $course->id, 'unit_id' => $unit_id]) }}" class="btn btn-primary-custom"><i class='bx bx-left-arrow-alt mt-1 fs-4' ></i></i></a>
</div>
@endsection

@section('pagename', $course->name)
@section('content')
<div class="container py-4">
    <div class="row mt-3">
        <div class="col">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-column mb-2">
                    <div class="d-flex align-items-center">
                        <div class="d-flex">
                            <p class="fw-bold mb-0">
                                {{ $thread->user->name }}<span class="mx-2">•</span>
                            </p>
                            <p class="mb-0 text-secondary">
                                {{ $thread->created_at->format('d F Y') }}
                            </p>
                        </div>
                    </div>
                    <p class="mb-0 text-primary-custom">
                        {{-- {{ $thread->user->roles->first()->name }} --}}
                        @if($thread->user->roles->first()->name == 'instructor') Instructor @else Student @endif

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

            <!--Description-->
            <p class="text-ellipsis-two-row">
                {!! $thread->body !!}
            </p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <div class="d-flex flex-column mb-2">
                <p class="fw-bold ms-2">
                    {{ Auth::user()->name }}
                </p>
                <form action="{{ route('forum.post.store', $thread->id) }}" method="post">
                    @csrf
                    @method('POST')
                    <textarea name="body" id="simple"></textarea>
                    <div class="d-flex mt-3">
                        <button type="submit" class="btn btn-primary ms-auto">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col">
            @foreach ($thread->post as $post)
                <div class="card mt-3">
                    <div class="p-3">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-column mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex">
                                        <p class="fw-bold mb-0">
                                            {{ $post->user->name }}<span class="mx-2">•</span>
                                        </p>
                                        <p class="mb-0 text-secondary">
                                            {{ $post->created_at->format('d F Y') }}
                                        </p>
                                    </div>
                                </div>
                                <p class="mb-0 text-primary-custom">
                                    @if($post->user->roles->first()->name == 'Instructor') Instructor @else Student @endif
                                </p>
                            </div>
                            <div class="d-flex">
                                @if($post->user->id == Auth::user()->id)
                                    <form action="{{ route('forum.post.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm ms-2"><i class='bx bxs-trash'></i></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <p>
                            {!! $post->body !!}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
