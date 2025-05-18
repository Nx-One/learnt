@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @if(Auth::user()->isInstructor())
            <div class="col-10">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    {{-- <button class="btn btn-outline-success" type="submit">Search</button> --}}
                </form>
            </div>
            <div class="col-2">
                <a href="{{ route('articles.create') }}" class="btn btn-outline-primary"><i class='bx bxs-plus-circle me-2' ></i>Create Article</a>
            </div>
        @else
            <div class="col">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
        @endif
    </div>

    @foreach ($articles as $article)
    <div class="row mt-4">
        <div class="col">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="{{ asset('storage/images/' . $article->path_image_title) }}" class="rounded-start img-fluid" alt="..." />
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="card-text"><small class="text-body-secondary">{{ $article->created_at->format('d F Y') }}</small></p>
                                    <h5 class="card-title fw-bold m-0">{{ $article->title }}</h5>
                                </div>
                                <div class="col-md-2 d-flex justify-content-end flex-column mb-3">
                                    <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary-custom">Open</a>
                                </div>
                            </div>
                            <p class="card-text">{{ $article->user->name }}</p>
                            <div class="card-text">{!! Str::limit($article->content, 100, '...') !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{-- <div class="row mt-4">
        <div class="col">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://placehold.co/400x200/png" class="img-fluid rounded-start" alt="..." />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-11">
                                    <p class="card-text"><small class="text-body-secondary">31 January 2024</small></p>
                                    <h5 class="card-title fw-bold m-0">Title Goes Here</h5>
                                </div>
                                <div class="col-md-1 mr-2">
                                    <a href="#" class="btn btn-primary-custom">Open</a>
                                </div>
                            </div>
                            <p class="card-text">John Doe</p>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
