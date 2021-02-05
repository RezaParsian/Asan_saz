@extends('layouts.auth')

@section('title',"ورود")

@section('content')


    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input placeholder="نام کاربری یا ایمیل" id="email" type="email"
                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password" placeholder="رمز عبور" type="password"
                class="form-control @error('password') is-invalid @enderror" name="password" required
                autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group d-sm-flex justify-content-between text-left mb-4">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked id="customCheck1">
                <label class="custom-control-label" for="customCheck1">به خاطر سپاری</label>
            </div>
            <a class="d-block mt-2 mt-sm-0" href="{{route("password.update")}}">بازنشانی رمز عبور</a>
        </div>
        <button class="btn btn-primary btn-block">ورود</button>
        {{--
        <hr>
        <p class="text-muted">با حساب شبکه اجتماعی خود وارد شوید.</p>
        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="#" class="btn btn-floating btn-facebook">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#" class="btn btn-floating btn-twitter">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#" class="btn btn-floating btn-dribbble">
                    <i class="fa fa-dribbble"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#" class="btn btn-floating btn-linkedin">
                    <i class="fa fa-linkedin"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#" class="btn btn-floating btn-google">
                    <i class="fa fa-google"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#" class="btn btn-floating btn-behance">
                    <i class="fa fa-behance"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#" class="btn btn-floating btn-instagram">
                    <i class="fa fa-instagram"></i>
                </a>
            </li>
        </ul> --}}
        <hr>
        <p class="text-muted">حسابی ندارید؟</p>
        @if ( Route::has('register'))
        <a href="{{route("register")}}" class="btn btn-outline-light btn-sm">هم اکنون ثبت نام کنید!</a>
        @endif
    </form>
@endsection
