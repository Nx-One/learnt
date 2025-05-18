@extends('layouts.app')

@section('backButton')
<div class="col-1 d-flex flex-column">
    <a href="{{ route('courses.index') }}" class="btn btn-primary-custom"><i class='bx bx-left-arrow-alt mt-1 fs-4' ></i></i></a>
</div>
@endsection

@section('pagename', $unit->name)  {{--Replace with course name--}}
@section('content')
<div class="container">
    <div class="row mt-3 justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img src="{{ asset('img/header/resources.png') }}" alt="" class="img-fluid rounded" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="fw-bold">Learning Resource</h5>
                                <p class1="card-text">Find all your learning materials here, like videos, notes, and lessons. Use them to study anytime you want.</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('material.index', ['course_id' => $course->id, 'unit_id' => $unit->id]) }}" class="btn btn-primary ms-auto">Open</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img src="{{ asset('img/header/assessment.png') }}" alt="" class="img-fluid rounded" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="fw-bold">Assessment</h5>
                                <p class1="card-text">Take quizzes and tests to check what you’ve learned. This helps you see how well you understand the lessons.</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('assessment.index', ['course_id' => $course->id, 'unit_id' => $unit->id]) }}" class="btn btn-primary ms-auto">Open</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img src="{{ asset('img/header/forum.png') }}" alt="" class="img-fluid rounded" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="fw-bold">Discussion Forum</h5>
                                <p class1="card-text">Talk with your classmates and teachers. You can ask questions, share ideas, and help each other learn.</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('forum.thread.index', ['course_id' => $course->id, 'unit_id' => $unit->id]) }}" class="btn btn-primary ms-auto">Open</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
