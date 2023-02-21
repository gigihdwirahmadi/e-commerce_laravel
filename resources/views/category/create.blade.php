@extends('layouts.templateadmin')
@section('title')
    Login
@endsection
@section('style')
    <style>
        .box {
            border-radius: 10px;
            background: linear-gradient(315deg, #e6d787, rgb(255, 239, 150));
            -webkit-box-shadow: 0 0 30px #7e7653;
            box-shadow: 0 0 30px #7e7653;
            height: auto;
        }

        .form-control {
            background: transparent;
            border: none;
            border-bottom: 1px solid black;
            border-radius: 0px;
        }

        .form-control:focus {
            background: transparent;
            border: 0px;
            box-shadow: none;
            border-bottom: 1px solid black;
            border-radius: 0px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid" style="height: 100vh; width:100%">
        <form class="card p-4 box" method="POST" action="{{ route('category.store') }}">
            @csrf
            <div class="py-2">
                <label for="name" class="form-label">{{ __('Category Name') }}</label>
                <input id="name" class="form-control  @error('name') is-invalid @enderror" type="text" name="name"
                    value="{{ old('name') }}" />
                @error('name')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
            <div class="py-2">
                <label for="description" class="form-label">{{ __('Description') }}</label>
                <input id="description" class="form-control  @error('description') is-invalid @enderror" type="text"
                    name="description" value="{{ old('description') }}" />
                @error('description')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
            <div class="mt-3 confirm">
                <button class="btn btn-dark submit">
                    {{ __('ADD') }}
                </button>
            </div>
        </form>
    </div>
@endsection
