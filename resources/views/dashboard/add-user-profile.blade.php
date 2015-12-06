@extends('dashboard.layout')
@section('page-breadcrumb')
    Profile
@stop
@section('page-heading')
    Edit Your Profile
@stop
@section('content')
    @if(Session::has('profile-added'))
        <p class="alert alert-success">{{Session::get('profile-added')}}</p>
    @endif
    <div class="row">
        <div class="col-lg-6">
            <form action="{{route('post:user-profile-update')}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}"/>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" value="{{Auth::user()->email}}"/>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password"/>
                </div>
                <div class="form-group">
                    <label for="">Birth Date</label>
                    <input type="text" class="form-control" name="birth-date" value="{{$userProfile['birth_date']}}"/>
                </div>
                <div class="form-group">
                    <label for="">Gender</label> &nbsp;
                    <input type="radio" name="gender"  value="male" {{($userProfile->gender == 'male')? 'checked' : ''}}/> Male &nbsp;
                    <input type="radio" name="gender" value="female" {{($userProfile->gender == 'female')? 'checked' : ''}}/> Female
                </div>
                <div class="form-group">
                    <label for="">Image</label><br/>
                    @if($userProfile['image'])
                        <img src="{{asset('img/' .$userProfile['image'])}}" height="250" width="250" /><br/><br/>
                        <a href="{{route('edit-profile-image')}}" class="btn btn-primary">Edit Image</a>
                    @else
                        <a href="{{route('add-profile-image')}}" class="btn btn-primary">Add Your Image</a>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Update"/>
                </div>
            </form>
        </div>
    </div>
@stop