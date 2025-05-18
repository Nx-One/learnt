@extends('layouts.app')

@section('backButton')
<div class="col-1 d-flex flex-column">
    <a href="{{ route('assessment.index', ['course_id' => $course->id, 'unit_id' => $unit_id]) }}" class="btn btn-primary-custom"><i class='bx bx-left-arrow-alt mt-1 fs-4' ></i></i></a>
</div>
@endsection

@section('pagename', $course->name)  {{--Replace with course name--}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title">Assessment Scores</h5>
                    <h2 class="">{{ $assessment->title }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('assessment.saveScore', $assessment->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col mb-3">
                                <h4 for="exampleFormControlInput1" class="form-label">Student Name</h4>
                            </div>
                            <div class="col mb-3">
                                <h4 for="exampleFormControlInput1" class="form-label">Score</h4>
                            </div>
                        </div>
                        @foreach ($users as $user)
                            <div class="row">
                                <div class="col mb-3">
                                    <input type="hidden" class="form-control" id="exampleFormControlInput1" value="{{ $user->id }}" name="user_id[]">
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ $user->name }}" disabled>
                                </div>
                                <div class="col mb-3">
                                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Score" name="score[]" value="@if($user->score){{ $user->score }}@else '' @endif">
                                </div>
                            </div>
                        @endforeach
                        <div class="row mt-2">
                            <div class="col-1 ms-auto d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
