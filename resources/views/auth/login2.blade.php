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
        .yellow{
            background-color: #ffe135;
            border: 1px solid black;
        }
        .form-control:focus {
        border-color:  black;
        box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset, 5px 4px 8px #ffe135;
    }
    </style>
@endsection
@section('content')
    <div class="container-fluid wall"
        style="display: grid; width:100%; height:100vh; align-items:center; justify-items:center">
        <div>
            <img src=" {{ asset('storage/asset/1a.jpg') }}" style=" object-fit: cover; width:100%; height:650px" >
        </div>
        <div  style="width: 100%; height:100%;display:grid; align-items: center; justify-items:center" class="bg-dark">
            <form method="POST" class="card p-4 mb-5" style="height:auto; width:400px"action="{{ route('login') }}"
                enctype="multipart/form-data">
                <div class="title" style="width: 100%; font-weight:bold; text-align:center;font-size:20px">
                    LOGIN
                </div>
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" class="form-control  @error('email') is-invalid @enderror" type="email"
                        name="email" value="{{ old('email') }}" required autofocus />
                    @error('email')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <!-- Password -->
                    <div class="my-3">
                        <label for="password" class="form-label"> {{ __('Password') }}</label>

                        <input id="password" class="form-control @error('password') is-invalid @enderror" type="password"
                            name="password" required autocomplete="current-password" />
                        @error('password')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="block my-2">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-1 confirm">
                        @if (Route::has('password.request'))
                            <a class="text-dark underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <div class="mt-3 confirm">
                            <button class="btn yellow" style="float:left">
                                {{ __('Log in') }}
                            </button>
                        </div>
                        <a href="/auth/google" style="float: right" class="btn btn-dark"><i class="fa fa-google"></i> Login
                            with Google</a>

                    </div>
            </form>
        </div>
    </div>
@endsection
