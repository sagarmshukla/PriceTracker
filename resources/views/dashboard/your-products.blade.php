@extends('dashboard.layout')
@section('page-breadcrumb')
    Dashboard
@stop
@section('page-heading')
    Choose your target Price
@stop
@section('content')
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr class="warning">
                <th>Product</th>
                <th>Price</th>
                <th>Your Target Price</th>
                <th>Store</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->getCurrentPrice($product->id)}}</td>
                <td>{{$product->target_price}}</td>
                <td>{{$product->getStore($product->id)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop