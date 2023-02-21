@extends('layouts.templateadmin')
@section('title')
    Login
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

        .wall-separate {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

       .form-select,.file{
        background-color: transparent;
        border:none;
        border-bottom:1px solid black;
        border-radius: 0px
       }
       .form-select:focus, .file:focus{
        background-color: transparent;
        box-shadow: none;
        border:none;
       }
     
       select *{
        background-color: #e6d787;
       }
       select *:hover {
        color: #e6d787;
        background-color: black;
       }
    </style>
@endsection
@section('content')
    <div class="container-fluid" style="height: 100vh; width:100%">
        <form class="card p-4 box" method="POST" action="{{route('product.update',["product"=>$product->id])}}" enctype="multipart/form-data">
           
            @csrf
            @method('PUT')
            <div class="wall-separate">
                <div class="separator" style="padding-right: 20px">
                   
                    <div class="py-2">
                        <label for="name" class="form-label">{{ __('Product Name') }}</label>
                        <input id="name" class="form-control  @error('name') is-invalid @enderror" type="text"
                            name="name" value="{{ $product->name }}" />
                        @error('name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="py-2">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <input id="description" class="form-control  @error('description') is-invalid @enderror"
                            type="text" name="description" value="{{ $product->description }}" />
                        @error('description')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="py-2">
                        <label for="sku" class="form-label">{{ __('Sku') }}</label>
                        <input id="sku" class="form-control  @error('sku') is-invalid @enderror" type="text"
                            name="sku" value="{{ $product->sku }}" />
                        @error('sku')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="py-2">
                        <label for="stock" class="form-label">{{ __('stock') }}</label>
                        <input id="stock" class="form-control  @error('stock') is-invalid @enderror" type="number"
                            name="stock" value="{{ $product->stock }}" />
                        @error('stock')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="py-2">
                        <label for="image" class="form-label js-example-basic-single">{{ __('image') }}</label>
                        <input type='file' class="image" name='image[]' multiple style="display: block">
                    </div>
                </div>
                <div class="separator" style="padding-left: 20px">
                    <div class="py-2">
                        <label for="unit" class="form-label">{{ __('unit') }}</label>
                        <input id="unit" class="form-control  @error('unit') is-invalid @enderror" type="text"
                            name="unit" value="{{ $product->unit }}" />
                        @error('unit')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="py-2">
                        <label for="weight" class="form-label">{{ __('weight') }}</label>
                        <input id="weight" class="form-control  @error('weight') is-invalid @enderror" type="number"
                            name="weight" value="{{ $product->weight }}" />
                        @error('weight')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror 
                    </div>
                    <div class="py-2">
                        <label for="price" class="form-label">{{ __('price') }}</label>
                        <input id="price" class="form-control  @error('price') is-invalid @enderror" type="number"
                            name="price" value="{{ $product->price }}" />
                        @error('price')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="py-2">
                        <label for="price" class="form-label js-example-basic-single">{{ __('price') }}</label>
                        <select class="form-select mb-3" name="category_id" aria-label=".form-select-lg example">
                            <option selected>Open this select menu</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" <?php if ($category->id=== $product->category_id) echo "selected " ?>>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3 confirm">
               
                        <button class="btn btn-dark submit">
                            {{ __('ADD') }}
                        </button>
        
                    </div>
                </div>
            </div>
           
        </form>
    </div>
@endsection

@section('script')

<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

@endsection