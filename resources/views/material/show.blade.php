@extends('layouts.app')
@section('pagename', $course->name)  {{--Replace with course name--}}
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $assessment->title }}</h5>
            <p>{{ $assessment->description }}</p>
            <iframe src="{{ $assessment->link }}" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="640vh"></iframe>
        </div>
    </div>
</div>
@endsection
