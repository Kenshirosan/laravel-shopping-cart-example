@extends('layouts.master')

@section('title')
    Your message
@endsection

@section('content')
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Let us know what you think</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @include('includes.error')
            <form role="form" method="POST" action="/contact-us">
                {{ csrf_field() }}
                <!-- text input -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email@email.com" required>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Your name" required>
                </div>
                <div class="form-group">
                    <label>Phone number</label>
                    <input type="tel" maxlength="10" name="phone" class="form-control" placeholder="format: 1234567890" required>
                </div>

            <!-- textarea -->
                <div class="form-group">
                    <label>Your message</label>
                    <textarea class="form-control" name="message" rows="3" placeholder="Your message must be 20 characters minimum"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                </div>
            </form>
        </div>
    </div>
@endsection
