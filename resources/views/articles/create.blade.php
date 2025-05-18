@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row mb-5">
            <div class="col">
                <label for="cover_image" class="form-label fw-semibold">Cover Image</label>
                <input type="file" class="form-control" name="cover_image">
            </div>
            <div class="col">
                <label for="title" class="form-label fw-semibold">Title</label>
                <input type="text" class="form-control" placeholder="Title" name="title">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <textarea name="content" id="editor" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col text-end">
                <button type="submit" class="btn btn-outline-primary">Save</button>
            </div>
        </div>
    </form>

</div>
@endsection
