@extends('layouts.app')

@section('content')



{{-- <div class="container ">
    <div class="row">
        <div class="col text-center">
            Tableau de bord
        </div>
    </div>
    <div class="row">
        <div class="col text-end">
            Modifier
        </div>
    </div>
    <div class="row">
        <div class="col">
            Photo
        </div>
        <div class="col ">
            <div class="p-3">
                <div class="row">
                    <div class="col">
                         Information ;

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        nom :

                   </div>

                </div>
                <div class="row">
                    <div class="col">
                        mail :

                   </div>
                </div>
            </div>

        </div>
        <div class="col">
            Prenom :
        </div>
    </div>
</div> --}}

<div class="container mt-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="bg-secondary text-white py-3 rounded">
                <h2>Tableau de bord</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- User Section -->
        <div class="col-md-4 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="rounded-circle bg-secondary mx-auto mb-3" style="width: 100px; height: 100px;">
                        <img src="{{asset('/storage/images/'.Auth::user()->image)}}" class="rounded-circle user-img-big" alt="">
                    </div>
                    <a href="{{ route('userimg') }}" class="btn btn-outline-secondary">Edit</a>
                    <h4 class="fw-bold mt-3">{{ $user->name }}</h4>
                    <p>{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Information Section -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-outline-secondary">
                            Modifier <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>
                    <h5>Informations :</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nom : {{ $user->name }}</strong></p>

                        </div>
                        <div class="col-md-6">
                            <p><strong>Mail : {{ $user->email }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--
<!-- Titre -->
<section>
    <div style="text-align: center">
        <h1 >
            Dashboard
        </h1>
    </div>
</section>

 <!-- zone d'information utilisateur -->
<section class="d-flex justify-content-evenly" class="mt">
    <!-- pp de profil -->
    <div>
        <section class="d-flex  justify-content-end flex-direction: column">
            <button class="btn btn-secondary invisible">Modifier</button>
        </section>
        <div style="border: 3px solid black; width: 150px; height: 150px;" class="d-flex mt-5">

        </div>
    </div>

    <!-- informations personnelles -->
    <div style="width: 900px; height: 800px;" class="mt-">
        <section class="d-flex  justify-content-end flex-direction: column">
            <button class="btn btn-secondary">Modifier</button>
        </section>
        <div style="border: 3px solid black; width: 100%; height: 100%;" class="mt-5">
        </div>
    </div>
</section> --}}

@endsection
