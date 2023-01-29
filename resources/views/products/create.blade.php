@extends('layout.app') @section('title', 'ProductController-CREATE')
@section("content")
<section>
    <form method="post" action="{{ route('product.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">제품명</label>
            <input
                type="text"
                class="form-control"
                id="name"
                placeholder="제품명을 입력하세요"
                name="name"
            />
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">타입</label>
            <select
                class="form-select"
                aria-label="Default select example"
                id="type"
                name="type_num"
            >
                <option selected>타입을 선택해주세요.</option>
                <option value="1">노트북</option>
                <option value="2">마우스</option>
                <option value="3">핸드폰</option>
                <option value="4">이어폰</option>
                <option value="5">마우스</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">가격</label>
            <input
                type="text"
                class="form-control"
                id="price"
                placeholder="가격을 입력해주세요."
                name="price"
            />
        </div>
        <div class="mb-3">
            <label for="count" class="form-label">재고 수량</label>
            <input
                type="text"
                class="form-control"
                id="count"
                placeholder="재고 수량을 입력해주세요."
                name="count"
            />
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">제품 상세</label>
            <textarea
                class="form-control"
                id="description"
                rows="3"
                placeholder="250자 이내로 입력해주세요."
                name="description"
            ></textarea>
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">제품 이미지</label>
            <input
                class="form-control"
                type="file"
                id="formFile"
                name="image"
            />
        </div>
        <input class="btn btn-primary" type="submit" value="Submit" />
    </form>
</section>
@endsection
