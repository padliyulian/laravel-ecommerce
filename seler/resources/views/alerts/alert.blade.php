@if (session()->has('success.message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span>{{session()->get('success.message')}}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('error.message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span>{{session()->get('error.message')}}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
