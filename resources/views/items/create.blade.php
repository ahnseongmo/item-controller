@extends('layout.app') @section('title', 'ProductController-CREATE')
@section("content")
<section class='container'>
    <h2>Item Register</h2>
    <form method="post" action="{{ route('item.store') }}">
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
            <label for="category_name" class="form-label">카테고리</label>
            <select class="form-select" id="category_name" name="category_name">
                <option selected>카테고리를 선택해주세요.</option>
                @foreach ($categories as $key => $category)
                <option value="{{ $category->name }}">
                    {{$category->name}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">브랜드</label>
            <select
                class="form-select"
                aria-label="Default select example"
                id="brand_id"
                name="brand_id"
            >
                <option selected>브랜드를 선택해주세요.</option>
            </select>
        </div>
        <div id="brand_select_form" class="mb-3"></div>
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

<script type="text/javascript">
    $(document).ready(function () {
        $('#category_name').on('change', function () {
            var get_Selected_category = $(this).find(':selected').text().trim();
            if (get_Selected_category) {
                $.ajax({
                    url: '/brand/by-category/' + get_Selected_category,
                    type: 'GET',
                    // data: { _token: "{{ csrf_token() }}" },
                    // dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (data) {
                            $('#brand_id').empty();
                            $('#brand_id').focus;
                            $('#brand_id').append(
                                '<option value="">브랜드를 선택해주세요.</option>'
                            );
                            $.each(data['data'], function (key, value) {
                                $('select[id="brand_id"]').append(
                                    '<option value="' +
                                        value.brand_id +
                                        '">' +
                                        value.brand_name +
                                        '</option>'
                                );
                            });
                        } else {
                            $('#brand_id').empty();
                        }
                    },
                });
            } else {
                $('#brand_id').empty();
            }
        });
    });
</script>
@endsection
