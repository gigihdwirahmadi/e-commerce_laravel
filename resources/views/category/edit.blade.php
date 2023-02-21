@extends('layouts.templateadmin')
@section('title')
    Login
@endsection
@section('style')
    <style>
           </style>
@endsection
@section('content')
<div class="container-fluid" style="height: 100vh; width:100%">
    <form class="card p-4" method="POST" action="{{route('category.update',["category"=>$category->id])}}">
        @method('PUT')
        @csrf
        <div class="py-2">
            <label for="name" class="form-label">{{ __('Category Name') }}</label>
            <input id="name" class="form-control  @error('name') is-invalid @enderror" type="text" name="name"
                value="{{$category->name}}"  />
            @error('name')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
        <div class="py-2">
            <label for="description" class="form-label">{{ __('Description') }}</label>
            <input id="description" class="form-control  @error('description') is-invalid @enderror" type="text" name="description"
                value="{{ $category->description }}"  />
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