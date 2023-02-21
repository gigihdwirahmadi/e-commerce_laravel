@extends('layouts.template2')
@section('title')
    Home
@endsection
@section('style')
    <style>
        .for-banana-button{
            display: grid;
            justify-content: center;
            
        }
        nav {
            background-color: #f9dc5c;
            display: flex;
            align-content: center;
            justify-content: center;
        }
        .wall {
            border-radius: 30px;
            background-color: white;
            height: 700px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-top:60px
        }

        .wall2 {
            padding-top: 30px;
        }
        .title{
            text-align: center;
            font-weight: bold;
            font-size: 30px;
        }
        .price{
            text-align: center;
            font-size: 20px;
        }
        .image{
            
        }
        .box-image{
            
        }
        .banana {
            color: black;
            background-color: #f9dc5c;
            border: 1px solid;
            font-weight: bold;
            margin-top: 10px;
            width: 100px;
        }
        .caro-image{
            object-fit: cover;
        }
        /* f0f0f0 */
    </style>
@endsection
@section('content')
    <div class="wall container">
        <div class="image">
            <div class="box-image">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($product->Image as $img)
                        <?php if ($img->is_primary == 1) { ?>
                        <div class="carousel-item active">
                            <img src=" {{ asset('storage/' . $img->image) }}" class="d-block w-70 caro-image" height='400' width="400"
                                style="object-fit:cover"alt="...">
                        </div>
                        <?php } else { ?>

                        <div class="carousel-item">
                            <img src="{{ asset('storage/' . $img->image) }}" class="d-block w-70" height='400'
                                alt="...">
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
            <div class="text-bottom-image">
                <div class="title">
                    {{$product->name}}
                </div>
                <div class="price">
                    {{$product->price}}
                </div>
            </div>
            <div class="for-banana-button">
                <form method="post" action="{{route('cart.store')}}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="number" name="quantity" >
                    <button class="btn banana">ADD</button>
                </form>
            </div>
        </div>
        </div>
        <div class="wall2">
            
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
    </div>
    <div></div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@endsection
