@extends('layouts.app')

@section('content')

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-3 mt-md-4">

                            <h2 class="fw-bold mb-2 text-uppercase">{{ __('Mofication user : ') }}</h2>
                            <p class="text-white-50 mb-5">Veuillez remplir les champs pour modifier.</p>

                            <form method="POST" action="{{ route('update') }}">
                            @csrf

                                <!-- Partie nom -->
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="name">{{ __('Name') }} : </label>
                                    <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('email', $user->name) }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Partie mail -->
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="email">{{ __('Email Address') }} :</label>
                                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Bouton de soumission -->
                                <button class="btn btn-outline-light btn-lg px-5 mt-4" type="submit">{{ __('Modifier') }}</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
