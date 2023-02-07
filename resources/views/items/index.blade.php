@extends('layout.app')
@section('title', 'ProductController-HOME')
@section("content")
<section class="container">
    <h2 class="row m-2">
        Item List
        <button type="button" class="btn btn-warning ml-2 mr-2">
            {{ $count }}
        </button>
    </h2>
    <nav class='row mx-1 mt-3 mb-2 justify-content-between'>
        <form class='form-inline mb-0 w-100 w-sm-auto ' role="search" action="{{ route('page.search') }}">
            <select id="category_name" class="custom-select mb-2 mr-sm-2" name="category_name">
                <option selected value="">카테고리</option>
                @foreach ($categories as $key => $category)
                <option value="{{ $category->name }}">
                    {{$category->name}}
                </option>
                @endforeach
            </select>
            <select class="custom-select mb-2 mr-sm-2" aria-label="Default select example" id="brand_id"
                name="brand_id">
                <option selected value="">브랜드</option>
            </select>
            <button class="btn btn-outline-success d-block w-100 d-sm-inline-block w-sm-auto  mb-2
            " type="submit">
                Search
            </button>
        </form>
        <button type="button" class="btn btn-primary d-block w-100 d-sm-inline-block w-sm-auto mb-2" data-toggle="modal"
            data-target="#exampleModal" data-whatever="@mdo">추가 +</button>
    </nav>
    <div class="table-responsive-xl">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class='col-1 text-center'>No</th>
                    <th scope="col" class='col-1 text-center'>Id</th>
                    <th scope="col" class='col-1 text-center' style='min-width: 120px;'>제품명</th>
                    <th scope="col" class='col-1 text-center' style='min-width: 80px;'>카테고리</th>
                    <th scope="col" class='col-1 text-center' style='min-width: 80px;'>브랜드</th>
                    <th scope="col" class='col-1 text-center' style='min-width: 120px;'>상세</th>
                    <th scope="col" class='col-1 text-center' style='min-width: 50px;'>가격</th>
                    <th scope="col" class='col-1 text-center' style='min-width: 50px;'>재고</th>
                    <th class="buttons-head col-4 text-center" scope="col" style='min-width: 200px;'>buttons</th>
                </tr>
            </thead>
            <tbody id="item-container">
                @foreach ($items as $key => $item)
                <tr class="item border-bottom">
                    <th scope="row" class='align-middle text-center'>{{ $key + 1 }}</th>
                    <td class='align-middle text-center'>{{ $item->id }}</td>
                    <td class='align-middle text-center'>{{ $item->name }}</td>
                    <td class='align-middle text-center'>{{ $item->category->name ?? "-" }}</td>
                    <td class='align-middle text-center'>{{ $item->category->brand->name ?? "-" }}</td>
                    <td class='align-middle text-center'>{{ $item->description }}</td>
                    <td class='align-middle text-center'>{{ number_format($item->price) }}</td>
                    <td class='align-middle text-center'>{{ number_format($item->count) }}</td>
                    <td class="btns align-middle text-center row align-items-center justify-content-center border-0  ">
                        <button class="btn"
                            onclick="location.href='{{ route('page.item-detail', ['id'=>$item->id]) }}'">
                            상세
                        </button>
                        <button class="btn" onclick="location.href='{{ route('page.item-edit', ['id'=>$item->id]) }}'">
                            수정
                        </button>
                        <form class="form-inline m-0" method="post"
                            action="{{ route('item.delete', ['id'=>$item->id]) }}">
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

<section>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog my-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">상품 추가</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button> -->
                    <!-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button> -->
                </div>
                <div class="modal-body">
                    <form id="item-create-form" method="post" action="{{ route('item.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="col-form-label">제품명:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="category_name_create" class="form-label">카테고리</label>
                            <select class="custom-select" id="category_name_create" name="category_name">
                                <option selected>카테고리</option>
                                @foreach ($categories as $key => $category)
                                <option value="{{ $category->name }}">
                                    {{$category->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="category_name_create" class="form-label">브랜드</label>
                            <select class="custom-select" aria-label="Default select example" id="brand_id_create"
                                name="brand_id">
                                <option selected>브랜드</option>
                            </select>
                        </div>
                        <div id="brand_select_form" class="mb-3"></div>
                        <div class="mb-3">
                            <label for="price" class="form-label">가격</label>
                            <input type="text" class="form-control" id="price" placeholder="가격을 입력해주세요." name="price" />
                        </div>
                        <div class="mb-3">
                            <label for="count" class="form-label">재고 수량</label>
                            <input type="text" class="form-control" id="count" placeholder="재고 수량을 입력해주세요."
                                name="count" />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">제품 상세</label>
                            <textarea class="form-control" id="description" rows="3" placeholder="250자 이내로 입력해주세요."
                                name="description"></textarea>
                        </div>
                        <!-- 
                        <div class="mb-3">
                            <label for="formFile" class="form-label">제품 이미지</label>
                            <input class="form-control" type="file" id="formFile" name="image" />
                        </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                <!-- <input class="btn btn-primary" type="submit" value="Submit" /> -->
                </form>

            </div>
        </div>
    </div>
</section>
<!-- <script>
    changeDropDown();
    changeDropDownInModal();
    createItemInModal();
</script> -->
@endsection
</section>