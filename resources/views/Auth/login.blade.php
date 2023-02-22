@extends('layouts.auth')

@section('content')
    <h3 class="card-title text-left mb-3">Login</h3>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <span>{!! Session::get('success') !!}</span>
        </div>
    @endif
    <ul class="nav">
        <li class="nav-item menu-items"><a class="nav-link" data-bs-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">Masyarakat</a></li>
        <li class="nav-item menu-items"><a class="nav-link" data-bs-toggle="collapse" href="#admin" aria-expanded="false" aria-controls="admin">Admin</a></li>
    </ul>
    <div class="tab-content">
        <div class="collapse" id="admin">
            <p id="petugas">
                Admin
            </p>
        </div>
        <div class="collapse" id="user">
            <p id="user">
                User
            </p>
        </div>
    </div>
    
    <h1 class="text-center">FORM USER</h1>
    <form method="POST" action="{{route('post-log-user')}}">
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
        <p class="sign-up">Don't have an Account?<a href="{{url('register')}}"> Sign Up</a></p>
    </form>

    <h1 class="text-center">FORM ADMIN</h1>
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
        <p class="sign-up">Don't have an Account?<a href="{{url('register')}}"> Sign Up</a></p>
    </form>
    {{-- <div class="tabs">
        <span data-tab-value="#admin">Admin</span>
        <span data-tab-value="#user">User</span>
    </div>

    <div class="tab-content">
        <div class="tabs__tab active" id="admin" data-tab-info>
            <form method="POST" action="{{url('postlogin')}}">
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
                <p class="sign-up">Don't have an Account?<a href="{{url('register')}}"> Sign Up</a></p>
            </form>
        </div>
        <div class="tabs__tab" id="user" data-tab-info>
            <form method="POST" action="{{url('postlogin')}}">
                @csrf
                <div class="form-group">
                    <label>Username or NIK</label>
                    <input type="text" class="form-control p_input" name="email">
                </div>
                <div class="form-group">
                    <label>Password </label>
                    <input type="password" class="form-control p_input" name="password">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                </div>
                <p class="sign-up">Don't have an Account?<a href="{{url('register')}}"> Sign Up</a></p>
            </form>
        </div>
    </div> --}}

    <script>
        $(function () {
            $('.select2').select2(); 
        });
    </script>
@endsection