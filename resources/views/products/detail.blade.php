@extends('layout.app') @section('title', 'ProductController-DETAIL')
@section("content")
<section class="product-card">
    <h2>Product Detail</h2>
    <div class="card" style="width: 70%">
        <img src="{{ $product->image }}" class="card-img-top" alt="..." />
        <div class="card-body">
            <h5 class="card-title">{{$product->name}}</h5>
            <p class="card-text">
                <ol>
                    <li>id : {{$product->id}}</li>
                    <li>제품명 : {{$product->name}}</li>
                    <li>타입 : {{$product->type}}</li>
                    <li>타입 번호 : {{$product->type_num}}</li>
                    <li>상세 정보 : {{$product->description}}</li>
                    <li>가격 : {{$product->price}}원</li>
                    <li>수량 : {{$product->count}}개</li>
                    <li>이미지 : {{$product->image}}</li>
                    <li>사용 여부 : {{$product->useyn}}</li>
                    <li>등록 날짜 : {{$product->created_at}}</li>
                    <li>수정 날짜 : {{$product->updated_at}}</li>
                </ol>
            </p>
        </div>
    </div>
</section>

@endsection
