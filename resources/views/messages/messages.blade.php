@if (session()->has('success_message'))
    <div class="alert alert-success">
        {{ session()->get('success_message') }}
    </div>
@endif
@if (session()->has('warning_message'))
    <div class="alert alert-warning">
        {{ session()->get('warning_message') }}
    </div>
@endif
@if (session()->has('error_message'))
    <div class="alert alert-danger">
        {{ session()->get('error_message') }}
    </div>
@endif
