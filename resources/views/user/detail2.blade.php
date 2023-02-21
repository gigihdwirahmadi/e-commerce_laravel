@extends('layouts.template2')
@section('title')
    Home
@endsection
@section('style')
    <style>
        .wall {
            display: grid;
            grid-template-columns: 2fr 2fr;
            padding-top: 70px;
        }

        .column-1 {
            margin: 20px;
            border-radius: 10px;
            height: 100%;
            width: 100%;
        }

        nav {
            background-color: #f9dc5c
        }

        .hidden-navbar {
            height: 400px;
            width: 100%;
            z-index: -1;
        }

        .column-2 {
            padding: 20px;

        }

        .name-product {
            font-size: 23px;
            float: left;
            padding-top: 20px;
            color: black !important;
        }

        .price-product {
            font-size: 23px;
            font-weight: bold;
            justify-self: flex-end;
            padding-top: 20px;
            color: black !important;
        }

        .grid-column-2 {
            height: 100px;
            margin: 20px
        }

        .banana {
            background-color: black;
            color: #f9dc5c;
            border: 1px solid;
            font-weight: bold;
            margin-top: 10px;
            width: 100px;
        }

        .label {
            height: 200px;
            border-radius: 30px;
            background-color: #f9dc5c;
            margin-top: 40px;
        }

        .for-banana-button {
            text-align: center;
            display: block;
        }

        .grid-label {
            display: grid;
            grid-template-columns: 1fr 1fr;
            padding: 0 30px;
        }
        .desc{
            font-size:15px;
            padding-left:30px;
            padding-right: 30px;
        }
        .title{
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 20px;
        }
        .grid-column-2 {}

        .sticky-md-top {}
        body{
            background-color: #212529;
        }
    </style>
@endsection
@section('content')

    <div class="wall bg-dark" style="height:100vh; width:100%">
        <div class="column-1 text-white ">
            <div class="text-white desc">
                <div class="title">DETAIL PRODUCT</div>
                <table width='500'>
                    <tr>
                        <td>Stock</td>
                        <td>{{$product->stock}}</td>
                    </tr>
                    <tr>
                        <td>Unit</td>
                        <td>{{$product->unit}}</td>
                    </tr>
                    <tr>
                        <td>weight</td>
                        <td>{{$product->weight}}</td>
                    </tr>
                </table>
                <div class="title-desc">Description</div>
              {!! $product->description !!}
            </div>
        </div>
        <div class="column-2">
            <div class="grid-column-2" style=" position: fixed; width:400px">

                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="height:300px">
                    <div class="carousel-inner">
                        @foreach ($product->Image as $img)
                            <?php if ($img->is_primary == 1) { ?>
                            <div class="carousel-item active">
                                <img src=" {{ asset('storage/' . $img->image) }}" class="d-block w-100" height='300' style="object-fit:cover"alt="...">
                            </div>
                            <?php } else { ?>

                            <div class="carousel-item">
                                <img src="{{ asset('storage/' . $img->image) }}" class="d-block w-100" alt="...">
                            </div>
                            <?php } ?>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="label">
                    <div class="grid-label">
                        <div class="text-white name-product">{{ $product->name }}</div>
                        <div class="text-white price-product">{{ $product->price }}</div>
                    </div>
                <hr>
                    <div class="for-banana-button">
                        <a href="" class="btn banana">BUY</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@endsection
