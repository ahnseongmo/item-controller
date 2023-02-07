@extends('layout.app') 
@section('title', 'ProductController-categories')
@section("content")
<section class='container'>
    @if($errors->any())
    <script>
        window.alert("{{$errors->first()}}");
    </script>
    @endif


    <h2 class="row m-2 mb-4">
        Categories List
    </h2>
    <nav class='row mx-1 mt-3 mb-2 justify-content-end'>
        <button type="button" class="btn btn-primary d-block w-100 d-sm-inline-block w-sm-auto mb-2" data-toggle="modal"
            data-target="#category_modal" data-whatever="@mdo">추가 +</button>
    </nav>
    <div class="table-responsive-xl">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class=' text-center'>No.</th>
                    <th scope="col" class=' text-center'>Id</th>
                    <th scope="col" class=' text-center' style='min-width: 80px;'>카테고리</th>
                    <th scope="col" class=' text-center' style='min-width: 80px;'>브랜드</th>
                    <th scope="col" class=' text-center' style='max-width: 120px;'>관련 아이템</th>
                    <th scope="col" class=' text-center' style='min-width: 80px;'>buttons</th>
                    <!-- <th class="buttons-head" scope="col">buttons</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $category)
                <tr class='border-bottom '>
                    <th scope="row" class='align-middle text-center'>{{ $key + 1 }}</th>
                    <td class='align-middle text-center'>{{ $category->id }}</td>
                    <td class='align-middle text-center'>{{ $category->name }}</td>
                    <td class='align-middle text-center'>{{ $category->brand_name }}</td>
                    <td class="related_items align-middle w-25">
                        <div class="ellipsis-1" style='max-width: 500px'>
                            @foreach ($category->items as $key => $item)
                            {{ $item->name }},
                            @endforeach
                        </div>
                    </td>
                    <td class="btns d-flex align-items-center justify-content-center border-0  ">
                        <button type="button" class="btn btn-primary mr-2" data-toggle="modal"
                            data-target="#category_edit_modal" data-category_id="{{ $category->id }}">수정
                        </button>

                        <form class="" method="post"
                            action="{{ route('category.delete', ['id'=>$category->id]) }}">
                            @csrf @method('DELETE')
                            <input class="btn btn-secondary" type="submit" value="삭제" />
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>


<!-- 모달 -->
<section>
    <div class="modal fade" id="category_modal" tabindex="-1" aria-labelledby="category_modal_label" aria-hidden="true">
        <div class="modal-dialog my-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="category_modal_label">카테고리 추가</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="category_create_form" method="post" action="{{ route('category.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="col-form-label">카테고리명:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder='카테고리명을 입력하세요.'>
                        </div>
                        <div class="mb-3">
                            <label for="brand_id" class="form-label">브랜드명</label>
                            <select class="custom-select" aria-label="Default select example" id="brand_id"
                                name="brand_id">
                                <option selected>브랜드를 선택해주세요.</option>
                                @foreach ($brands as $key => $brand)
                                <option value="{{ $key + 1 }}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                @if($errors->any())
                <script>
                    window.alert("{{ $errors->first() }}");
                </script>
                @endif
                </form>
            </div>
        </div>
    </div>
</section>

<!-- 수정 모달 -->
@include('layout.editmodal')

@endsection