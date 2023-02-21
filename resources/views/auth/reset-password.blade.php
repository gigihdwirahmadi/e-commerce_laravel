@extends('layouts.template')
@section('title')
    Login
@endsection
@section('style')
    <style>
        .container-fluid {
            margin: 0;
            padding: 0;
        }

        .wall {
            display: grid;
            grid-template-columns: 600px auto;
        }

        .yellow {
            background-color: #ffe135;
            border: 1px solid black;
        }

        .form-control:focus {
            border-color: black;
            box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset, 5px 4px 8px #ffe135;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid wall"
        style="display: grid; width:100%; height:100vh; align-items:center; justify-items:center">
        <div>
            <img src=" {{ asset('storage/asset/1a.jpg') }}" style=" object-fit: cover; width:100%; height:650px">
        </div>
        <div style="width: 100%; height:100%;display:grid; align-items: center; justify-items:center" class="bg-dark">
            <form method="POST" class="card p-4 mb-5" style="height:auto; width:400px"action="{{ route('password.store') }}"
                enctype="multipart/form-data">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="my-3">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                :value="old('email')" required autofocus>
            @error('email')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="my-3">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                :value="old('password')" required autofocus>
            @error('password')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="my-3">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                name="password_confirmation" :value="old('password_confirmation')" required autofocus>
            @error('password_confirmation')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
          \
        </div>

        <div class="flex items-center justify-end mt-4">
            <button class="btn btn-dark">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</div>
@endsection