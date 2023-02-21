@extends('layouts.template2')
@section('title')
    All
@endsection
@section('style')
    <style>
        body{
            background-color: #f9dc5c;
        }
        .yellow {

            height: 30px;
        }

        .wall {
            width: 100%;
            height: auto;
            background-color: #f9dc5c;
            padding-left: 40px;
            padding-right: 40px;

        }

        .hidden-navbar {
            height: 400px;
            width: 100%;
            z-index: -1;
        }

        .grid-2 {
            margin-top: 100px;
        }


        nav {
            background-color: #f9dc5c;
        }

        .banana {
            background-color: #f9dc5c;
            border: 1px solid;
            font-weight: bold;
        }

        .banana:hover {
            background-color: white;
            color: black;
            border: 1px solid black;
        }

        .in-div {
            background-color: white;
            height: 200px;
            border-radius: 10px;
        }

        img {
            object-fit: cover;
            border-radius: 20px;
        }

        .in-div {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            justify-items: center
        }
        .right{
            grid-template-columns: auto 100px;
        }
        .wall{
          
        }
    </style>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

@endsection
@section('content')
    <div class="wall">
        <div class="grid-2 row gx-2 gy-2">
            <div>
            <a href="{{ route('history') }}?process=0" 
                class="btn banana btn-category">Process</a>
                <a href="{{ route('history') }}?process=1" 
                class="btn banana btn-category">succes</a></div>
            @foreach ($orders as $order)
                <div class="col-md-4">
                    <div class="in-div bg-dark">
                        <div class="left">
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php $produk = 0;
                                    $i = 0; ?>
                                    @foreach ($order->detail as $d)
                                        <?php
                                        if ($i==0){ ?>
                                        <div class="carousel-item active">
                                            <img src={{ asset('storage/' . @$d->image) }} height="150" class="image-cart"
                                                width="150" />
                                        </div>
                                        <?php $i++; }
                                            else { ?>
                                        <div class="carousel-item">
                                            <img src={{ asset('storage/' . @$d->image) }} height="150" class="image-cart"
                                                width="150" />
                                        </div> <?php }  $produk++ ?>
                                        
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="right">
                            <div class="text" >
                                <div class="text-white">{{ $produk }} Product</div>
                                <div  class="text-white">{{$order->total_price}}</div>
                            </div>
                            <?php if ($order->processed==0) { ?>
                            <div><a href="{{route('order.show',['order'=>$order->id])}}" class="btn banana">detail</a></div>
                            <?php } else {?>
                                <div><a href="{{route('invoice',['order'=>$order->id])}}" class="btn banana">detail</a></div>
                                <?php } ?>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
@endsection
