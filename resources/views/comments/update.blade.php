@extends ('layout') 
@section('content')


<form action="/comment/{{$comment->id}}/update" method="POST" class="mb-3">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$comment->name}}">
    </div>
    <div class="mb-3">
        <label for="desc" class="form-label">Description</label>
        <textarea type="text" class="form-control" id="desc" name="desc">{{$comment->desc}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update comment</button>
</form>

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

@endsection