@if(Session::has('success'))
    <div class="alert alert-success mx-4">
        <p>
            {{Session::get('success')}}
        </p>
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger mx-4">
        <p>
            {{Session::get('error')}}
        </p>
    </div>
@endif
