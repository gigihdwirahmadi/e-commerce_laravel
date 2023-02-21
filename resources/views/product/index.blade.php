@extends('layouts.templateadmin')
@section('title')
    Product
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
                    <th>title</th>
                    <th>description</th>
                    <th>sku</th>
                    <th>stock</th>
                    <th>unit</th>
                    <th>weight</th>
                    <th>price</th>
                    <th>image</th>
                    <th>category</th>
                    <th>active</th>
                    <th>option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
               
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td class="description"> {!! substr($product->description,0,50) !!}..</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->unit }}</td>
                        <td>{{ $product->weight }}</td>
                        <td>{{ $product->price }}</td>
                        <td style="max-width: 100px; overflow-x:scroll" class="ov">
                            <?php $a=( $product->Image->pluck('image')->toArray());
                            foreach ($a as $image ) { ?>
                                <img src=" {{ asset('storage/'.$image) }}" style=" object-fit: cover; width:50px; height:50px" >
                           <?php }
                            ?></td>
                        <td>{{ $product->categories->name }}</td>
                        <td>{{ $product->is_active }}</td>
                        <td><a href="{{ route('product.edit', ['product' => $product->id]) }}"
                                style="float: left; margin-right:10px" class="btn button">edit</a>
                            <form method="POST" action="{{ route('product.destroy', ['product' => $product->id]) }}">
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
