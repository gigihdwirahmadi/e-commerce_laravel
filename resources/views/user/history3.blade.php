@extends('layouts.template2')
@section('title')
    All
@endsection
@section('style')
    <style>
        .yellow {

            height: 30px;
        }

        .wall {
            min-height: 100vh;
            width: 100%;
            background-color: #f0f0f0;

        }

        .hidden-navbar {
            height: 400px;
            width: 100%;
            z-index: -1;
        }

        .grid-2 {
            padding-top: 100px;
        }

    </style>
@endsection
@section('content')
    <div class="wall">


        <div class="grid-2 container-fluid">
            <div class="row gx-2 gy-2 mt-1">

                @foreach ($orders as $order)
                {{-- {{dd($order->detail[0]->image)}} --}}
                    {{-- {{dd(asset('storage/'.$product->Imageprimary->pluck('image')->toArray()))}} --}}
                    <div class="col-sm-2 product-menu" style="height:350px">
                        <div>
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">ldsjfkla
                                    @foreach ($order->detail as $d)
                                  <div class="carousel-item">
                                    <img src={{ asset('storage/' . @$d->image) }} height="150" class="image-cart"
                                    width="150" />
                                  </div>
                                  @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Next</span>
                                </button>
                              </div>
                            {{-- <div class="text text-black" style="text-align: center; font-weight:bold; font-size:20px">
                                {{ $product->price }}</div>
                            <div class="text text-black" style="text-align: center;">{{ $product->name }}</div>
                            <div style="padding-left:20px;padding-right:20px; padding-top:10px"> --}}
                                {{-- <a class="btn banana"href="{{ route('detail', ['product' => $product->id]) }}"
                                    style="width:100%">Detail</a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const params = new URLSearchParams(window.location.search)
       
        for (const param of params) {
            
            if (param[0] == "category") {
               var button=document.getElementById(`button${param[1]}`)
               button.classList.add("active");
               die();
            }
            
                console.log("masuk");
                var button=document.getElementById(`buttonall`)
               button.classList.add("active");
            
        }

        function search() {
            var src = document.getElementById('search').value;
            window.location.href = `{{ route('all') }}?src=${src}`;
        }
    </script>
@endsection
