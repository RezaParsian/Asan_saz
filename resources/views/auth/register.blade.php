@extends('layouts.auth')

@section('title',"ایجاد حساب")

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <input placeholder="نام و نام خانوادگی" id="name" type="text"
                class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required
                autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input placeholder="ایمیل" id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password" placeholder="گذرواژه">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="تایید گذرواژه" autocomplete="new-password">
        </div>
        <button class="btn btn-primary btn-block">ثبت نام</button>
        <hr>
        <p class="text-muted">حساب کاربری دارید؟</p>
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">وارد شوید!</a>
    </form>
@endsection
