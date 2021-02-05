@extends('layouts.auth')

@section('title',"تایید گذرواژه")

@section('content')
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="form-group align-items-center">
            <div class="mr-3">
                <figure class="mb-4 avatar">
                    <img src="{{ asset('assets/media/image/avatar.jpg') }}" class="rounded-circle">
                </figure>
            </div>
            <input placeholder="رمز عبور" id="password" type="password"
                class="form-control @error('password') is-invalid @enderror" name="password" required
                autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ __('validation-inline.password') }}</strong>
                </span>
            @enderror

        </div>
        <button class="btn btn-primary btn-block">ورود</button>
        <hr>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <input type="submit" class="btn btn-sm btn-outline-light ml-1" value="خروج">
    </form>
@endsection
