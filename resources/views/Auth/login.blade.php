@extends('layouts.auth')

@section('content')
    <h3 class="card-title text-left mb-3">Login</h3>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <span>{!! Session::get('success') !!}</span>
        </div>
    @endif
    <form method="POST" action="{{route('post-log-admin')}}">
        @csrf
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control p_input" name="email">
        </div>
        <div class="form-group">
            <label>Password </label>
            <input type="password" class="form-control p_input" name="password">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
        </div>
    </form>
    <script>
        $(function () {
            $('.select2').select2(); 
        });
    </script>
@endsection