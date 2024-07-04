@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Post Details
                <a href="{{ route('posts.index') }}" class="btn btn-primary float-right">Back</a>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->content }}</p>
                <p class="card-text">Created by {{ $post->user->name }}</p>
            </div>
        </div>

        <div class="mt-3 card">
            <div class="card-header">Comments</div>
            <ul class="list-group list-group-flush">
                @foreach($post->comments as $comment)
                    <li class="list-group-item">
                        <p>{{ $comment->content }}</p>
                        <p>Commented by {{ $comment->user->name }}</p>

                        @can('update', $comment)
                            <a href="{{ route('comments.edit', [$post, $comment]) }}" class="btn btn-primary">Edit</a>
                        @endcan

                        @can('delete', $comment)
                            <form action="{{ route('comments.destroy', [$post, $comment]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endcan
                    </li>
                @endforeach
            </ul>
        </div>

        @auth
            <div class="mt-3">
                <form action="{{ route('comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="content">Add Comment</label>
                        <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        @else
            <p class="mt-3">Please <a href="{{ route('login') }}">login</a> to add comments.</p>
        @endauth
    </div>
@endsection
