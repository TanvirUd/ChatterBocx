<?php

use App\Models\Message;
use App\Models\User;

it('can create a message', function () {
    $user = User::factory()->create();

    $response = Message::create([
        'user_id' => $user->id,
        'recipient_id' => 2,
        'text' => 'Hello World'
    ]);

    $this->assertDatabaseHas('messages', [
        'user_id' => $response->user_id,
        'recipient_id' => $response->recipient_id,
        'text' => $response->text     
    ]);

    $response->delete();
    $user->delete();
});

it('can get all messages by user', function () {
    $user = User::factory()->create();

    $message = Message::create([
        'user_id' => $user->id,
        'recipient_id' => 2,
        'text' => 'Hello World'
    ]);

    $this->actingAs($user)->get('/messages')->assertSee($message->text);
    $message->delete();
    $user->delete();
});

// TODO: Add message POST tests