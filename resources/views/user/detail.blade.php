@extends('layouts.template2')
@section('title')
    Home
@endsection
@section('style')
    <style>
        .for-banana-button {
            display: grid;
            justify-content: center;

        }

        body {
            background-color: #f9dc5c;
        }

        nav {
            background-color: #f9dc5c;
            display: flex;
            align-content: center;
            justify-content: center;
        }

        .wall {
            border-radius: 30px;
            height: 500px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .box-image {}

        .image {
            margin-top: 30px;
            background-color: white;
            border-radius: 20px;
            display: grid;
            align-items: center;
            justify-items: center;
            border: 1px solid;
        }

        .banana {
            color: black;
            background-color: #f9dc5c;
            border: 1px solid;
            font-weight: bold;
            margin-top: 10px;
            width: 100px;
        }

        .caro-image {
            object-fit: cover;
        }

        .text div {
            padding-left: 5px
        }

        .title {
            font-weight: bold;
            font-size: 40px
        }

        .price {
            font-size: 25px
        }

        /* .text {
            padding-left: 40px;
        } */

        .desc {
            height: 200px;
            overflow: scroll;
            overflow-x: hidden;

        }

        .input {
            width: 100px;
            height: 40px;
        }

        ::-webkit-scrollbar {
            width: 0;
            /* Remove scrollbar space */
            background: transparent;
            /* Optional: just make scrollbar invisible */
        }

        /* Optional: show position indicator in red */
        ::-webkit-scrollbar-thumb {
            background: #FF0000;
        }

        .comment {
            background-color: white;
            border-radius: 20px;
            display: grid;
            grid-template-rows: 30px auto;
            padding: 20px;
        }

        .image {
            position: fixed;

        }

        img {
            border-radius: 30px
        }

        .comment-bar {
            margin-top: 30px;
        }
        .comment{
            margin-top:10px;
        }
        .comment div{
            padding-left:20px;
        }
    </style>
@endsection
@section('content')
    <div class="wall container">
        <div class="image">
            <div class="cover-image">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($product->Image as $img)
                            <?php if ($img->is_primary == 1) { ?>
                            <div class="carousel-item active">
                                <img src=" {{ asset('storage/' . $img->image) }}" class="d-block w-70 caro-image"
                                    height='400' width="400" style="object-fit:cover"alt="...">
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
            </div>
        </div>
        <div></div>
        <div class="text">
            <div class="title">{{ $product->name }} </div>
            <div class="price" style="color: white; background-color: black">{{ $product->price }} </div>
            <div style="padding-top:20px;padding-bottom:10px"> <button class="btn btn-transparent" onclick="buttondesc()"
                    id="btn-desc">Description</button><button id="btn-comment" class="h btn btn-transparent"
                    onclick="buttoncomment()">Comment</button>
                <div class="desc" id="desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, iure
                    labore praesentium
                    exercitationem consequuntur non vel laborum dolorum voluptatum ullam reiciendis velit dolore aliquam
                    modi
                    soluta sint vitae aspernatur a eligendi minima esse aperiam? Omnis magnam possimus veritatis voluptatem.
                    Tenetur consequuntur repellat tempora vero aliquid pariatur eum iste distinctio. Recusandae, placeat
                    rem,
                    accusamus quibusdam tenetur porro in veniam excepturi, minima eligendi laborum hic asperiores nobis
                    exercitationem vitae corporis! Doloribus tenetur eaque, quas nam laborum totam autem illo nulla itaque
                    commodi harum quos, libero recusandae adipisci iusto perspiciatis incidunt similique excepturi
                    repellendus
                    eveniet cupiditate veritatis. Sapiente itaque voluptates adipisci facilis ad.</div>
                <div style="padding-top: 20px" id="btn">
                    <form method="post" action="{{ route('cart.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" class="input">
                        <button class="btn btn-dark">ADD</button>
                    </form>
                </div>
                <div class="comment-bar" id="comment-bar">
                    @foreach ($review as $item)
                    <div class="comment">
                        <div style="font-weight: bold; font-size:15px;">{{$item->users->name}}</div>
                        <div style="font-size:15px">{{$item->comment}}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script>
            document.getElementById("comment-bar").style.display = "none";
            document.getElementById('btn-desc').style.border = "1px solid"

            function buttoncomment() {
                document.getElementById('btn-comment').style.border = "1px solid"
                document.getElementById('btn-desc').style.border = "none"
                document.getElementById("desc").style.display = "none";
                document.getElementById("btn").style.display = "none";
                document.getElementById("comment-bar").style.display = "block";
            }

            function buttondesc() {
                document.getElementById('btn-desc').style.border = "1px solid"
                document.getElementById('btn-comment').style.border = "none"
                document.getElementById("comment-bar").style.display = "none";
                document.getElementById("btn").style.display = "block";
                document.getElementById("desc").style.display = "block";
            }
        </script>
    @endsection
