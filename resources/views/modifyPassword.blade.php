@extends('layouts.app')

@section('content')

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-3 mt-md-4">

                            <h2 class="fw-bold mb-2 text-uppercase">{{ __('MODIFIER LE MOT DE PASS') }}</h2>
                            <p class="text-white-50 mb-5">Veuillez remplir les champs pour modifier.</p>

                            <form method="POST" action="{{ route('updatePassword') }}">
                                @csrf
                                @method('PUT')

                                <!-- Mot de passe actuel-->
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="current_password">{{ __('Current Password') }} : </label>
                                    <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current-password">
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Nouveau mot de passe -->
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="new_password">{{ __('New Password') }} : </label>
                                    <input id="new_password" type="password" class="form-control form-control-lg @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new-password">
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Confirmation du nouveau mot de passe -->
                                <div class="form-outline form-white mb-5">
                                    <label class="form-label" for="new_password_confirmation">{{ __('Confirm New Password') }} : </label>
                                    <input id="new_password_confirmation" type="password" class="form-control form-control-lg" name="new_password_confirmation" required autocomplete="new-password">
                                </div>

                                <button class="btn btn-outline-light btn-lg px-5 mt-4" type="submit">{{ __('Modifier le password') }}</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
