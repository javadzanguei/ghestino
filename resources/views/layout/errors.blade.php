@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach($errors->all() as $error)
                <li><span class="fa fa-exclamation-triangle"></span> {{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
