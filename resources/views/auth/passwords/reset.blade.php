@extends('layouts.auth')

@section('title', 'بازنشانی رمز')

@section('content')
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group row">
            <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}"
                required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group row">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group row">

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
        </div>

        <div class="form-group row mb-0">
            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
@endsection
