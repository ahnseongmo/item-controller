@extends('layout.app') @section('title', 'ProductController-CREATE')
@section("content")
<section>
    <form method="post" action="{{ route('brand.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">브랜드명</label>
            <input
                type="text"
                class="form-control"
                id="name"
                placeholder="브랜드명을 입력하세요"
                name="name"
            />
        </div>
        <input class="btn btn-primary" type="submit" value="Submit" />
    </form>
</section>
@endsection
