@extends('dashboard.layout')
@section('page-breadcrumb')
    Dashboard
@stop
@section('page-heading')
    Update your target Price
@stop
@section('content')
    @if(Session::has('delete-product'))
        <p class="alert alert-success">{{Session::get('delete-product')}}</p>
    @endif
    @if(Session::has('update-product-price'))
        <p class="alert alert-success">{{Session::get('update-product-price')}}</p>
    @endif
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr class="warning">
            <th>Product</th>
            <th>Price</th>
            <th>Your Target Price</th>
            <th>Store</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->getCurrentPrice($product->id)}}</td>
                <td>{{$product->target_price}}</td>
                <td>{{$product->getStore($product->id)}}</td>
                <td>
                    <a href="{{route('edit-target-price', $product['id'])}}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" style="font-size: large"></i>Edit</a> |
                    <a href="{{route('delete-your-products', $product['id'])}}" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o" style="font-size: large"></i>Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop