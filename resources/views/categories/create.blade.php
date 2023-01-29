@extends('layout.app') @section('title', 'ProductController-CREATE')
@section("content")
<section>
    <form method="post" action="{{ route('category.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">카테고리명</label>
            <input
                type="text"
                class="form-control"
                id="name"
                placeholder="카테고리명을 입력하세요"
                name="name"
            />
        </div>
        <div class="mb-3">
            <label for="brand_id" class="form-label">브랜드명</label>
            <select
                class="form-select"
                aria-label="Default select example"
                id="brand_id"
                name="brand_id"
            >
                <option selected>브랜드를 선택해주세요.</option>
                @foreach ($brands as $key => $brand)
                <option value="{{ $key + 1 }}">{{$brand->name}}</option>
                @endforeach
            </select>
        </div>
        <input class="btn btn-primary" type="submit" value="Submit" />
        @if($errors->any())
        <script>
            window.alert("{{$errors->first()}}");
        </script>
        @endif
    </form>
</section>
@endsection
