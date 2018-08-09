@if (session()->has('success_message'))
    <div class="alert alert-success">
        <strong>{{ session()->get('success_message') }}</strong>
    </div>
@endif
@if (session()->has('warning_message'))
    <div class="alert alert-warning">
        <strong>{{ session()->get('warning_message') }}</strong>
    </div>
@endif
@if (session()->has('error_message'))
    <div class="alert alert-danger">
        <strong>{{ session()->get('error_message') }}</strong>
    </div>
@endif
