@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row card">
            <div class="card-header">Profile Image</div>
            <div class="card-body d-flex justify-content-center">
                <img class="image user-img " src="{{asset('/storage/images/'.Auth::user()->image)}}" alt="profile_image_user_{{Auth::user()->name}}">
            </div>
            <div class="card-footer d-flex justify-content-center">
                <form action="{{route('sendimg')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <p>Upload Image (max size 10Mo)</p>
                    <input type="file" name="image">
                    <input type="submit" value="Upload">
                </form>
            </div>
        </div>
    </div>


@endsection