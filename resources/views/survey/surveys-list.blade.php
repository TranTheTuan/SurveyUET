@extends('layouts.app')

@section('content')
    <h3 class="text-center">Recent Surveys</h3>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="list-group">
                @forelse($surveys as $survey)
                    {{$survey->question}}
                    <li class="list-group-item">
                        <div class="card" style="border: none">
                            <div class="card-body">
                                <h5 class="card-title"><a class="card-link" href="{{ route('show', $survey->id) }}">{{ $survey->title }}</a></h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $survey->user->name }}</h6>
                                <p class="card-text">{{ $survey->description }}</p>
                                <a href="{{ route('edit', $survey->id) }}" class="card-link">
                                    <i class="far fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('delete', $survey->id) }}" class="card-link" onclick="return confirm('Are you sure you want to delete this item?');">
                                    <i class="far fa-trash-alt"></i> Delete
                                </a>
                                <a href="#" class="card-link">
                                    <i class="fas fa-share-alt"></i> Share
                                </a>
                                <a href="{{ route('take', $survey->id) }}" class="card-link">
                                    <i class="fas fa-laptop"></i> Take Survey
                                </a>
                            </div>
                        </div>
                    </li>
                @empty
                    <p class="text-danger text-center">No survey found</p>
                @endforelse
            </ul>
        </div>
    </div>
@endsection