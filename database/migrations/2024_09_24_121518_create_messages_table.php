<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute les migrations.
     */
    public function up(): void
    {
        // Crée la table messages
        Schema::create('messages', function (Blueprint $table) {
            // Identifiant unique de la ligne
            $table->id();

            // Identifiant de l'utilisateur qui a envoyé le message
            // La clé étrangère pointe vers la colonne id de la table users
            $table->foreignId('user_id')->constrained();

            // Identifiant de l'utilisateur destinataire du message
            $table->integer('recipient_id')->nullable(false)->default(0);

            // Texte du message
            $table->text('text')->nullable();

            // champ timestamps
            $table->timestamps();
        });
    }

    /**
     * Réinitialise les migrations.
     * Cétte fonction n'est pas encore utilisée.
     */
    public function down(): void
    {
        // Supprime la table messages
        Schema::dropIfExists('messages');
    }
};
