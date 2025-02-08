@if (session()->has('success'))
    <div class="alert alert-success alert-dismissable fade show" role="alert" id="success-alert">
        <strong>{{ session()->get('success') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger alert-dismissable fade show" role="alert">


        @foreach ($errors->all() as $error)
            <strong>{{ $error }}</strong>
        @endforeach

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>


    </div>
@endif
