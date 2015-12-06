@extends('dashboard.layout')
@section('page-breadcrumb')
    Dashboard
@stop
@section('page-heading')
    Know Your Price
@stop
@section('content')
    <div class="row">
        <div class="col-md-6">
            @if(Session::has('data-inserted'))
                <p class="alert alert-success">{{Session::get('data-inserted')}}</p>
            @endif
            @if(Session::has('notify'))
                <p class="alert alert-success">{{Session::get('notify')}}</p>
            @endif
            <form action="{{route('findprice')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="">URL</label>
                    <input type="text" name="url" class="form-control" placeholder="Enter URL"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@stop