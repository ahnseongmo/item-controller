@extends('layout.app') @section('title', 'ProductController-DETAIL')
@section("content")
<section class="container">
    <h2>Product Detail</h2>
    <div class="card" style="width: 70%">
        <img src="{{ $item->image }}" class="card-img-top" alt="..." />
        <div class="card-body">
            <h5 class="card-title">{{$item->name}}</h5>
            <p class="card-text">
                <ol>
                    <li>id : {{$item->id}}</li>
                    <li>제품명 : {{$item->name}}</li>
                    <li>타입 : {{$item->category->name}}</li>
                    <li>브랜드 : {{$item->category->brand->name}}</li>
                    <li>상세 정보 : {{$item->description}}</li>
                    <li>가격 : {{$item->price}}원</li>
                    <li>수량 : {{$item->count}}개</li>
                    <li>사용 여부 : {{$item->useyn}}</li>
                    <li>등록 날짜 : {{$item->created_at}}</li>
                    <li>수정 날짜 : {{$item->updated_at}}</li>
                </ol>
            </p>
        </div>
    </div>
</section>

@endsection
