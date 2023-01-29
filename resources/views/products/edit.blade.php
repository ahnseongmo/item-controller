@extends('layout.app') @section('title', 'ProductController-EDIT')
@section("content")
<section>
    <form
        method="post"
        action="{{ route('product.update', ['id'=>$product->id]) }}"
    >
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">제품명</label>
            <input
                type="text"
                class="form-control"
                id="name"
                placeholder="제품명을 입력하세요"
                name="name"
                value="{{ $product->name  }}"
            />
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">타입</label>
            <select
                class="form-select"
                aria-label="Default select example"
                id="selected_value"
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
                value="{{ $product->price }}"
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
                value="{{ $product->count }}"
            />
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">제품 상세</label>
            <textarea
                class="form-control"
                id="description"
                rows="3"
                name="description"
            >
<?php echo $product->description; ?>
            </textarea>
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">제품 이미지</label>
            <input
                class="form-control"
                type="file"
                id="formFile"
                name="image"
                value="{{ $product->image }}"
            />
            <div id="selected_file"></div>
        </div>
        <input class="btn btn-primary" type="submit" value="Submit" />
    </form>
</section>

<script type="text/javascript">
    function changeValue() {
        const selected_type = document.getElementById("selected_value");
        selected_type.value = "{{$product->type_num}}";
        const selected_file = document.getElementById("selected_file");
        selected_file.textContent = `현재 등록된 파일 : "{{$product->image}}"`;
    }
    changeValue();
</script>

<!-- <section class="main">
<div>{{$product}}</div>
<div class="form">
    <form method="post" action="{{ route('product.update', ['id'=>$product->id]) }}">
        @csrf
        @method('PUT')
        <div class="form_input_group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form__input" name="name"  value="{{ $product->name  }}"/>
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror   
        <div class="form_input_group">
            <label for="type">type</label>
            <input type="text" id="type" class="form__input" name="type"  value="{{ $product->type }}" />
        </div>
        @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror  
        <div class="form_input_group">
            <label for="type_num">type_num</label>
            <input
                type="text"
                id="type_num"
                class="form__input"
                name="type_num"
                value="{{ $product->type_num  }}"
            />
        </div>
        @error('type_num')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror  
        <div class="form_input_group">
            <label for="description">description</label>
            <input
                type="text"
                id="description"
                class="form__input"
                name="description"
                value="{{ $product->description }}"
            />
        </div>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror  
        <div class="form_input_group">
            <label for="price">price</label>
            <input
                type="text"
                id="price"
                class="form__input"
                name="price"
                value="{{ $product->price  }}"
            />
        </div>
        @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form_input_group">
            <label for="description">count</label>
            <input
                type="text"
                id="count"
                class="form__input"
                name="count"
                value="{{ $product->count }}"
            />
        </div>
        @error('count')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form_input_group">
            <label for="image">image</label>
            <input
                type="text"
                id="image"
                class="form__input"
                name="image"
                value="{{ $product->image  }}"
            />
        </div>
        <input type="submit" name="send" value="Submit" class="btn" />
    </form>
</div>
</section> -->
@endsection
