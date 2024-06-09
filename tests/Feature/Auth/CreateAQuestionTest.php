<?php

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new quertion bigger than 255 chars', function () {
    // Arrange
    $user = \App\Models\User::factory()->create();
    actingAs($user);

    // Act
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    // Assert
    $request->assertRedirect(route('dashboard'));

    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
    ]);

});

it('should check if ends with question mark', function () {

})->todo();

it('should have at least 10 charracteres', function () {

})->todo();
