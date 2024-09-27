<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/**
 * Gère les canaux de broadcast pour les utilisateurs.
 *
 * @param  \App\Models\User  $user
 * @param  int  $id
 * @return bool
 */
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    // Vérifie que l'utilisateur courant est bien l'utilisateur connecté
    // pour éviter que des utilisateurs mal intentionnés ne puissent
    // écouter les messages des autres utilisateurs.
    return (int) $user->id === (int) $id;
});

