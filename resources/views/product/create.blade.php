@extends('layouts.templateadmin')
@section('title')
    Login
@endsection
@section('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js">
        < script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity = "sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn"
        crossorigin = "anonymous" >
    </script>
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

        .form-select,
        .file {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid black;
            border-radius: 0px
        }

        .form-select:focus,
        .file:focus {
            background-color: transparent;
            box-shadow: none;
            border: none;
        }

        select * {
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
        <form class="card p-4 box" method="POST" action="{{ route('product.store') }}"enctype="multipart/form-data">
            <div class="wall-separate">
                <div class="separator" style="padding-right: 20px">
                    @csrf
                    <div class="py-2">
                        <label for="name" class="form-label">{{ __('Product Name') }}</label>
                        <input id="name" class="form-control  @error('name') is-invalid @enderror" type="text"
                            name="name" value="{{ old('name') }}" />
                        @error('name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="py-2">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <input id="desc" class="form-control  @error('description') is-invalid @enderror"
                            type="text" name="description" value="{{ old('description') }}" />
                        @error('description')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                  
                    <div class="py-2">
                        <label for="image" class="form-label js-example-basic-single">{{ __('image') }}</label>
                        <input type='file' class="image" id="upload_file" name='image[]'onchange='preview_image()'
                            multiple style="display: block">
                        
                    </div>
                </div>
                <div class="separator" style="padding-left: 20px">
                    <div class="py-2">
                        <label for="sku" class="form-label">{{ __('Sku') }}</label>
                        <input id="sku" class="form-control  @error('sku') is-invalid @enderror" type="text"
                            name="sku" value="{{ old('sku') }}" />
                        @error('sku')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="py-2">
                        <label for="stock" class="form-label">{{ __('stock') }}</label>
                        <input id="stock" class="form-control  @error('stock') is-invalid @enderror" type="number"
                            name="stock" value="{{ old('stock') }}" />
                        @error('stock')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="py-2">
                        <label for="unit" class="form-label">{{ __('unit') }}</label>
                        <input id="unit" class="form-control  @error('unit') is-invalid @enderror" type="text"
                            name="unit" value="{{ old('unit') }}" />
                        @error('unit')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="py-2">
                        <label for="weight" class="form-label">{{ __('weight') }}</label>
                        <input id="weight" class="form-control  @error('weight') is-invalid @enderror" type="number"
                            name="weight" value="{{ old('weight') }}" />
                        @error('weight')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="py-2">
                        <label for="price" class="form-label">{{ __('price') }}</label>
                        <input id="price" class="form-control  @error('price') is-invalid @enderror" type="number"
                            name="price" value="{{ old('price') }}" />
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
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
            <div id="image_preview" class="row"></div>
        </form>
        
    </div>
@endsection

@section('script')
        
<script src="https://cdn.tiny.cloud/1/w8g77b4wldzau28ajgja6c8em8cy56nijq2lycomubodi8oo/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


  <script>
    tinymce.init({
      selector: '#desc',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>
  <script>
        function preview_image() {
            var total_file = document.getElementById("upload_file").files.length;
            var input = document.getElementById("upload_file");
            document.getElementById("image_preview").innerHTML = "";
            for (var i = 0; i < total_file; i++) {
                console.log(input.files[i]);
                const file = (input.files[i])
                if (file) {
                    $('#image_preview').append(`<div class="col-lg-3"><img src='` + (URL.createObjectURL(file)) +
                        `' height=200 width=200 ><br> <select name="is_primary[]" class="form-select" aria-label="Default select example"><option value="0">None</option><option value="1">Primary</option></select></div><br>`);
                }
            }

        }
        //     console.log(event.target.file);

        // }
    </script>
@endsection
