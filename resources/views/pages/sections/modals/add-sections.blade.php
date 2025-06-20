<div class="modal" id="addSectionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">إضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="card-body pt-0">
                    <form class="form-horizontal" action="{{ route('sections.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="section_name" class="form-control" id="inputName"
                                placeholder="اسم القسم">
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control" placeholder="الوصف" rows="3"></textarea>
                        </div>
                        <div class="form-group mb-0 justify-content-end">
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="submet">حفظ</button>
                </form>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق </button>
            </div>
        </div>
    </div>
</div>
