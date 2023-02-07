<!-- Modal -->
<div class="modal fade" id="category_edit_modal" tabindex="-1" aria-labelledby="category_edit_modal_label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="category_edit_modal_label">카테고리 수정</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="category_edit_form" method="post" action="{{ route('category.edit', ['id'=>1]) }}">
                    @csrf
                    <input id="category_edit_id" type="hidden" name='category_id'/>
                    <div class="mb-3">
                        <label for="category_edit_name" class="col-form-label">카테고리명:</label>
                        <input type="text" class="form-control" id="category_edit_name" name="name" value=''>
                    </div>
                    <div class="mb-3">
                        <label for="brand_id" class="form-label">브랜드명</label>
                        <select class="custom-select" aria-label="Default select example" id="brand_id" name="brand_id">
                            <option selected id='brand_edit_name'>브랜드를 선택해주세요.</option>
                            @foreach ($brands as $key => $brand)
                            <option value="{{ $key + 1 }}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">취소</button>
                <button type="submit" class="btn btn-primary">수정</button>
            </div>
            @if($errors->any())
            <script>
                window.alert("{{$errors->first()}}");
            </script>
            @endif
            </form>
        </div>
    </div>
</div>