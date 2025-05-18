@extends('layouts.app')

@section('content')
{{-- create jumbotron for course name --}}
<div class="container-fluid">
    <div class="container">
        <div class="row">
            {{-- <div class="col-1 my-auto">
                <a href="{{ url()->previous() }}" class="btn btn-primary-custom"><i class='bx bx-left-arrow-alt display-6' ></i></i></a>
            </div> --}}
            <div class="col-12">
                <h1>{{ $subUnits->first()->unit->name }}</h1>
                <p class="lead">{{ $subUnits->first()->unit->description }}</p>
            </div>
        </div>
    </div>
    {{-- <div class="jumbotron jumbotron-fluid bg-primary-subtle-custom text-white rounded rounded-pill py-2">
    </div> --}}
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        @foreach ($subUnits as $subUnit)
        <div class="col-4">
            <div class="card mb-3" style="max-width: 35rem;">
                <div class="row g-0">
                    <div class="col">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            @if($subUnit->video_url != null)
                                <a href="{{ $subUnit->video_url }}" class="btn btn-primary-custom"><i class='bx bx-video fs-4'></i></a>
                            @else
                                <a href="{{ route('quiz', ['subUnitId' => $subUnit->id, 'questionNumber' => 1]) }}" class="btn btn-primary-custom"><i class='bx bx-edit-alt' ></i></a>
                            @endif
                            <h5 class="card-title">{{ $subUnit->name }}</h5>
                            @if($subUnit->userProgress->count() != 0)
                                {{-- @if($subUnit->userProgress->first()->score != null) --}}
                                    <span class="badge bg-success">{{ $subUnit->userProgress->first()->score }}</span>
                                {{-- @endif --}}
                            @elseif($subUnit->video_url == null)
                                <span class="badge bg-warning">Incomplete</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
