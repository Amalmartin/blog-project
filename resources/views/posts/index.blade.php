@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-md-10">
                <a href="{{ route('posts.create') }}" class="btn btn-success">Create New Post</a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Posts</div>

                    <div class="card-body">
                        @if($posts->count())
                            @foreach($posts as $post)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5>{{ $post->title }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                                        <p class="card-text"><small class="text-muted">Created by {{ $post->user->name }} on {{ $post->created_at->format('d M Y') }}</small></p>
                                        <a href="{{ route('posts.show', $post) }}" class="btn btn-success">View</a>
                                        @can('update', $post)
                                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
                                        @else
                                            <a href="#" class="btn btn-secondary disabled" aria-disabled="true">Edit</a>
                                        @endcan
                                        @can('delete', $post)
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @else
                                            <button class="btn btn-secondary disabled" aria-disabled="true">Delete</button>
                                        @endcan
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-center">
                                {{ $posts->links() }}
                            </div>
                        @else
                            <p>No posts available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
