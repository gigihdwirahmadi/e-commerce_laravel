<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    </style>

    {{-- style dan bootstrap --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>
<style>
    body{
        background: rgb(255, 239, 150);
    }
    * {
        font-family: 'Poppins', sans-serif;
    }

    .grid {
        display: grid;
        grid-template-columns: 250px auto;
    }

    .admin-bar {
        margin: 0;
        padding: 20px;

    }

    nav {}

    .grid {
        background: rgb(255, 239, 150);

    }

    .nav-header {

        display: grid;
        align-items: center;
        align-content: center;
        height: 100px;
        width: 100%;
    }

    .menu-wall {
        display: grid;
        grid-template-columns: 40px auto;
    }

    .admin-menu {
        color: white;
        text-decoration: none;
        display: grid;
        align-items: center;
        align-content: center;
        height: 50px;
        padding-left: 10%;
        width: 100%;
        margin-bottom: 20px;
    }

    .admin-menu:hover {
        border-radius: 58px;
        background: #e6d787;
        box-shadow: inset 35px 35px 33px #bdb06f,
            inset -35px -35px 33px #fffe9f;
        color: black;
    }

    .dark,.dark:hover {
        border-radius: 18px;
        background: linear-gradient(145deg, #444441, #51514d);
        box-shadow: 14px 14px 28px #bdb06f,
            -14px -14px 28px #fffe9f;
        color: white
    }

    .button {
        border-radius: 18px;
        background: linear-gradient(145deg, #cfc27a, #f6e690);
        box-shadow: 14px 14px 28px #bdb06f,
            -14px -14px 28px #fffe9f;
        font-weight: bold;
    }
    .button:hover {
        border-radius: 18px;
        background: linear-gradient(145deg, #cfc27a, #f6e690);
        box-shadow: 14px 14px 28px #bdb06f,
            -14px -14px 28px #fffe9f;
        font-weight: bold;
        border: 1px solid;
    }
</style>
@yield('style')

<body>

    <div class="container-fluid grid" style="width:100%; height:100vh; margin:0; padding:0">
        <div class="admin-bar bg-dark fixed-top" style="width: 250px; height:100%">
            <a class="nav-header"></a>
            <div class="menu-wall">
                <div class="half-circle"></div>
                <a href="{{ Route('product.index') }}" class="admin-menu">Product</a>
                <div class="half-circle"></div>
                <a href="{{ Route('category.index') }}" class="admin-menu">Category</a>
                <div class="half-circle"></div>
                <a href="#" class="admin-menu">Transaction</a>
                <div class="half-circle"></div>
                <a href="#" class="admin-menu">Order</a>
            </div>
        </div>
    <div></div>
        <div class="content-side">
            @include('layouts.navigation2')

            <div class="content mx-5 ">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.footer')
