@extends('layout.app') @section('title', 'ProductController-HOME')
@section("content")
<section>
    <?php 
    // 클래스 만들기
        class MyFileObject{
            function isFile(){
                return is_file($this->filename);
            }               
        }

        $file1 = new MyFileObject();
        $file1->filename = 'data1.txt';
        var_dump($file1->isFile());

        $file2 = new MyFileObject();
        $file2->filename = 'data2.txt';
        var_dump($file2->isFile());
    ?>

    <?php 
    ?>

    
</section>
    <section>
        <div class="wrapper">
            <h2 class="search-bar">
                Item List
                <button type="button" class="btn btn-warning">
                    {{ $count }}
                </button>
                <form
                    class="d-flex"
                    role="search"
                    action="{{ route('page.search') }}"
                >
                    <div class="mb-3">
                        <!-- <label for="category_name" class="form-label"
                        >카테고리</label
                    > -->
                        <select
                            class="form-select"
                            id="category_name"
                            name="category_name"
                        >
                            <option selected value="">카테고리</option>
                            @foreach ($categories as $key => $category)
                            <option value="{{ $category->name }}">
                                {{$category->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <!-- <label for="type" class="form-label">브랜드</label> -->
                        <select
                            class="form-select"
                            aria-label="Default select example"
                            id="brand_id"
                            name="brand_id"
                        >
                            <option selected value="">브랜드</option>
                        </select>
                    </div>
                    <button class="btn btn-outline-success" type="submit">
                        Search
                    </button>
                </form>
            </h2>

            <div>
                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="location.href='/item/create'"
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
                        <th scope="col">아이디</th>
                        <th scope="col">제품명</th>
                        <th scope="col">카테고리</th>
                        <th scope="col">브랜드</th>
                        <th scope="col">상세</th>
                        <th scope="col">가격</th>
                        <th scope="col">재고</th>
                        <th scope="col">이미지링크</th>
                        <th class="buttons-head" scope="col">buttons</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $key => $item)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name ?? "-" }}</td>
                        <td>{{ $item->category->brand->name ?? "-" }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ number_format($item->price) }}</td>
                        <td>{{ number_format($item->count) }}</td>
                        <td>{{ $item->image }}</td>
                        <td class="btns">
                            <button
                                class="btn"
                                onclick="location.href='{{ route('page.item-detail', ['id'=>$item->id]) }}'"
                            >
                                상세
                            </button>
                            <button
                                class="btn"
                                onclick="location.href='{{ route('page.item-edit', ['id'=>$item->id]) }}'"
                            >
                                수정
                            </button>
                            <form
                                method="post"
                                action="{{ route('item.delete', ['id'=>$item->id]) }}"
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
    <script type="text/javascript">
        $(document).ready(function () {
            $("#category_name").on("change", function () {
                var get_Selected_category = $(this)
                    .find(":selected")
                    .text()
                    .trim();
                console.log(get_Selected_category);
                if (get_Selected_category) {
                    $.ajax({
                        url: "/brand/by-category/" + get_Selected_category,
                        type: "GET",
                        // data: { _token: "{{ csrf_token() }}" },
                        // dataType: "json",
                        success: function (data) {
                            console.log(data);
                            if (data) {
                                $("#brand_id").empty();
                                $("#brand_id").focus;
                                $("#brand_id").append(
                                    '<option value="">브랜드를 선택해주세요.</option>'
                                );
                                $.each(data, function (key, value) {
                                    $('select[id="brand_id"]').append(
                                        '<option value="' +
                                            value.brand_id +
                                            '">' +
                                            value.brand_name +
                                            "</option>"
                                    );
                                });
                            } else {
                                $("#brand_id").empty();
                            }
                        },
                    });
                } else {
                    $("#brand_id").empty();
                }
            });
        });
    </script>
    @endsection
</section>
