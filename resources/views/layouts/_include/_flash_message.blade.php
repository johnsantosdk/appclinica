<div class="col-sm-10">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                		@endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('flash_message'))
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div align="center" class="alert {{Session::get('flash_message')['class']}}">
                        {{ Session::get('flash_message')['msg'] }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>