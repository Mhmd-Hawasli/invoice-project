@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    إضافة فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة فاتورة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الفواتير</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input type="text" class="form-control" id="inputName" name="invoice-number"
                                    placeholder="ادخل رقم الفاتورة" value="{{ old('invoice-number') }}"
                                    title="يرجي ادخال رقم الفاتورة" required>
                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice-date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="col">
                                <label>تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker" name="due-date" placeholder="ادخل تاريخ الاستحقاق"
                                    type="text" value="{{ old('due-date') }}" required>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <select name="section" class="form-control " required>

                                    <option value="" selected disabled>حدد القسم</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"> {{ $section->section_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col">
                                <label for="inputName" class="control-label">المنتج</label>
                                <select id="product" name="product" class="form-control " required>
                                    <option value="" selected disabled>حدد القسم أولاً</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input type="text" class="form-control" id="inputName" name="collected-amount"
                                    value="{{ old('collected-amount') }}" placeholder="ادخل مبلغ التحصيل"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="commission-amount" class="control-label">مبلغ العمولة</label>
                                <input type="number" class="form-control form-control-lg no-arrow" id="commission-amount"
                                    name="commission-amount" value="{{ old('commission-amount') ?? 0 }}"
                                    title="يرجي ادخال مبلغ العمولة" min="0" step="0.01"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '');"
                                    onchange="calculateTotalAmount()" required>
                            </div>


                            <div class="col">
                                <label for="discount" class="control-label">الخصم</label>
                                <input type="number" class="form-control form-control-lg no-arrow" id="discount"
                                    name="discount" value="{{ old('discount') ?? 0 }}" onchange="calculateTotalAmount()"
                                    title="يرجى إدخال مبلغ الخصم" min="0" step="1"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '');" required>
                            </div>


                            <div class="col">
                                <label for="rate-vat" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input type="number" name="rate-vat" id="rate-vat" class="form-control no-arrow"
                                        placeholder="أدخل نسبة الضريبة" value="{{ old('rate-vat') ?? 0 }}"
                                        min="0" max="100" step="1"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '');"
                                        onchange="calculateTotalAmount()" required>
                                </div>
                            </div>


                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" id="value-vat" name="value-vat" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="total" name="total" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                            </div>
                        </div><br>

                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">المرفقات</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="attachment" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                        </div>
                        <br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        let date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="section"]').on('change', function() {
                let sectionId = $(this).val();
                if (sectionId) {
                    $.ajax({
                        url: "{{ URL::to('sections') }}/" + sectionId + "/getProducts",
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $('select[name="product"]').append(
                                '<option value="" selected disabled>حدد المنتج</option>'
                            ); // Add the default option
                            $.each(data, function(key, value) {
                                console.log(key); // Logs each key-value pair
                                $('select[name="product"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
    </script>


    <script>
        function calculateTotalAmount() {
            // Get values from inputs
            let commissionAmount = parseFloat(document.getElementById("commission-amount").value);
            let discount = parseFloat(document.getElementById("discount").value);
            let rateVat = parseFloat(document.getElementById("rate-vat").value);

            // Ensure inputs are valid numbers, and handle NaN or negative cases
            if (isNaN(commissionAmount) || commissionAmount < 0) {
                alert('يرجى إدخال مبلغ عمولة صالح');
                return; // Exit if commission is invalid
            }

            if (isNaN(discount) || discount < 0) {
                alert('يرجى إدخال مبلغ خصم صالح');
                return; // Exit if discount is invalid
            }

            if (isNaN(rateVat) || rateVat < 0 || rateVat > 100) {
                alert('يرجى إدخال نسبة ضريبة القيمة المضافة صالحة بين 0 و 100');
                return; // Exit if VAT rate is invalid
            }

            // Calculate pure commission after discount
            let pureCommision = commissionAmount - discount;

            // Calculate VAT and total
            let vatResult = pureCommision * rateVat / 100;
            let totalResults = pureCommision + vatResult;

            // Display results
            document.getElementById("value-vat").value = vatResult.toFixed(2);
            arguments
            document.getElementById("total").value = totalResults.toFixed(2);
        }
    </script>


@endsection
