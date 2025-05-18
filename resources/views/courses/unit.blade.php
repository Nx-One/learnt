@extends('layouts.app')
@section('pagename', $units->first()->course->name)
@section('content')
{{-- create jumbotron for course name --}}
<div class="container-fluid">
    <div class="container">
        <div class="row">
            {{-- <div class="col-1 my-auto">
                <a href="{{ url()->previous() }}" class="btn btn-primary-custom"><i class='bx bx-left-arrow-alt display-6' ></i></i></a>
            </div> --}}
            <div class="col-12">
                <p class="lead">{{ $units->first()->course->description }}</p>
            </div>
        </div>
    </div>
    {{-- <div class="jumbotron jumbotron-fluid bg-primary-subtle-custom text-white rounded rounded-pill py-2">
    </div> --}}
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        @foreach ($units as $unit)
        <div class="col-4">
            <div class="card mb-3" style="max-width: 35rem;">
                <div class="row g-0">
                    <div class="col">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h5 class="card-title">{{ $unit->name }}</h5>
                            <a href="{{ route('courses.subUnit', ['course_id' => $unit->course->id, 'unit_id' => $unit->id]) }}" class="btn"><i class='bx bxs-right-arrow-circle fs-3 text-primary' ></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
