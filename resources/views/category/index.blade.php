@extends('layouts.templateadmin')
@section('title')
    Login
@endsection
@section('style')
    <style>
.box{
    border-radius: 10px;
background: linear-gradient(315deg, #e6d787, rgb(255,239,150));
-webkit-box-shadow: 0 0 30px  #7e7653;
        box-shadow:  0 0 30px  #7e7653;
height: auto;
            }

           </style>
@endsection
@section('content')
<a href="{{route('category.create')}}" class="btn btn-dark ">add</a> <a href="{{route('product.index')}}" class="btn btn-dark ">Product</a>
<div class="container-fluid bg-white box pt-3 mt-2" style="height: 30vh; width:100%">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>title</th>
            <th>description</th>
            <th>created_at</th>
            <th>option</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td>{{$category->created_at}}</td>
                <td><a href="{{route('category.edit',['category'=>$category->id])}}" style="float: left; margin-right:10px" class="btn btn-dark">edit</a>
                <form method="POST" action="{{route('category.destroy',['category'=>$category->id])}}">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-dark">delete</button>
                </form></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

