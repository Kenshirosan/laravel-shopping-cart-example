@if (count($errors))
    <div class="form-group">

        <div>
            <ul class="list-group">
                @foreach($errors->all() as $error)
                    <li class="list-group-item-danger">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
