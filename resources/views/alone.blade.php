@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-bold">Aucun autre utilisateur n'a été trouvé</h5> 
            <p class="card-text">Il semble que vous êtes tout seul ! Recomendez cette application à vos amis et peut-être que vous pourrez commencer à chatter :)</p>
            <a href="{{ route('welcome')}}" class="btn btn-outline-primary">Partager</a>
        </div>
    </div>
</div>

@endsection