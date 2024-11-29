@extends ('layout') 
@section('content')
<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <strong>Author: </strong>
            {{ $user->name }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $article->name }}</h5>
            <p class="card-text">{{ $article->desc }}</p>
            <div class="d-flex justify-content-center">
                @can('edit', $article->id)
                <a href="/article/{{$article->id}}/edit" class="btn btn-primary me-2">Edit article</a>
                @endcan
                @can('delete', $article->id)
                <form action="/article/{{$article->id}}" method="POST">
                    @method("DELETE")
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete article</button>
                </form>
                @endcan
            </div>
        </div>

        <div class="add-comment-section mt-5 shadow-sm">
            <h4 class="mb-3">Leave a Comment</h4>
            <form action="{{ '/comment' }}" method="POST">
                @method("POST")
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Your Comment</label>
                    <textarea name="desc" id="desc" rows="4" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </form>
        </div>
        @if (session('status'))
            <div id="toast-container">
                <div class="toast-message alert alert-success">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div id="toast-container">
                @foreach ($errors->all() as $error)
                    <div class="toast-message alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
            </div>
        @endif
        <div>
            <div class="comments-section my-5">
                <h3 class="mb-4">Comments ({{ $comments->count() }})</h3>
                @forelse ($comments as $comment)
                    <div class="card mb-3 shadow-sm pr-3">
                        <div class="card-header d-flex justify-content-between align-items-center pr-3">
                            <span>
                                <strong>{{ $comment->name ?? 'Anonymous' }}</strong>
                            </span>
                            <span class="text-muted">{{ $comment->created_at->format('F d, Y \a\t H:i') }}</span>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $comment->desc }}</p>
                        </div>
                        <div class="d-flex justify-content-end card-body pt-0">
                            @can('update_comment', $comment)
                                <a href="/comment/{{$comment->id}}/edit" class="btn btn-primary me-2">Edit comment</a>
                                <a href="/comment/{{$comment->id}}/delete" class="btn btn-danger me-2">Delete comment</a>
                            @endcan
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No comments yet. Be the first to leave your thoughts!</p>
                @endforelse
            </div>


        </div>
        @endsection