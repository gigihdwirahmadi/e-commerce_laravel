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
            background-color: #f9dc5c;

        }

        .hidden-navbar {
            height: 400px;
            width: 100%;
            z-index: -1;
        }

        .grid-2 {
            margin-top: 80px;
            background-color: white;
            width: 60%;
            min-height: 300px;
            padding: 40px;
            border-radius: 20px;
            display: grid;
            grid-template-rows: 50px auto;
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

        img {
            object-fit: cover;
        }

        .name {
            text-justify: center;
            height: auto;
        }

        .center {
            display: grid;
            align-items: center;
            justify-items: center;
            height: 100%;
        }

        .bottom {
            display: grid;
            grid-template-columns: 160px 4fr 1fr;
        }

        .item2,
        .item3 {
            display: grid;
            padding-top: 50px;
            padding-left: 30px;
        }

        .item3 {
            display: grid;
            grid-template-rows: 1fr 30px;
        }

        .nameproduct {
            font-weight: bold;
            font-size: 20px;
        }

        .top {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .left{
            display: grid;
            align-items: center;
            justify-items: flex-end;
        }
    </style>
@endsection
@section('content')
    <div class="wall">
        <div class="grid-2 container-fluid">
            <div class="top">

                <div>
                    <button id="pay-button" class="btn btn-dark">Pay</button>
                    <form action="" id="submit_form" method="POST">
                        @csrf
                        <input type="hidden" name="json" id="json_callback">
                    </form>
                </div>
                <div class="left">
                    total
                    <div style="font-size: 20px; font-weight:bold">{{ $order->total_price }}</div>
                    
                </div>
            </div>
            <div class="bottom">


                @foreach ($details as $d)
                    <div class="item1">

                        <img src={{ asset('storage/' . @$d->showproduct->image) }} height="150" class="image-cart"
                            width="150" />
                    </div>
                    <div class="item2">
                        <div>
                            <span class="nameproduct">{{ @$d->showproduct->name }}</span><br>
                            {{ @$d->showproduct->price }}/unit

                        </div>
                    </div>
                    <div class="item3">
                        <div style="font-weight: bold; font-size:30px">${{ @$d->showproduct->price * $d->quantity }}</div>
                        <div>{{ $d->quantity }} item</div>
                    </div>
                @endforeach

            </div>
        </div>
    @endsection
    @section('script')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
        </script>
        <script>
            const payButton = document.querySelector('#pay-button');
            payButton.addEventListener('click', function(e) {
                e.preventDefault();

                snap.pay('{{ $snapToken }}', {
                    // Optional
                    onSuccess: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result);
                        window.location.href='{{route("all")}}';

                    },
                    // Optional
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result)

                    },
                    // Optional
                    onError: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result)

                    }
                });

            });
           
        </script>
    @endsection
