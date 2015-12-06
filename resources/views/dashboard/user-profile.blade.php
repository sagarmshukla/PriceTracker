@extends('dashboard.layout')
@section('page-breadcrumb')
    User-profile
@stop
@section('page-heading')
    Your Profile &nbsp; <a href="{{route('add-your-profile')}}"><i class="fa fa-pencil-square-o"></i></a>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-6">
            @if ($errors->has())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            @if(Session::has('profileUpdate'))
                <p class="alert alert-success">{{Session::get('profileUpdate')}}</p>
            @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <td>Name</td>
                            <td>{{Auth::user()->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{Auth::user()->email}}</td>
                        </tr>
                        <tr>
                            <td>Birth Date</td>
                            <td>{{$userProfile['birth_date']}}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{$userProfile['gender']}}</td>
                        </tr>
                        <tr>
                            <td>image</td>
                            @if($userProfile['image'])
                                <td><img src="{{asset('img/' .$userProfile['image'])}}" height="300" width="300" />&nbsp;&nbsp;</td>
                            @endif
                        </tr>
                        <tr>
                            <td>
                                <a href="{{route('deactivate-account')}}" class="btn btn-primary">Deactivate My Account</a>
                            </td>
                        </tr>
                    </table>
                </div>
        </div>
    </div>
@stop