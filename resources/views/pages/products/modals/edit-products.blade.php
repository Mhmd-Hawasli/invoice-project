<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل منتج</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="edit-form" method="POST" autocomplete="off">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">اسم المنتج:</label>
                        <input class="form-control" name="product_name" id="product_name" type="text">
                    </div>

                    <div class="form-group">
                        <label for="section_name" class="col-form-label">اسم القسم:</label>
                        <select class="form-control select2-no-search" name="section_name" id="section_name">
                            @foreach ($sections as $section)
                                <option>{{ $section->section_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="form-group">
                        <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                        <input class="form-control" id="section_name" type="text" disabled>
                    </div> --}}

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ملاحظات:</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">تاكيد</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
            </form>
        </div>
    </div>
</div>
