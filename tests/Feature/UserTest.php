<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('can create a user', function () {
    $response = User::factory()->create();

    $this->assertDatabaseHas('users', [
        'name' => $response->name,
        'email' => $response->email,
        'password' => $response->password
    ]);

    $response->delete();
});

it('can delete a user', function () {
    $user = User::factory()->create();

    $user->delete();

    $this->assertDatabaseMissing('users', [
        'name' => $user->name,
        'email' => $user->email
    ]);
});

it('can update a user', function () {
    $user = User::factory()->create();
    $faker = \Faker\Factory::create();

    $name = $faker->name;
    $email = $faker->email;

    $user->update([
        'name' => $name,
        'email' => $email
    ]);

    $this->assertDatabaseHas('users', [
        'name' => $name,
        'email' => $email
    ]);

    $user->delete();
});

it('can get all users', function () {
    $users = User::all();
    $this->assertNotEmpty($users);
});

it('can get a user to login', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/home')->assertOk();

    $user->delete();
});

// TODO: Add user registration test