@extends ('layout') 
@section('content')


<form action="/auth/register" method="POST" class="mb-3">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">signUp</button>
</form>

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