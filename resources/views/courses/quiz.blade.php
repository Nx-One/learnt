@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <ul class="list-group">
                @for ($i = 1; $i <= $totalQuestions; $i++)
                    <li class="list-group-item {{ $i == $questionNumber ? 'active' : '' }}">
                        Question {{ $i }}
                    </li>
                @endfor
            </ul>
        </div>
        <div class="col-9">
            <h3>{{ $question->question }}</h3>
            <form action="{{ route('submitAnswer', ['subUnitId' => $question->sub_unit_id, 'questionNumber' => $questionNumber]) }}" method="POST">
                @csrf
                {{-- <input type="hidden" name="totalQuestions" value="{{ $totalQuestions }}"> --}}
                @foreach($question->options as $option)
                    <div>
                        <input type="radio" name="option_id" value="{{ $option->id }}"> {{ $option->option }}
                    </div>
                @endforeach

                <input type="hidden" name="question_id" value="{{ $question->id }}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div class="mt-3">
                @if ($questionNumber > 1)
                    <a href="{{ route('quiz', ['subUnitId' => $question->sub_unit_id, 'questionNumber' => $questionNumber - 1]) }}" class="btn btn-secondary">Previous</a>
                @endif
                @if ($questionNumber < $totalQuestions)
                    <a href="{{ route('quiz', ['subUnitId' => $question->sub_unit_id, 'questionNumber' => $questionNumber + 1]) }}" class="btn btn-secondary">Next</a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
