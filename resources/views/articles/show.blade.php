@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h5 class="card-title fw-bold m-0">{{ $article->title }}</h5>
                        </div>
                        <div class="col-md-2">
                            <p class="card-text"><small class="text-body-secondary">{{ $article->created_at->format('d F Y') }}</small></p>
                        </div>
                    </div>
                    <p class="card-text">{{ $article->user->name }}</p>
                </div>
                <div class="mt-3 row justify-content-center">
                    <img style="width: 30rem" src="{{ asset('storage/images/' . $article->path_image_title) }}" class="img-fluid rounded-start" alt="..." />
                </div>
                <div class="card-body">

                    <div class="mt-5 card-text">{!! $article->content !!}</div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
