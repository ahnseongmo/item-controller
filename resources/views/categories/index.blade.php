@extends('layout.app') @section('title', 'ProductController-categories')
@section("content")
<section>
    @if($errors->any())
    <script>
        window.alert("{{$errors->first()}}");
    </script>
    @endif
    <div class="wrapper">
        <h2>Categories List</h2>
        <div>
            <button
                type="button"
                class="btn btn-primary"
                onclick="location.href='/category/create'"
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
                    <th scope="col">카테고리</th>
                    <th scope="col">브랜드</th>
                    <th scope="col">관련 아이템</th>
                    <th scope="col">buttons</th>
                    <!-- <th class="buttons-head" scope="col">buttons</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $category)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->brand_name }}</td>
                    <td class="related_items">
                        @foreach ($category->items as $key => $item)
                        <span>{{ $item->name }}, </span>
                        @endforeach
                    </td>
                    <td class="btns">
                        <button
                            class="btn"
                            onclick="location.href='{{ route('page.category.edit', ['id'=>$category->id]) }}'"
                        >
                            수정
                        </button>
                        <form
                            method="post"
                            action="{{ route('category.delete', ['id'=>$category->id]) }}"
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
