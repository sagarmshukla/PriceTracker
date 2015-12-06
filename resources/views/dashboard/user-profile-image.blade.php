@extends('dashboard.layout')
@section('page-breadcrumb')
    User-profile
@stop
@section('page-heading')
    {{(Route::is('add-profile-image'))? 'Add' : 'Edit'}} Your Profile Image
@stop
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form action="{{(Route::is('add-profile-image'))? route('post:add-your-profile') :route('post:edit-profile-image')}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <label for="">Image</label>
                <div>
                    <input type="file" class="form-control" name="image"/>
                </div>
                <br/>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="{{(Route::is('add-profile-image'))? 'Add' : 'Edit'}}"/>
                </div>
            </form>
        </div>
    </div>
@stop