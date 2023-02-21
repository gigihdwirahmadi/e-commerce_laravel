@extends('layouts.template2')
@section('title')
    All
@endsection
@section('style')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <style>
        .wall {
            min-height: 100vh;
            width: 100%;
            background-color: #f0f0f0;
            padding-left: 20px;

        }

        .grid-2 {
            padding-top: 100px;
            min-height: 100vh;
            width: 100%;
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
            margin: 10px 0;
            display: grid;
            grid-template-columns: 1fr 300px 1fr 1fr 70px 70px;
            ;
            height: 150px;
            border-radius: 39px;
            background: linear-gradient(145deg, #ffffff, #d8d8d8);
            box-shadow: 6px 6px 12px #d3d3d3,
                -6px -6px 12px #ffffff;
        }

        nav {
            background-color: #f9dc5c
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        .number {
            width: 50px;
            margin-right: 10px;
        }

        .image-cart {
            object-fit: cover;
            border-radius: 30px;
        }

        .image {
            display: grid;
            align-items: center;
            justify-items: center;
        }

        .text {
            display: grid;
            justify-items: center;
            align-items: center;
        }

        .addquantity,
        .reducequantity {
            background-color: #f9dc5c;
            border-radius: 20%;
            width: 30px;
            height: 30px;
            border: 1px solid;
        }

        .addquantity {
            justify-self: center;
        }

        .total {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            justify-items: center;
            align-items: center;
        }

        .total * {
            display: grid;
            justify-items: center;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
        }

        .number {
            border: none;
            width: 100%;
            margin: 10px;
            text-align: center;
            height: 60px;

        }

        .summary {
            border-radius: 20px;
            padding-left: 30px;
            height: 400px;
            width: 300px;
            position: fixed;

        }

        td input,
        td input:focus {
            width: 100px;
            border: none;
            text-align: center;
        }

        .totalprice {
            display: grid;
            justify-items: center;
            align-items: center;
        }

        .price {
            text-align: center;
            border: none;
            font-size: 20px;
            font-weight: bold;
            height: 100px;
            width: 100px;
        }

        .recaptotal {
            border: none;
            float: left;
            font-size: 25px;
        }

        input {
            background-color: transparent;
        }

        .checkbox {
            display: grid;
            align-items: center;
            justify-items: flex-start;

        }

        .table-wall {
            height: 200px;
        }

        .checkbox input {
            accent-color: black;
            color: black;
            height: 30px;
            width: 30px;
        }

        .recap {
            display: grid;
            grid-template-columns: 50% 50%;
        }

        ;

        .recap div {
            font-weight: bold;
            font-size: 20px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
@endsection
@section('content')
    <div class="wall">
        <div class="grid-2 container-fluid row">
            <div class="gx-2 col-md-8 gy-2 mt-1 gx-3">
                @foreach ($carts as $cart)
                    <div class="col">
                        <div class="in-div" id="ajax">

                            <div class="image">

                                <img src={{ asset('storage/' . @$cart->products->image) }} height="120" class="image-cart"
                                    width="150" />
                            </div>
                            <div class="text">
                                <div>
                                    <div class="title">
                                        {{ $cart->products->name }}
                                    </div>
                                    <div class="">
                                        {{ $cart->products->price }}
                                    </div>
                                    <div class="quantity">
                                        {{ $cart->products->stock }}
                                    </div>
                                </div>
                            </div>
                            <div class="total">
                                <button class="addquantity" id="add{{ $cart->id }}">+</button>
                                <div id="qtt{{ $cart->id }}">
                                    <input type="number" id="quantity{{ $cart->id }}"class="number"
                                        value="{{ $cart->quantity }}">
                                </div>
                                <button class="reducequantity" id="reduce{{ $cart->id }}">-</button>
                            </div>
                            <div class="totalprice" id="pricetotal{{ $cart->id }}">
                                <div>
                                    <input type="number" class="price" id="price{{ $cart->id }}" value=""
                                        data-price={{ $cart->products->price }}>
                                </div>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" id="btnadd{{ $cart->id }}">
                            </div>
                            <div class="checkbox">
                                <button type="button"
                                    id="identify{{ $cart->id }}"class="btn btn-dark identifyingClass"
                                    data-bs-toggle="modal" data-cart="{{ $cart->id }}" data-bs-target="#exampleModal">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="col-md-4 ">
                <form method="POST" action="{{route('order.store')}}">
                @csrf
                <div class=" summary">
                    <div class="title">Summary</div>
                    <div class="table-wall">
                        <table class="table">

                        </table>
                    </div>
                    <div class="recap">
                        <div style="font-weight: bold; font-size:20px">Total</div>
                        <div style="float: left">
                            <div style="float: left">$ <div><input type="number" class="recaptotal" name="recaptotal" id="recaptotal"
                                        value="0" width=100 style="float: left" style="outline: none" readonly>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div style="text-align: center">
                        <button class="btn btn-dark w-50" id="addcart" >buy</button>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="formmodal">
                                @csrf
                                @method('DELETE')
                                Are you sure you want to delete this cart
                                <input type="hidden" id="hiddenValue" name="id" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn banana" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-dark" value="Delete">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body2">
                      ...
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
              
        @endsection
        @section('script')
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
            <script>
                jQuery(document).ready(function($) {
                    // CREATE 
                    var addcart = new Array;
                    <?php foreach($carts as $cart){ ?>

                    $("#identify{{ $cart->id }}").click(function() {
                        var a = $('#identify{{ $cart->id }}')[0].dataset.cart;
                        console.log(a);
                        document.getElementById('formmodal').setAttribute("action", `cart/${a}`);
                        $(".modal-body #hiddenValue").val(a);
                    })


                    $("#add<?php echo $cart->id; ?>").click(function(e) {
                       
                        var q= Number(jQuery('#quantity<?= $cart->id ?>').val()) + 1;
                        
                        if (q > <?= $cart->products->stock ?>){
                            $('#exampleModal2').modal('show'); 
                        }
                        else{
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        e.preventDefault();
                        var formData = {
                            quantity: q,
                        };
                        var type = "PATCH";
                        var ajaxurl = `{{ route('cart.update', ['cart' => $cart->id]) }}`;

                        $.ajax({
                            type: type,
                            url: ajaxurl,
                            data: formData,
                            dataType: 'json',
                            success: function(data) {
                                var todo =
                                    `<input type="number" id="quantity${data[0].id}"class="number" value="${data[0].quantity}">`;
                                document.getElementById(`qtt${data[0].id}`).innerHTML = todo;
                                var script2 =
                                    `<input type="number" class="price" id="price${data[0].id}" value="${data[0].products.price*data[0].quantity}">`;
                                document.getElementById(`pricetotal${data[0].id}`).innerHTML = script2;
                                var table =
                                    `<td><input type="text" name="name[]" value="${data[0].products.name}" class="name" readonly><input type="hidden" value="${data[0].id}" name="id[]"><input type="hidden" value="${data[0].products.id} name="product_id[]"></td><td><input type="text" value=${data[0].quantity} class="quantity" name="quantity[]" readonly></td> <td><input type="text" value=${data[0].products.price* data[0].quantity} name="totalprice[]" readonly class="totalprice"></td>`;
                                console.log(data[0].id);
                                document.getElementById(`tr${data[0].id}`).innerHTML = table;
                                var total = 0;
                                for (var i = 0; i < addcart.length; i++) {
                                    var price = document.getElementById(`price${addcart[i]}`).value
                                    total += Number(price);
                                }
                                document.getElementById('recaptotal').value = total;
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                console.log(xhr);
                                alert(xhr.status);
                                alert(thrownError);
                            }
                        });
                    }
                    });
                    $("#reduce<?php echo $cart->id; ?>").click(function(e) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        e.preventDefault();
                        var formData = {
                            quantity: Number(jQuery('#quantity<?= $cart->id ?>').val()) - 1,
                        };
                        var type = "PATCH";
                        var ajaxurl = `{{ route('cart.update', ['cart' => $cart->id]) }}`;

                        $.ajax({
                            type: type,
                            url: ajaxurl,
                            data: formData,
                            dataType: 'json',
                            success: function(data) {
                                var todo =
                                    `<input type="number" id="quantity${data[0].id}"class="number" value="${data[0].quantity}">`;
                                document.getElementById(`qtt${data[0].id}`).innerHTML = todo;
                                var script2 =
                                    `<input type="number" class="price" id="price${data[0].id}" value="${data[0].products.price*data[0].quantity}">`;
                                document.getElementById(`pricetotal${data[0].id}`).innerHTML = script2;
                                var table =
                                    `<td><input type="text" name="name[]" value="${data[0].products.name}" class="name" readonly><input type="hidden" value="${data[0].id}" name="id[]"><input type="hidden" name="product_id[]" value="${data[0].products.id}"</td><td><input type="text" value=${data[0].quantity} class="quantity" name="quantity[]" readonly></td> <td><input type="text" value=${data[0].products.price* data[0].quantity} name="totalprice[]" readonly class="totalprice"></td>`;
                                console.log(data[0].id);
                                document.getElementById(`tr${data[0].id}`).innerHTML = table;
                                var total = 0;
                                for (var i = 0; i < addcart.length; i++) {
                                    var price = document.getElementById(`price${addcart[i]}`).value
                                    total += Number(price);
                                }
                                document.getElementById('recaptotal').value = total;
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                console.log(xhr);
                                alert(xhr.status);
                                alert(thrownError);
                            }
                        });
                    });
                    $("#btnadd<?php echo $cart->id; ?>").click(function(e) {
                        if (document.getElementById("btnadd<?php echo $cart->id; ?>").checked == true) {
                            addcart.push(<?php echo $cart->id; ?>)
                            var price = document.getElementById('price<?= $cart->id ?>').value;
                            var quantity = document.getElementById('quantity<?= $cart->id ?>').value;
                            $("table").append(
                                `<tr id=tr<?= $cart->id ?>><td><input type="text" value="<?= $cart->products->name?>"><input type="hidden" value="<?= $cart->id ?>" name="id[]" class="name" readonly><input type="hidden" name="product_id[]" value=<?= $cart->products->id ?>></td><td width=50> <input type="text" value =${quantity} name="quantity[]" width=50px readonly></td><td><input type="text" value =${price} name="totalprice[]" readonly class="totalprice" ></td></tr>`

                            );
                        } else {
                            const index = addcart.indexOf(<?= $cart->id ?>);
                            if (index > -1) { // only splice array when item is found
                                addcart.splice(index, 1); // 2nd parameter means remove one item only
                            }
                            console.log(addcart);
                            document.getElementById('tr<?= $cart->id ?>').remove();
                        }
                        var total = 0;
                        for (var i = 0; i < addcart.length; i++) {
                            var price = document.getElementById(`price${addcart[i]}`).value;
                            total += Number(price);
                        }
                        document.getElementById('recaptotal').value = total;



                    })
                    <?php } ?>

                });
               
            </script>
            <script>
                <?php foreach($carts as $cart){ ?>
                var price = document.getElementById('price<?php echo $cart->id; ?>');
                var quant = document.getElementById('quantity<?php echo $cart->id; ?>').value;
                price.value = (quant * price.dataset.price);
                <?php } ?>
                <?php foreach($carts as $cart){ ?>
                var add = document.getElementById('add<?php echo $cart->id; ?>');
                var min = document.getElementById('reduce<?php echo $cart->id; ?>');



                <?php } ?>
            </script>
          
        @endsection
