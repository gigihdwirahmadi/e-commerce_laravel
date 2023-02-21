@extends('layouts.template')
@section('title')
    Register
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
            <form method="POST" class="card p-4 mb-5" style="height:auto; width:400px"action="{{route('register') }}">
                @csrf
                <div class="title" style="width: 100%; font-weight:bold; text-align:center;font-size:20px">
                    REGISTER
                </div>
                <!-- Name -->

                <div class="my-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input id="name" class="form-control  @error('name') is-invalid @enderror" type="text"
                        name="name" :value="{{ old('name') }}" required autofocus />
                    @error('name')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <!-- Email Address -->
                    <div class="my-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" class="form-control  @error('email') is-invalid @enderror" type="email"
                            name="email" :value="{{ old('email') }}" required autofocus />
                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    {{-- <div class="my-3">
                <label for="role" class="form-label">{{ __('role') }}</label>
                <input id="role" class="form-control  @error('role') is-invalid @enderror" type="role"
                    name="role" :value="{{ old('role') }}" required autofocus />
                @error('role')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div> --}}
                    <div class="my-3">
                        <label for="password" class="form-label"> {{ __('Password') }}</label>

                        <input id="password" class="form-control @error('password') is-invalid @enderror" type="password"
                            name="password" required autocomplete="new-password" />
                        @error('password')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror


                    </div class="mb-3">
                    <div class="my-3">
                        <label for="password_confirmation" class="form-label"> {{ __('Confirm Password') }}</label>

                        <input id="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    {{-- <div class="my-3">
                        <label for="avatar" class="form-label">{{ __('avatar') }}</label>
                        <input id="avatar" class="form-control  @error('avatar') is-invalid @enderror" type="file"
                            name="avatar" :value="{{ old('avatar') }}" required autofocus />
                        @error('avatar')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div> --}}
                    {{-- </div> --}}
                    <div class="text-dark mt-4 confirm">
                        <a class=" text-dark underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                        <br>
                        <button class="btn mt-2 yellow">
                            {{ __('Register') }}
                        </button>
                    </div>
            </form>
        @endsection
