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
        .b2{
            display:grid;
            margin-top:30px;
            margin-bottom:30px;
            grid-template-rows: 60px auto;
        }
        .top{
            
        }
        .item{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            align-items: center;
            height: 150px;
            justify-items: center
        }
        img{
            border-radius: 20px;
        }
        th,
        td {
            border-bottom: 1px solid black;
        }
        .name{
            align-self: center;
            justify-self: center;
            font-size:20px;
            font-weight:bold;
        }
        .quantity{
            font-size: 30px;
            font-weight: bold;
            float: left;
        }
        .total{
            text-align: right;
            font-size: 20px;
        }
        .number{
            font-size: 35px;
        }
        .q{
            font-size: 20px
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid" style="height: 100vh; width:100%">
        <div class="card p-4 box">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{ $order[0]->user->name }}</td>
                </tr>
                <tr>
                    <td>User email</td>
                    <td>{{ $order[0]->user->email }}</td>
                </tr>
                <tr>
                    <td>Payment type</td>
                    <td>{{ $order[0]->payment_type }}</td>
                </tr>
                <tr>
                    <td>Processed</td>
                    <td>{{ $order[0]->processed }}</td>
                </tr>
                <tr>
                    <td>transaction_status</td>
                    <td>{{ $order[0]->transaction_status }}</td>
                </tr>
                <tr>
                    <td>transaction_time</td>
                    <td>{{ $order[0]->transaction_time }}</td>
                </tr>
                <tr>
                    <td>settlement_time</td>
                    <td>{{ $order[0]->settlement_time }}</td>
                </tr>
                <tr>
                    <td>delivery_status</td>
                    <td><select class="form-select" aria-label="Default select example" id="form">
                            <option value="waiting" <?php if ($order[0]->delivery_status=="waiting") {echo "selected";} ?>>waiting</option>
                            <option value="packing"  <?php if ($order[0]->delivery_status=="packing") {echo "selected";} ?>>packing</option>
                            <option value="delivery"  <?php if ($order[0]->delivery_status=="delivery") {echo "selected";} ?>>delivery</option>
                            <option value="finish"  <?php if ($order[0]->delivery_status=="finish") {echo "selected";} ?>>finish</option>
                      </select></td>
                </tr>
                <tr>
                    <td>delivery_address</td>
                    <td>{{ $order[0]->delivery_address }}</td>
                </tr>
            </table>
        </div>
        <div class="card p-4 box b2">
            <div class="top">
                <div class="quantity">{{$tproduk}} Product</div>
                <div class="total">{{$order[0]->total_price}}<br>{{$titem}} Item</div>
            </div>
            <div class="bottom">
                @foreach ($order[0]->Detail as $detail)
                    
               <hr>
                <div class="item">
                    <div class="image"><img src="{{asset('storage/'.$detail->image)}}" height="150" width="150"></div>
                    <div class="name">{{$detail->name}}</div>
                    <div class="price">
                        <div class="number">{{$detail->price*$detail->quantity}}</div>
                        <div class="q">{{$detail->quantity}}</div>
                    </div>
                </div>
                @endforeach
                <hr>
            </div>
        @endsection
        @section('script')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script>
        $("#form").change(function(e) {
                       console.log('ada');
            var q= jQuery('#form').val();
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            e.preventDefault();
            var formData = {
                delivery_status: q,
            };
            var type = "PATCH";
            var ajaxurl = `{{ route('order.status', ['order' => $order[0]->id]) }}`;
            console.log(formData);
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                success: function(data) {
                  console.log(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
        );
        </script>
        @endsection
