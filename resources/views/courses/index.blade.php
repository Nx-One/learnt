@extends('layouts.app')
@section('pagename', 'Courses')
@section('content')
<div class="container">
    {{-- @if($unit != null)
    <div class="row mb-5">
        <h3>Continue Learning</h3>
        <div class="card mb-3 p-0">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('img/code2.jpg') }}" class="img-fluid rounded-start" alt="..." />
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="row mb-5">
                            <h3 class="card-title fw-bolder">{{ $unit->course->name }}</h3>
                            <div class="row">
                                <div class="col-12">
                                    <p class="fw-semibold fs-5 m-0">{{ $unit->course->user->name }}</p>
                                    <p class="fs-6 m-0">{{ $unit->course->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: {{ $progress }}%;">{{ $progress }}%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    @endif --}}
    <div class="row">
        @foreach ($courses as $course)
        <div class="col-md-4">
            <div class="card p-1 shadow" >
                <img src="{{ asset('img/course.svg') }}" class="p-2 img-fluid" alt="..." />
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
</div>
@endsection
