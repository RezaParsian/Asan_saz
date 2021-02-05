@extends('layouts.auth')

@section('title',"فراموشی رمز عبور")

@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <input placeholder="نام کاربری یا ایمیل" id="email" type="email"
                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required
                autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button class="btn btn-primary btn-block">ثبت</button>
        <hr>
        <p class="text-muted">یک عمل دیگر انجام دهید.</p>
        @if (Route::has('register'))
        <a href="{{route("register")}}" class="btn btn-sm btn-outline-light mr-1 my-1">هم اکنون ثبت نام کنید!</a>
        یا
        @endif
        <a href="{{route("login")}}" class="btn btn-sm btn-outline-light ml-1 my-1">وارد شوید!</a>
    </form>
@endsection
