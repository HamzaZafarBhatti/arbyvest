<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 text-center m-auto">
        @if (Session::has('success'))
            <div class="alert alert-success">
                <b>
                    {{ session('success') }}
                </b>
            </div>
        @elseif(Session::has('warning'))
            <div class="alert alert-warning">
                <b>
                    {{ session('warning') }}
                </b>
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">
                <b>
                    {{ session('error') }}
                </b>
            </div>
        @elseif(Session::has('deleted'))
            <div class="alert alert-secondary">
                <b>
                    {{ session('deleted') }}
                </b>
            </div>
        @endif
    </div>
</div>
