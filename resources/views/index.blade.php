@extends('layout.app') @section('title', 'ProductController-HOME')
@section("content")
<section>
    <h2>Item List</h2>
    <div class="items">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">아이디</th>
                    <th scope="col">제품명</th>
                    <th scope="col">타입</th>
                    <th scope="col">상세</th>
                    <th scope="col">가격</th>
                    <th scope="col">재고</th>
                    <th scope="col">이미지링크</th>
                    <th class="buttons-head" scope="col">buttons</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $product->category->name ?? "-" }}</td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->type }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->count }}</td>
                    <td>{{ $product->image }}</td>
                    <td class="btns">
                        <button
                            class="btn"
                            onclick="location.href='{{ route('page.product-detail', ['id'=>$product->id]) }}'"
                        >
                            상세
                        </button>
                        <button
                            class="btn"
                            onclick="location.href='{{ route('page.product-edit', ['id'=>$product->id]) }}'"
                        >
                            수정
                        </button>
                        <form
                            method="post"
                            action="{{ route('product.delete', ['id'=>$product->id]) }}"
                        >
                            @csrf @method('DELETE')
                            <input class="btn" type="submit" value="삭제" />
                        </form>
                        <!-- <button
                            class="btn"
                            onclick="location.href='route('product.delete', ['id'=>$product->id])'"
                        >
                            삭제
                        </button> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
