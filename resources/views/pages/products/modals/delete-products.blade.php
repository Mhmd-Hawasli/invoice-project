<div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">حذف المنتج</h6>
                <button class="close" data-dismiss="modal" type="button">
                    <span>&times;</span>
                </button>
            </div>

            {{-- id="delete_form" --}}
            <form id="delete-form" method="POST">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    <p>هل أنت متأكد من عملية الحذف؟</p>
                    <input type="text" name="product_name" id="product_name" class="form-control" readonly>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">تأكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>
