@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row card">
        <div class="card-header">Delete Account</div>
        <div class="card-body">
            <p>Are you sure you want to delete your account ?</p>
            <a href="{{ route('deleteAccount') }}" class="btn btn-outline-danger">Delete</a>
        </div>
    </div>
</div>

@endsection