@extends('layouts.app')

@section('backButton')
<div class="col-1 d-flex flex-column">
    <a href="{{ route('assessment.index', ['course_id' => $course->id, 'unit_id' => $assessment->unit->id]) }}" class="btn btn-primary-custom"><i class='bx bx-left-arrow-alt mt-1 fs-4' ></i></i></a>
</div>
@endsection

@section('pagename', $course->name)  {{--Replace with course name--}}
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $assessment->title }}</h5>
            <p>{{ $assessment->description }}</p>
            <iframe src="{{ $assessment->link }}" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="590vh"></iframe>
        </div>
    </div>
</div>
@endsection
