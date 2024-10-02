<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GotMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    
    /**
     * Instancie un nouveau GotMessage.
     *
     * @param array $message Un tableau contenant les informations du message (user_id, recipient_id, content)
     */
    public function __construct(public array $message)
    {
        //
    }




    /**
     * Spécifie les canaux de broadcast.
     * Les canaux de broadcast sont des canaux privés,
     * qui portent le nom de la classe du modèle "App\Models\User"
     * suivis de l'ID de l'utilisateur et de l'ID du destinataire.
     * @return array
     */
    public function broadcastOn(): array
    {
        // $this->message is available here
        
        return [
            new PrivateChannel("App.Models.User.{$this->message['user_id']}.{$this->message['recipient_id']}"),
            new PrivateChannel("App.Models.User.{$this->message['recipient_id']}.{$this->message['user_id']}"),
        ];
    }}
