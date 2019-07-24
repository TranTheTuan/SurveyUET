@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="card w-75">
            <div class="card-body">
                <h4 class="card-title">{{ $survey->title }}</h4>
                <p class="card-text">{{ $survey->description }}</p>
                <hr>
                <div class="card">
                    <div class="card-header">
                        Questions
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse($survey->questions as $index => $question)
                            <a href="#{{ 'answer' . $index }}" data-toggle="collapse" class="card-link ml-2 mt-1">Question #{{ $index + 1 }}: {{ $question->label }}?</a>
                            <div id="{{ 'answer' . $index }}" class="collapse">
                                @if($question->type == 1)
                                    @foreach($question->options as $key => $option)
                                        <p class="ml-3 mt-1">
                                            <input type="checkbox" id="{{ $question->id . $key }}" name="q1" value="{{ $option->id }}">
                                            <label for="{{ $question->id . $key }}">{{ $option->choice }}</label>
                                        </p>
                                    @endforeach
                                @elseif($question->type == 2)
                                    @foreach($question->options as $key => $option)
                                        <p class="ml-3 mt-1">
                                            <input type="radio" id="{{ $key }}" name="q1" value="{{ $option->id }}">
                                            <label for="{{ $key }}">{{ $option->choice }}</label>
                                        </p>
                                    @endforeach
                                @else
                                    <textarea class="form-control ml-3 mt-2 w-75" id="31" name="option"></textarea>
                                    <label for="31"></label>
                                @endif
                            </div>
                        @empty
                            <p class="text-danger ml-3 mt-2">This survey doesn't have any questions</p>
                        @endforelse
                    </ul>
                </div>
                <hr>
                <h3>Add Question</h3>
                <form method="post" action="{{ route('add_question', $survey->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="label">Question</label>
                        <input type="text" class="form-control" id="label" name="label" required>
                    </div>
                    <div class="form-group">
                        <label for="select-type">Types</label>
                        <select class="custom-select" id="select-type" name="type" required>
                            <option selected disabled>Choose question type</option>
                            <option value="1">Checkbox</option>
                            <option value="2">Radio</option>
                            <option value="3">Text</option>
                        </select>
                    </div>
                    <div class="answer-field"></div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection