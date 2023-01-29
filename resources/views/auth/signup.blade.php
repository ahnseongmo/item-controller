@extends('layout.app') @section('title', 'ProductController-Login')
@section("content")
<section>
    <h2>Sign up</h2>
    <form method="post" action="{{ route('auth.register') }}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"
                >Email address</label
            >
            <input
                type="email"
                class="form-control"
                id="exampleInputEmail1"
                aria-describedby="emailHelp"
                name="email"
            />
            <div id="emailHelp" class="form-text">
                We'll never share your email with anyone else.
            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                class="form-control"
                id="password"
                name="password"
            />
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label"
                >Password check</label
            >
            <input
                type="password"
                class="form-control"
                id="password_confirmation"
                name="password_confirmation"
            />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div>{{ $errors }}</div>
</section>
@endsection
