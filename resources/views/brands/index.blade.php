@extends('layout.app') @section('title', 'ProductController-categories')
@section("content")
<section class='container'>
    <h2 class="row m-2 mb-4">
        Brand List
    </h2>
    <nav class='row mx-1 mt-3 mb-2 justify-content-end'>
        <button type="button" class="btn btn-primary d-block w-100 d-sm-inline-block w-sm-auto mb-2" data-toggle="modal"
            data-target="#brand_modal" data-whatever="@mdo">추가 +</button>
    </nav>
    <div class="table-responsive-xl">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class='text-center'>No.</th>
                    <th scope="col" class='text-center'>Id</th>
                    <th scope="col" class='text-center' style='min-width: 300px;'>브랜드명</th>
                    <th scope="col" class='text-center' scope="col">buttons</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $key => $brand)
                <tr class='border-bottom'>
                    <th scope="row" class=' align-middle text-center'>{{ $key + 1 }}</th>
                    <td class='align-middle text-center'>{{ $brand->id }}</td>
                    <td class='align-middle text-center'>{{ $brand->name }}</td>
                    <td
                        class='btns d-flex align-items-center justify-content-center align-middle text-center border-0 '>
                        <button class="btn"
                            onclick="location.href='{{ route('page.brand.edit', ['id'=>$brand->id]) }}'">
                            수정
                        </button>
                        <form method="post" action="{{ route('brand.delete', ['id'=>$brand->id]) }}">
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