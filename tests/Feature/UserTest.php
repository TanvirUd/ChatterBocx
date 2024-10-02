<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Comment this test on production
 */
it('populated some users to the database', function(){
    if(User::count() <= 0){
        User::factory()->create()->times(10);
    }

    $this->assertNotEmpty(User::all());
});

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