@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex ">
        <div id="main" data-user="{{ json_encode($user) }}" data-all-users="{{ json_encode($users) }}"></div>
    </div>
</div>
@endsection
