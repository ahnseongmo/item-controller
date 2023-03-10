@extends('layout.app') @section('title', 'ProductController-Login')
@section("content")
<section class='container'>
    <h2 class="row m-2 mb-4">
        Login
    </h2>
    <form class="m-2" method="POST" action="{{ route('auth.login') }}">
        @csrf
        <div class="mb-3 w-sm-75">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp" />
            <div id="emailHelp" class="form-text">
                We'll never share your email with anyone else.
            </div>
        </div>
        <div class="mb-3 w-sm-75">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" />
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" />
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        @foreach ($errors as $key => $error)
        <div>{{ $error }}</div>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</section>
@endsection