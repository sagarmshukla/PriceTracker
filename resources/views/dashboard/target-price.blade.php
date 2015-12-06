@extends('dashboard.layout')
@section('page-breadcrumb')
    Dashboard
@stop
@section('page-heading')
    Update your target Price
@stop
@section('content')
<div class="row">
    @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif
    <div class="col-md-4">
        <label for="">Store</label>
    </div>
    <div class="col-md-1"> : </div>
    <div class="col-md-7 text-left">
        <b style="text-transform: uppercase;">{{$product->getStore($product->id)}}</b>
    </div>
    <span class="clearfix"></span>
</div>
<hr/>
<div class="row">
    <div class="col-md-4">
        <label for="">Product</label>
    </div>
    <div class="col-md-1"> : </div>
    <div class="col-md-7 text-left">
        <b style="text-transform: uppercase;">{{$product->name}}</b>
    </div>
    <span class="clearfix"></span>
</div>
<hr/>
<div class="row">
    <div class="col-md-4">
        <label for="">Image</label>
    </div>
    <div class="col-md-1"> : </div>
    <div class="col-md-7 text-left">
        <img src="{{$product->image}}" alt="" class="img-responsive" height="150px;" width="150px;"/>
    </div>
    <span class="clearfix"></span>
</div>
<hr/>
<div class="row">
    <div class="col-md-4">
        <label for="">Current Price</label>
    </div>
    <div class="col-md-1"> : </div>
    <div class="col-md-7 text-left">
        <b style="text-transform: uppercase;">{{$product->getCurrentPrice($product->id)}}</b>
    </div>
    <span class="clearfix"></span>
</div>
<hr/>
<div class="row">
{{--<form action="{{route('post:target-price', $product->id)}}" method="post">--}}

<form action="{{isset($editTargetPrice)? route('post:update-target-price', $product->id) : route('post:target-price', $product->id)}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Target Price</label>
            <input type="text" name="target_price" class="form-control" placeholder="Enter Your Target Price" value="{{isset($editTargetPrice)? $editTargetPrice['target_price'] : '' }}"/>
        </div>
    </div>
    <div class="col-md-6" style="padding-top: 25px;">
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
</form>
</div>
@stop