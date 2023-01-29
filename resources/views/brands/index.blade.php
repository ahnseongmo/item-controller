@extends('layout.app') @section('title', 'ProductController-categories')
@section("content")
<section>
    <div class="wrapper">
        <h2>Brand List</h2>
        <div>
            <button
                type="button"
                class="btn btn-primary"
                onclick="location.href='/brand/create'"
            >
                추가 +
            </button>
        </div>
    </div>
    <div class="items">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Id</th>
                    <th scope="col">브랜드명</th>
                    <th class="buttons-head" scope="col">buttons</th>
                    <!-- <th class="buttons-head" scope="col">buttons</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $key => $brand)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->name }}</td>
                    <td class="btns">
                        <button
                            class="btn"
                            onclick="location.href='{{ route('page.brand.edit', ['id'=>$brand->id]) }}'"
                        >
                            수정
                        </button>
                        <form
                            method="post"
                            action="{{ route('brand.delete', ['id'=>$brand->id]) }}"
                        >
                            @csrf @method('DELETE')
                            <input class="btn" type="submit" value="삭제" />
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
