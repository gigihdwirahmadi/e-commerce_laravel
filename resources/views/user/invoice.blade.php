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
            display: grid;
            padding-right: 40px;
            grid-template-columns: 1fr 2fr;

        }

        .summary {
            height: 500px;
            border-radius: 20px;
            margin-right: 20px;
            width: 100%;
            background-color: white;
            border: 1px solid;
            padding-top: 40px;
            padding-left: 20px;
        }

        .hidden-navbar {
            height: 400px;
            width: 100%;
            z-index: -1;
        }

        .grid-2 {
            margin-top: 80px;
            border: 1px solid;
            background-color: white;
            height: 80%;
            width: 100%;
            padding: 40px;
            border-radius: 20px;
            display: grid;
            grid-template-rows: 50px auto;
        }

        .grid-1 {
            margin-top: 80px;

            padding-right: 30px;
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

        .item {
            display: grid;
            grid-template-columns: 160px 4fr 1fr;
            height: 150px;
        }

        .center {
            display: grid;
            align-items: center;
            justify-items: center;
            height: 100%;
        }

        .title {
            text-align: center;
            margin: 10px;
            font-weight: bold;
            font-size: 20px;
        }

        .bottom {}

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

        .left {
            display: grid;
            align-items: center;
            justify-items: flex-end;
        }

        body {
            background-color: #f9dc5c
        }

        .fa-star {
            color: gray;
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@endsection
@section('content')
    <div class="wall container">
        <div class="grid-1">
            <div class="summary">
                <div class="title">Summary</div>
                <div class="table-summary">
                    <table class="table">
                        <tr>
                            <td>Processed</td>
                            <td>{{ $order->processed }}</td>
                        </tr>
                        <tr>
                            <td>Payment-type</td>
                            <td>{{ $order->payment_type }}</td>
                        </tr>
                        <tr>
                            <td>transaction status</td>
                            <td>{{ $order->transaction_status }}</td>
                        </tr>
                        <tr>
                            <td>Delivery Status</td>
                            <td>{{ $order->delivery_status }}</td>
                        </tr>
                        <tr>
                            <td>transaction time</td>
                            <td>{{ $order->transaction_time }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="grid-2">
            <div class="top">

                <div>
                    <div style="font-size: 15px; font-weight:bold">{{ $titem }} Item</div>
                    <div style="font-size: 15px;">{{ $tproduk }} Produk</div>
                </div>
                <div class="left">
                    total
                    <div style="font-size: 20px; font-weight:bold">{{ $order->total_price }}</div>
                   
                </div>
            </div>
            <div class="bottom">
                @foreach ($details as $d)
                    <div class="item">
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
                            <div style="font-weight: bold; font-size:30px">${{ @$d->showproduct->price * $d->quantity }}
                            </div>
                            <div>{{ $d->quantity }} item</div>
                            <?php if ($order->delivery_status =="finish") { ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" id="reviewbtn{{ $d->showproduct->id }}"
                                data-product="{{ $d->showproduct->id }}">Give Review</button>
                                <?php } ?>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formmodal" action="{{ route('review.store') }}" method="POST">
                            @csrf
                            <div id="hidden"></div>
                            @error('product_id')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <div class="mb-3">
                                <i class="fa-solid fa-star" id="str1" data-num="1"></i> <i class="fa-solid fa-star"
                                    id="str2" data-num="2"></i> <i class="fa-solid fa-star" data-num="3"
                                    id="str3"></i> <i class="fa-solid fa-star" id="str4" data-num="4"></i> <i
                                    class="fa-solid fa-star" id="str5" data-num="5"></i>
                                <input type="hidden" class="form-control" name="rating" id="rating" value="{{ old('rating') }}">
                                @error('rating')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Comment:</label>
                                <textarea class="form-control" name="comment" id="message-text" value="{{ old('comment') }}"></textarea>
                                @error('comment')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-dark" value="Submit">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script>
            $(`.fa-star`).click(function() {

                for (var i = 1; i < 6; i++) {
                    document.getElementById(`str${i}`).style.color = "grey";
                }
                var a = this.dataset.num;
                console.log(a);
                document.getElementById('rating').value = a;
                for (var i = a; i > 0; i--) {
                    document.getElementById(`str${i}`).style.color = "black";
                }
            })

            <?php foreach ($details as $d) {?>
            $("#reviewbtn{{ $d->showproduct->id }}").click(function() {
                var a = $('#reviewbtn{{ $d->showproduct->id }}')[0].dataset.product;
                document.getElementById('hidden').innerHTML =
                    "<input type='hidden' name='product_id' value='{{ $d->showproduct->id }}'>";
                console.log(document.getElementById('hidden'));
                document.getElementById('exampleModalLabel').innerHTML = "{{ $d->showproduct->name }} Review";
                console.log(a);
                $(".modal-body #hiddenValue").val(a);
            })
            <?php } ?>
        </script>
    @endsection
