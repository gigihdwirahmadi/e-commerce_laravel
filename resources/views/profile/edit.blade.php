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
            width: 100%;
            height: auto;
            display: grid;
            grid-template-columns: 2fr 4fr 2fr;
            height: 100vh;
            padding: 0;
        }


        nav {
            background-color: transparent;
        }

        .grid-1 {
            background-color: #f9dc5c;
            display: grid;
            padding-top: 50px;
            justify-items: center;
            ;

        }

        .avatar {
            height: 300px;
            width: 300px;
            border-radius: 50%;
            background-color: black;
        }

        .name {
            font-weight: bold;
            padding-top: 30px;
            font-size: 25px;
            text-align: center
        }

        .role {
            font-size: 18px;
            text-align: center
        }

        .grid-2 {
            background-color: white;
            padding-left:30px;
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

        .title {
            font-size: 25px;
            font-weight: bold;
            margin-top: 50px;
        }
        .w-table{
            margin-top: 60px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@endsection
@section('content')
    <div class="wall">
        <div class="grid-1">
            <div>
                <div class="avatar"></div>
                <div class="name">GIGIH DWI RAHMADI</div>
                <div class="role">user</div>
            </div>
        </div>
        <div class="grid-2 row gx-2 gy-2">
            <div>
            <div class="title">PROFILE PAGE</div>
            <div class="w-table">
                <form action="" method="POST">
                <table class="table">
                    <tr>
                        <td><label for="exampleFormControlInput1" class="form-label">Name</label></td>
                        <td>
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="name">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="exampleFormControlInput2" class="form-label">Email</label></td>
                        <td>
                            <input type="email" class="form-control" name="email" id="exampleFormControlInput2" placeholder="email">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="exampleFormControlInput3" class="form-label">Phone</label></td>
                        <td>
                            <input type="text" class="form-control" name="phone" id="exampleFormControlInput3" placeholder="phone">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="exampleFormControlInput1" class="form-label">Address</label></td>
                        <td>
                            <input type="text" name="address" class="form-control" id="exampleFormControlInput1" placeholder="adress">
                        </td>
                    </tr>
                </table>
                <div style="text-align: right">
                <button class="btn banana">Edit</button>

                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
