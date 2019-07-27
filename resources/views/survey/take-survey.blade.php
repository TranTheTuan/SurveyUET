@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="card w-75">
            <div class="card-body">
                <h4 class="card-title">{{ $survey->title }}</h4>
                <p class="card-text">{{ $survey->description }}</p>
                <hr>
                <form method="post" action="{{ route('post', $survey->id) }}">
                    @csrf
                    @forelse($survey->questions as $index => $question)
                        <h3 class="ml-2 mt-1">Question #{{ $index + 1 }}: {{ $question->label }}?</h3>
                        @if($question->type == 1)
                            @foreach($question->options as $key => $option)
                                <p class="ml-3 mt-1">
                                    <input type="checkbox" id="{{ $question->id . $key }}" name="{{ $question->id}}[]" value="{{ $option->id }}"/>
                                    <label for="{{ $question->id . $key }}">{{ $option->choice }}</label>
                                </p>
                            @endforeach
                        @elseif($question->type == 2)
                            @foreach($question->options as $key => $option)
                                <p class="ml-3 mt-1">
                                    <input type="radio" id="{{ $question->id . $key }}" name="{{ $question->id }}" value="{{ $option->id }}"/>
                                    <label for="{{ $question->id . $key }}">{{ $option->choice }}</label>
                                </p>
                            @endforeach
                        @else
                            <div class="form-group">
                                <textarea class="form-control ml-3 mt-2 w-75" id="31" name="{{ $question->id }}"></textarea>
                                <label for="31"></label>
                            </div>
                        @endif
                    @empty
                        <p class="text-danger ml-3 mt-2">This survey doesn't have any questions</p>
                    @endforelse
                    <input type="submit" class="btn btn-primary" value="Submit">
                </form>
            </div>
        </div>
    </div>
@endsection