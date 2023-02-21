@extends('layouts.templateadmin')
@section('title')
    order
@endsection
@section('style')
    <style>
        table tr td,
        table tr th {
            font-size: 15px;
        }

        .box {
            border-radius: 10px;
            background: linear-gradient(315deg, #e6d787, rgb(255, 239, 150));
            -webkit-box-shadow: 0 0 30px #7e7653;
            box-shadow: 0 0 30px #7e7653;
            height: auto;
        }

        th,
        td {
            border-bottom: 1px solid black;
        }

        .ov {
            overflow: scroll;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 0;
            /* Remove scrollbar space */
            background: transparent;
            /* Optional: just make scrollbar invisible */
        }
        /* Optional: show position indicator in red */
        .container::-webkit-scrollbar { /* WebKit */
    width: 0;
    height: 0;
}
    </style>
@endsection
@section('content')
    <a href="{{ route('product.create') }}" class="btn btn-dark ">add</a>
    <div class="container-fluid bg-white box pt-3 mt-2" style="height: auto; width:100%">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>name</th>
                    <th>total_price</th>
                    <th>processed</th>
                    <th>payment_type</th>
                    <th>transaction_status</th>
                 
                    <th>delivery_status</th>
                    <th>delivery_address</th>
                    <th>option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
               
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>{{ $order->processed }}</td>
                        <td>{{ $order->payment_type }}</td>
                        <td>{{ $order->transaction_status }}</td>
                        <td>{{ $order->delivery_status }}</td>
                        <td>{{ $order->delivery_address }}</td>
                        <td><a href="{{ route('order.detail', ['order' => $order->id]) }}"
                                style="float: left; margin-right:10px" class="btn button">edit</a>
                            <form method="POST" action="{{ route('order.destroy', ['order' => $order->id]) }}">
                                @method('DELETE')
                                @csrf
                                <button class="btn dark">delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
